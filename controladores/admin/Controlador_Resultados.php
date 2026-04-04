<?php
class Controlador_Resultados extends Controlador_Admin_Base {

    public function resultados() {

        $this->cambiarSeleccion('resultados');

        $sql = "
            SELECT 
                (SELECT COUNT(*) FROM prospectos)                          AS total_leads,
                (SELECT COUNT(*) FROM videos)                             AS total_videos,
                (SELECT COUNT(*) FROM productos   WHERE activo = 1)       AS total_productos,
                (SELECT COUNT(*) FROM pedidos)                            AS total_pedidos,
                (SELECT COUNT(*) FROM articulos_blog WHERE activo = 1)    AS total_articulos,
                (SELECT COUNT(*) FROM webinars    WHERE activo = 1)       AS total_webinars,
                (SELECT COUNT(*) FROM diplomados  WHERE activo = 1)       AS total_diplomados
        ";

        $resultado = db()->ejecutarConsulta($sql, []);
        $stats = $resultado[0] ?? [];

        $this->mostrar('admin/resultados',[
            'usuario' => $_SESSION['usuario'],
            'stats'   => $stats,
        ]);
    }

}
?>
