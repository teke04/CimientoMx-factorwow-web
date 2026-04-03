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
        <section class="w-screen pt-[72px] xl:pt-[80px]" style="background: linear-gradient(90deg, #553CC8 0%, #7D82AA 100%);">
            <div class="w-full max-w-7xl mx-auto px-6 xl:px-8 py-10 xl:py-16 flex items-center justify-center">
                <h1 class="font-montserrat font-extrabold text-[34px] xl:text-[48px] text-white tracking-widest uppercase text-center">
                    Preguntas frecuentes
                </h1>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="w-screen min-h-screen flex items-start justify-center  pb-[400px] relative overflow-hidden" style="background: #E6F0F0;">

            <!-- Decoración superior derecha -->
            <img
                src="<?= importAsset('imagenes/faq/deco-arriba.svg') ?>"
                alt=""
                class="absolute top-0 right-0 w-[40%] max-w-[500px] h-auto pointer-events-none select-none"
            >

            <!-- Decoración inferior izquierda -->
            <img
                src="<?= importAsset('imagenes/faq/deco-abajo.svg') ?>"
                alt=""
                class="absolute bottom-0 left-0 w-[40%] max-w-[500px] h-auto pointer-events-none select-none"
            >

            <div class="w-full max-w-7xl flex flex-col gap-12 py-16 px-8 relative z-10">

                <!-- FAQ Items -->
                <div class="w-full flex flex-col gap-6">
                    <?php
                    $faqs = [
                        [
                            'pregunta' => '¿Qué es Factor WOW?',
                            'respuesta' => 'Es una marca registrada, y al mismo tiempo, representa esos momentos que generan una emoción positiva en los pacientes. Es ese "WOW" que dicen cuando entran a un consultorio hermoso, cuando se sorprenden porque un procedimiento no dolió o cuando sienten una atención excepcional. Es ese detalle que marca la diferencia en su experiencia.',
                        ],
                        [
                            'pregunta' => '¿Qué es WOW Experience?',
                            'respuesta' => 'Es un Diplomado que se lleva a cabo de manera anual a través de un modelo innovador en el sector salud que transforma la manera en que los profesionales interactúan con sus pacientes, creando experiencias memorables y diferenciadoras. Se basa en la hospitalidad, la comunicación asertiva y la excelencia en el servicio.',
                        ],
                        [
                            'pregunta' => '¿Qué servicios ofrece Factor WOW?',
                            'respuesta' => '<ul class="list-disc ml-6 space-y-1">
                                <li>Diplomado en línea de Servicio y Hospitalidad al paciente implementando Filosofía WOW (valor curricular SEP CONOCER).</li>
                                <li>Curso de Manejo de Conducta.</li>
                                <li>Enfoques Modernos y Prácticas Innovadoras en línea (grabado y presencial).</li>
                                <li>Curso presencial de dos días de duración WOW Customer Experience: Filosofía WOW en Servicios Médicos.</li>
                                <li>WOW Experience con Thinkific (curso grabado).</li>
                                <li>Descargables (ebooks).</li>
                                <li>Deck de tarjetas de 100 Ways to WOW.</li>
                                <li>Manual de hospitalidad en odontología.</li>
                            </ul>',
                        ],
                        [
                            'pregunta' => '¿Qué métodos de pago aceptan?',
                            'respuesta' => 'Aceptamos una amplia variedad de métodos de pago para facilitar tu compra, incluyendo tarjetas de crédito y débito (Visa, Mastercard y AMEX) y PayPal. Nuestra plataforma de pago en línea es segura y tus datos siempre se mantienen protegidos.',
                        ],
                        [
                            'pregunta' => '¿Cuánto tiempo tarda el envío?',
                            'respuesta' => 'El tiempo de envío puede variar dependiendo de tu ubicación y el método de envío seleccionado. Para envíos en México, generalmente entregamos en un plazo de 3-7 días hábiles. Para envíos internacionales, el tiempo de entrega puede variar entre 7-21 días hábiles.',
                        ],
                        [
                            'pregunta' => '¿Qué pasa si tengo problemas con mi orden?',
                            'respuesta' => 'Puedes contactarnos a través del correo contacto@wowexperience.com.mx para atender tus dudas.',
                        ],
                        [
                            'pregunta' => '¿Realizan reembolsos?',
                            'respuesta' => 'Todas nuestras ventas son finales y por lo cual no aceptamos reembolsos.',
                        ],
                        [
                            'pregunta' => '¿Es seguro comprar en su sitio web?',
                            'respuesta' => 'La seguridad de tus datos es nuestra máxima prioridad. Nuestro sitio web utiliza encriptación SSL para proteger tus datos personales y de pago. Puedes comprar con confianza, sabiendo que tu información está segura en todo momento.',
                        ],
                        [
                            'pregunta' => '¿Necesito una cuenta para realizar un pedido?',
                            'respuesta' => 'No es necesario crear una cuenta para realizar un pedido en nuestro sitio web.',
                        ],
                    ];
                    ?>

                    <?php foreach ($faqs as $index => $faq): ?>
                    <div class="faq-item bg-white w-full rounded-[20px] xl:rounded-[40px] p-6 xl:p-10 cursor-pointer overflow-hidden border-b-4 border-b-transparent transition-all duration-500 hover:shadow-lg" data-faq="<?= $index ?>">
                        <!-- Header -->
                        <div class="faq-header flex gap-10 items-center justify-between w-full">
                            <h3 class="font-montserrat font-bold text-[20px] xl:text-[24px] text-[#553CC8] leading-tight flex-1">
                                <?= htmlspecialchars($faq['pregunta']) ?>
                            </h3>
                            <div class="faq-toggle text-[#FF3D81] text-[28px] font-bold flex-shrink-0 transition-transform duration-500">+</div>
                        </div>

                        <!-- Respuesta (oculta por defecto) -->
                        <?php if (!empty($faq['respuesta'])): ?>
                        <div class="faq-content max-h-0 transition-all duration-700 ease-in-out overflow-hidden">
                            <div class="h-0.5 bg-[#FF3D81] my-6"></div>
                            <div class="faq-text font-montserrat font-normal text-[14px] xl:text-[18px] text-[#4B4B4B] leading-relaxed pb-4 opacity-0 transition-opacity duration-700">
                                <?= $faq['respuesta'] ?>
                            </div>
                        </div>
                        <?php else: ?>
                        <div class="faq-content max-h-0 transition-all duration-700 ease-in-out overflow-hidden">
                            <div class="h-0.5 bg-[#FF3D81] my-6"></div>
                            <div class="faq-text font-montserrat font-normal text-[14px] xl:text-[18px] text-[#4B4B4B] leading-relaxed pb-4 opacity-0 transition-opacity duration-700">
                                Próximamente.
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>

                

            </div>
            <!-- Decoración inferior -->
                <div class="w-full max-w-[300px] absolute left-0 bottom-0">
                    <img src="<?= importAsset('imagenes/home/deco-faq.png') ?>" alt="" class="w-full h-auto">
                </div>
        </section>

        <?php $this->componente('flotante-whatsapp'); ?>
        <?php $this->componente('footer'); ?>
    </main>

    <script>
    document.querySelectorAll('.faq-item').forEach(function(item) {
        item.addEventListener('click', function() {
            const content = this.querySelector('.faq-content');
            const text    = content.querySelector('.faq-text');
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
