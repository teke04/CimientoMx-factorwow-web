<?php
class Controlador_Leads extends Controlador_Admin_Base {

    public function verleads() {

        $this->cambiarSeleccion('leads');

        $sql = "
            SELECT 
                prospectos.id,
                prospectos.creada,
                landings.keyword,
                prospectos.nombre,
                prospectos.telefono,
                prospectos.correo,
                intereses.interes,
                servicios.servicio
            FROM 
                prospectos
            LEFT JOIN 
                landings ON prospectos.landing_id = landings.id
            LEFT JOIN 
                intereses ON prospectos.interes_id = intereses.id
            LEFT JOIN 
                servicios ON prospectos.servicio_id = servicios.id
            ORDER BY prospectos.creada DESC;
        ";

        $leads = db()->ejecutarConsulta($sql, []);

        $this->mostrar('admin/verleads',[
            'usuario' => $_SESSION['usuario'],
            'leads' => $leads,
        ]);
    }

    public function borrarLead(){
        $id = $_POST['lead_id'];
        $sql = "DELETE FROM prospectos WHERE id = :id";
        $params = [':id' => $id];
        db()->ejecutarConsulta($sql, $params);
        $this->verleads();
    }

}
?>
