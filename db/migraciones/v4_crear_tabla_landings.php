<?php

/**
 * Migración v4: Crear tabla landings con trigger
 * Tabla de landing pages y trigger de eliminación
 */
class V4CrearTablaLandings {

    
    public function descripcion() {
        return "Crear tabla landings y trigger before_landing_delete";
    }
    
    public function ejecutar() {
        // Crear tabla landings
        $sql = "CREATE TABLE IF NOT EXISTS landings (
            id INT NOT NULL AUTO_INCREMENT,
            keyword VARCHAR(50) NOT NULL,
            h1 VARCHAR(100),
            h2 VARCHAR(100),
            meta_titulo VARCHAR(150),
            meta_descripcion VARCHAR(255),
            activa BOOLEAN DEFAULT 1,
            creada DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            INDEX idx_keyword (keyword)
        )";
        db()->ejecutarConsulta($sql);
        
        // Eliminar trigger si existe
        $sql = "DROP TRIGGER IF EXISTS before_landing_delete";
        db()->ejecutarConsulta($sql);
        
        // Crear trigger
        $sql = "CREATE TRIGGER before_landing_delete
            BEFORE DELETE ON landings
            FOR EACH ROW
            BEGIN
                UPDATE prospectos SET landing_id = 1 WHERE landing_id = OLD.id;
            END";
        db()->ejecutarConsulta($sql);
    }
}

?>
