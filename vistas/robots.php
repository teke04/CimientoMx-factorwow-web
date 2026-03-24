# Robots.txt generado dinámicamente
# Sitio: <?= env('EMPRESA'); ?>

# Permitir acceso a todos los robots por defecto
User-agent: *

# Bloquear todas las rutas administrativas
Disallow: <?= $urlBase; ?>admin/

# Bloquear rutas específicas de sistema
<?php foreach ($rutasEspecificasBloqueadas as $ruta): ?>
Disallow: <?= parse_url(ruta($ruta), PHP_URL_PATH); ?>

<?php endforeach; ?>

# Permitir recursos públicos
Allow: <?= $urlBase; ?>recursos/


# Sitemap
Sitemap: <?= $sitemap; ?>
