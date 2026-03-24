<?php

/**
 * Clase para gestionar migraciones de base de datos
 * Sistema de versionado para aplicar cambios automáticamente
 * Lee archivos de la carpeta db/migraciones/ y los ejecuta en orden
 */
class Migraciones {
    private $db;
    
    public function __construct($database) {
        $this->db = $database;
    }
    
    /**
     * Obtiene todas las migraciones disponibles en la carpeta db/migraciones/
     */
    private function obtenerArchivosMigraciones() {
        $carpeta = __DIR__ . '/../db/migraciones/';
        $archivos = glob($carpeta . 'v*.php');
        
        $migraciones = [];
        
        foreach ($archivos as $archivo) {
            $nombreArchivo = basename($archivo, '.php');
            
            // Extraer versión (ej: v1_agregar_campo -> v1)
            preg_match('/^v(\d+)_/', $nombreArchivo, $matches);
            if (isset($matches[1])) {
                $version = 'v' . $matches[1];
                $migraciones[$version] = [
                    'archivo' => $archivo,
                    'nombreArchivo' => $nombreArchivo
                ];
            }
        }
        
        // Ordenar por número de versión
        uksort($migraciones, function($a, $b) {
            $numA = (int)str_replace('v', '', $a);
            $numB = (int)str_replace('v', '', $b);
            return $numA - $numB;
        });
        
        return $migraciones;
    }
    
    /**
     * Verifica si una versión ya fue ejecutada
     */
    private function versionEjecutada($version) {
        $sql = "SELECT * FROM db_versiones WHERE version = :version";
        $result = $this->db->ejecutarConsulta($sql, [':version' => $version]);
        return !empty($result);
    }
    
    /**
     * Registra una versión como ejecutada
     */
    private function registrarVersion($version, $descripcion) {
        $sql = "INSERT INTO db_versiones (version, descripcion) VALUES (:version, :descripcion)";
        $this->db->ejecutarConsulta($sql, [
            ':version' => $version,
            ':descripcion' => $descripcion
        ]);
    }
    
    /**
     * Ejecuta todas las migraciones pendientes
     */
    public function ejecutarPendientes() {
        $migraciones = $this->obtenerArchivosMigraciones();
        
        foreach ($migraciones as $version => $info) {
            if (!$this->versionEjecutada($version)) {
                // Cargar el archivo de migración
                require_once $info['archivo'];
                
                // Construir nombre de clase basado en el nombre del archivo
                // vagregar_campo -> AgregarCampo
                $nombreClase = str_replace('_', ' ', $info['nombreArchivo']);
                $nombreClase = ucwords($nombreClase);
                $nombreClase = str_replace(' ', '', $nombreClase);
                
                // Instanciar y ejecutar la migración
                if (class_exists($nombreClase)) {
                    $migracion = new $nombreClase($this->db);
                    $migracion->ejecutar();
                    
                    // Obtener descripción si el método existe
                    $descripcion = method_exists($migracion, 'descripcion') 
                        ? $migracion->descripcion() 
                        : $info['nombreArchivo'];
                    
                    // Registrar como ejecutada
                    $this->registrarVersion($version, $descripcion);
                }
            }
        }
        
        return $this;
    }
}

/**
 * Inicializa el sistema de migraciones
 */
function inicializarMigraciones() {
    global $migraciones;
    
    if (!isset($migraciones)) {
        $migraciones = new Migraciones($GLOBALS['db']);
        $migraciones->ejecutarPendientes();
    }
}

?>
