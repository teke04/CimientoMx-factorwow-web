<?php

/**
 * Migración v10: Crear tabla configuraciones
 * Tabla para almacenar configuraciones del sistema
 */
class V10CrearTablaConfiguraciones {

    public function descripcion() {
        return "Crear tabla configuraciones";
    }
    
    public function ejecutar() {
        // Crear tabla configuraciones
        $sql = "CREATE TABLE IF NOT EXISTS configuraciones (
            id INT NOT NULL AUTO_INCREMENT,
            clave VARCHAR(50) NOT NULL UNIQUE,
            valor TEXT,
            actualizada DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            INDEX idx_clave (clave)
        )";
            db()->ejecutarConsulta($sql);
        
        // Insertar valores por defecto
        $configuraciones = [
            ['clave' => 'tag_manager_head', 'valor' => ''],
            ['clave' => 'tag_manager_body', 'valor' => ''],
            ['clave' => 'telefono', 'valor' => ''],
            ['clave' => 'whatsapp_num', 'valor' => ''],
            ['clave' => 'whatsapp_msg', 'valor' => ''],
            ['clave' => 'correo_leads', 'valor' => ''],
            ['clave' => 'correo_errores', 'valor' => ''],
            ['clave' => 'modo_dashboard', 'valor' => 'claro']
        ];
        
        foreach ($configuraciones as $config) {
            $sql = "INSERT INTO configuraciones (clave, valor) 
                    VALUES (:clave, :valor)
                    ON DUPLICATE KEY UPDATE valor = valor";
                db()->ejecutarConsulta($sql, [
                ':clave' => $config['clave'],
                ':valor' => $config['valor']
            ]);
        }
    }
}

?>
