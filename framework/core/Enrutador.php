
<?php
/**
 * Clase para manejar el sistema de enrutamiento
 */
class Enrutador {
    private static $instance = null;
    private static $inicializado = false;
    private $rutas = [];

    public function agregarRuta($ruta, $controlador, $metodo) {
        $controlador = trim($controlador, '/');
        
        // Validar que la clase del controlador existe
        if (!class_exists($controlador)) {
            throw new Exception("Error al registrar ruta '{$ruta}': El controlador '{$controlador}' no existe.");
        }
        
        // Validar que el método existe en el controlador
        if (!method_exists($controlador, $metodo)) {
            throw new Exception("Error al registrar ruta '{$ruta}': El método '{$metodo}' no existe en el controlador '{$controlador}'.");
        }
        
        $this->rutas[trim($ruta,'/')] = [$controlador, $metodo];
    }

    /**
     * Devuelve la lista de rutas guardadas en el enrutador
     * @return array
     */
    public function listarRutas() {
        return $this->rutas;
    }

    private function cargarRutasLandings() {
        $sql = "SELECT keyword FROM landings WHERE activa = 1";
        $sqlReply = db()->ejecutarConsulta($sql, []);
        foreach ($sqlReply as $row) {
            $this->rutas[$row['keyword']] = ['Controlador_Landing', 'keyword'];
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function inicializar() {
        if (self::$inicializado) {
            return;
        }
        self::$inicializado = true;
        
        inicializarRutas();
        if (env('MODO_PROYECTO') === 'landing') {
            self::getInstance()->cargarRutasLandings();
        }
        self::iniciarEnrutamiento();
    }

    private static function iniciarEnrutamiento() {
        $enrutador = self::getInstance();
        // Forzar https en producción
        if (env('ENVIRONMENT') === 'production' && (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on')) {
            $httpsUrl = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            header('Location: ' . $httpsUrl);
            exit;
        }

        $requestUri = $_SERVER['REQUEST_URI'];
        if (env('ENVIRONMENT') === 'development') {
            $requestUri = str_replace(str_replace('http://localhost/', '', env('DOMINIO')), '', $_SERVER['REQUEST_URI']);
        }
        $requestUri = trim($requestUri, '/');

        if (array_key_exists($requestUri, $enrutador->rutas)) {
            $nombreControlador = $enrutador->rutas[$requestUri][0];
            $nombreMetodo = $enrutador->rutas[$requestUri][1];

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
?>