<?php

/**
 * Migración v19: Crear tabla pedidos
 * Registra cada intento de compra via Stripe Checkout
 */
class V19CrearTablaPedidos {

    public function descripcion() {
        return "Crear tabla pedidos para integración con Stripe";
    }

    public function ejecutar() {
        db()->ejecutarConsulta(
            "CREATE TABLE IF NOT EXISTS pedidos (
                id                 INT NOT NULL AUTO_INCREMENT,
                producto_id        INT NOT NULL,
                stripe_session_id  VARCHAR(255) NOT NULL UNIQUE,
                email              VARCHAR(255) NULL,
                nombre             VARCHAR(255) NULL,
                monto              DECIMAL(10,2) NOT NULL DEFAULT 0.00,
                moneda             VARCHAR(10)   NOT NULL DEFAULT 'mxn',
                estado             ENUM('pendiente','pagado','cancelado') NOT NULL DEFAULT 'pendiente',
                creado             DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                actualizado        DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (id),
                INDEX idx_estado (estado),
                INDEX idx_producto (producto_id),
                INDEX idx_session (stripe_session_id)
            )"
        );
    }
}
