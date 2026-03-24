<?php

/**
 * Migración v7: Poblar tabla intereses
 * Inserta intereses de ejemplo
 */
class V7PoblarTablaIntereses {

    
    public function descripcion() {
        return "Insertar intereses de ejemplo";
    }
    
    public function ejecutar() {
        $intereses = ['Interés 1', 'Interés 2', 'Interés 3', 'Interés 4', 'Interés 5'];
        
        foreach ($intereses as $interes) {
            $sql = "INSERT IGNORE INTO intereses (interes) VALUES (:interes)";
            db()->ejecutarConsulta($sql, [':interes' => $interes]);
        }
    }
}

?>
