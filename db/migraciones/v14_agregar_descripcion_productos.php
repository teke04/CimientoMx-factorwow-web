<?php

/**
 * Migración v14: Agregar columna descripcion a productos
 */
class V14AgregarDescripcionProductos {

    public function descripcion() {
        return "Agregar columna descripcion a productos";
    }

    public function ejecutar() {
        $sql = "ALTER TABLE productos ADD COLUMN descripcion TEXT NULL AFTER nombre";
        db()->ejecutarConsulta($sql);
    }
}
