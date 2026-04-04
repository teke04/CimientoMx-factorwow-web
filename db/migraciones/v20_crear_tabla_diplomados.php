<?php

/**
 * Migración v20: Crear tabla diplomados
 */
class V20CrearTablaDiplomados {

    public function descripcion() {
        return "Crear tabla diplomados para el módulo de diplomados";
    }

    public function ejecutar() {
        $sql = "CREATE TABLE IF NOT EXISTS diplomados (
            id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            titulo      VARCHAR(255) NOT NULL,
            slug        VARCHAR(255) NOT NULL UNIQUE,
            generacion  VARCHAR(100) DEFAULT NULL,
            extracto    TEXT DEFAULT NULL,
            url_temario VARCHAR(500) DEFAULT NULL,
            activo      TINYINT(1) NOT NULL DEFAULT 1,
            creado      TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

        db()->ejecutarConsulta($sql);
    }
}
