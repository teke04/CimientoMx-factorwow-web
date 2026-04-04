<?php
class V22AgregarImagenPreviewDiplomados {
    public function descripcion() {
        return 'Agrega columna imagen_preview a la tabla diplomados';
    }

    public function ejecutar() {
        db()->ejecutarConsulta(
            "ALTER TABLE diplomados ADD COLUMN imagen_preview VARCHAR(500) NULL AFTER url_temario",
            []
        );
    }
}
