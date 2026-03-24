<?php

/**
 * Migración v9: Poblar tabla landings
 * Inserta landing por defecto
 */
class V9PoblarTablaLandings {

    
    public function descripcion() {
        return "Insertar landing por defecto";
    }
    
    public function ejecutar() {
        $sql = "INSERT IGNORE INTO landings (keyword, h1, h2, meta_titulo, meta_descripcion, activa) 
                VALUES ('default', 'h1 default', 'h2 default', 'meta titulo default', 'meta descricion default', 1)";
        db()->ejecutarConsulta($sql);
    }
}

?>
