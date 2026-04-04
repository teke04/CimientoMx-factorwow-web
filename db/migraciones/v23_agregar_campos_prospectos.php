<?php
class V23AgregarCamposProspectos {
    public function descripcion() {
        return 'Agrega columnas pais, ciudad y mensaje a la tabla prospectos';
    }

    public function ejecutar() {
        db()->ejecutarConsulta("ALTER TABLE prospectos ADD COLUMN pais VARCHAR(100) NULL AFTER correo", []);
        db()->ejecutarConsulta("ALTER TABLE prospectos ADD COLUMN ciudad VARCHAR(100) NULL AFTER pais", []);
        db()->ejecutarConsulta("ALTER TABLE prospectos ADD COLUMN mensaje TEXT NULL AFTER ciudad", []);
    }
}
