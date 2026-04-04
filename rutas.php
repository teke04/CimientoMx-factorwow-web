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
        crearRuta('faq', 'Controlador_Web', 'faq');
        
        // Rutas del navbar
        crearRuta('diplomado', 'Controlador_Web', 'listaDiplomados');
        crearRuta('tienda', 'Controlador_Web', 'tienda');
        crearRuta('acerca-de-wow', 'Controlador_Web', 'acercaDe');
        crearRuta('webinars', 'Controlador_Web', 'webinars');
        crearRuta('blog', 'Controlador_Web', 'blog');
        
        crearRuta('aviso-de-privacidad', 'Controlador_Web', 'avisoPrivacidad');
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
    crearRuta('admin/productos-borrar',       'Controlador_Productos', 'borrarProducto');
    crearRuta('admin/productos-sincronizar', 'Controlador_Productos', 'sincronizarPrecios');

    // Rutas de blog (admin)
    crearRuta('admin/blog', 'Controlador_Blog', 'verArticulos');
    crearRuta('admin/blog-crear', 'Controlador_Blog', 'crearArticulo');
    crearRuta('admin/blog-editar', 'Controlador_Blog', 'editarArticulo');
    crearRuta('admin/blog-borrar', 'Controlador_Blog', 'borrarArticulo');

    // Rutas de webinars (admin)
    crearRuta('admin/webinars', 'Controlador_Webinars', 'verWebinars');
    crearRuta('admin/webinars-crear', 'Controlador_Webinars', 'crearWebinar');
    crearRuta('admin/webinars-editar', 'Controlador_Webinars', 'editarWebinar');
    crearRuta('admin/webinars-borrar', 'Controlador_Webinars', 'borrarWebinar');

    // Rutas de diplomados (admin)
    crearRuta('admin/diplomados', 'Controlador_Diplomados', 'verDiplomados');
    crearRuta('admin/diplomados-crear', 'Controlador_Diplomados', 'crearDiplomado');
    crearRuta('admin/diplomados-editar', 'Controlador_Diplomados', 'editarDiplomado');
    crearRuta('admin/diplomados-borrar', 'Controlador_Diplomados', 'borrarDiplomado');

    // Rutas de configuraciones
    crearRuta('admin/configuraciones', 'Controlador_Configuraciones', 'verconfiguraciones');

    // Rutas de pedidos (admin)
    crearRuta('admin/pedidos', 'Controlador_Pedidos', 'verPedidos');

    // ── Stripe Checkout (público) ────────────────────────────────────────────
    crearRuta('checkout', 'Controlador_Checkout', 'iniciar');
    crearRuta('checkout/exito', 'Controlador_Checkout', 'exito');
    crearRuta('checkout/cancelado', 'Controlador_Checkout', 'cancelado');

    // ── Stripe Webhook (público, sin sesión) ─────────────────────────────────
    crearRuta('stripe/webhook', 'Controlador_Webhook', 'recibir');

}

?>