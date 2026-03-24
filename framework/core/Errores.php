<?php
/**
 * Funciones y clases para manejo global de errores y excepciones
 */


class Errores {
    private static $inicializado = false;

    // Inicializa los manejadores globales de errores y excepciones
    public static function inicializar() {
        if (self::$inicializado) {
            return;
        }
        self::$inicializado = true;
        
        set_exception_handler(function($excepcion) {
            self::manejarErrorGlobal($excepcion);
        });

        register_shutdown_function(function() {
            $error = error_get_last();
            if ($error !== null && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
                $excepcion = new ErrorException(
                    $error['message'],
                    0,
                    $error['type'],
                    $error['file'],
                    $error['line']
                );
                self::manejarErrorGlobal($excepcion);
            }
        });

        set_error_handler(function($severity, $message, $file, $line) {
            if (!(error_reporting() & $severity)) {
                return;
            }
            throw new ErrorException($message, 0, $severity, $file, $line);
        });
    }
    
    /**
     * Envía una notificación de error por email
     * @param string $mensaje - Mensaje principal del error
     * @param array $contexto - Información adicional del error
     * @return bool - true si el email se envió correctamente, false en caso contrario
     */
    private static function enviarNotificacionError($mensaje, $contexto = []) {
        $destino = configuracion('correo_errores');
        if (!$destino) return false;
        $asunto = '[ERROR] Notificación de error en ' . (function_exists('env') ? env('EMPRESA', 'Sistema') : 'Sistema');
        $cabeceras = 'From: ' . (function_exists('env') ? env('EMAIL_REMITENTE') : 'no-reply@sistema.com') . "\r\n" .
            'Reply-To: ' . (function_exists('env') ? env('EMAIL_REMITENTE') : 'no-reply@sistema.com') . "\r\n" .
            'X-Mailer: PHP/' . phpversion() . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-Type: text/html; charset=UTF-8' . "\r\n";

        $cuerpo = '<h2>Error en el sistema</h2>';
        $cuerpo .= '<p><strong>Mensaje:</strong> ' . htmlspecialchars($mensaje) . '</p>';
        $cuerpo .= '<p><strong>Fecha:</strong> ' . date('Y-m-d H:i:s') . '</p>';
        $cuerpo .= '<p><strong>IP:</strong> ' . ($_SERVER['REMOTE_ADDR'] ?? 'N/A') . '</p>';
        $cuerpo .= '<p><strong>URL:</strong> ' . ($_SERVER['REQUEST_URI'] ?? 'N/A') . '</p>';
        if (!empty($contexto)) {
            $cuerpo .= '<pre style="background:#f8f8f8;border:1px solid #eee;padding:10px;">' . htmlspecialchars(print_r($contexto, true)) . '</pre>';
        }

        try {
            if (@mail($destino, $asunto, $cuerpo, $cabeceras)) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }
    

    // Manejador global para mostrar pantalla 500 y loguear
    private static function manejarErrorGlobal($excepcion) {
        $error_log_creado = false;
        $error_mail_enviado = false;
        if (function_exists('logger')) {
            try {
                logger()->critical('Error fatal capturado', [
                    'mensaje' => $excepcion->getMessage(),
                    'archivo' => $excepcion->getFile(),
                    'linea' => $excepcion->getLine(),
                    'trace' => $excepcion->getTraceAsString()
                ]);
                $error_log_creado = true;
                // Enviar notificación de error por correo (solo en producción)
                if (function_exists('env') && env('ENVIRONMENT') === 'production') {
                    $error_mail_enviado = self::enviarNotificacionError(
                        $excepcion->getMessage(),
                        [
                            'archivo' => $excepcion->getFile(),
                            'linea' => $excepcion->getLine(),
                            'trace' => $excepcion->getTraceAsString()
                        ]
                    );
                }
            } catch (Exception $e) {
                $error_log_creado = false;
                $error_mail_enviado = false;
            }
        }

        while (ob_get_level()) {
            ob_end_clean();
        }

        http_response_code(500);

        $modo_debug = (function_exists('env') && env('ENVIRONMENT') === 'development');

        if ($modo_debug) {
            $trace = $excepcion->getTrace();
            // Agregar el error principal como primer paso del array
            $error_principal = [
                'file' => $excepcion->getFile(),
                'line' => $excepcion->getLine(),
                'function' => $excepcion->getMessage()
            ];
            $error_trace_array = array_merge([$error_principal], $trace);

            // El error principal será el primer paso
            $error_mensaje = $excepcion->getMessage();
            $error_archivo = $excepcion->getFile();
            $error_linea = $excepcion->getLine();
            $error_trace = $excepcion->getTraceAsString();
        }

        $vista500 = __DIR__ . '/../vistas/error_servidor.php';
        
        if (file_exists($vista500)) {
            include $vista500;
        } else {
            echo '<h1>Error 500</h1><p>Ha ocurrido un error interno del servidor.</p>';
        }
        exit(1);
    }
}
