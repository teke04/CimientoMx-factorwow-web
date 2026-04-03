<?php

/**
 * Migración v15: Agregar 'otros' al ENUM categoria de productos
 */
class V15AgregarOtrosCategoriaProductos {

    public function descripcion() {
        return "Agregar valor 'otros' al ENUM categoria de productos";
    }

    public function ejecutar() {
        $sql = "ALTER TABLE productos MODIFY COLUMN categoria ENUM('presencial','online','descargable','otros') NOT NULL DEFAULT 'online'";
        db()->ejecutarConsulta($sql);
    }
}
