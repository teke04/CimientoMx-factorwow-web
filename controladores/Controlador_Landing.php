<?php
class Controlador_Landing extends Controlador {
    
    public function keyword($keyword) {

        if (strpos($keyword, '/') !== false) {
            $keyword = substr(strrchr($keyword, "/"), 1);
        }

        if (empty($keyword)) {
            $keyword = 'default';
        }

        $sql      = "SELECT * FROM landings WHERE keyword = :keyword limit 1";
        $params   = [':keyword' => $keyword];
        $sqlReply = db()->ejecutarConsulta($sql, $params)[0];



        $sql       = "SELECT * FROM intereses";
        $intereses = db()->ejecutarConsulta($sql, []);

        $sql       = "SELECT * FROM servicios";
        $servicios = db()->ejecutarConsulta($sql, []);

        $this->mostrar('landing/home',[
            'keyword'          => $sqlReply['keyword'],
            'h1'               => $sqlReply['h1'],
            'h2'               => $sqlReply['h2'],
            'landing_id'       => $sqlReply['id'],
            'intereses'        => $intereses,
            'servicios'        => $servicios
        ]);
    }
}
?>