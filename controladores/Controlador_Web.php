<?php
class Controlador_Web extends Controlador {

    public function __construct() {
        parent::__construct();
    }

    
    public function home() {
        $sql = "SELECT titulo, youtube_id FROM videos ORDER BY creado ASC LIMIT 3";
        $videos = db()->ejecutarConsulta($sql, []);
        $this->mostrar('web/home', [
            'videos' => $videos,
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

    public function diplomado() {
        $this->mostrar('web/diplomado',[
        ]);
    }

    public function tienda() {
        $this->mostrar('web/tienda',[
        ]);
    }

    public function acercaDe() {
        $this->mostrar('web/acerca-de',[
        ]);
    }

    public function webinars() {
        $this->mostrar('web/webinars',[
        ]);
    }

    public function blog() {
        $this->mostrar('web/blog',[
        ]);
    }


}
?>