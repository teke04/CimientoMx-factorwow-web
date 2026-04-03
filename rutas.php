<?php

// crearRuta(URL RELATIVA, NOMBRE CONTROLADOR, NOMBRE METODO)

/**
 * Función para inicializar las rutas del proyecto
 * Se ejecuta después de cargar el entorno
 */
function inicializarRutas() {
    
    // Configurar rutas según el modo del proyecto
    if (env('MODO_PROYECTO') === 'landing') {
        // Ruta raíz para landings
        crearRuta('', 'Controlador_Landing', 'keyword');
    } else {
        // Ruta raíz para web
        crearRuta('', 'Controlador_Web', 'home');
        
        // Rutas específicas de la web
        crearRuta('home', 'Controlador_Web', 'home');
        crearRuta('pagina2', 'Controlador_Web', 'pagina2');
        crearRuta('pagina3', 'Controlador_Web', 'pagina3');
        crearRuta('contacto', 'Controlador_Web', 'contacto');
        
        // Rutas del navbar
        crearRuta('diplomado', 'Controlador_Web', 'diplomado');
        crearRuta('tienda', 'Controlador_Web', 'tienda');
        crearRuta('acerca-de', 'Controlador_Web', 'acercaDe');
        crearRuta('webinars', 'Controlador_Web', 'webinars');
        crearRuta('blog', 'Controlador_Web', 'blog');
        
        //crearRuta('aviso-de-privacidad', 'Controlador_Web', 'avisoPrivacidad');
    }

    // RUTAS COMUNES (disponibles en ambos modos)
    
    // Rutas de documentos técnicos
    crearRuta('sitemap.xml', 'Controlador_Documentos', 'sitemap');
    crearRuta('robots.txt', 'Controlador_Documentos', 'robots');

    //Ruta de 404
    crearRuta('404', 'Controlador', 'show404');

    // Ruta de prospectos
    crearRuta('gracias', 'Controlador_Prospectos', 'guardarLead');

    // Rutas de sesión del panel (disponibles en ambos modos)
    crearRuta('login', 'Controlador_Login', 'login');
    crearRuta('logout', 'Controlador_Login', 'logout');
    crearRuta('recuperar-cuenta', 'Controlador_Login', 'recuperar');

    // Rutas de administración (disponibles en ambos modos)
    
    // Rutas de resultados
    crearRuta('admin', 'Controlador_Resultados', 'resultados');
    crearRuta('admin/resultados', 'Controlador_Resultados', 'resultados');
    
    // Rutas de leads
    crearRuta('admin/leads', 'Controlador_Leads', 'verleads');
    crearRuta('admin/leads-borrar', 'Controlador_Leads', 'borrarLead');
    
    // Rutas de landings
    crearRuta('admin/landings', 'Controlador_Landings', 'verLandings');
    crearRuta('admin/landings-borrar', 'Controlador_Landings', 'borrarLanding');
    crearRuta('admin/landings-editar', 'Controlador_Landings', 'editarLanding');
    crearRuta('admin/landings-crear', 'Controlador_Landings', 'crearLanding');
    
    // Rutas de videos
    crearRuta('admin/videos', 'Controlador_Videos', 'verVideos');
    crearRuta('admin/videos-crear', 'Controlador_Videos', 'crearVideo');
    crearRuta('admin/videos-borrar', 'Controlador_Videos', 'borrarVideo');

    // Rutas de productos
    crearRuta('admin/productos', 'Controlador_Productos', 'verProductos');
    crearRuta('admin/productos-crear', 'Controlador_Productos', 'crearProducto');
    crearRuta('admin/productos-editar', 'Controlador_Productos', 'editarProducto');
    crearRuta('admin/productos-borrar', 'Controlador_Productos', 'borrarProducto');

    // Rutas de configuraciones
    crearRuta('admin/configuraciones', 'Controlador_Configuraciones', 'verconfiguraciones');

}

?>