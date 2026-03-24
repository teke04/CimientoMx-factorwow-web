<?php
class Controlador_Documentos extends Controlador {

    public function sitemap() {
        // Establecer header para XML antes de mostrar la vista
        header("Content-Type: application/xml; charset=utf-8");
        
        // Solo generar sitemap para el modo web (Controlador_Web)
        // Las landings NO deben aparecer en el sitemap
        $controladorObjetivo = 'Controlador_Web';
        $carpetaVistas = 'web';
        
        // Filtrar rutas según el controlador
        $RUTAS = enrutador()->listarRutas();
        $rutasWebFiltradas = [];
        
        // Definir rutas a excluir del sitemap (técnicas, duplicadas o legales)
        $rutasExcluidas = ['sitemap.xml', 'robots.txt', 'home', 'aviso-de-privacidad'];
        
        foreach ($RUTAS as $ruta => $config) {
            if ($config[0] === $controladorObjetivo && !in_array($ruta, $rutasExcluidas)) {
                $rutasWebFiltradas[] = $ruta;
            }
        }
        
        // Definir valores por defecto para todas las páginas
        $valoresDefecto = [
            'priority' => '0.8',
            'changefreq' => 'monthly'
        ];
        
        // Definir configuración personalizada solo para páginas específicas
        $configuracionPersonalizada = [
            '' => [
                'priority' => '1.0',
                'changefreq' => 'daily'
            ],
            //'pagina2' => [
            //    'priority' => '0.8',
            //    'changefreq' => 'weekly'
            //]
        ];
        
        // Función para obtener la fecha de última modificación del archivo de vista
        $obtenerLastMod = function($ruta) use ($carpetaVistas) {
            // Determinar el archivo de vista basándose en la ruta
            if ($ruta === '') {
                // Ruta vacía corresponde a home.php
                $archivoVista = "vistas/{$carpetaVistas}/home.php";
            } else {
                // Otras rutas corresponden directamente al nombre del método
                $archivoVista = "vistas/{$carpetaVistas}/{$ruta}.php";
            }
            
            if (file_exists($archivoVista)) {
                return date('Y-m-d', filemtime($archivoVista));
            }
            
            // Fallback: usar la fecha de modificación del home
            $archivoHome = "vistas/{$carpetaVistas}/home.php";
            if (file_exists($archivoHome)) {
                return date('Y-m-d', filemtime($archivoHome));
            }
            
            // Fallback final: fecha actual si ni siquiera existe el home
            return date('Y-m-d');
        };
        
        // Combinar valores por defecto con personalizados y agregar lastmod
        $configuracionSEO = [];
        foreach ($rutasWebFiltradas as $ruta) {
            $config = array_merge(
                $valoresDefecto, 
                isset($configuracionPersonalizada[$ruta]) ? $configuracionPersonalizada[$ruta] : []
            );
            
            // Agregar lastmod basado en la fecha del archivo de vista
            $config['lastmod'] = $obtenerLastMod($ruta);
            
            $configuracionSEO[$ruta] = $config;
        }
        
        // Pasar las rutas filtradas y configuración a la vista
        $datos['rutasWeb'] = $rutasWebFiltradas;
        $datos['configuracionSEO'] = $configuracionSEO;
        
        $this->mostrar('sitemap', $datos);
    }

    public function robots() {
        // Establecer header para text/plain
        header("Content-Type: text/plain; charset=utf-8");
        
        // Solo trabajar con rutas del modo web (Controlador_Web)
        // Las landings NO deben aparecer en robots.txt
        $RUTAS = enrutador()->listarRutas();
        
        // Filtrar solo rutas que NO son del Controlador_Web (para bloquear)
        // Esto incluye todas las rutas de landings (Controlador_Landing)
        $rutasNoWeb = [];
        foreach ($RUTAS as $ruta => $config) {
            if ($config[0] !== 'Controlador_Web') {
                $rutasNoWeb[] = $ruta;
            }
        }
        
        // Rutas específicas a bloquear (aunque sean del Controlador_Web)
        $rutasEspecificasBloqueadas = ['gracias', 'login', 'logout', 'recuperar-cuenta'];
        
        // Configuración para robots.txt
        $datosRobots = [
            'rutasNoWeb' => $rutasNoWeb,
            'rutasEspecificasBloqueadas' => $rutasEspecificasBloqueadas,
            'sitemap' => ruta('sitemap.xml'),
            'urlBase' => env('URL')
        ];
        
        $this->mostrar('robots', $datosRobots);
    }

}
?>
