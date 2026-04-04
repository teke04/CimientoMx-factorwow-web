<!DOCTYPE html>
<html lang="ES">
<head> 
    <?php $this->plantilla('metas-basicas')?>
    <?php $this->plantilla('estilos')?>
    <title>Acerca de WOW! | <?=env('EMPRESA')?></title>
    <meta name="description" content="Conoce la Filosofía WOW! Experience: el modelo innovador que transforma la experiencia del paciente en el sector salud.">
    <meta name="robots" content="index, follow">
</head>
<body class="w-screen overflow-x-clip font-montserrat">
<main>

    <?php $this->componente('navbar');?>
    <?php $this->componente('flotante-whatsapp');?>


    <!-- ============================================================
         SECCIÓN 1 — HERO
         ============================================================ -->
    <section class="-mt-20 relative overflow-hidden bg-gradient-to-r from-[#8160ae] to-[#553cc8] flex items-center min-h-screen pb-28">

        <!-- Deco diagonal -->
        <img src="<?=importAsset('imagenes/acerca-de-wow/deco1.svg')?>"
             alt="" aria-hidden="true"
             class="absolute top-0 -left-20 w-[700px] lg:w-[1000px] opacity-20 rotate-[39deg] pointer-events-none select-none">

        <!-- Deco derecha inferior -->
        <img src="<?=importAsset('imagenes/acerca-de-wow/deco2.svg')?>"
             alt="" aria-hidden="true"
             class="absolute bottom-4 right-0 w-48 lg:w-72 opacity-30 pointer-events-none select-none">

        <!-- Sticker WOW inferior izquierdo -->
        <img src="<?=importAsset('imagenes/acerca-de-wow/sticker-wow-1.svg')?>"
             alt="" aria-hidden="true"
             class="absolute left-4 bottom-8 w-28 lg:w-40 pointer-events-none select-none">

        <div class="w-full relative z-10 pt-28 pb-12 lg:py-0 flex flex-col lg:flex-row items-center">

            <!-- Columna texto -->
            <div class="w-full lg:w-1/2 px-6 lg:pl-16 xl:pl-24 text-white text-center lg:text-left">
                <h1 class="font-montserrat font-extrabold text-4xl sm:text-5xl lg:text-6xl uppercase leading-tight mb-6">
                    ACERCA DE <span class="text-[#00E6FF]">WOW!</span>
                </h1>
                <h2 class="font-montserrat font-bold text-xl sm:text-2xl lg:text-3xl uppercase leading-snug mb-6">
                    <span class="text-[#00E6FF]">Filosofía WOW!</span> como modelo innovador en el sector salud
                </h2>
                <p class="font-montserrat font-normal text-base lg:text-lg leading-relaxed text-white/90 max-w-xl mx-auto lg:mx-0">
                    Transforma la manera en que los profesionales interactúan con sus pacientes, creando experiencias memorables y diferenciadoras.
                </p>
            </div>

            <!-- Columna imagen — pegada a la orilla derecha -->
            <div class="w-full lg:w-1/2 flex justify-center lg:justify-end lg:pr-0 mt-8 lg:mt-0">
                <img src="<?=importAsset('imagenes/acerca-de-wow/img-hero.png')?>"
                     alt="Factor WOW! Experience"
                     class="w-4/5 sm:w-3/5 lg:w-full lg:max-w-[560px] xl:max-w-[680px] object-contain object-right-bottom drop-shadow-2xl">
            </div>

        </div>
    </section>


    <!-- ============================================================
         SECCIÓN 2 — PILARES DE LA FILOSOFÍA WOW!
         Flota encima de la sección anterior y la siguiente con -my
         ============================================================ -->
    <section class="relative z-10 -mt-20 -mb-20 px-6 lg:px-24 py-8">

        <!-- Fila 1: 4 tarjetas -->
        <div class="flex flex-wrap justify-center gap-5 mb-5">

            <div class="bg-[#553cc8] rounded-[20px] w-[292px] shrink-0 px-10 py-16 text-white font-montserrat font-bold text-sm leading-relaxed text-center">
                Protocolos diseñados para mejorar la experiencia del paciente en cada etapa.
            </div>

            <div class="bg-[#553cc8] rounded-[20px] w-[292px] shrink-0 px-10 py-16 text-white font-montserrat font-bold text-sm leading-relaxed text-center">
                Herramientas de hospitalidad aplicadas al sector salud.
            </div>

            <div class="bg-[#553cc8] rounded-[20px] w-[292px] shrink-0 px-10 py-16 text-white font-montserrat font-bold text-sm leading-relaxed text-center">
                Adaptación del ambiente, preferencias, tratamientos y más elementos para el paciente: ULTRA PERSONALIZADOS.
            </div>

            <div class="bg-[#553cc8] rounded-[20px] w-[292px] shrink-0 px-10 py-16 text-white font-montserrat font-bold text-sm leading-relaxed text-center">
                Estrategias de fidelización que convierten pacientes en embajadores de la marca intencionada.
            </div>

        </div>

        <!-- Fila 2: 3 tarjetas -->
        <div class="flex flex-wrap justify-center gap-5">

            <div class="bg-[#553cc8] rounded-[20px] w-[292px] shrink-0 px-10 py-16 text-white font-montserrat font-bold text-sm leading-relaxed text-center">
                Preparación del recurso humano para lograr una cultura organizacional enfocada en la práctica.
            </div>

            <div class="bg-[#553cc8] rounded-[20px] w-[292px] shrink-0 px-10 py-16 text-white font-montserrat font-bold text-sm leading-relaxed text-center">
                Creando entornos WOW! donde el personal pueda dar lo mejor de sí.
            </div>

            <div class="bg-[#553cc8] rounded-[20px] w-[292px] shrink-0 px-10 py-16 text-white font-montserrat font-bold text-sm leading-relaxed text-center">
                Tener un servicio centrado en el paciente.
            </div>

        </div>
    </section>


    <!-- ============================================================
         SECCIÓN 3 — CONOCE LA FUNDADORA (fondo azure)
         ============================================================ -->
    <section class="bg-[#e6f0f0] pt-32 lg:pt-36 relative overflow-hidden">

        <!-- Deco fondo izquierdo (grande, diagonal) -->
        <img src="<?=importAsset('imagenes/acerca-de-wow/deco-seccion-dra-ale.svg')?>"
             alt="" aria-hidden="true"
             class="absolute -left-20 top-0 h-full w-auto opacity-20 pointer-events-none select-none">

        <!-- Deco fondo derecho -->
        <img src="<?=importAsset('imagenes/acerca-de-wow/deco-ale-acerca-de.svg')?>"
             alt="" aria-hidden="true"
             class="absolute top-0 right-0 w-64 lg:w-96 opacity-20 pointer-events-none select-none">

        <div class="container mx-auto px-6 lg:px-16 flex flex-col lg:flex-row items-end gap-0 lg:gap-12">

            <!-- Foto — pegada al fondo de la sección -->
            <div class="lg:w-5/12 flex justify-center items-end self-end order-2 lg:order-1">
                <img src="<?=importAsset('imagenes/acerca-de-wow/ale-acerca-de.png')?>"
                     alt="Dra. Alejandra Martínez — WOW! Experience"
                     class="w-full max-w-xs sm:max-w-sm lg:max-w-md object-contain object-bottom block align-bottom">
            </div>

            <!-- Texto -->
            <div class="lg:w-7/12 text-center lg:text-left pb-16 lg:pb-20 order-1 lg:order-2">
                <h2 class="font-montserrat font-bold text-2xl lg:text-3xl uppercase leading-snug mb-8">
                    <span class="text-[#ff3d81]">WOW!</span><span class="text-[#553cc8]"> Experience no es un extra,</span><br>
                    <span class="text-[#553cc8]">es la nueva forma de hacer salud.</span>
                </h2>
                <div class="font-montserrat font-normal text-[#4b4b4b] text-base lg:text-lg leading-relaxed max-w-xl mx-auto lg:mx-0 space-y-4">
                    <p>Es la diferencia que permite que un consultorio, clínica u hospital sobresalga en un sector cada vez más competitivo.</p>
                    <p>El paciente ya no busca solo un tratamiento, busca una experiencia que lo haga sentir cuidado, valorado y especial. Y eso es lo que logramos con WOW! Experience.</p>
                </div>
            </div>

        </div>
    </section>


    <!-- ============================================================
         SECCIÓN 4 — LA HISTORIA DE WOW! EXPERIENCE
         ============================================================ -->
    <section class="bg-gradient-to-r from-[#ff3d81] to-[#ff8a8a] py-20 lg:py-28 relative overflow-y-visible z-30">

        <!-- Deco izquierdo -->
        <img src="<?=importAsset('imagenes/acerca-de-wow/deco-historia.svg')?>"
             alt="" aria-hidden="true"
             class="absolute left-0 top-0 h-full w-auto opacity-15 pointer-events-none select-none">

        <!-- Nubin + amigos — fondo inferior izquierdo -->
        <img src="<?=importAsset('imagenes/acerca-de-wow/amigos-nubin.svg')?>"
             alt="" aria-hidden="true"
             class="absolute bottom-0 left-0 w-60 -mb-[33px] lg:w-72 pointer-events-none select-none">

        <div class="container mx-auto px-6 lg:px-16 relative z-10">

            <!-- Fila superior: título + imagen circular -->
            <div class="flex flex-col lg:flex-row items-center gap-10 lg:gap-16 mb-16">

                <!-- Texto -->
                <div class="lg:w-1/2 text-white text-center lg:text-left">
                    <h2 class="font-montserrat font-bold text-3xl lg:text-4xl uppercase leading-snug mb-6">
                        <span class="text-white">La Historia de WOW! Experience</span><br>
                        <span class="text-white">inicia en </span><span class="text-[#553cc8]">2018</span>
                    </h2>
                    <p class="font-montserrat font-normal text-base lg:text-lg leading-relaxed text-white/90">
                        La verdadera transformación en la experiencia del paciente no solo depende de técnicas clínicas, sino también de otros factores clave como:
                    </p>
                </div>

                <!-- Imagen circular -->
                <div class="lg:w-1/2 flex justify-center">
                    <img src="<?=importAsset('imagenes/acerca-de-wow/img-historia-1.png')?>"
                         alt="WOW! Experience en odontología"
                         class="w-72 lg:w-96 object-contain drop-shadow-2xl">
                </div>

            </div>

            <!-- Tarjetas escalonadas (staggered pills) -->
            <div class="flex flex-col gap-5 max-w-2xl lg:max-w-3xl mx-auto lg:mx-0 lg:ml-10">

                <?php
                $bgTarjeta = importAsset('imagenes/acerca-de-wow/bg-tarjeta-historia.svg');
                $tarjetas = [
                    ['align' => 'self-end',   'padding' => 'px-16 py-8',  'svgbg' => true,  'negrita' => 'Neuromarketing y Programación Neurolingüística', 'resto' => ' para conectar emocionalmente con los pacientes.'],
                    ['align' => 'self-start', 'padding' => 'px-16 py-8',  'svgbg' => true,  'negrita' => 'Branding corporativo intencionado',              'resto' => ', que transmite confianza y diferenciación.'],
                    ['align' => 'self-end',   'padding' => 'px-16 py-8',  'svgbg' => true,  'negrita' => 'Protocolos de servicio y atención excepcional',   'resto' => ' para elevar la percepción de calidad.'],
                    ['align' => 'self-start', 'padding' => 'px-16 py-8',  'svgbg' => true,  'negrita' => 'Comunicación asertiva, eficiente y efectiva',     'resto' => ', tanto con los pacientes como con el equipo de trabajo.'],
                    ['align' => 'self-end',   'padding' => 'px-16 py-8',  'svgbg' => true,  'negrita' => 'Equipos comprometidos',                           'resto' => ', con la camiseta bien puesta y alineados a una misma visión de servicio.'],
                    ['align' => 'self-start', 'padding' => 'px-12 py-8',  'svgbg' => false, 'negrita' => 'Impacto comunitario:',                            'resto' => ' Creemos que la excelencia en el sector salud va más allá del consultorio, por eso participamos activamente en actividades comunitarias, acercando educación, prevención y atención a quienes más lo necesitan.'],
                ];
                ?>

                <?php foreach ($tarjetas as $t): ?>
                <?php
                    $inlineStyle = $t['svgbg'] ? "background-image: url('{$bgTarjeta}'); background-size: 100% 100%; background-repeat: no-repeat;" : '';
                    $extraClass  = $t['svgbg'] ? '' : 'bg-white rounded-[60px]';
                ?>
                <div class="<?= $t['align'] ?> w-full sm:w-3/4 lg:w-2/3 <?= $t['padding'] ?> <?= $extraClass ?> text-[#4b4b4b] font-montserrat text-sm leading-relaxed"
                     <?= $inlineStyle ? "style=\"{$inlineStyle}\"" : '' ?>>
                    <strong class="font-bold"><?= htmlspecialchars($t['negrita']) ?></strong><?= htmlspecialchars($t['resto']) ?>
                </div>
                <?php endforeach; ?>

            </div>

        </div>
    </section>


    <!-- ============================================================
         SECCIÓN 4B — HISTORIA INICIO (blanco, fotos + lista)
         ============================================================ -->
    <section class="bg-white py-20 lg:py-28">
        <div class="container mx-auto px-6 lg:px-16">

            <div class="flex flex-col lg:flex-row items-start gap-12 lg:gap-16">

                <!-- Columna izquierda: dos fotos apiladas -->
                <div class="lg:w-5/12 flex flex-col gap-6 relative">
                    <img src="<?=importAsset('imagenes/acerca-de-wow/img-historia-1.png')?>"
                         alt="Historia WOW! Experience — odontología"
                         class="w-full rounded-2xl object-cover drop-shadow-lg">
                    <img src="<?=importAsset('imagenes/acerca-de-wow/img-historia-2.png')?>"
                         alt="Equipo WOW! Experience"
                         class="w-4/5 self-end rounded-2xl object-cover drop-shadow-lg">
                </div>

                <!-- Columna derecha: título + lista -->
                <div class="lg:w-7/12 flex flex-col gap-8">

                    <h2 class="font-montserrat font-bold text-3xl lg:text-4xl uppercase leading-snug">
                        <span class="text-[#ff3d81]">La Historia de WOW!</span>
                        <span class="text-[#4b4b4b]"> Experience </span>
                        <span class="text-[#553cc8]">inicia en 2018</span>
                    </h2>

                    <p class="font-montserrat font-normal text-base lg:text-lg leading-relaxed text-[#4b4b4b]">
                        La verdadera transformación en la experiencia del paciente no solo depende de técnicas clínicas, sino también de otros factores clave como:
                    </p>

                    <!-- Items con icono barra -->
                    <ul class="flex flex-col gap-5">
                        <?php
                        $icon = importAsset('imagenes/acerca-de-wow/wow-history-item-icon.svg');
                        $items = [
                            ['negrita' => 'Neuromarketing y Programación Neurolingüística', 'resto' => ' para conectar emocionalmente con los pacientes.'],
                            ['negrita' => 'Branding corporativo intencionado',              'resto' => ', que transmite confianza y diferenciación.'],
                            ['negrita' => 'Protocolos de servicio y atención excepcional',   'resto' => ' para elevar la percepción de calidad.'],
                            ['negrita' => 'Comunicación asertiva, eficiente y efectiva',     'resto' => ', tanto con los pacientes como con el equipo de trabajo.'],
                            ['negrita' => 'Equipos comprometidos',                           'resto' => ', con la camiseta bien puesta y alineados a una misma visión de servicio.'],
                            ['negrita' => 'Impacto comunitario:',                            'resto' => ' Creemos que la excelencia en el sector salud va más allá del consultorio, por eso participamos activamente en actividades comunitarias, acercando educación, prevención y atención a quienes más lo necesitan. Estamos presentes y comprometidos con generar un cambio real en la sociedad.'],
                        ];
                        ?>
                        <?php foreach ($items as $item): ?>
                        <li class="flex items-start gap-4">
                            <img src="<?= $icon ?>" alt="" aria-hidden="true"
                                 class="shrink-0 mt-1 w-[9px] h-[30px] select-none pointer-events-none">
                            <p class="font-montserrat text-base lg:text-lg leading-relaxed text-[#4b4b4b]">
                                <strong class="font-bold"><?= htmlspecialchars($item['negrita']) ?></strong><?= htmlspecialchars($item['resto']) ?>
                            </p>
                        </li>
                        <?php endforeach; ?>
                    </ul>

                </div>

            </div>

        </div>
    </section>


    <!-- ============================================================
         SECCIÓN 5 — EQUIPO (img-historia-2)
         ============================================================ -->
    <section class="bg-[#e6f0f0] py-20 lg:py-28 relative overflow-hidden">

        <div class="container mx-auto px-6 lg:px-16 flex justify-center">
            <div class="relative inline-block">
                <img src="<?=importAsset('imagenes/acerca-de-wow/img-historia-2.png')?>"
                     alt="Equipo WOW! Experience"
                     class="w-full max-w-sm lg:max-w-2xl rounded-3xl drop-shadow-xl">
                <img src="<?=importAsset('imagenes/acerca-de-wow/sticker-1-img-historia-2.svg')?>"
                     alt="" aria-hidden="true"
                     class="absolute -top-8 -right-8 w-20 lg:w-24 pointer-events-none select-none">
                <img src="<?=importAsset('imagenes/acerca-de-wow/sticker-2-img-historia-2.svg')?>"
                     alt="" aria-hidden="true"
                     class="absolute -bottom-8 -left-8 w-20 lg:w-24 pointer-events-none select-none">
            </div>
        </div>

    </section>


    <!-- ============================================================
         SECCIÓN 6 — EL PATIENT JOURNEY DE WOW!
         ============================================================ -->
    <section class="bg-gradient-to-r from-[#ff3d81] to-[#ff8a8a] py-20 lg:py-28 relative overflow-hidden">

        <!-- Stickers decorativos -->
        <img src="<?=importAsset('imagenes/acerca-de-wow/sticker-patienr-journey-1.svg')?>"
             alt="" aria-hidden="true"
             class="absolute left-4 top-12 w-24 lg:w-32 opacity-80 pointer-events-none select-none">
        <img src="<?=importAsset('imagenes/acerca-de-wow/sticker-patienr-journey-2.svg')?>"
             alt="" aria-hidden="true"
             class="absolute right-4 bottom-12 w-24 lg:w-32 opacity-80 pointer-events-none select-none">

        <div class="container mx-auto px-6 lg:px-16 relative z-10">

            <div class="flex flex-col lg:flex-row items-start gap-12 lg:gap-16">

                <!-- Columna texto principal -->
                <div class="lg:w-1/2 text-white">
                    <h2 class="font-montserrat font-bold text-3xl lg:text-4xl uppercase leading-snug mb-8 text-center lg:text-left">
                        El <span class="text-[#553cc8]">Patient Journey</span><br>de WOW! Experience
                    </h2>
                    <div class="font-montserrat font-normal text-base lg:text-lg leading-relaxed space-y-4 text-white/90 max-w-xl">
                        <p>
                            El viaje del paciente es el recorrido completo que una persona hace para llegar a tu marca dental, abarcando antes, durante y después de su consulta. Es decir, cada punto de contacto que tiene con tu consultorio o clínica, desde la primera vez que escucha hablar de ti hasta el seguimiento post-consulta y su fidelización.
                        </p>
                        <p>
                            Este viaje se puede mapear, lo que permite visualizar cada etapa y detectar tanto puntos de dolor como puntos de oportunidad (momentos clave en los que podemos sorprender y generar confianza).
                        </p>
                    </div>
                    <p class="font-montserrat font-bold text-lg lg:text-xl text-white uppercase mt-8 mb-4 text-center lg:text-left">
                        Ejemplo en odontología:
                    </p>
                </div>

                <!-- Columna etapas -->
                <div class="lg:w-1/2 flex flex-col gap-5 w-full">

                    <div class="bg-white/20 backdrop-blur-sm rounded-2xl p-6 border border-white/30">
                        <h3 class="font-montserrat font-bold text-white text-lg mb-2">Antes de la consulta</h3>
                        <p class="font-montserrat text-white/90 text-sm leading-relaxed">
                            ¿Cómo te encuentra el paciente? Redes sociales, página web, recomendaciones, facilidad para agendar cita. ¿Recibe información clara y una bienvenida amigable?
                        </p>
                    </div>

                    <div class="bg-white/20 backdrop-blur-sm rounded-2xl p-6 border border-white/30">
                        <h3 class="font-montserrat font-bold text-white text-lg mb-2">Durante la consulta</h3>
                        <p class="font-montserrat text-white/90 text-sm leading-relaxed">
                            Desde su llegada a la recepción, la atención del personal, el ambiente del consultorio, el trato del doctor y el proceso del tratamiento. ¿Se siente cómodo y en confianza?
                        </p>
                    </div>

                    <div class="bg-white/20 backdrop-blur-sm rounded-2xl p-6 border border-white/30">
                        <h3 class="font-montserrat font-bold text-white text-lg mb-2">Después de la consulta</h3>
                        <p class="font-montserrat text-white/90 text-sm leading-relaxed">
                            Seguimiento post-tratamiento, recordatorios de próximas citas, comunicación con el paciente, fidelización. ¿Recibe un servicio que lo haga volver y recomendarte?
                        </p>
                    </div>

                    <p class="font-montserrat text-white/80 text-sm leading-relaxed text-center italic px-2">
                        Cuando entiendes el viaje del paciente, puedes mejorar su experiencia en cada etapa, logrando que su paso por tu consultorio sea no solo satisfactorio, sino <strong class="text-white not-italic">WOW</strong>.
                    </p>

                </div>

            </div>
        </div>
    </section>


    <!-- ============================================================
         SECCIÓN 7 — DRA. ALE MARTÍNEZ
         ============================================================ -->
    <section class="bg-[#e6f0f0] py-20 lg:py-28 relative overflow-hidden">

        <!-- Deco fondo -->
        <img src="<?=importAsset('imagenes/acerca-de-wow/deco-seccion-dra-ale.svg')?>"
             alt="" aria-hidden="true"
             class="absolute right-0 top-1/2 -translate-y-1/2 w-72 lg:w-96 opacity-20 pointer-events-none select-none">

        <div class="container mx-auto px-6 lg:px-16 relative z-10 flex flex-col lg:flex-row items-start gap-12 lg:gap-16">

            <!-- Foto Dra. Ale -->
            <div class="lg:w-5/12 flex justify-center">
                <div class="relative">
                    <img src="<?=importAsset('imagenes/acerca-de-wow/img-seccion-dr-ale.png')?>"
                         alt="Dra. Alejandra Martínez"
                         class="w-full max-w-xs sm:max-w-sm lg:max-w-md object-contain rounded-3xl drop-shadow-xl">
                    <img src="<?=importAsset('imagenes/acerca-de-wow/deco-sticker-2-img-historia-2.svg')?>"
                         alt="" aria-hidden="true"
                         class="absolute -bottom-8 -right-6 w-24 pointer-events-none select-none">
                </div>
            </div>

            <!-- Bio -->
            <div class="lg:w-7/12">
                <h2 class="font-montserrat font-bold text-3xl lg:text-4xl text-[#553cc8] uppercase mb-6">
                    Dra. Ale Martínez
                </h2>
                <div class="space-y-4 font-montserrat font-normal text-[#4b4b4b] text-base lg:text-lg leading-relaxed">
                    <p>
                        Soy una mujer apasionada por la odontopediatría, pero sobre todo, por las personas. Mi vocación es la resolución de problemas con base a las necesidades del paciente, buscando que cada consulta sea una experiencia positiva y significativa.
                    </p>
                    <p>
                        Soy mamá de tres niñas y, aunque mis días están llenos de retos, sigo eligiendo estar en mi consultorio, porque amo lo que hago. No concibo mi profesión sin ejercerla, sin seguir aprendiendo, sin seguir buscando maneras de mejorar la forma en que atendemos a nuestros pacientes.
                    </p>
                    <p>
                        Mi enfoque principal está en la atención a niños, familias neurodivergentes (específicamente autistas) y la odontología estética en bebés. He enfrentado el cáncer de manera personal, lo que me ha dado una perspectiva diferente sobre la empatía y el trato humano en la medicina.
                    </p>
                    <p>
                        He dedicado años a la educación y creación de contenido para ayudar a otros profesionales. Soy la porrista número uno de muchos doctores, porque sé que el sector salud necesita más profesionales empoderados, seguros y dispuestos a transformar la manera en que se brinda atención.
                    </p>
                    <p>
                        <strong class="font-bold text-[#553cc8]">WOW! Experience no es solo una metodología, es una nueva forma de hacer salud.</strong>
                    </p>
                </div>
                <a href="<?=ruta('contacto')?>"
                   class="inline-block mt-8 bg-[#ff3d81] text-white font-montserrat font-bold px-8 py-3 rounded-full hover:opacity-90 transition-all text-base">
                    Contacta a Dra. Ale
                </a>
            </div>

        </div>
    </section>


</main>

<?php $this->componente('footer');?>

</body>
</html>
