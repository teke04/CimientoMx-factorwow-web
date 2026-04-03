<!DOCTYPE html>
<html lang="ES">
<?php
$titulo = 'Aviso de Privacidad — ' . env('EMPRESA');
$descripcion = 'Conoce el aviso de privacidad de WOW! Experience. Protección de datos personales conforme a la Ley Federal de Protección de Datos Personales en Posesión de los Particulares.';
?>
<head>
    <?php $this->plantilla('metas-basicas')?>
    <?php $this->plantilla('estilos')?>
    <?php $this->plantilla('metadatos', [
        'titulo'      => $titulo,
        'descripcion' => $descripcion,
        'imagen'      => '',
        'url'         => ''
    ])?>
    <title><?= $titulo ?></title>
    <meta name="description" content="<?= $descripcion ?>">
    <link rel="canonical" href="<?= ruta('aviso-de-privacidad') ?>"/>
    <meta name="robots" content="index, follow">
    <?= configuracion('tag_manager_head') ?>
</head>
<body class="w-screen overflow-x-clip">
    <?= configuracion('tag_manager_body') ?>
    <main>
        <?php $this->componente('navbar'); ?>

        <!-- HERO HEADER -->
        <section class="w-screen bg-gradient-to-r from-[#8160ae] to-[#553cc8] pt-[90px] xl:pt-[120px] pb-[30px] xl:pb-[40px] flex items-end justify-center min-h-[200px] xl:min-h-[280px]">
            <h1 class="font-montserrat font-extrabold text-[34px] xl:text-[48px] text-white uppercase text-center leading-[1.2] px-6">
                Aviso de privacidad
            </h1>
        </section>

        <!-- CONTENT SECTION -->
        <section class="w-screen bg-[#e6f0f0] py-[60px] px-4 relative overflow-hidden">

            <!-- Decoración superior derecha -->
            <img
                src="<?= importAsset('imagenes/aviso-privacidad/deco-arriba.svg') ?>"
                alt=""
                class="absolute top-0 right-0 w-[40%] max-w-[500px] h-auto pointer-events-none select-none"
            >

            <!-- Decoración inferior izquierda -->
            <img
                src="<?= importAsset('imagenes/aviso-privacidad/deco-abajo.svg') ?>"
                alt=""
                class="absolute bottom-0 left-0 w-[40%] max-w-[500px] h-auto pointer-events-none select-none"
            >

            <div class="max-w-[812px] mx-auto relative z-10">

                <!-- Subtitle -->
                <h2 class="font-montserrat font-bold text-[24px] xl:text-[30px] text-center uppercase leading-[1.2] mb-[30px] xl:mb-[40px]">
                    <span class="text-[#ff3d81]">Factor WOW!</span>
                    <span class="text-[#553cc8]"> - Implementación de la Filosofía WOW! en Servicios Médicos</span>
                </h2>

                <!-- Privacy Policy Content -->
                <div class="font-montserrat text-[#4b4b4b] text-[14px] xl:text-[18px] leading-[1.8] flex flex-col gap-[16px]">

                    <p><strong class="text-[#553cc8]">FACTOR WOW!</strong></p>
                    <p>De conformidad con lo establecido en la Ley Federal de Protección de Datos Personales en Posesión de los Particulares y demás normativas aplicables en México, Factor WOW! pone a su disposición el siguiente aviso de privacidad.</p>

                    <p><strong>Identidad y domicilio del responsable</strong></p>
                    <p>Factor WOW! es responsable del uso y protección de sus datos personales. Nuestro domicilio se encuentra en:</p>
                    <ul class="flex flex-col gap-[4px] pl-4">
                        <li>• Clemencia Borja Taboada 512</li>
                        <li>• Colonia Juriquilla</li>
                        <li>• CP 76230</li>
                        <li>• Santiago de Querétaro, Querétaro</li>
                        <li>• Puede contactarnos a través del correo electrónico contacto@wowexperience.com.mx</li>
                    </ul>

                    <p><strong>Finalidades del tratamiento</strong></p>
                    <p>Los datos personales que obtengamos de usted serán utilizados para las siguientes finalidades, que son necesarias para concretar nuestra relación contigo y brindarte nuestros Servicios WOW:</p>
                    <ul class="flex flex-col gap-[4px] pl-4">
                        <li>• Diplomado WOW!</li>
                        <li>• Cursos, plática y/o conferencias sobre la Filosofía WOW! implementada en el sector médico.</li>
                        <li>• Asesoría para consultorios odontopediatras y odontológicos.</li>
                    </ul>

                    <p><strong>Datos personales recabados</strong></p>
                    <p>Para llevar a cabo las finalidades descritas, requerimos obtener los siguientes datos personales:</p>
                    <ul class="flex flex-col gap-[4px] pl-4">
                        <li>• Nombre completo</li>
                        <li>• Correo electrónico</li>
                        <li>• Teléfono</li>
                        <li>• País</li>
                        <li>• Estado/Ciudad</li>
                    </ul>

                    <p><strong>Transferencias de datos personales</strong></p>
                    <p>Sus datos personales no serán compartidos con ninguna autoridad, empresa, organización o persona distinta a nosotros y serán utilizados exclusivamente para los fines mencionados.</p>

                    <p><strong>Derechos ARCO</strong></p>
                    <p>Usted tiene el derecho de acceder, rectificar, cancelar u oponerse al tratamiento de sus datos personales (Derechos ARCO). Para ejercer estos derechos, presente una solicitud a través del correo electrónico contacto@wowexperience.com.mx</p>
                    <p>Para procesar su solicitud, incluya la siguiente información:</p>
                    <ul class="flex flex-col gap-[4px] pl-4">
                        <li>• Nombre completo</li>
                        <li>• Correo electrónico</li>
                        <li>• Empresa</li>
                        <li>• Puesto</li>
                    </ul>
                    <p>Responderemos a su solicitud dentro de un plazo de 5 días hábiles y nos comunicaremos a través del correo electrónico desde el que realizó la solicitud.</p>

                    <p><strong>Seguridad de los datos personales</strong></p>
                    <p>Factor WOW! toma medidas técnicas, administrativas y físicas para proteger sus datos personales contra accesos no autorizados, divulgaciones, alteraciones o destrucción.</p>

                    <p><strong>Período de conservación</strong></p>
                    <p>Sus datos personales serán conservados durante el tiempo necesario para cumplir con las finalidades del tratamiento, a menos que usted solicite su eliminación o la legislación vigente exija un período de retención diferente.</p>
                    <p>Cualquier modificación a este aviso de privacidad podrá consultarla en nuestro sitio web www.wowexperience.com.mx</p>

                    <p><strong>Quejas y denuncias</strong></p>
                    <p>Si considera que sus derechos de datos personales han sido vulnerados, puede presentar una queja ante el Instituto Nacional de Transparencia, Acceso a la Información y Protección de Datos Personales (INAI).</p>

                    <p>Última actualización: Julio del 2025</p>
                </div>

            </div>
        </section>

        <?php $this->componente('flotante-whatsapp'); ?>
        <?php $this->componente('footer'); ?>
    </main>
</body>
</html>
