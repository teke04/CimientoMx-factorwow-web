<?php

class Controlador_Webhook extends Controlador {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Recibe eventos de Stripe via HTTP POST.
     * Stripe llama a esta URL automáticamente cuando ocurre un evento.
     * IMPORTANTE: esta ruta NO debe estar protegida por sesión.
     */
    public function recibir() {
        // Solo aceptar POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit;
        }

        $stripe_key    = env('STRIPE_SECRET_KEY', '');
        $webhook_secret = env('STRIPE_WEBHOOK_SECRET', '');

        if (empty($stripe_key) || empty($webhook_secret)) {
            http_response_code(500);
            logger()->error('Stripe: claves no configuradas en .env');
            exit;
        }

        \Stripe\Stripe::setApiKey($stripe_key);

        $payload   = file_get_contents('php://input');
        $sig_header = isset($_SERVER['HTTP_STRIPE_SIGNATURE']) ? $_SERVER['HTTP_STRIPE_SIGNATURE'] : '';

        try {
            $event = \Stripe\Webhook::constructEvent($payload, $sig_header, $webhook_secret);
        } catch (\UnexpectedValueException $e) {
            // Payload inválido
            http_response_code(400);
            exit;
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Firma inválida — posible intento de spoofing
            logger()->warning('Stripe webhook: firma inválida', ['error' => $e->getMessage()]);
            http_response_code(400);
            exit;
        }

        // Procesar eventos relevantes
        switch ($event->type) {
            case 'checkout.session.completed':
                $this->manejarPagoExitoso($event->data->object);
                break;

            case 'checkout.session.expired':
                $this->manejarSesionExpirada($event->data->object);
                break;

            default:
                // Ignorar eventos no manejados
                break;
        }

        http_response_code(200);
        echo json_encode(['received' => true]);
        exit;
    }

    private function manejarPagoExitoso(\Stripe\Checkout\Session $session) {
        $session_id     = $session->id;
        $email          = $session->customer_details->email ?? null;
        $nombre         = $session->customer_details->name  ?? null;
        $monto_pagado   = $session->amount_total ? $session->amount_total / 100 : 0;

        db()->ejecutarConsulta(
            "UPDATE pedidos
             SET estado = 'pagado', email = :email, nombre = :nombre, monto = :monto
             WHERE stripe_session_id = :sid AND estado = 'pendiente'",
            [
                ':email'  => $email,
                ':nombre' => $nombre,
                ':monto'  => $monto_pagado,
                ':sid'    => $session_id,
            ]
        );

        logger()->info('Stripe: pago completado', [
            'session_id' => $session_id,
            'email'      => $email,
        ]);
    }

    private function manejarSesionExpirada(\Stripe\Checkout\Session $session) {
        db()->ejecutarConsulta(
            "UPDATE pedidos SET estado = 'cancelado'
             WHERE stripe_session_id = :sid AND estado = 'pendiente'",
            [':sid' => $session->id]
        );
    }
}
