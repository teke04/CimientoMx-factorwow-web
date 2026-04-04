<?php

class Controlador_Pedidos extends Controlador_Admin_Base {

    public function verPedidos() {
        $this->cambiarSeleccion('pedidos');

        $estado_filtro = isset($_GET['estado']) ? trim($_GET['estado']) : '';
        $estados_validos = ['pendiente', 'pagado', 'cancelado'];

        $where  = '';
        $params = [];

        if (in_array($estado_filtro, $estados_validos)) {
            $where  = 'WHERE pe.estado = :estado';
            $params[':estado'] = $estado_filtro;
        }

        $pedidos = db()->ejecutarConsulta(
            "SELECT pe.id, pe.stripe_session_id, pe.email, pe.nombre,
                    pe.monto, pe.moneda, pe.estado, pe.creado,
                    pr.nombre AS producto_nombre
             FROM pedidos pe
             LEFT JOIN productos pr ON pr.id = pe.producto_id
             {$where}
             ORDER BY pe.creado DESC
             LIMIT 200",
            $params
        );

        $this->mostrar('admin/pedidos/ver-pedidos', [
            'usuario'        => $_SESSION['usuario'],
            'pedidos'        => $pedidos,
            'estado_filtro'  => $estado_filtro,
        ]);
    }
}
