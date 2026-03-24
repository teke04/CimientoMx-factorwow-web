<?php

/**
 * Función para agregar rutas al sistema de enrutamiento
 * @param string $ruta - La ruta URL (ejemplo: 'home', 'admin/usuarios')
 * @param string $controlador - El nombre del controlador (ejemplo: 'Controlador_Web')
 * @param string $metodo - El método del controlador a ejecutar (ejemplo: 'home')
 */
function crearRuta($ruta, $controlador, $metodo) {
    enrutador()->agregarRuta($ruta, $controlador, $metodo);
}

/**
 * Devuelve la URL completa para una ruta de navegación registrada
 * @param string $ruta - La ruta relativa registrada en el enrutador (ejemplo: 'home', 'admin/usuarios')
 * @return string - URL completa con el dominio configurado
 */
function ruta($ruta){
    if(array_key_exists($ruta, enrutador()->listarRutas())){
        return url($ruta);
    }
    throw new Exception('La ruta "' . $ruta . '" no está registrada en el enrutador.');
}

/**
 * Función para generar URLs completas basadas en el dominio configurado
 * @param string $url - La ruta relativa (ejemplo: 'admin/usuarios', 'recursos/imagen.jpg')
 * @return string - URL completa con el dominio configurado
 */
function url($url){
   return trim(env('DOMINIO'),'/').'/'.trim($url,'/');
}
/**
 * Función para importar assets con cache busting automático
 * @param string $nombreasset - El nombre del archivo asset relativo a la carpeta recursos (ejemplo: 'css/styles.css', 'js/app.js')
 * @return string - URL completa del asset con parámetro de versión para evitar cache
 */
function importAsset($nombreasset) {
   $rutaCompleta = dirname(__DIR__) . '/recursos/' . trim($nombreasset);
   if (!file_exists($rutaCompleta)) {
         return url('recursos/placeholder.svg');
   }
   return url('recursos/'.$nombreasset) . '?v=' . filemtime($rutaCompleta);
}

function importarScript($nombrescript) {
   return '<script defer src="'.importAsset('scripts/'.trim($nombrescript,'/')).'"></script>';
}

/**
 * Función para obtener valores de configuración desde la base de datos
 * @param string $clave - La clave de configuración (ejemplo: 'telefono', 'tag_manager_head')
 * @param string $default - Valor por defecto si no existe la configuración
 * @return string - El valor de la configuración o el valor por defecto
 */
function configuracion($clave, $default = '') {
    
    // Cache estático para evitar consultas repetidas en la misma ejecución
    static $configuraciones = null;
    
    // Si no se ha cargado el cache, cargar todas las configuraciones
    if ($configuraciones === null) {
        $configuraciones = [];
        try {
            $sql = "SELECT clave, valor FROM configuraciones";
            $resultados = db()->ejecutarConsulta($sql, []);
            
            foreach ($resultados as $config) {
                $configuraciones[$config['clave']] = $config['valor'];
            }
        } catch (Exception $e) {
            // Si hay error (ej: tabla no existe), retornar el default
            return $default;
        }
    }
    
    // Retornar el valor de la configuración o el default
    return isset($configuraciones[$clave]) ? $configuraciones[$clave] : $default;
}

/**
 * Función para acceder a variables de entorno
 * @param string $key - Nombre de la variable de entorno
 * @param mixed $default - Valor por defecto si no existe
 * @return mixed
 */
function env($key, $default = null) {
    return Entorno::obtenerConfiguracion($key, $default);
}

/**
 * Helper para acceder al logger global
 * @return Logger
 */
function logger() {
    return Logger::getInstance();
}

/**
 * Helper para acceder a la instancia global de la base de datos
 * @return Db
 */
function db() {
    return Db::getInstance();
}

/**
 * Helper para acceder a la instancia global del enrutador
 * @return Enrutador
 */
function enrutador() {
    return Enrutador::getInstance();
}