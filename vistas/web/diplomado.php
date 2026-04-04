<!DOCTYPE html>
<html lang="ES">
<?php
$titulo      = ($diplomado['titulo'] ?? 'Diplomado') . ' - ' . env('EMPRESA');
$descripcion = $diplomado['extracto'] ?? '';
$generacion  = $diplomado['generacion'] ?? '';
$url_temario = $diplomado['url_temario'] ?? '';
$slug        = $diplomado['slug'] ?? '';
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
    <link rel="canonical" href="<?= ruta('diplomado/' . $slug) ?>"/>
    <meta name="robots" content="index, follow">
    <?= configuracion('tag_manager_head') ?>
</head>
<body class="w-screen overflow-x-clip">
    <?= configuracion('tag_manager_body') ?>
    <main>
        <?php $this->componente('navbar'); ?>
        <?php $this->componente('flotante-whatsapp'); ?>

        <!-- ── HERO ──────────────────────────────────────────── -->
        <section class="relative -mt-[40px] w-screen overflow-hidden bg-gradient-to-r from-[#8160ae] to-[#553CC8] pt-28 pb-16 md:pt-32 md:pb-20">

            <!-- Decoración top-right -->
            <img src="<?= importAsset('imagenes/diplomado/decoracion-img-hero.svg') ?>" alt=""
                 class="absolute top-0 right-0 w-[55%] max-w-[700px] pointer-events-none select-none"
                 aria-hidden="true">

            <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-12 flex flex-col gap-10 md:gap-14">

                <!-- Título centrado -->
                <h1 class="font-montserrat font-extrabold text-[38px] md:text-[48px] text-white text-center uppercase leading-[1.2]">
                    <?= htmlspecialchars($diplomado['titulo'] ?? '') ?>
                </h1>

                <!-- Dos columnas: texto | foto -->
                <div class="flex flex-col lg:flex-row gap-10 lg:gap-16 items-center">

                    <!-- Columna izquierda: texto -->
                    <div class="flex-1 flex flex-col gap-6 text-white">
                        <?php if (!empty($diplomado['subtitulo_hero'])): ?>
                        <h2 class="font-montserrat font-bold text-[24px] xl:text-[30px] uppercase leading-[1.2]">
                            <?= htmlspecialchars($diplomado['subtitulo_hero']) ?>
                        </h2>
                        <?php endif; ?>
                        <?php if (!empty($diplomado['descripcion_hero'])): ?>
                        <p class="font-montserrat font-normal text-[16px] xl:text-[18px] leading-[1.8]">
                            <?= nl2br(htmlspecialchars($diplomado['descripcion_hero'])) ?>
                        </p>
                        <?php endif; ?>
                    </div>

                    <!-- Columna derecha: foto + sticker -->
                    <div class="relative flex-shrink-0 flex justify-center lg:justify-end
                                w-full lg:w-auto">

                        <!-- Sticker WOW! -->
                        <img src="<?= importAsset('imagenes/diplomado/sticker-wow.svg') ?>" alt="WOW!"
                             class="absolute -top-6 right-4 lg:-top-8 lg:right-0 w-[80px] md:w-[100px] lg:w-[120px] z-10 select-none">

                        <!-- Foto del grupo -->
                        <img src="<?= importAsset('imagenes/diplomado/img-hero.png') ?>" alt="Graduados del Diplomado WOW!"
                             class="relative z-[1] w-full max-w-[480px] lg:max-w-[540px] xl:max-w-[600px] object-contain drop-shadow-xl">

                        <!-- Mini-deco 1 (óvalo cian, esquina inferior izquierda de la foto) -->
                        <img src="<?= importAsset('imagenes/diplomado/mini-deco-1.svg') ?>" alt=""
                             class="absolute -bottom-4 -left-4 lg:-bottom-6 lg:-left-6 w-[60px] md:w-[80px] pointer-events-none select-none"
                             aria-hidden="true">

                        <!-- Mini-deco 2 (óvalo azul, esquina inferior derecha) -->
                        <img src="<?= importAsset('imagenes/diplomado/mini-deco-2.svg') ?>" alt=""
                             class="absolute bottom-6 -right-2 lg:bottom-8 lg:-right-4 w-[40px] md:w-[55px] pointer-events-none select-none"
                             aria-hidden="true">
                    </div>

                </div>
            </div>
        </section>

        <!-- ── SOBRE EL DIPLOMADO ─────────────────────────────── -->
        <section class="relative w-screen overflow-hidden bg-white py-16 md:py-24">

            <!-- Halitoso (mascota verde) -->
            <img src="<?= importAsset('imagenes/diplomado/Halitoso.svg') ?>" alt=""
                 class="absolute bottom-0 right-0 w-[120px] md:w-[160px] lg:w-[200px] pointer-events-none select-none"
                 aria-hidden="true">

            <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-12
                        flex flex-col lg:flex-row gap-12 lg:gap-16 items-center">

                <!-- Columna izquierda: foto de Ale con decoraciones -->
                <div class="relative flex-shrink-0 flex justify-center w-full lg:w-auto">

                    <!-- Decoración anillos/curvas detrás de la foto -->
                    <img src="<?= importAsset('imagenes/diplomado/decoracion-ale.svg') ?>" alt=""
                         class="absolute inset-0 w-full h-full object-contain pointer-events-none select-none scale-[1.4]"
                         aria-hidden="true">

                    <!-- Foto circular de Ale -->
                    <img src="<?= importAsset('imagenes/diplomado/img-ale-diplomado.png') ?>" alt="Alejandra Martínez - Fundadora del Diplomado WOW!"
                         class="relative z-[1] w-[280px] md:w-[340px] lg:w-[400px] xl:w-[440px] rounded-full object-cover aspect-square">

                    <!-- Mini-deco Ale (óvalos decorativos) -->
                    <img src="<?= importAsset('imagenes/diplomado/mini-deco-ale.svg') ?>" alt=""
                         class="absolute -bottom-4 -right-2 lg:-bottom-6 lg:-right-4 w-[80px] md:w-[110px] pointer-events-none select-none z-[2]"
                         aria-hidden="true">
                </div>

                <!-- Columna derecha: texto -->
                <div class="flex-1 flex flex-col gap-6 md:gap-8">

                    <div class="flex flex-col gap-4">
                        <h2 class="font-montserrat font-bold text-[24px] xl:text-[30px] uppercase leading-[1.2]">
                            <span class="text-[#FF3D81]">Diplomado WOW!</span><span class="text-[#553CC8]"> Experience Generación <?= htmlspecialchars($generacion) ?></span>
                        </h2>
                        <?php if (!empty($diplomado['subtitulo'])): ?>
                        <p class="font-montserrat font-bold text-[18px] xl:text-[24px] text-[#553CC8] leading-[1.2]">
                            <?= htmlspecialchars($diplomado['subtitulo']) ?>
                        </p>
                        <?php endif; ?>
                    </div>

                    <?php if (!empty($diplomado['descripcion'])): ?>
                    <p class="font-montserrat font-normal text-[16px] xl:text-[18px] text-[#4B4B4B] leading-[1.8]">
                        <?= nl2br(htmlspecialchars($diplomado['descripcion'])) ?>
                    </p>
                    <?php endif; ?>

                    <?php if (!empty($url_temario)): ?>
                    <a href="<?= url('recursos/' . $url_temario) ?>"
                       target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center gap-3 text-[#0064FF] font-montserrat font-medium text-[16px] xl:text-[18px] hover:underline">
                        <!-- Ícono cloud-download -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#0064FF" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <polyline points="8 17 12 21 16 17"/>
                            <line x1="12" y1="12" x2="12" y2="21"/>
                            <path d="M20.88 18.09A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.29"/>
                        </svg>
                        Descargar temario
                    </a>
                    <?php endif; ?>
                </div>

            </div>
        </section>

        <?php if (!empty($diplomado['imagen_preview'])): ?>
        <!-- ── PREVIEW TEMARIO ──────────────────────────── -->
        <section class="relative w-screen overflow-hidden py-16 md:py-24" style="background: linear-gradient(135deg, #E6F0F0 0%, #f0f6f9 100%)">
            <div class="max-w-5xl mx-auto px-6 lg:px-12 flex flex-col items-center gap-8 md:gap-12">
                <h2 class="font-montserrat font-bold text-[24px] xl:text-[30px] uppercase text-center leading-[1.2]">
                    Temario del <span class="text-[#FF3D81]">Diplomado WOW!</span> <span class="text-[#553CC8]">Experience</span>
                </h2>
                <!-- Imagen decorada -->
                <div class="relative flex justify-center w-full max-w-3xl">

                    <!-- Imagen del temario -->
                    <img src="<?= url('recursos/' . $diplomado['imagen_preview']) ?>"
                         alt="Preview del temario del Diplomado WOW! Experience"
                         class="relative w-full rounded-2xl object-contain">

                    <!-- Sombra decorativa encima -->
                    <img src="<?= importAsset('imagenes/diplomado/sombra-preview.svg') ?>" alt=""
                         class="absolute inset-0 w-full h-full object-contain scale-[1.08] pointer-events-none select-none z-[1]"
                         aria-hidden="true">

                    <!-- Sticker WOW! 2 -->
                    <img src="<?= importAsset('imagenes/diplomado/Sticker WOW 2.svg') ?>" alt="WOW!"
                         class="absolute -top-8 -right-4 md:-top-10 md:-right-6 w-[80px] md:w-[110px] lg:w-[130px] z-[2] select-none pointer-events-none"
                         aria-hidden="true">
                </div>
                <?php if (!empty($url_temario)): ?>
                <a href="<?= url('recursos/' . $url_temario) ?>"
                   target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center gap-3 bg-[#FF3D81] text-white font-montserrat font-bold text-[16px] px-8 py-4 rounded-full hover:bg-[#e02a6e] duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <polyline points="8 17 12 21 16 17"/>
                        <line x1="12" y1="12" x2="12" y2="21"/>
                        <path d="M20.88 18.09A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.29"/>
                    </svg>
                    Descargar temario
                </a>
                <?php endif; ?>
            </div>
        </section>
        <?php endif; ?>

        <?php $this->componente('footer'); ?>
    </main>
</body>
</html>
