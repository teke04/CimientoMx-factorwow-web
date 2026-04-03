<!DOCTYPE html>
<html lang="ES">
<?php
$titulo      = 'Preguntas Frecuentes - ' . env('EMPRESA');
$descripcion = 'Resolvemos tus dudas sobre Factor WOW y WOW Experience: servicios, pagos, envíos y más.';
?>
<head>
    <?php $this->plantilla('metas-basicas') ?>
    <?php $this->plantilla('estilos') ?>
    <?php $this->plantilla('metadatos', [
        'titulo'      => $titulo,
        'descripcion' => $descripcion,
        'imagen'      => '',
        'url'         => ruta('faq'),
    ]) ?>
    <title><?= $titulo ?></title>
    <meta name="description" content="<?= $descripcion ?>">
    <link rel="canonical" href="<?= ruta('faq') ?>"/>
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
                <h1 class="font-montserrat font-extrabold text-[48px] text-white tracking-widest uppercase text-center">
                    Preguntas frecuentes
                </h1>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="w-screen min-h-screen flex items-start justify-center  pb-[400px] relative" style="background: #E6F0F0;">
            <div class="w-full max-w-7xl flex flex-col gap-12 py-16 px-8">

                <!-- FAQ Items -->
                <div class="w-full flex flex-col gap-6">
                    <?php
                    $faqs = [
                        [
                            'pregunta' => '¿Qué es Factor WOW?',
                            'respuesta' => '',
                        ],
                        [
                            'pregunta' => '¿Qué es WOW Experience?',
                            'respuesta' => 'WOW! Experience es una metodología donde, a través de conferencias, diplomados y cursos creados y enseñados por la Dra. Alejandra Martínez, conocerás cómo mejorar la experiencia de servicio al cliente en el sector salud.',
                        ],
                        [
                            'pregunta' => '¿Qué servicios ofrece Factor WOW?',
                            'respuesta' => '',
                        ],
                        [
                            'pregunta' => '¿Qué métodos de pago aceptan?',
                            'respuesta' => '',
                        ],
                        [
                            'pregunta' => '¿Ofrecen envíos internacionales?',
                            'respuesta' => '',
                        ],
                        [
                            'pregunta' => '¿Cuánto tiempo tarda el envío?',
                            'respuesta' => '',
                        ],
                        [
                            'pregunta' => '¿Qué pasa si tengo problemas con mi orden?',
                            'respuesta' => '',
                        ],
                        [
                            'pregunta' => '¿Realizan reembolsos?',
                            'respuesta' => 'Al ser productos digitales, no se realizan reembolsos. Una vez completada la compra, recibirás por correo las instrucciones para acceder al material.',
                        ],
                        [
                            'pregunta' => '¿Es seguro comprar en su sitio web?',
                            'respuesta' => '',
                        ],
                        [
                            'pregunta' => '¿Necesito una cuenta para realizar un pedido?',
                            'respuesta' => '',
                        ],
                    ];
                    ?>

                    <?php foreach ($faqs as $index => $faq): ?>
                    <div class="faq-item bg-white w-full rounded-[40px] p-10 cursor-pointer overflow-hidden border-b-4 border-b-transparent transition-all duration-500 hover:shadow-lg" data-faq="<?= $index ?>">
                        <!-- Header -->
                        <div class="faq-header flex gap-10 items-center justify-between w-full">
                            <h3 class="font-montserrat font-bold text-[24px] text-[#553CC8] leading-tight flex-1">
                                <?= htmlspecialchars($faq['pregunta']) ?>
                            </h3>
                            <div class="faq-toggle text-[#FF3D81] text-[28px] font-bold flex-shrink-0 transition-transform duration-500">+</div>
                        </div>

                        <!-- Respuesta (oculta por defecto) -->
                        <?php if (!empty($faq['respuesta'])): ?>
                        <div class="faq-content max-h-0 transition-all duration-700 ease-in-out overflow-hidden">
                            <div class="h-0.5 bg-[#FF3D81] my-6"></div>
                            <p class="font-montserrat font-normal text-[18px] text-[#4B4B4B] leading-relaxed pb-4 opacity-0 transition-opacity duration-700">
                                <?= htmlspecialchars($faq['respuesta']) ?>
                            </p>
                        </div>
                        <?php else: ?>
                        <div class="faq-content max-h-0 transition-all duration-700 ease-in-out overflow-hidden">
                            <div class="h-0.5 bg-[#FF3D81] my-6"></div>
                            <p class="font-montserrat font-normal text-[18px] text-[#4B4B4B] leading-relaxed pb-4 opacity-0 transition-opacity duration-700">
                                Próximamente.
                            </p>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Decoración inferior -->
                <div class="w-full max-w-[300px] absolute left-0 bottom-0">
                    <img src="<?= importAsset('imagenes/home/deco-faq.png') ?>" alt="" class="w-full h-auto">
                </div>

            </div>
        </section>

        <?php $this->componente('flotante-whatsapp'); ?>
        <?php $this->componente('footer'); ?>
    </main>

    <script>
    document.querySelectorAll('.faq-item').forEach(function(item) {
        item.addEventListener('click', function() {
            const content = this.querySelector('.faq-content');
            const text    = content.querySelector('p');
            const toggle  = this.querySelector('.faq-toggle');
            const isOpen  = content.classList.contains('open');

            if (!isOpen) {
                content.classList.add('open');
                content.style.maxHeight = content.scrollHeight + 'px';
                setTimeout(function() {
                    text.classList.remove('opacity-0');
                    text.classList.add('opacity-100');
                }, 200);
                item.classList.add('border-b-[#FF3D81]');
                toggle.textContent = '−';
            } else {
                content.classList.remove('open');
                content.style.maxHeight = '0';
                text.classList.add('opacity-0');
                text.classList.remove('opacity-100');
                item.classList.remove('border-b-[#FF3D81]');
                toggle.textContent = '+';
            }
        });
    });
    </script>
</body>
</html>
