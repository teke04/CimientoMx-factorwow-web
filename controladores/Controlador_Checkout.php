<?php

class Controlador_Checkout extends Controlador {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Crea una Stripe Checkout Session y redirige al checkout hospedado.
     * Acepta el id del producto via POST (campo producto_id) o en la URL.
     */
    public function iniciar($segmento = '') {
        // Priorizar POST (formulario de tienda/producto)
        if (isset($_POST['producto_id'])) {
            $id = (int)$_POST['producto_id'];
        } elseif ($segmento) {
            // Extraer ID numérico del segmento "checkout/{id}"
            if (strpos($segmento, '/') !== false) {
                $id = (int) substr(strrchr($segmento, '/'), 1);
            } else {
                $id = (int) $segmento;
            }
        } else {
            $id = 0;
        }

        if (!$id) {
            http_response_code(400);
            $this->show404();
            return;
        }

        // Obtener producto
        $rows = db()->ejecutarConsulta(
            "SELECT id, nombre, precio, stripe_price_id FROM productos WHERE id = :id AND activo = 1 LIMIT 1",
            [':id' => $id]
        );

        if (empty($rows)) {
            http_response_code(404);
            $this->show404();
            return;
        }

        $producto = $rows[0];

        // Verificar que tiene stripe_price_id configurado
        if (empty($producto['stripe_price_id'])) {
            // Si no tiene Price ID de Stripe, redirigir de vuelta a la tienda
            header('Location: ' . ruta('tienda'));
            exit;
        }

        $stripe_key = env('STRIPE_SECRET_KEY', '');
        if (empty($stripe_key)) {
            http_response_code(500);
            logger()->error('STRIPE_SECRET_KEY no configurada en .env');
            $this->mostrar('web/checkout-error', ['mensaje' => 'El sistema de pago no está disponible en este momento.']);
            return;
        }

        \Stripe\Stripe::setApiKey($stripe_key);

        try {
            $session = \Stripe\Checkout\Session::create([
                'mode'        => 'payment',
                'line_items'  => [[
                    'price'    => $producto['stripe_price_id'],
                    'quantity' => 1,
                ]],
                'success_url' => ruta('checkout/exito') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url'  => ruta('checkout/cancelado') . '?producto_id=' . $producto['id'],
                'metadata'    => [
                    'producto_id'   => $producto['id'],
                    'producto_nombre' => $producto['nombre'],
                ],
            ]);

            // Registrar pedido como pendiente
            db()->ejecutarConsulta(
                "INSERT INTO pedidos (producto_id, stripe_session_id, monto, moneda, estado)
                 VALUES (:producto_id, :session_id, :monto, 'mxn', 'pendiente')",
                [
                    ':producto_id' => $producto['id'],
                    ':session_id'  => $session->id,
                    ':monto'       => $producto['precio'],
                ]
            );

            header('Location: ' . $session->url);
            exit;

        } catch (\Stripe\Exception\ApiErrorException $e) {
            logger()->error('Error al crear Stripe Session: ' . $e->getMessage());
            $this->mostrar('web/checkout-error', ['mensaje' => 'No se pudo iniciar el proceso de pago. Intenta más tarde.']);
        }
    }

    /**
     * Página que muestra Stripe tras un pago exitoso.
     */
    public function exito() {
        $session_id = isset($_GET['session_id']) ? trim($_GET['session_id']) : '';

        $pedido = null;
        $producto = null;

        if ($session_id) {
            $rows = db()->ejecutarConsulta(
                "SELECT p.*, pr.nombre AS producto_nombre
                 FROM pedidos p
                 LEFT JOIN productos pr ON pr.id = p.producto_id
                 WHERE p.stripe_session_id = :sid LIMIT 1",
                [':sid' => $session_id]
            );
            if (!empty($rows)) {
                $pedido = $rows[0];
            }
        }

        $this->mostrar('web/checkout-exito', ['pedido' => $pedido]);
    }

    /**
     * Página que muestra Stripe si el usuario cancela.
     */
    public function cancelado() {
        $producto_id = isset($_GET['producto_id']) ? (int)$_GET['producto_id'] : null;

        $producto = null;
        if ($producto_id) {
            $rows = db()->ejecutarConsulta(
                "SELECT id, nombre, url_interna FROM productos WHERE id = :id AND activo = 1 LIMIT 1",
                [':id' => $producto_id]
            );
            if (!empty($rows)) $producto = $rows[0];
        }

        $this->mostrar('web/checkout-cancelado', ['producto' => $producto]);
    }
}
