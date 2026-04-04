<?php

/**
 * Migración v21: Agregar campos de contenido a tabla diplomados
 */
class V21AgregarCamposDiplomados {

    public function descripcion() {
        return "Agregar campos subtitulo_hero, descripcion_hero, subtitulo, descripcion a la tabla diplomados";
    }

    public function ejecutar() {
        $sql = "ALTER TABLE diplomados
                ADD COLUMN subtitulo_hero   VARCHAR(500) DEFAULT NULL AFTER generacion,
                ADD COLUMN descripcion_hero TEXT         DEFAULT NULL AFTER subtitulo_hero,
                ADD COLUMN subtitulo        VARCHAR(500) DEFAULT NULL AFTER descripcion_hero,
                ADD COLUMN descripcion      TEXT         DEFAULT NULL AFTER subtitulo";

        db()->ejecutarConsulta($sql);
    }
}
