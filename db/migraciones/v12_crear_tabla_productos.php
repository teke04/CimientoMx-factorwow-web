<?php

/**
 * Migración v12: Crear tabla productos
 * Tabla para almacenar los productos de la tienda
 */
class V12CrearTablaProductos {

    public function descripcion() {
        return "Crear tabla productos";
    }

    public function ejecutar() {
        $sql = "CREATE TABLE IF NOT EXISTS productos (
            id INT NOT NULL AUTO_INCREMENT,
            nombre VARCHAR(255) NOT NULL,
            precio DECIMAL(10,2) NOT NULL DEFAULT 0.00,
            precio_original DECIMAL(10,2) NULL,
            categoria ENUM('presencial','online','descargable') NOT NULL DEFAULT 'online',
            url_compra VARCHAR(500) NOT NULL DEFAULT '',
            imagen_url VARCHAR(500) NULL,
            activo TINYINT(1) NOT NULL DEFAULT 1,
            creado DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            INDEX idx_categoria (categoria),
            INDEX idx_activo (activo)
        )";
        db()->ejecutarConsulta($sql);
    }
}

?>
