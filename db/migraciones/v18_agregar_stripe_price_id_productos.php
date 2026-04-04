<?php

/**
 * Migración v18: Agregar stripe_price_id a productos
 * Almacena el Price ID de Stripe (ej: price_abc123) para el checkout nativo
 */
class V18AgregarStripePriceIdProductos {

    public function descripcion() {
        return "Agregar columna stripe_price_id a productos";
    }

    public function ejecutar() {
        db()->ejecutarConsulta(
            "ALTER TABLE productos ADD COLUMN stripe_price_id VARCHAR(100) NULL DEFAULT NULL AFTER url_compra"
        );
    }
}
