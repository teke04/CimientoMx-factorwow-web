<?php

/**
 * Migración v17: Crear tabla webinars
 */
class V17CrearTablaWebinars {

    public function descripcion() {
        return "Crear tabla webinars para el módulo de webinars";
    }

    public function ejecutar() {
        $sql = "CREATE TABLE IF NOT EXISTS webinars (
            id           INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            titulo       VARCHAR(255) NOT NULL,
            slug         VARCHAR(255) NOT NULL UNIQUE,
            extracto     TEXT,
            link_youtube VARCHAR(500),
            activo       TINYINT(1) NOT NULL DEFAULT 1,
            creado       TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

        db()->ejecutarConsulta($sql);
    }
}
