<!DOCTYPE html>
<html lang="ES">
<?php
$titulo      = htmlspecialchars($producto['nombre']) . ' - ' . env('EMPRESA');
$descripcion = htmlspecialchars($producto['nombre']) . '. ' . env('EMPRESA') . '.';
$imagen_og   = $producto['imagen_url'] ? url($producto['imagen_url']) : '';
?>
<head>
    <?php $this->plantilla('metas-basicas') ?>
    <?php $this->plantilla('estilos') ?>
    <?php $this->plantilla('metadatos', [
        'titulo'      => $titulo,
        'descripcion' => $descripcion,
        'imagen'      => $imagen_og,
        'url'         => ruta('tienda/' . htmlspecialchars($producto['url_interna'])),
    ]) ?>
    <title><?= $titulo ?></title>
    <meta name="description" content="<?= $descripcion ?>">
    <link rel="canonical" href="<?= ruta('tienda/' . htmlspecialchars($producto['url_interna'])) ?>"/>
    <meta name="robots" content="index, follow">
    <?= configuracion('tag_manager_head') ?>
</head>
<body class="w-screen overflow-x-clip">
    <?= configuracion('tag_manager_body') ?>
    <main>
        <?php $this->componente('navbar'); ?>

        <!-- Breadcrumb -->
        <section class="w-screen pt-[80px] bg-white border-b border-gray-100">
            <div class="w-full max-w-7xl mx-auto px-8 py-4">
                <nav class="flex items-center gap-2 text-sm font-montserrat text-[#7D82AA]">
                    <a href="<?= ruta('tienda') ?>" class="hover:text-[#553CC8] transition-colors duration-200">Tienda</a>
                    <span>/</span>
                    <span class="text-[#553CC8] font-semibold"><?= htmlspecialchars($producto['nombre']) ?></span>
                </nav>
            </div>
        </section>

        <!-- Producto -->
        <section class="w-screen py-16 bg-white">
            <div class="w-full max-w-7xl mx-auto px-8">
                <div class="flex flex-col lg:flex-row gap-12 lg:gap-16 items-start">

                    <!-- Imagen -->
                    <div class="w-full lg:w-1/2 flex-shrink-0">
                        <?php if ($producto['imagen_url']): ?>
                        <div class="w-full aspect-square rounded-[20px] overflow-hidden bg-gray-100">
                            <img src="<?= url($producto['imagen_url']) ?>"
                                 alt="<?= htmlspecialchars($producto['nombre']) ?>"
                                 class="w-full h-full object-cover">
                        </div>
                        <?php else: ?>
                        <div class="w-full aspect-square rounded-[20px] bg-gray-100 flex items-center justify-center">
                            <svg width="80" height="80" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="3" y="3" width="18" height="18" rx="2" stroke="#D1D5DB" stroke-width="1.5"/>
                                <circle cx="8.5" cy="8.5" r="1.5" stroke="#D1D5DB" stroke-width="1.5"/>
                                <path d="M21 15l-5-5L5 21" stroke="#D1D5DB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- Info -->
                    <div class="w-full lg:w-1/2 flex flex-col gap-6">

                        <!-- Categoría -->
                        <?php
                        $labels_cat = [
                            'presencial'  => 'Curso presencial',
                            'online'      => 'Curso online',
                            'descargable' => 'Descargable',
                        ];
                        ?>
                        <span class="inline-block self-start px-4 py-1 rounded-full text-sm font-montserrat font-semibold
                                     bg-[#553CC8]/10 text-[#553CC8]">
                            <?= htmlspecialchars($labels_cat[$producto['categoria']] ?? $producto['categoria']) ?>
                        </span>

                        <!-- Nombre -->
                        <h1 class="font-montserrat font-bold text-[36px] lg:text-[42px] text-black leading-[1.2]">
                            <?= htmlspecialchars($producto['nombre']) ?>
                        </h1>

                        <!-- Precios -->
                        <div class="flex items-center gap-4">
                            <span class="font-montserrat font-bold text-[32px] text-[#553CC8]">
                                $<?= number_format($producto['precio'], 2) ?> MXN
                            </span>
                            <?php if ($producto['precio_original']): ?>
                            <span class="font-montserrat font-normal text-[20px] text-[#7D82AA] line-through">
                                $<?= number_format($producto['precio_original'], 2) ?> MXN
                            </span>
                            <?php endif; ?>
                        </div>

                        <!-- Botón comprar -->
                        <a href="<?= htmlspecialchars($producto['url_compra']) ?>"
                           target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center justify-center px-10 py-4 rounded-full
                                  bg-[#FF3D81] font-montserrat font-semibold text-[18px] text-white text-center
                                  transition-transform duration-200 hover:scale-105 self-start">
                            Comprar ahora
                        </a>

                    </div>
                </div>
            </div>
        </section>

        <?php $this->componente('flotante-whatsapp'); ?>
        <?php $this->componente('footer'); ?>
    </main>
</body>
</html>
