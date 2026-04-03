<?php

/**
 * Migración v16: Crear tabla articulos_blog
 */
class V16CrearTablaArticulosBlog {

    public function descripcion() {
        return "Crear tabla articulos_blog para el módulo de blog";
    }

    public function ejecutar() {
        $sql = "CREATE TABLE IF NOT EXISTS articulos_blog (
            id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            titulo      VARCHAR(255) NOT NULL,
            slug        VARCHAR(255) NOT NULL UNIQUE,
            extracto    TEXT,
            contenido   LONGTEXT,
            imagen_url  VARCHAR(500),
            activo      TINYINT(1) NOT NULL DEFAULT 1,
            creado      TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

        db()->ejecutarConsulta($sql);
    }
}
