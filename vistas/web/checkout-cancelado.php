<!DOCTYPE html>
<html lang="ES">
<?php
$titulo = 'Pago cancelado - ' . env('EMPRESA');
?>
<head>
    <?php $this->plantilla('metas-basicas') ?>
    <?php $this->plantilla('estilos') ?>
    <title><?= $titulo ?></title>
    <meta name="robots" content="noindex, nofollow">
    <?= configuracion('tag_manager_head') ?>
</head>
<body class="w-screen overflow-x-clip">
    <?= configuracion('tag_manager_body') ?>
    <main>
        <?php $this->componente('navbar'); ?>

        <section class="w-screen min-h-screen flex items-center justify-center pt-[100px] pb-[60px] px-4"
                 style="background-color: #E6F0F0;">
            <div class="bg-white rounded-[30px] shadow-2xl max-w-[560px] w-full px-10 py-14 flex flex-col items-center gap-6 text-center">

                <!-- Ícono × -->
                <div class="w-[80px] h-[80px] rounded-full bg-[#FF3D81]/10 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-[#FF3D81]" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </div>

                <h1 class="font-montserrat font-extrabold text-[32px] text-[#553CC8] leading-tight">
                    Pago cancelado
                </h1>

                <p class="font-montserrat text-[16px] text-[#4B4B4B] leading-relaxed">
                    Saliste del proceso de pago. No se realizó ningún cargo.
                    Puedes intentarlo de nuevo cuando quieras.
                </p>

                <div class="flex flex-col sm:flex-row gap-3 mt-4 w-full justify-center">
                    <?php if (!empty($producto) && !empty($producto['url_interna'])): ?>
                    <a href="<?= ruta('tienda/' . htmlspecialchars($producto['url_interna'])) ?>"
                       class="px-8 py-3 rounded-full font-montserrat font-semibold text-white text-[16px] hover:opacity-90 transition-opacity duration-200"
                       style="background: linear-gradient(90deg, #553CC8 0%, #FF3D81 100%);">
                        Volver al producto
                    </a>
                    <?php endif; ?>
                    <a href="<?= ruta('tienda') ?>"
                       class="px-8 py-3 rounded-full font-montserrat font-semibold text-[#553CC8] border-2 border-[#553CC8] text-[16px] hover:bg-[#553CC8] hover:text-white transition-colors duration-200">
                        Ver tienda
                    </a>
                </div>
            </div>
        </section>

        <?php $this->componente('footer'); ?>
    </main>
</body>
</html>
