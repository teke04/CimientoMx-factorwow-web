<?php

/**
 * Clase para manejar el sistema de enrutamiento
 */
class Enrutador {
    private $rutas = [];
    
    /**
     * Agregar una ruta al sistema
     */
    public function agregarRuta($ruta, $controlador, $metodo) {
        $this->rutas[trim($ruta,'/')] = [trim($controlador,'/'), $metodo];
    }
    
    /**
     * Cargar rutas dinámicas de landings desde la base de datos
     */
    public function cargarRutasLandings() {
        global $db;
        
        $sql = "SELECT keyword FROM landings WHERE activa = 1";
        $sqlReply = $db->ejecutarConsulta($sql, []);
        
        foreach ($sqlReply as $row) {
            $this->rutas[$row['keyword']] = ['Controlador_Landing', 'keyword'];
        }
    }
    
    
    /**
     * Ejecutar el enrutamiento
     */
    public function ejecutar() {
        //Forzar https en produccion
        if (env('ENVIRONMENT') === 'production' && (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on')) {
            $httpsUrl = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            header('Location: ' . $httpsUrl);
            exit;
        }

        //URI personalizada para entorno de desarrollo
        $requestUri = $_SERVER['REQUEST_URI'];
        if (env('ENVIRONMENT') === 'development') {
            $requestUri = str_replace(str_replace('http://localhost/', '', env('DOMINIO')), '', $_SERVER['REQUEST_URI']);
        }
        $requestUri = trim($requestUri, '/');

        // Verificar si la ruta existe en el arreglo de rutas
        if (array_key_exists($requestUri, $this->rutas)) {
            $nombreControlador = $this->rutas[$requestUri][0];
            $nombreMetodo = $this->rutas[$requestUri][1];

            $controller = new $nombreControlador();

            if ($nombreMetodo === 'keyword') {
                $controller->$nombreMetodo($requestUri);
            } else {
                $controller->$nombreMetodo();
            }
        } else {
            http_response_code(404);
            $controller = new Controlador_Web();
            $controller->show404();
        }
    }
}

/**
 * Función para iniciar el sistema de enrutamiento
 */
function iniciarEnrutamiento() {
    global $enrutador;
    $enrutador->ejecutar();
}

/**
 * Función para inicializar el enrutador
 */
function inicializarEnrutamiento() {
    global $enrutador;
    $enrutador = new Enrutador();
}

?>