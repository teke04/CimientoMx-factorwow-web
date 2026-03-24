<?php

/**
 * Migración v5: Crear tabla prospectos
 * Tabla de prospectos/leads con relaciones a otras tablas
 */
class V5CrearTablaProspectos {

    
    public function descripcion() {
        return "Crear tabla prospectos";
    }
    
    public function ejecutar() {
        $sql = "CREATE TABLE IF NOT EXISTS prospectos (
            id INT NOT NULL AUTO_INCREMENT,
            creada DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            nombre VARCHAR(50),
            telefono VARCHAR(20),
            correo VARCHAR(100),
            interes_id INT,
            servicio_id INT,
            landing_id INT DEFAULT 0,
            PRIMARY KEY (id),
            FOREIGN KEY (interes_id) REFERENCES intereses(id),
            FOREIGN KEY (servicio_id) REFERENCES servicios(id)
        )";
        db()->ejecutarConsulta($sql);
    }
}

?>
