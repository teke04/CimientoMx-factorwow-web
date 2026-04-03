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

    public function faq() {
        $this->mostrar('web/faq', []);
    }

    public function diplomado() {
        $this->mostrar('web/diplomado',[
        ]);
    }

    public function tienda() {
        $sql = "SELECT id, nombre, precio, precio_original, categoria, url_compra, url_interna, imagen_url
                FROM productos WHERE activo = 1 ORDER BY creado DESC";
        $productos = db()->ejecutarConsulta($sql, []);
        $this->mostrar('web/tienda', [
            'productos' => $productos,
        ]);
    }

    public function verProducto($slug) {
        // El slug viene como 'tienda/nombre-del-producto'
        if (strpos($slug, '/') !== false) {
            $slug = substr(strrchr($slug, '/'), 1);
        }
        $sql = "SELECT * FROM productos WHERE url_interna = :slug AND activo = 1 LIMIT 1";
        $rows = db()->ejecutarConsulta($sql, [':slug' => $slug]);
        if (empty($rows)) {
            http_response_code(404);
            $this->show404();
            return;
        }
        $this->mostrar('web/producto', [
            'producto' => $rows[0],
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