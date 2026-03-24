<?php
class Controlador_Admin_Base extends Controlador {
    
    public function __construct() {
        parent::__construct();
        $this->verificar_sesion();
    }

}