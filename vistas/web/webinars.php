<!DOCTYPE html>
<html lang="ES">
<?php
$titulo      = 'Webinars - ' . env('EMPRESA');
$descripcion = 'Webinars y videos educativos de WOW Experience.';

function ytIdFromUrl($url) {
    if (empty($url)) return null;
    if (preg_match(
        '/(?:youtube\.com\/(?:watch\?(?:.*&)?v=|embed\/|v\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/',
        $url, $m
    )) return $m[1];
    return null;
}
function ytThumbWebinar($url) {
    $id = ytIdFromUrl($url);
    return $id ? 'https://img.youtube.com/vi/' . $id . '/maxresdefault.jpg' : null;
}
?>
<head>
    <?php $this->plantilla('metas-basicas') ?>
    <?php $this->plantilla('estilos') ?>
    <?php $this->plantilla('metadatos', [
        'titulo'      => $titulo,
        'descripcion' => $descripcion,
        'imagen'      => '',
        'url'         => ruta('webinars'),
    ]) ?>
    <title><?= $titulo ?></title>
    <meta name="description" content="<?= $descripcion ?>">
    <link rel="canonical" href="<?= ruta('webinars') ?>"/>
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
                    Webinars
                </h1>
            </div>
        </section>

        <!-- Webinars Grid -->
        <section class="w-screen bg-white py-16 pb-24 relative overflow-hidden">
            <div class="w-full max-w-7xl mx-auto px-8">

                <?php if (empty($webinars)): ?>
                    <p class="text-center text-gray-400 font-montserrat py-16 text-lg">
                        Próximamente publicaremos webinars. ¡Vuelve pronto!
                    </p>
                <?php else: ?>

                <div id="webinars-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 items-stretch">
                    <?php foreach ($webinars as $w): ?>
                    <?php
                        $ytId  = ytIdFromUrl($w['link_youtube']);
                        $thumb = ytThumbWebinar($w['link_youtube']);
                    ?>
                    <button type="button"
                            onclick="abrirWebinar(
                                '<?= htmlspecialchars(addslashes($ytId ?? ''), ENT_QUOTES) ?>',
                                '<?= htmlspecialchars(addslashes($w['titulo']), ENT_QUOTES) ?>',
                                '<?= htmlspecialchars(addslashes($w['extracto'] ?? ''), ENT_QUOTES) ?>'
                            )"
                            class="flex flex-col gap-[20px] items-start rounded-[20px] cursor-pointer hover:shadow-xl transition-shadow duration-300 h-full pb-[20px] text-left w-full">

                        <!-- Thumbnail -->
                        <div class="relative w-full h-[260px] rounded-[20px] overflow-hidden bg-gray-200 shrink-0">
                            <?php if ($thumb): ?>
                            <img src="<?= htmlspecialchars($thumb) ?>"
                                 alt="<?= htmlspecialchars($w['titulo']) ?>"
                                 class="absolute inset-0 w-full h-full object-cover rounded-[20px]"
                                 onerror="this.onerror=null;this.src='https://img.youtube.com/vi/<?= htmlspecialchars($ytId ?? '') ?>/hqdefault.jpg'">
                            <?php else: ?>
                            <div class="absolute inset-0 bg-gradient-to-br from-[#553CC8] to-[#7D82AA] rounded-[20px]"></div>
                            <?php endif; ?>

                            <!-- Play button -->
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="w-[80px] h-[80px] rounded-full bg-white/40 backdrop-blur-sm flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white ml-1" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </div>
                            </div>

                            <!-- Date badge -->
                            <div class="absolute bottom-4 left-1/2 -translate-x-1/2">
                                <span class="bg-[#7d82aa] text-white font-montserrat text-[14px] font-normal px-[20px] py-0.5 rounded-[40px] whitespace-nowrap">
                                    <?= date('d/m/Y', strtotime($w['creado'])) ?>
                                </span>
                            </div>
                        </div>

                        <!-- Text -->
                        <div class="flex flex-col gap-[10px] items-start px-[20px] w-full">
                            <p class="font-montserrat font-bold text-[24px] text-[#553cc8] leading-[1.2] w-full">
                                <?= htmlspecialchars($w['titulo']) ?>
                            </p>
                            <?php if (!empty($w['extracto'])): ?>
                            <p class="font-montserrat font-normal text-[14px] text-black leading-[1.8] w-full">
                                <?= htmlspecialchars($w['extracto']) ?>
                            </p>
                            <?php endif; ?>
                        </div>

                    </button>
                    <?php endforeach; ?>
                </div>

                <!-- Cargar más -->
                <?php if ($total > $offset + $limit): ?>
                <div class="flex justify-center mt-16">
                    <a href="<?= ruta('webinars') . '?desde=' . ($offset + $limit) ?>"
                       class="font-montserrat font-medium text-[18px] text-[#ff3d81] border-2 border-[#ff3d81]
                              px-10 py-3 rounded-full hover:bg-[#ff3d81] hover:text-white transition-colors duration-200">
                        Cargar más
                    </a>
                </div>
                <?php endif; ?>

                <?php endif; ?>
            </div>
        </section>

        <?php $this->componente('footer'); ?>
    </main>

    <!-- ── Webinar Modal ──────────────────────────────────────────────────── -->
    <div id="webinar-overlay"
         class="fixed inset-0 z-[999] flex items-center justify-center p-4 hidden"
         style="background: rgba(0,0,0,0.85);"
         onclick="cerrarWebinar(event)">

        <!-- Card -->
        <div class="relative bg-white rounded-[20px] w-full max-w-[860px] overflow-hidden shadow-2xl">

            <!-- Close button — outside card, top-right corner -->
            <button onclick="cerrarWebinar()"
                    class="absolute -top-5 -right-5 z-10 w-[40px] h-[40px] rounded-full bg-white border-2 border-gray-300
                           flex items-center justify-center hover:border-[#553CC8] hover:text-[#553CC8] transition-colors shadow-md"
                    aria-label="Cerrar">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- Video area 16:9 with rounded corners -->
            <div id="webinar-video-wrap" class="w-full rounded-t-[20px] overflow-hidden bg-black"
                 style="padding-top: 56.25%; position: relative;">
                <iframe id="webinar-iframe"
                        src=""
                        title="Webinar"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                        class="absolute inset-0 w-full h-full border-0 rounded-t-[20px]">
                </iframe>
            </div>

            <!-- Text -->
            <div class="flex flex-col gap-[10px] items-start px-[20px] py-[20px]">
                <p id="webinar-titulo"
                   class="font-montserrat font-bold text-[24px] text-[#553cc8] leading-[1.2] w-full"></p>
                <p id="webinar-extracto"
                   class="font-montserrat font-normal text-[14px] text-black leading-[1.8] w-full"></p>
            </div>
        </div>
    </div>

    <script>
    function abrirWebinar(ytId, titulo, extracto) {
        document.getElementById('webinar-titulo').textContent   = titulo;
        document.getElementById('webinar-extracto').textContent = extracto;
        const src = ytId
            ? 'https://www.youtube.com/embed/' + ytId + '?autoplay=1&rel=0'
            : '';
        document.getElementById('webinar-iframe').src = src;
        document.getElementById('webinar-overlay').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function cerrarWebinar(e) {
        // If called from overlay click, only close if target IS the overlay
        if (e && e.target !== document.getElementById('webinar-overlay')) return;
        document.getElementById('webinar-iframe').src = '';  // stops video
        document.getElementById('webinar-overlay').classList.add('hidden');
        document.body.style.overflow = '';
    }

    // ESC key closes the modal
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.getElementById('webinar-iframe').src = '';
            document.getElementById('webinar-overlay').classList.add('hidden');
            document.body.style.overflow = '';
        }
    });
    </script>
</body>
</html>
