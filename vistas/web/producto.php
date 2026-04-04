<!DOCTYPE html>
<html lang="ES">
<?php
$titulo      = htmlspecialchars($producto['nombre']) . ' - ' . env('EMPRESA');
$descripcion_meta = htmlspecialchars($producto['descripcion'] ?? $producto['nombre']) . '. ' . env('EMPRESA') . '.';
$imagen_og   = $producto['imagen_url'] ? url($producto['imagen_url']) : '';
?>
<head>
    <?php $this->plantilla('metas-basicas') ?>
    <?php $this->plantilla('estilos') ?>
    <?php $this->plantilla('metadatos', [
        'titulo'      => $titulo,
        'descripcion' => $descripcion_meta,
        'imagen'      => $imagen_og,
        'url'         => ruta('tienda/' . htmlspecialchars($producto['url_interna'])),
    ]) ?>
    <title><?= $titulo ?></title>
    <meta name="description" content="<?= $descripcion_meta ?>">
    <link rel="canonical" href="<?= ruta('tienda/' . htmlspecialchars($producto['url_interna'])) ?>"/>
    <meta name="robots" content="index, follow">
    <?= configuracion('tag_manager_head') ?>
</head>
<body class="w-screen overflow-x-clip">
    <?= configuracion('tag_manager_body') ?>
    <main>
        <?php $this->componente('navbar'); ?>

        <!-- ===================== HERO: Gradient + imagen-principal ===================== -->
        <section class="w-screen pt-[80px] relative"
                 style="background: linear-gradient(90deg, #FF3D81 0%, #553CC8 100%);">

            <!-- Botón volver -->
            <a href="<?= ruta('tienda') ?>"
               class="absolute top-[108px] left-8 z-40 flex items-center justify-center p-2.5 rounded-[22px] border-2 border-[#0064FF] bg-white/10 hover:bg-white/20 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <g clip-path="url(#clip0_1018_1786)">
                        <path d="M0.88029 14.0899L4.75029 17.9999C4.84325 18.0936 4.95385 18.168 5.07571 18.2188C5.19757 18.2696 5.32828 18.2957 5.46029 18.2957C5.5923 18.2957 5.72301 18.2696 5.84487 18.2188C5.96673 18.168 6.07733 18.0936 6.17029 17.9999C6.26402 17.9069 6.33841 17.7963 6.38918 17.6745C6.43995 17.5526 6.46609 17.4219 6.46609 17.2899C6.46609 17.1579 6.43995 17.0272 6.38918 16.9053C6.33841 16.7835 6.26402 16.6729 6.17029 16.5799L2.61029 12.9999H23.0003C23.2655 12.9999 23.5199 12.8945 23.7074 12.707C23.8949 12.5195 24.0003 12.2651 24.0003 11.9999C24.0003 11.7347 23.8949 11.4803 23.7074 11.2928C23.5199 11.1053 23.2655 10.9999 23.0003 10.9999H2.55029L6.17029 7.3799C6.34758 7.19392 6.44648 6.94684 6.44648 6.6899C6.44648 6.43296 6.34758 6.18588 6.17029 5.9999C6.07733 5.90617 5.96673 5.83178 5.84487 5.78101C5.72301 5.73024 5.5923 5.7041 5.46029 5.7041C5.32828 5.7041 5.19757 5.73024 5.07571 5.78101C4.95385 5.83178 4.84325 5.90617 4.75029 5.9999L0.88029 9.8499C0.318488 10.4124 0.00292969 11.1749 0.00292969 11.9699C0.00292969 12.7649 0.318488 13.5274 0.88029 14.0899Z" fill="#0064FF"/>
                    </g>
                    <defs>
                        <clipPath id="clip0_1018_1786">
                        <rect width="24" height="24" fill="white"/>
                        </clipPath>
                    </defs>
                </svg>
            </a>

            <!-- Foto + decoración centradas -->
            <div class="relative flex justify-center items-end pb-0 pt-12 mb-[-200px] z-30">
                <!-- decoracion-principal.svg centrado DETRAS de la foto -->
                <img src="<?= url('recursos/imagenes/interna-producto/decoracion-principal.svg') ?>"
                     alt=""
                     class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2
                            w-[130%] max-w-[900px] pointer-events-none select-none z-0">
                <!-- imagen-principal.png encima -->
                <img src="<?= url('recursos/imagenes/interna-producto/imagen-principal.png') ?>"
                     alt=""
                     class="relative z-10 w-full max-w-[560px] lg:max-w-[720px] mx-auto">
            </div>
        </section>

        <!-- ===================== INFO: bg #E6F0F0 ===================== -->
        <section class="w-screen bg-[#E6F0F0] py-16 relative overflow-hidden pt-[280px]">

            <!-- Decoración de fondo (lado derecho) -->
            <img src="<?= url('recursos/imagenes/interna-producto/decoracion-principal.svg') ?>"
                 alt=""
                 class="absolute right-[-60px] top-1/2 -translate-y-1/2 w-[360px]
                        pointer-events-none select-none opacity-25">

            <div class="w-full max-w-7xl mx-auto px-6 lg:px-8">
                <div class="flex flex-col lg:flex-row gap-12 items-start">

                    <!-- Columna izquierda: nombre, descripción, imagen del producto -->
                    <div class="flex-1 min-w-0 flex flex-col gap-5">

                        <h1 class="font-montserrat font-extrabold text-[clamp(30px,4vw,48px)]
                                   text-[#553CC8] uppercase leading-[1.2]">
                            <?= htmlspecialchars($producto['nombre']) ?>
                        </h1>

                        <?php if (!empty($producto['descripcion'])): ?>
                        <p class="font-montserrat font-normal text-[18px] text-[#4B4B4B] leading-[1.8]">
                            <?= nl2br(htmlspecialchars($producto['descripcion'])) ?>
                        </p>
                        <?php endif; ?>

                        <!-- imagen del producto debajo de la descripción -->
                        <?php if ($producto['imagen_url']): ?>
                        <div class="mt-2">
                            <img src="<?= url($producto['imagen_url']) ?>"
                                 alt="<?= htmlspecialchars($producto['nombre']) ?>"
                                 class="w-full max-w-[480px] rounded-[20px] object-cover">
                        </div>
                        <?php endif; ?>

                    </div>

                    <!-- Columna derecha: Nubín + tarjeta de precio -->
                    <div class="w-full lg:w-[396px] flex-shrink-0 flex flex-col">

                        <!-- Nubín con decoración centrada detras -->
                        <div class="relative flex justify-center items-center h-[140px] z-10">
                            <img src="<?= url('recursos/imagenes/interna-producto/decoracion-nubin.svg') ?>"
                                 alt=""
                                 class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2
                                        w-full pointer-events-none select-none">
                            <img src="<?= url('recursos/imagenes/interna-producto/nubin.svg') ?>"
                                 alt="Nubín"
                                 class="relative z-10 h-[130px] w-auto">
                        </div>

                        <!-- Tarjeta de precio -->
                        <div class="bg-white rounded-[20px] p-10 w-full mt-[-24px] relative z-0">
                            <div class="flex flex-col gap-5">

                                <div class="flex flex-col gap-2.5">
                                    <p class="font-montserrat font-normal text-[18px] text-black leading-[1.8]">Precio</p>
                                    <p class="font-montserrat font-bold text-[28px] text-[#553CC8] leading-[1.2]">
                                        $<?= number_format($producto['precio'], 2) ?> MXN
                                    </p>
                                    <?php if (!empty($producto['precio_original'])): ?>
                                    <p class="font-montserrat font-normal text-[16px] text-[#7D82AA] line-through leading-[1.2]">
                                        $<?= number_format($producto['precio_original'], 2) ?> MXN
                                    </p>
                                    <?php endif; ?>
                                </div>

                                <?php if (!empty($producto['stripe_price_id'])): ?>
                                <form method="post" action="<?= ruta('checkout') ?>">
                                    <input type="hidden" name="producto_id" value="<?= $producto['id'] ?>">
                                    <button type="submit"
                                            class="w-full flex items-center justify-center px-10 py-2.5 rounded-full
                                                   bg-[#FF3D81] font-montserrat font-semibold text-[18px] text-white text-center
                                                   hover:opacity-90 transition-opacity cursor-pointer">
                                        Comprar
                                    </button>
                                </form>
                                <?php else: ?>
                                <a href="<?= htmlspecialchars($producto['url_compra']) ?>"
                                   target="_blank" rel="noopener noreferrer"
                                   class="w-full flex items-center justify-center px-10 py-2.5 rounded-full
                                          bg-[#FF3D81] font-montserrat font-semibold text-[18px] text-white text-center">
                                    Comprar
                                </a>
                                <?php endif; ?>

                                <p class="font-montserrat font-normal text-[10px] text-[#7D82AA] leading-normal">
                                    *Te recuerdo que al ser un producto digital no hay reembolsos.
                                    En cuanto hagas la compra te llegará a tu mail las instrucciones
                                    para poder descargar el material.
                                </p>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>

        <?php $this->componente('flotante-whatsapp'); ?>
        <?php $this->componente('footer'); ?>
    </main>
</body>
</html>
