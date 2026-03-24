<?php

/**
 * Migración v6: Poblar tabla users
 * Inserta usuario administrador por defecto
 */
class V6PoblarTablaUsers {

    
    public function descripcion() {
        return "Insertar usuario administrador";
    }
    
    public function ejecutar() {
        // Ruta del archivo de usuarios iniciales
        $archivoUsuarios = __DIR__ . '/../usuarios_iniciales.php';
        
        // Verificar si el archivo existe
        if (!file_exists($archivoUsuarios)) {
            return; // El archivo ya fue eliminado o no existe
        }
        
        // Cargar usuarios desde el archivo
        $usuarios = require $archivoUsuarios;
        
        // Insertar usuarios
        foreach ($usuarios as $usuario) {
            $passwordHash = password_hash($usuario[1], PASSWORD_DEFAULT);
            
            $sql = "INSERT IGNORE INTO users (username, pass, email) 
                    VALUES (:username, :pass, :email)";
            db()->ejecutarConsulta($sql, [
                ':username' => $usuario[0],
                ':pass' => $passwordHash,
                ':email' => $usuario[2]
            ]);
        }
        
        // Si estamos en producción, eliminar el archivo de usuarios
        if (env('ENVIRONMENT') === 'production') {
            unlink($archivoUsuarios);
        }
    }
}

?>
