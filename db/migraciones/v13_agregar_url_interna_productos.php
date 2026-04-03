<?php

/**
 * Migración v13: Agregar columna url_interna a productos
 * Slug para la página de detalle de cada producto
 */
class V13AgregarUrlInternaProductos {

    public function descripcion() {
        return "Agregar columna url_interna a productos";
    }

    public function ejecutar() {
        $sql = "ALTER TABLE productos ADD COLUMN url_interna VARCHAR(255) NULL UNIQUE AFTER url_compra";
        db()->ejecutarConsulta($sql);
    }
}
