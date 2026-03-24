<?php

/**
 * Migración v2: Crear tabla intereses
 * Tabla de intereses disponibles
 */
class V2CrearTablaIntereses {

    
    public function descripcion() {
        return "Crear tabla intereses";
    }
    
    public function ejecutar() {
        $sql = "CREATE TABLE IF NOT EXISTS intereses (
            id INT AUTO_INCREMENT PRIMARY KEY,
            interes VARCHAR(100) NOT NULL
        )";
        db()->ejecutarConsulta($sql);
    }
}

?>
