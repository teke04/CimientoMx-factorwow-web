<?php
class Controlador_Web extends Controlador {

    public function __construct() {
        parent::__construct();
    }

    
    public function home() {
        $this->mostrar('web/home',[
        ]);
    }
    
    public function pagina2() {
        $this->mostrar('web/pagina2',[
        ]);
    }
    
    public function pagina3() {
        $this->mostrar('web/pagina3',[
        ]);
    }

    public function contacto() {
        $this->mostrar('web/contacto',[
        ]);
    }


}
?>