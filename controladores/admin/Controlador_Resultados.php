<?php
class Controlador_Resultados extends Controlador_Admin_Base {

    public function resultados() {

        $this->cambiarSeleccion('resultados');

        $sql = "
            SELECT 
                landings.keyword AS landing,
                COUNT(prospectos.id) AS total_leads
            FROM 
                landings
            LEFT JOIN 
                prospectos ON landings.id = prospectos.landing_id
            GROUP BY 
                landings.id
            ORDER BY 
                total_leads DESC
            LIMIT 5;
        ";

        $landings = db()->ejecutarConsulta($sql, []);

        $this->mostrar('admin/resultados',[
            'usuario' => $_SESSION['usuario'],
            'landings' => $landings,
        ]);
    }

}
?>
