<?php

/**
 * Clase para gestionar el registro de logs del sistema
 * Niveles de log: DEBUG, INFO, WARNING, ERROR, CRITICAL
 * Características:
 * - Rotación automática de archivos por tamaño
 * - Formato configurable
 * - Contexto adicional para debugging
 */
class Logger {
    private static $instance;
    private static $inicializado = false;
    private $directorioLogs;
    private $tamañoMaximo; // En bytes
    private $nivel_minimo;
    
    // Niveles de log (mayor número = mayor severidad)
    const DEBUG = 1;
    const INFO = 2;
    const WARNING = 3;
    const ERROR = 4;
    const CRITICAL = 5;
    
    /**
     * Constructor
     * @param string $directorio - Directorio donde guardar los logs (default: logs/)
     * @param int $tamañoMaximo - Tamaño máximo en bytes antes de rotar (default: 5MB)
     * @param int $nivel_minimo - Nivel mínimo a registrar (default: INFO en producción, DEBUG en desarrollo)
     */
    private function __construct($directorio = null, $tamañoMaximo = 5242880, $nivel_minimo = null) {
        if ($directorio === null) {
            $directorio = __DIR__ . '/../../logs';
        }
        $this->directorioLogs = rtrim($directorio, '/\\');
        $this->tamañoMaximo = $tamañoMaximo;
        if ($nivel_minimo === null) {
            $this->nivel_minimo = (env('ENVIRONMENT') === 'development') ? self::DEBUG : self::INFO;
        } else {
            $this->nivel_minimo = $nivel_minimo;
        }
        if (!file_exists($this->directorioLogs)) {
            mkdir($this->directorioLogs, 0755, true);
        }
    }

    // Inicializa el logger global
    public static function inicializar($directorio = null, $tamañoMaximo = 5242880, $nivel_minimo = null) {
        if (self::$inicializado) {
            return;
        }
        self::$inicializado = true;
        if (!isset(self::$instance)) {
            self::$instance = new self($directorio, $tamañoMaximo, $nivel_minimo);
        }
    }

    // Obtiene la instancia global del logger
    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::inicializar();
        }
        return self::$instance;
    }
    
    /**
     * Obtener el nombre del archivo de log para hoy
     * Formato: logs_2025-11-26.log
     */
    private function obtenerArchivoLog() {
        $fecha = date('Y-m-d');
        return $this->directorioLogs . '/logs_' . $fecha . '.log';
    }
    
    /**
     * Registrar un mensaje en el log
     * @param int $nivel - Nivel de severidad (usar constantes de clase)
     * @param string $mensaje - Mensaje a registrar
     * @param array $contexto - Información adicional (datos del error, usuario, etc.)
     */
    private function registrar($nivel, $mensaje, $contexto = []) {
        // No registrar si el nivel es menor al mínimo configurado
        if ($nivel < $this->nivel_minimo) {
            return;
        }
        
        // Obtener archivo de log del día actual
        $archivoLog = $this->obtenerArchivoLog();
        
        // Rotar archivo si excede el tamaño máximo
        $this->rotarSiEsNecesario($archivoLog);
        
        // Formatear mensaje
        $timestamp = date('Y-m-d H:i:s');
        $nivelTexto = $this->obtenerNombreNivel($nivel);
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'CLI';
        $url = $_SERVER['REQUEST_URI'] ?? 'N/A';
        
        $linea = sprintf(
            "[%s] [%s] [IP: %s] [URL: %s] %s",
            $timestamp,
            $nivelTexto,
            $ip,
            $url,
            $mensaje
        );
        
        // Agregar contexto si existe
        if (!empty($contexto)) {
            $linea .= " | Contexto: " . json_encode($contexto, JSON_UNESCAPED_UNICODE);
        }
        
        $linea .= PHP_EOL;
        
        // Asegurar que el directorio y el archivo existan antes de escribir
        $directorio = dirname($archivoLog);
        if (!is_dir($directorio)) {
            $creadoDir = @mkdir($directorio, 0755, true);
            if ($creadoDir === false) {
                throw new Exception('No se pudo crear el directorio de logs: ' . $directorio);
            }
        }
        if (!file_exists($archivoLog)) {
            $creado = @touch($archivoLog);
            if ($creado === false) {
                throw new Exception('No se pudo crear el archivo de log: ' . $archivoLog);
            }
        }
        // Escribir al archivo
        $resultado = @file_put_contents($archivoLog, $linea, FILE_APPEND | LOCK_EX);
        if ($resultado === false) {
            throw new Exception('No se pudo escribir en el archivo de log: ' . $archivoLog);
        }
    }
    
    /**
     * Rotar el archivo de log si excede el tamaño máximo
     * @param string $archivoLog - Ruta del archivo a verificar
     */
    private function rotarSiEsNecesario($archivoLog) {
        if (file_exists($archivoLog) && filesize($archivoLog) > $this->tamañoMaximo) {
            $timestamp = date('H-i-s');
            $archivoRotado = str_replace('.log', "_{$timestamp}.log", $archivoLog);
            rename($archivoLog, $archivoRotado);
        }
    }
    
    /**
     * Obtener nombre del nivel
     */
    private function obtenerNombreNivel($nivel) {
        switch ($nivel) {
            case self::DEBUG:    return 'DEBUG';
            case self::INFO:     return 'INFO';
            case self::WARNING:  return 'WARNING';
            case self::ERROR:    return 'ERROR';
            case self::CRITICAL: return 'CRITICAL';
            default:             return 'UNKNOWN';
        }
    }
    
    // Métodos públicos para cada nivel
    
    /**
     * Registrar mensaje de DEBUG (información detallada para desarrollo)
     */
    public function debug($mensaje, $contexto = []) {
        $this->registrar(self::DEBUG, $mensaje, $contexto);
    }
    
    /**
     * Registrar mensaje de INFO (eventos normales del sistema)
     */
    public function info($mensaje, $contexto = []) {
        $this->registrar(self::INFO, $mensaje, $contexto);
    }
    
    /**
     * Registrar mensaje de WARNING (algo inusual pero no crítico)
     */
    public function warning($mensaje, $contexto = []) {
        $this->registrar(self::WARNING, $mensaje, $contexto);
    }
    
    /**
     * Registrar mensaje de ERROR (error que no detiene la ejecución)
     */
    public function error($mensaje, $contexto = []) {
        $this->registrar(self::ERROR, $mensaje, $contexto);
    }
    
    /**
     * Registrar mensaje de CRITICAL (error fatal que requiere atención inmediata)
     */
    public function critical($mensaje, $contexto = []) {
        try {
            $this->registrar(self::CRITICAL, $mensaje, $contexto);
        } catch (Exception $e) {
            // Propagar la excepción para que el handler pueda saber si falló
            throw $e;
        }
        // Enviar email en errores críticos (solo en producción)
        if (env('ENVIRONMENT') === 'production') {
            $this->notificarErrorCritico($mensaje, $contexto);
        }
    }
    
    /**
     * Registrar una excepción con toda su información
     */
    public function excepcion($excepcion, $contexto = []) {
        $mensaje = sprintf(
            "Excepción %s: %s en %s:%d",
            get_class($excepcion),
            $excepcion->getMessage(),
            $excepcion->getFile(),
            $excepcion->getLine()
        );
        
        $contexto['stack_trace'] = $excepcion->getTraceAsString();
        
        $this->error($mensaje, $contexto);
    }
    
    /**
     * Notificar error crítico por email
     */
    private function notificarErrorCritico($mensaje, $contexto) {
        $correo_errores = configuracion('correo_errores');
        if (!$correo_errores) {
            return; // No hay correo configurado
        }
        
        $asunto = "[CRÍTICO] Error en " . env('EMPRESA', 'Sistema');
        $cuerpo = "Se ha detectado un error crítico:\n\n";
        $cuerpo .= "Mensaje: $mensaje\n";
        $cuerpo .= "Fecha: " . date('Y-m-d H:i:s') . "\n";
        $cuerpo .= "IP: " . ($_SERVER['REMOTE_ADDR'] ?? 'N/A') . "\n";
        $cuerpo .= "URL: " . ($_SERVER['REQUEST_URI'] ?? 'N/A') . "\n";
        
        if (!empty($contexto)) {
            $cuerpo .= "\nContexto:\n" . print_r($contexto, true);
        }
        
        $cabeceras = 'From: ' . env('EMAIL_REMITENTE') . "\r\n";
        @mail($correo_errores, $asunto, $cuerpo, $cabeceras);
    }
}




?>
