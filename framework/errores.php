<?php
/**
 * Funciones y clases para manejo global de errores y excepciones
 */

// Configura los manejadores globales de errores y excepciones
function inicializarErrores() {
    // Manejador de excepciones no capturadas
    set_exception_handler(function($excepcion) {
        manejarErrorGlobal($excepcion);
    });

    // Manejador de errores fatales
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
            manejarErrorGlobal($excepcion);
        }
    });

    // Convertir errores en excepciones (warnings, notices, etc.)
    set_error_handler(function($severity, $message, $file, $line) {
        if (!(error_reporting() & $severity)) {
            return;
        }
        throw new ErrorException($message, 0, $severity, $file, $line);
    });
}

// Manejador global para mostrar pantalla 500 y loguear
function manejarErrorGlobal($excepcion) {
    // Registrar en log si está disponible
    if (function_exists('logger')) {
        logger()->critical('Error fatal capturado', [
            'mensaje' => $excepcion->getMessage(),
            'archivo' => $excepcion->getFile(),
            'linea' => $excepcion->getLine(),
            'trace' => $excepcion->getTraceAsString()
        ]);
    }

    // Limpiar cualquier output buffer
    while (ob_get_level()) {
        ob_end_clean();
    }

    // Establecer código de respuesta HTTP
    http_response_code(500);

    // Determinar si mostrar información de debug
    $modo_debug = (function_exists('env') && env('ENVIRONMENT') === 'development');

    // Pasar datos a la vista
    if ($modo_debug) {
        $error_mensaje = $excepcion->getMessage();
        $error_archivo = $excepcion->getFile();
        $error_linea = $excepcion->getLine();
        $error_trace = $excepcion->getTraceAsString();
    }

    // Mostrar vista de error 500
    $vista500 = __DIR__ . '/vistas/error_servidor.php';
    if (file_exists($vista500)) {
        include $vista500;
    } else {
        echo '<h1>Error 500</h1><p>Ha ocurrido un error interno del servidor.</p>';
    }
    exit(1);
}
