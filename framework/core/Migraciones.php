<?php

/**
 * Clase para gestionar migraciones de base de datos
 * Sistema de versionado para aplicar cambios automáticamente
 * Lee archivos de la carpeta db/migraciones/ y los ejecuta en orden
 */

class Migraciones {
    private static $inicializado = false;
    
    public function __construct() {
        // Constructor vacío
    }

    public static function inicializar() {
        if (self::$inicializado) {
            return;
        }
        self::$inicializado = true;
        
        global $migraciones;
        if (!isset($migraciones)) {
            $migraciones = new Migraciones();
            $migraciones->ejecutarPendientes();
        }
    }

    private function obtenerArchivosMigraciones() {
        $carpeta = __DIR__ . '/../../db/migraciones/';
        $archivos = glob($carpeta . 'v*.php');
        $migraciones = [];
        foreach ($archivos as $archivo) {
            $nombreArchivo = basename($archivo, '.php');
            preg_match('/^v(\d+)_/', $nombreArchivo, $matches);
            if (isset($matches[1])) {
                $version = 'v' . $matches[1];
                $migraciones[$version] = [
                    'archivo' => $archivo,
                    'nombreArchivo' => $nombreArchivo
                ];
            }
        }
        uksort($migraciones, function($a, $b) {
            $numA = (int)str_replace('v', '', $a);
            $numB = (int)str_replace('v', '', $b);
            return $numA - $numB;
        });
        return $migraciones;
    }

    private function versionEjecutada($version) {
        $sql = "SELECT * FROM db_versiones WHERE version = :version";
        $result = db()->ejecutarConsulta($sql, [':version' => $version]);
        return !empty($result);
    }

    private function registrarVersion($version, $descripcion) {
        $sql = "INSERT INTO db_versiones (version, descripcion) VALUES (:version, :descripcion)";
        db()->ejecutarConsulta($sql, [
            ':version' => $version,
            ':descripcion' => $descripcion
        ]);
    }

    public function ejecutarPendientes() {
        $migraciones = $this->obtenerArchivosMigraciones();
        foreach ($migraciones as $version => $info) {
            if (!$this->versionEjecutada($version)) {
                require_once $info['archivo'];
                $nombreClase = str_replace('_', ' ', $info['nombreArchivo']);
                $nombreClase = ucwords($nombreClase);
                $nombreClase = str_replace(' ', '', $nombreClase);
                if (class_exists($nombreClase)) {
                    $migracion = new $nombreClase();
                    $migracion->ejecutar();
                    $descripcion = method_exists($migracion, 'descripcion') 
                        ? $migracion->descripcion() 
                        : $info['nombreArchivo'];
                    $this->registrarVersion($version, $descripcion);
                }
            }
        }
        return $this;
    }

}

?>
