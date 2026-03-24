<?php

/**
 * Migración v8: Poblar tabla servicios
 * Inserta servicios de ejemplo
 */
class V8PoblarTablaServicios {

    
    public function descripcion() {
        return "Insertar servicios de ejemplo";
    }
    
    public function ejecutar() {
        $servicios = ['Servicio 1', 'Servicio 2', 'Servicio 3', 'Servicio 4', 'Servicio 5'];
        
        foreach ($servicios as $servicio) {
            $sql = "INSERT IGNORE INTO servicios (servicio) VALUES (:servicio)";
            db()->ejecutarConsulta($sql, [':servicio' => $servicio]);
        }
    }
}

?>
