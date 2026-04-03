<!DOCTYPE html>
<html lang="ES">
<?php
$titulo      = 'Tienda - ' . env('EMPRESA');
$descripcion = 'Explora nuestra tienda: cursos presenciales, cursos online y descargables de ' . env('EMPRESA') . '.';
?>
<head>
    <?php $this->plantilla('metas-basicas') ?>
    <?php $this->plantilla('estilos') ?>
    <?php $this->plantilla('metadatos', [
        'titulo'      => $titulo,
        'descripcion' => $descripcion,
        'imagen'      => '',
        'url'         => '',
    ]) ?>
    <title><?= $titulo ?></title>
    <meta name="description" content="<?= $descripcion ?>">
    <link rel="canonical" href="<?= ruta('tienda') ?>"/>
    <meta name="robots" content="index, follow">
    <?= configuracion('tag_manager_head') ?>
</head>
<body class="w-screen overflow-x-clip">
    <?= configuracion('tag_manager_body') ?>
    <main>
        <?php $this->componente('navbar'); ?>

        <!-- Hero banner -->
        <section class="w-screen pt-[80px]" style="background: linear-gradient(90deg, #553CC8 0%, #7D82AA 100%);">
            <div class="w-full max-w-7xl mx-auto px-8 py-16 flex items-center justify-center">
                <h1 class="font-montserrat font-extrabold text-[48px] text-white tracking-widest uppercase">
                    Tienda
                </h1>
            </div>
        </section>

        <!-- Catálogo -->
        <section class="w-screen py-16 bg-white">
            <div class="w-full max-w-7xl mx-auto px-8 flex flex-col gap-10">

                <!-- Filtros -->
                <div class="flex flex-wrap gap-3 justify-center">
                    <?php
                    $categorias = [
                        ''             => 'Todos',
                        'presencial'   => 'Cursos presenciales',
                        'online'       => 'Cursos online',
                        'descargable'  => 'Descargables',
                    ];
                    $cat_activa = isset($_GET['categoria']) ? $_GET['categoria'] : '';
                    foreach ($categorias as $val => $label):
                    ?>
                    <a href="<?= ruta('tienda') . ($val !== '' ? '?categoria=' . urlencode($val) : '') ?>"
                       class="px-5 py-2 rounded-full font-montserrat font-semibold text-[14px] border-2 transition-all duration-200
                              <?= $cat_activa === $val
                                  ? 'bg-[#553CC8] border-[#553CC8] text-white'
                                  : 'bg-white border-[#553CC8] text-[#553CC8] hover:bg-[#553CC8] hover:text-white' ?>">
                        <?= $label ?>
                    </a>
                    <?php endforeach; ?>
                </div>

                <?php
                // Filtrar por categoría en PHP
                $productosFiltrados = array_filter($productos ?? [], function($p) use ($cat_activa) {
                    return $cat_activa === '' || $p['categoria'] === $cat_activa;
                });
                ?>

                <?php if (empty($productosFiltrados)): ?>
                    <p class="text-center font-montserrat text-[#7D82AA] text-[18px] py-16">
                        No hay productos disponibles en esta categoría.
                    </p>
                <?php else: ?>
                <!-- Grid de productos -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 justify-items-center">
                    <?php foreach ($productosFiltrados as $producto): ?>
                    <div class="group flex flex-col gap-5 w-full max-w-[292px] rounded-[20px]">
                        <!-- Imagen -->
                        <?php $url_interna = $producto['url_interna'] ?? null; ?>
                        <div class="w-full aspect-square rounded-[20px] overflow-hidden bg-gray-100">
                            <?php if ($url_interna): ?>
                            <a href="<?= ruta('tienda/' . htmlspecialchars($url_interna)) ?>">
                            <?php endif; ?>
                            <?php if ($producto['imagen_url']): ?>
                            <img src="<?= url($producto['imagen_url']) ?>"
                                 alt="<?= htmlspecialchars($producto['nombre']) ?>"
                                 class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                            <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                <svg width="60" height="60" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="3" y="3" width="18" height="18" rx="2" stroke="#D1D5DB" stroke-width="1.5"/>
                                    <circle cx="8.5" cy="8.5" r="1.5" stroke="#D1D5DB" stroke-width="1.5"/>
                                    <path d="M21 15l-5-5L5 21" stroke="#D1D5DB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <?php endif; ?>
                            <?php if ($url_interna): ?>
                            </a>
                            <?php endif; ?>
                        </div>
                        <!-- Info -->
                        <div class="flex flex-col gap-5 pb-5">
                            <div class="px-5">
                                <?php if ($url_interna): ?>
                                <a href="<?= ruta('tienda/' . htmlspecialchars($url_interna)) ?>">
                                <?php endif; ?>
                                <p class="font-montserrat font-medium text-[20px] text-black leading-[1.2]">
                                    <?= htmlspecialchars($producto['nombre']) ?>
                                </p>
                                <?php if ($url_interna): ?>
                                </a>
                                <?php endif; ?>
                            </div>
                            <div class="flex flex-col gap-5 px-5">
                                <!-- Precios -->
                                <div class="flex items-center justify-between gap-2">
                                    <span class="font-montserrat font-bold text-[22px] text-[#553CC8]">
                                        $<?= number_format($producto['precio'], 2) ?> MXN
                                    </span>
                                    <?php if ($producto['precio_original']): ?>
                                    <span class="font-montserrat font-normal text-[16px] text-[#7D82AA] line-through">
                                        $<?= number_format($producto['precio_original'], 2) ?> MXN
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <!-- Botón -->
                                <a href="<?= htmlspecialchars($producto['url_compra']) ?>"
                                   target="_blank" rel="noopener noreferrer"
                                   class="w-full flex items-center justify-center px-10 py-2.5 rounded-full
                                          bg-[#FF3D81]
                                          font-montserrat font-semibold text-[18px] text-white text-center">
                                    Comprar
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

            </div>
        </section>

        <?php $this->componente('flotante-whatsapp'); ?>
        <?php $this->componente('footer'); ?>
    </main>
</body>
</html>
