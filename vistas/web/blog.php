<!DOCTYPE html>
<html lang="ES">
<?php
$titulo      = 'Blog - ' . env('EMPRESA');
$descripcion = 'Artículos, consejos y noticias sobre WOW Experience y Factor WOW.';
?>
<head>
    <?php $this->plantilla('metas-basicas') ?>
    <?php $this->plantilla('estilos') ?>
    <?php $this->plantilla('metadatos', [
        'titulo'      => $titulo,
        'descripcion' => $descripcion,
        'imagen'      => '',
        'url'         => ruta('blog'),
    ]) ?>
    <title><?= $titulo ?></title>
    <meta name="description" content="<?= $descripcion ?>">
    <link rel="canonical" href="<?= ruta('blog') ?>"/>
    <meta name="robots" content="index, follow">
    <?= configuracion('tag_manager_head') ?>
</head>
<body class="w-screen overflow-x-clip">
    <?= configuracion('tag_manager_body') ?>
    <main>
        <?php $this->componente('navbar'); ?>

        <!-- Hero Banner -->
        <section class="w-screen pt-[80px]" style="background: linear-gradient(90deg, #8160AE 0%, #553CC8 100%);">
            <div class="w-full max-w-7xl mx-auto px-8 py-16 flex items-center justify-center">
                <h1 class="font-montserrat font-extrabold text-[48px] text-white tracking-widest uppercase text-center">
                    Blog
                </h1>
            </div>
        </section>

        <!-- Blog Grid -->
        <section class="w-screen bg-white py-16 pb-24">
            <div class="w-full max-w-7xl mx-auto px-8">

                <?php if (empty($articulos)): ?>
                    <p class="text-center text-gray-400 font-montserrat py-16 text-lg">
                        Próximamente publicaremos contenido. ¡Vuelve pronto!
                    </p>
                <?php else: ?>

                <div id="blog-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 items-stretch">
                    <?php foreach ($articulos as $art): ?>
                    <a href="<?= ruta('blog/' . htmlspecialchars($art['slug'])) ?>"
                       class="flex flex-col gap-[20px] items-start rounded-[20px] cursor-pointer hover:shadow-xl transition-shadow duration-300 h-full">

                        <!-- Image (h-[260px]) with date badge centered at bottom -->
                        <div class="relative w-full h-[260px] rounded-[20px] overflow-hidden bg-gray-100 shrink-0">
                            <img src="<?= url(htmlspecialchars($art['imagen_url'])) ?>"
                                 alt="<?= htmlspecialchars($art['titulo']) ?>"
                                 class="absolute inset-0 w-full h-full object-cover rounded-[20px]">

                            <!-- Date badge -->
                            <div class="absolute bottom-4 left-1/2 -translate-x-1/2">
                                <span class="bg-[#7d82aa] text-white font-montserrat text-[14px] font-normal px-[20px] py-0.5 rounded-[40px] whitespace-nowrap">
                                    <?= date('d/m/Y', strtotime($art['creado'])) ?>
                                </span>
                            </div>
                        </div>

                        <!-- Text + Saber más -->
                        <div class="flex flex-col gap-[40px] items-start w-full flex-1">

                            <!-- Title + excerpt -->
                            <div class="flex flex-col gap-[10px] items-start px-[20px] w-full">
                                <h2 class="font-montserrat font-bold text-[24px] text-[#553CC8] leading-[1.2] w-full line-clamp-2">
                                    <?= htmlspecialchars($art['titulo']) ?>
                                </h2>
                                <?php if (!empty($art['extracto'])): ?>
                                <p class="font-montserrat font-normal text-[14px] text-black leading-[1.8] w-full line-clamp-3">
                                    <?= htmlspecialchars($art['extracto']) ?>
                                </p>
                                <?php endif; ?>
                            </div>

                            <!-- Saber más -->
                            <div class="flex flex-col items-start pb-[20px] px-[20px] w-full mt-auto">
                                <div class="flex gap-[20px] items-center justify-end w-full">
                                    <span class="font-montserrat font-medium text-[18px] text-[#0064ff] whitespace-nowrap">
                                        Saber más
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#0064ff] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </div>
                            </div>

                        </div>
                    </a>
                    <?php endforeach; ?>
                </div>

                <!-- Cargar más -->
                <?php
                $siguienteOffset = $offset + $limit;
                $hayMas = $siguienteOffset < $total;
                ?>
                <?php if ($hayMas): ?>
                <div class="flex justify-center mt-16">
                    <a href="<?= ruta('blog') ?>?desde=<?= $siguienteOffset ?>"
                       class="border-2 border-[#FF3D81] text-[#FF3D81] font-montserrat font-semibold text-[18px]
                              px-10 py-3 rounded-full hover:bg-[#FF3D81] hover:text-white transition-colors duration-300">
                        Cargar más
                    </a>
                </div>
                <?php endif; ?>

                <?php endif; ?>

            </div>
        </section>

        <?php $this->componente('footer'); ?>
    </main>
</body>
</html>
