<?php
/**
 * Carga de variables de entorno desde archivo .env
 */

class Entorno {
    // Array privado para almacenar las variables de entorno
    private static $variables = [];
    private static $inicializado = false;

    // Inicializa el entorno cargando .env y validando configuración
    public static function inicializar() {
        if (self::$inicializado) {
            return;
        }
        self::$inicializado = true;
        
        self::cargarDotEnv(__DIR__ . '/../../.env');
        self::validarConfiguracion();
    }

    // Carga las variables de entorno desde el archivo .env
    private static function cargarDotEnv($path) {
        if(!file_exists($path)) {
            throw new Exception("El archivo .env no existe en: $path");
        }
        
        if (!is_readable($path)) {
            throw new Exception("El archivo .env no es legible");
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            // Ignorar comentarios
            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            // Parsear línea KEY=VALUE
            if (strpos($line, '=') !== false) {
                list($name, $value) = explode('=', $line, 2);
                $name = trim($name);
                $value = trim($value);

                // Remover comillas si existen
                $value = trim($value, '"\'');

                // Almacenar en el array privado
                self::$variables[$name] = $value;
            }
        }
    }

    /**
     * Obtiene el valor de una variable de entorno
     * @param string $key - Nombre de la variable
     * @param mixed $default - Valor por defecto si no existe
     * @return mixed
     */
    public static function obtenerConfiguracion($key, $default = null) {
        return isset(self::$variables[$key]) ? self::$variables[$key] : $default;
    }

    // Validaciones de configuración
    private static function validarConfiguracion() {
        $errores = [];

        // Validar ENVIRONMENT
        $environment = self::obtenerConfiguracion('ENVIRONMENT');
        if ($environment === null) {
            $errores[] = "ERROR: 'ENVIRONMENT' no está definido en el archivo .env";
        } elseif (!in_array($environment, ['development', 'production'])) {
            $errores[] = "ERROR: 'ENVIRONMENT' debe ser 'development' o 'production'. Valor actual: '{$environment}'";
        }

        // Validar MODO_PROYECTO
        $modoProyecto = self::obtenerConfiguracion('MODO_PROYECTO');
        if ($modoProyecto === null) {
            $errores[] = "ERROR: 'MODO_PROYECTO' no está definido en el archivo .env";
        } elseif (!in_array($modoProyecto, ['web', 'landing'])) {
            $errores[] = "ERROR: 'MODO_PROYECTO' debe ser 'web' o 'landing'. Valor actual: '{$modoProyecto}'";
        }

        // Validar DB_HOST
        $dbHost = self::obtenerConfiguracion('DB_HOST');
        if ($dbHost === null) {
            $errores[] = "ERROR: 'DB_HOST' no está definido en el archivo .env";
        } elseif (empty(trim($dbHost))) {
            $errores[] = "ERROR: 'DB_HOST' no puede estar vacío.";
        } elseif (!is_string($dbHost)) {
            $errores[] = "ERROR: 'DB_HOST' debe ser una cadena de texto.";
        }

        // Validar DB_NAME
        $dbName = self::obtenerConfiguracion('DB_NAME');
        if ($dbName === null) {
            $errores[] = "ERROR: 'DB_NAME' no está definido en el archivo .env";
        } elseif (empty(trim($dbName))) {
            $errores[] = "ERROR: 'DB_NAME' no puede estar vacío.";
        } elseif (!is_string($dbName)) {
            $errores[] = "ERROR: 'DB_NAME' debe ser una cadena de texto.";
        }

        // Validar DB_USER
        $dbUser = self::obtenerConfiguracion('DB_USER');
        if ($dbUser === null) {
            $errores[] = "ERROR: 'DB_USER' no está definido en el archivo .env";
        } elseif (!is_string($dbUser)) {
            $errores[] = "ERROR: 'DB_USER' debe ser una cadena de texto.";
        }

        // Validar DB_PASSWORD (puede estar vacío, pero debe existir)
        $dbPassword = self::obtenerConfiguracion('DB_PASSWORD');
        if ($dbPassword === null) {
            $errores[] = "ERROR: 'DB_PASSWORD' no está definido en el archivo .env";
        } elseif (!is_string($dbPassword)) {
            $errores[] = "ERROR: 'DB_PASSWORD' debe ser una cadena de texto.";
        }

        // Validar URL
        $url = self::obtenerConfiguracion('URL');
        if ($url === null) {
            $errores[] = "ERROR: 'URL' no está definido en el archivo .env";
        } elseif (empty(trim($url))) {
            $errores[] = "ERROR: 'URL' no puede estar vacío.";
        } elseif (!is_string($url)) {
            $errores[] = "ERROR: 'URL' debe ser una cadena de texto.";
        } elseif (substr($url, 0, 1) !== '/' || substr($url, -1) !== '/') {
            $errores[] = "ERROR: 'URL' debe comenzar y terminar con '/'. Valor actual: '{$url}'";
        }

        // Validar DOMINIO
        $dominio = self::obtenerConfiguracion('DOMINIO');
        if ($dominio === null) {
            $errores[] = "ERROR: 'DOMINIO' no está definido en el archivo .env";
        } elseif (empty(trim($dominio))) {
            $errores[] = "ERROR: 'DOMINIO' no puede estar vacío.";
        } elseif (!is_string($dominio)) {
            $errores[] = "ERROR: 'DOMINIO' debe ser una cadena de texto.";
        } elseif (!preg_match('/^https?:\/\/.+/', $dominio)) {
            $errores[] = "ERROR: 'DOMINIO' debe comenzar con 'http://' o 'https://'. Valor actual: '{$dominio}'";
        } elseif (substr($dominio, -1) !== '/') {
            $errores[] = "ERROR: 'DOMINIO' debe terminar con '/'. Valor actual: '{$dominio}'";
        }

        // Validar EMAIL_REMITENTE
        $emailRemitente = self::obtenerConfiguracion('EMAIL_REMITENTE');
        if ($emailRemitente === null) {
            $errores[] = "ERROR: 'EMAIL_REMITENTE' no está definido en el archivo .env";
        } elseif (empty(trim($emailRemitente))) {
            $errores[] = "ERROR: 'EMAIL_REMITENTE' no puede estar vacío.";
        } elseif (!filter_var($emailRemitente, FILTER_VALIDATE_EMAIL)) {
            $errores[] = "ERROR: 'EMAIL_REMITENTE' no es un email válido. Valor actual: '{$emailRemitente}'";
        }

        // Validar EMPRESA
        $empresa = self::obtenerConfiguracion('EMPRESA');
        if ($empresa === null) {
            $errores[] = "ERROR: 'EMPRESA' no está definido en el archivo .env";
        } elseif (empty(trim($empresa))) {
            $errores[] = "ERROR: 'EMPRESA' no puede estar vacío.";
        } elseif (!is_string($empresa)) {
            $errores[] = "ERROR: 'EMPRESA' debe ser una cadena de texto.";
        }

        // Validar COLOR_PRIMARIO
        $colorPrimario = self::obtenerConfiguracion('COLOR_PRIMARIO');
        if ($colorPrimario === null) {
            $errores[] = "ERROR: 'COLOR_PRIMARIO' no está definido en el archivo .env";
        } elseif (empty(trim($colorPrimario))) {
            $errores[] = "ERROR: 'COLOR_PRIMARIO' no puede estar vacío.";
        } elseif (!preg_match('/^#[0-9A-Fa-f]{6}$/', $colorPrimario)) {
            $errores[] = "ERROR: 'COLOR_PRIMARIO' debe ser un color hexadecimal válido (ej: #FFFFFF). Valor actual: '{$colorPrimario}'";
        }

        // Si hay errores, loguearlos, mostrarlos y detener la ejecución
        if (!empty($errores)) {
            if (function_exists('logger')) {
                try {
                    logger()->critical('Errores de configuración en .env', [
                        'errores' => $errores,
                        'total_errores' => count($errores)
                    ]);
                } catch (Exception $e) {
                    // Si falla el logger, continuar con la pantalla de error
                }
            }
            require_once __DIR__ . '/../vistas/error_configuracion.php';
            exit;
        }
    }
}

?>
