<!DOCTYPE html>
<html lang="ES">
<?php
$titulo      = htmlspecialchars($articulo['titulo']) . ' - ' . env('EMPRESA');
$descripcion = !empty($articulo['extracto']) ? htmlspecialchars($articulo['extracto']) : 'Artículo del blog.';
?>
<head>
    <?php $this->plantilla('metas-basicas') ?>
    <?php $this->plantilla('estilos') ?>
    <?php $this->plantilla('metadatos', [
        'titulo'      => $titulo,
        'descripcion' => $descripcion,
        'imagen'      => !empty($articulo['imagen_url']) ? url($articulo['imagen_url']) : '',
        'url'         => ruta('blog/' . $articulo['slug']),
    ]) ?>
    <title><?= $titulo ?></title>
    <meta name="description" content="<?= $descripcion ?>">
    <link rel="canonical" href="<?= ruta('blog/' . htmlspecialchars($articulo['slug'])) ?>"/>
    <meta name="robots" content="index, follow">
    <?= configuracion('tag_manager_head') ?>
    <style>
        /* Quill / rich-text output styles */
        .article-body p          { margin-bottom: 1em; }
        .article-body h1         { font-size: 1.875rem; font-weight: 700; color: #553CC8; line-height: 1.2; margin: 1.5em 0 .5em; }
        .article-body h2         { font-size: 1.5rem;   font-weight: 700; color: #553CC8; line-height: 1.2; margin: 1.5em 0 .5em; }
        .article-body h3         { font-size: 1.25rem;  font-weight: 700; color: #553CC8; line-height: 1.2; margin: 1.5em 0 .5em; }
        .article-body a          { color: #0064ff; text-decoration: underline; }
        .article-body strong,
        .article-body b          { font-weight: 700; color: #553CC8; }
        .article-body em,
        .article-body i          { font-style: italic; }
        .article-body ul         { list-style: disc;    padding-left: 1.5em; margin-bottom: 1em; }
        .article-body ol         { list-style: decimal; padding-left: 1.5em; margin-bottom: 1em; }
        .article-body li         { margin-bottom: .25em; }
        .article-body blockquote { border-left: 4px solid #553CC8; padding-left: 1em; color: #555; margin: 1em 0; font-style: italic; }
        .article-body s          { text-decoration: line-through; }
    </style>
</head>
<body class="w-screen overflow-x-clip">
    <?= configuracion('tag_manager_body') ?>
    <main>
        <?php $this->componente('navbar'); ?>

        <!-- ── Hero ─────────────────────────────────────────────── -->
        <section class="relative w-full h-[600px] overflow-hidden bg-[#553cc8]">

            <!-- Back button -->
            <a href="<?= ruta('blog') ?>"
               class="absolute top-[40px] left-[40px] xl:left-[80px] z-10
                      border-2 border-[#0064ff] rounded-full p-[10px]
                      hover:bg-[#0064ff]/10 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#0064ff]"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>

            <!-- Hero image -->
            <?php if (!empty($articulo['imagen_url'])): ?>
            <img src="<?= url(htmlspecialchars($articulo['imagen_url'])) ?>"
                 alt=""
                 class="absolute inset-0 w-full h-full object-cover pointer-events-none">
            <?php endif; ?>

            <!-- Dark tint -->
            <div class="absolute inset-0 bg-black/20 pointer-events-none mix-blend-multiply"></div>

            <!-- Bottom gradient: transparent → #553cc8 -->
            <div class="absolute inset-0 pointer-events-none"
                 style="background: linear-gradient(to bottom, rgba(85,60,200,0) 30%, #553cc8 100%);"></div>

            <!-- Title -->
            <div class="absolute bottom-[100px] left-0 right-0 text-center px-8">
                <h1 class="font-montserrat font-bold text-[30px] text-white uppercase leading-[1.2]">
                    <?= htmlspecialchars($articulo['titulo']) ?>
                </h1>
            </div>
        </section>

        <!-- ── Date + Share bar ───────────────────────────────────── -->
        <div class="w-full flex justify-center -mt-[40px] relative z-30">
            <div class="w-full max-w-[812px] relative">
                <!-- Decoración derecha de la barra -->
                <img
                    src="<?= importAsset('imagenes/articulo/Halitoso.svg') ?>"
                    alt=""
                    class="absolute translate-x-[-4px] z-[-10] left-full bottom-0 h-[80px] w-auto pointer-events-none select-none hidden xl:block"
                >
                <div class="flex items-center justify-between px-[40px] h-[80px]"
                     style="background: linear-gradient(90deg, #FF3D81 0%, #553CC8 100%);">
                    <span class="font-montserrat font-normal text-[18px] text-white leading-[1.8] whitespace-nowrap">
                        <?= date('d/m/Y', strtotime($articulo['creado'])) ?>
                    </span>
                    <!-- Share / export icon -->
                    <button onclick="if(navigator.share){navigator.share({title:document.title,url:window.location.href})}"
                            class="text-white hover:opacity-75 transition-opacity cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- ── Article content ───────────────────────────────────── -->
        <section class="w-full bg-white py-12 relative overflow-hidden">

            <!-- Decoración superior derecha -->
            <img
                src="<?= importAsset('imagenes/articulo/deco-arriba.svg') ?>"
                alt=""
                class="absolute top-0 right-0 w-[40%] max-w-[500px] h-auto pointer-events-none select-none"
            >

            <!-- Decoración inferior izquierda -->
            <img
                src="<?= importAsset('imagenes/articulo/deco-abajo.svg') ?>"
                alt=""
                class="absolute bottom-0 left-0 w-[40%] max-w-[500px] h-auto pointer-events-none select-none"
            >

            <div class="w-full max-w-[812px] mx-auto px-4 flex flex-col gap-[20px] relative z-10">

                <!-- Subtitle (extracto) -->
                <?php if (!empty($articulo['extracto'])): ?>
                <h2 class="font-montserrat font-bold text-[24px] text-[#553cc8] leading-[1.2]">
                    <?= htmlspecialchars($articulo['extracto']) ?>
                </h2>
                <?php endif; ?>

                <!-- Body (Quill HTML) -->
                <?php if (!empty($articulo['contenido'])): ?>
                <div class="article-body font-montserrat font-normal text-[18px] text-black leading-[1.8]">
                    <?= $articulo['contenido'] ?>
                </div>
                <?php else: ?>
                <p class="text-center text-gray-400 font-montserrat py-8">Contenido próximamente.</p>
                <?php endif; ?>

            </div>
        </section>

        <!-- ── Tarjetas artículo anterior / siguiente ──────────────── -->
        <?php if (!empty($articulo_anterior) || !empty($articulo_siguiente)): ?>
        <div class="w-full flex justify-center pb-8">
            <div class="w-full max-w-[812px] px-4 grid grid-cols-1 sm:grid-cols-2 gap-6">

                <?php if (!empty($articulo_anterior)): ?>
                <a href="<?= ruta('blog/' . htmlspecialchars($articulo_anterior['slug'])) ?>"
                   class="group flex flex-col gap-3 cursor-pointer">
                    <div class="relative rounded-[20px] overflow-hidden h-[260px] bg-gray-100">
                        <?php if (!empty($articulo_anterior['imagen_url'])): ?>
                        <img src="<?= url(htmlspecialchars($articulo_anterior['imagen_url'])) ?>"
                             alt="<?= htmlspecialchars($articulo_anterior['titulo']) ?>"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        <?php else: ?>
                        <div class="w-full h-full bg-gradient-to-br from-[#553CC8] to-[#FF3D81]"></div>
                        <?php endif; ?>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                        <span class="absolute bottom-4 left-4 right-4 font-montserrat font-bold text-white text-[16px] leading-[1.2] line-clamp-2">
                            <?= htmlspecialchars($articulo_anterior['titulo']) ?>
                        </span>
                    </div>
                    <span class="flex items-center gap-2 font-montserrat font-medium text-[18px] text-[#0064ff] leading-[1.8]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 shrink-0 rotate-180"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                        Artículo anterior
                    </span>
                </a>
                <?php else: ?>
                <div></div>
                <?php endif; ?>

                <?php if (!empty($articulo_siguiente)): ?>
                <a href="<?= ruta('blog/' . htmlspecialchars($articulo_siguiente['slug'])) ?>"
                   class="group flex flex-col gap-3 cursor-pointer">
                    <div class="relative rounded-[20px] overflow-hidden h-[260px] bg-gray-100">
                        <?php if (!empty($articulo_siguiente['imagen_url'])): ?>
                        <img src="<?= url(htmlspecialchars($articulo_siguiente['imagen_url'])) ?>"
                             alt="<?= htmlspecialchars($articulo_siguiente['titulo']) ?>"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        <?php else: ?>
                        <div class="w-full h-full bg-gradient-to-br from-[#553CC8] to-[#FF3D81]"></div>
                        <?php endif; ?>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                        <span class="absolute bottom-4 left-4 right-4 font-montserrat font-bold text-white text-[16px] leading-[1.2] line-clamp-2">
                            <?= htmlspecialchars($articulo_siguiente['titulo']) ?>
                        </span>
                    </div>
                    <span class="flex items-center gap-2 font-montserrat font-medium text-[18px] text-[#0064ff] leading-[1.8] justify-end">
                        Artículo siguiente
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 shrink-0"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </span>
                </a>
                <?php else: ?>
                <div></div>
                <?php endif; ?>

            </div>
        </div>
        <?php endif; ?>



        <?php $this->componente('footer'); ?>
    </main>
</body>
</html>
