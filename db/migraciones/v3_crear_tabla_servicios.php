<?php

/**
 * Migración v3: Crear tabla servicios
 * Tabla de servicios ofrecidos
 */
class V3CrearTablaServicios {

    
    public function descripcion() {
        return "Crear tabla servicios";
    }
    
    public function ejecutar() {
        $sql = "CREATE TABLE IF NOT EXISTS servicios (
            id INT AUTO_INCREMENT PRIMARY KEY,
            servicio VARCHAR(100) NOT NULL
        )";
        db()->ejecutarConsulta($sql);
    }
}

?>
