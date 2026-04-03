<?php

/**
 * Migración v11: Crear tabla videos
 * Tabla para almacenar los links de videos de YouTube que se muestran en los testimonios
 */
class V11CrearTablaVideos {

    public function descripcion() {
        return "Crear tabla videos";
    }

    public function ejecutar() {
        $sql = "CREATE TABLE IF NOT EXISTS videos (
            id INT NOT NULL AUTO_INCREMENT,
            titulo VARCHAR(255) NOT NULL,
            youtube_id VARCHAR(50) NOT NULL,
            creado DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id)
        )";
        db()->ejecutarConsulta($sql);
    }
}

?>
