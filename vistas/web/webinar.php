<!DOCTYPE html>
<html lang="ES">
<?php
$titulo      = htmlspecialchars($webinar['titulo']) . ' - ' . env('EMPRESA');
$descripcion = !empty($webinar['extracto']) ? htmlspecialchars($webinar['extracto']) : 'Webinar de WOW Experience.';

function ytIdDesdeUrl($url) {
    if (empty($url)) return null;
    if (preg_match(
        '/(?:youtube\.com\/(?:watch\?(?:.*&)?v=|embed\/|v\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/',
        $url, $m
    )) return $m[1];
    return null;
}
$ytId    = ytIdDesdeUrl($webinar['link_youtube'] ?? '');
$ogImage = $ytId ? 'https://img.youtube.com/vi/' . $ytId . '/maxresdefault.jpg' : '';
?>
<head>
    <?php $this->plantilla('metas-basicas') ?>
    <?php $this->plantilla('estilos') ?>
    <?php $this->plantilla('metadatos', [
        'titulo'      => $titulo,
        'descripcion' => $descripcion,
        'imagen'      => $ogImage,
        'url'         => ruta('webinars/' . $webinar['slug']),
    ]) ?>
    <title><?= $titulo ?></title>
    <meta name="description" content="<?= $descripcion ?>">
    <link rel="canonical" href="<?= ruta('webinars/' . htmlspecialchars($webinar['slug'])) ?>"/>
    <meta name="robots" content="index, follow">
    <?= configuracion('tag_manager_head') ?>
</head>
<body class="w-screen overflow-x-clip">
    <?= configuracion('tag_manager_body') ?>
    <main>
        <?php $this->componente('navbar'); ?>

        <!-- ── Hero / Video embed ────────────────────────────────── -->
        <section class="relative w-full mt-[120px] overflow-hidden bg-[#553cc8]">

            <!-- Back button -->
            <a href="<?= ruta('webinars') ?>"
               class="absolute top-[40px] left-[40px] xl:left-[80px] z-10
                      border-2 border-[#0064ff] rounded-full p-[10px]
                      hover:bg-[#0064ff]/10 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#0064ff]"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>

            <?php if ($ytId): ?>
            <!-- YouTube embed (16:9) -->
            <div class="w-full" style="padding-top: 56.25%; position: relative;">
                <iframe
                    src="https://www.youtube.com/embed/<?= htmlspecialchars($ytId) ?>?rel=0"
                    title="<?= htmlspecialchars($webinar['titulo']) ?>"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                    class="absolute inset-0 w-full h-full border-0">
                </iframe>
            </div>
            <?php else: ?>
            <!-- Fallback: just the gradient with title -->
            <div class="w-full h-[400px] flex items-end justify-center pb-16 px-8">
                <h1 class="font-montserrat font-bold text-[30px] text-white uppercase leading-[1.2] text-center">
                    <?= htmlspecialchars($webinar['titulo']) ?>
                </h1>
            </div>
            <?php endif; ?>
        </section>

        <!-- ── Date bar ───────────────────────────────────────────── -->
        <div class="w-full flex justify-center">
            <div class="w-full max-w-[812px]">
                <div class="flex items-center justify-between px-[40px] h-[80px]"
                     style="background: linear-gradient(90deg, #FF3D81 0%, #553CC8 100%);">
                    <span class="font-montserrat font-normal text-[18px] text-white leading-[1.8] whitespace-nowrap">
                        <?= date('d/m/Y', strtotime($webinar['creado'])) ?>
                    </span>
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

        <!-- ── Content ────────────────────────────────────────────── -->
        <section class="w-full bg-white py-12">
            <div class="w-full max-w-[812px] mx-auto px-4 flex flex-col gap-[20px]">

                <h1 class="font-montserrat font-bold text-[30px] text-[#553cc8] leading-[1.2]">
                    <?= htmlspecialchars($webinar['titulo']) ?>
                </h1>

                <?php if (!empty($webinar['extracto'])): ?>
                <p class="font-montserrat font-normal text-[18px] text-black leading-[1.8]">
                    <?= htmlspecialchars($webinar['extracto']) ?>
                </p>
                <?php endif; ?>

            </div>
        </section>

        <!-- ── Webinar anterior / siguiente ──────────────────────── -->
        <?php if (!empty($webinar_anterior) || !empty($webinar_siguiente)): ?>
        <div class="w-full flex justify-center py-8 pb-16">
            <div class="w-full max-w-[812px] px-4 grid grid-cols-1 sm:grid-cols-2 gap-6">

                <?php if (!empty($webinar_anterior)):
                    $thumbPrev = ytIdDesdeUrl($webinar_anterior['link_youtube'] ?? '');
                    $thumbPrev = $thumbPrev ? 'https://img.youtube.com/vi/' . $thumbPrev . '/hqdefault.jpg' : null;
                ?>
                <a href="<?= ruta('webinars/' . htmlspecialchars($webinar_anterior['slug'])) ?>"
                   class="group flex flex-col gap-3 cursor-pointer">
                    <div class="relative rounded-[20px] overflow-hidden h-[260px] bg-gray-100">
                        <?php if ($thumbPrev): ?>
                        <img src="<?= htmlspecialchars($thumbPrev) ?>"
                             alt="<?= htmlspecialchars($webinar_anterior['titulo']) ?>"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        <?php else: ?>
                        <div class="w-full h-full bg-gradient-to-br from-[#553CC8] to-[#FF3D81]"></div>
                        <?php endif; ?>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                        <!-- Play icon -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="w-12 h-12 rounded-full bg-white/40 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white ml-0.5" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
                            </div>
                        </div>
                        <span class="absolute bottom-4 left-4 right-4 font-montserrat font-bold text-white text-[16px] leading-[1.2] line-clamp-2">
                            <?= htmlspecialchars($webinar_anterior['titulo']) ?>
                        </span>
                    </div>
                    <span class="flex items-center gap-2 font-montserrat font-medium text-[18px] text-[#0064ff] leading-[1.8]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 shrink-0 rotate-180"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                        Webinar anterior
                    </span>
                </a>
                <?php else: ?><div></div><?php endif; ?>

                <?php if (!empty($webinar_siguiente)):
                    $thumbNext = ytIdDesdeUrl($webinar_siguiente['link_youtube'] ?? '');
                    $thumbNext = $thumbNext ? 'https://img.youtube.com/vi/' . $thumbNext . '/hqdefault.jpg' : null;
                ?>
                <a href="<?= ruta('webinars/' . htmlspecialchars($webinar_siguiente['slug'])) ?>"
                   class="group flex flex-col gap-3 cursor-pointer">
                    <div class="relative rounded-[20px] overflow-hidden h-[260px] bg-gray-100">
                        <?php if ($thumbNext): ?>
                        <img src="<?= htmlspecialchars($thumbNext) ?>"
                             alt="<?= htmlspecialchars($webinar_siguiente['titulo']) ?>"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        <?php else: ?>
                        <div class="w-full h-full bg-gradient-to-br from-[#553CC8] to-[#FF3D81]"></div>
                        <?php endif; ?>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="w-12 h-12 rounded-full bg-white/40 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white ml-0.5" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
                            </div>
                        </div>
                        <span class="absolute bottom-4 left-4 right-4 font-montserrat font-bold text-white text-[16px] leading-[1.2] line-clamp-2">
                            <?= htmlspecialchars($webinar_siguiente['titulo']) ?>
                        </span>
                    </div>
                    <span class="flex items-center gap-2 font-montserrat font-medium text-[18px] text-[#0064ff] leading-[1.8] justify-end">
                        Webinar siguiente
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 shrink-0"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </span>
                </a>
                <?php else: ?><div></div><?php endif; ?>

            </div>
        </div>
        <?php endif; ?>

        <?php $this->componente('footer'); ?>
    </main>
</body>
</html>
