<?php

/**
 * Migración v1: Crear tabla users
 * Tabla de usuarios del sistema
 */
class V1CrearTablaUsers {

    
    public function descripcion() {
        return "Crear tabla users";
    }
    
    public function ejecutar() {
        $sql = "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(30) NOT NULL,
            pass VARCHAR(64) NOT NULL,
            email VARCHAR(100) NOT NULL,
            creado DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            ultima_modificacion DATETIME
        )";
        db()->ejecutarConsulta($sql);
        
        // Crear índice (solo si no existe)
        try {
            $sql = "CREATE INDEX idx_username ON users(username)";
            db()->ejecutarConsulta($sql);
        } catch (Exception $e) {
            // El índice ya existe, ignorar error
        }
    }
}

?>
