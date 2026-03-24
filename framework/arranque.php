<?php

/**
 * Clase Framework - Patrón Singleton
 * Gestiona el ciclo de vida completo del framework
 */
class Framework {
    //Clases para forzar una única instancia
    private static $instancia = null;
    
    private function __construct() {}
    
    private function __clone() {}
    
    public function __wakeup() {
        throw new Exception("No se puede deserializar un Singleton");
    }
    
    public static function obtenerInstancia() {
        if (self::$instancia === null) {
            self::$instancia = new self();
        }
        return self::$instancia;
    }
    
    // Registra un autoloader para cargar clases desde múltiples directorios
    private function registrarAutoloader($directorios) {
        // Convertir a array si se pasa un solo directorio
        if (!is_array($directorios)) {
            $directorios = [$directorios];
        }
        
        spl_autoload_register(function ($class) use ($directorios) {
            foreach ($directorios as $directorio) {
                $iterator = new RecursiveIteratorIterator(
                    new RecursiveDirectoryIterator($directorio),
                    RecursiveIteratorIterator::LEAVES_ONLY
                );
                foreach ($iterator as $file) {
                    if ($file->isFile() && $file->getExtension() === 'php') {
                        if (basename($file->getFilename(), '.php') === $class) {
                            require_once $file->getPathname();
                            return;
                        }
                    }
                }
            }
        });
        return $this;
    }
    
    // Carga archivos auxiliares (rutas y funciones)
    private function cargarArchivos() {
        require_once __DIR__ . '/../rutas.php';
        require_once __DIR__ . '/funciones.php';
        return $this;
    }
    
    // Lista de componentes core en orden de inicialización
    private $componentes = [
        'Logger',
        'Errores',
        'Entorno',
        'Db',
        'Migraciones',
        'Enrutador'
    ];
    
    // Inicializa todos los componentes core
    private function inicializarCore() {
        foreach ($this->componentes as $componente) {
            $componente::inicializar();
        }
        return $this;
    }
    
    public function iniciar() {
        $this->registrarAutoloader([
                __DIR__ . '/../controladores/',
                __DIR__ . '/core/'
             ])
             ->cargarArchivos()
             ->inicializarCore();
    }
}

?>
