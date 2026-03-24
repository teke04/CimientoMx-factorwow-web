<!DOCTYPE html>
<html lang="ES">
<?php 
$titulo = 'Inicio - ' . env('EMPRESA');
$descripcion = 'Bienvenido a la página de inicio de ' . env('EMPRESA') . '. Descubre nuestros servicios y cómo podemos ayudarte a alcanzar tus objetivos.';
?>
<head> 
    <?php $this->plantilla('metas-basicas')?>
    <?php $this->plantilla('estilos')?>
    <?php $this->plantilla('metadatos',[
        'titulo' => $titulo,
        'descripcion' => $descripcion,
        'imagen' => '',
        'url' => ''
    ])?>
    <title><?= $titulo ?></title>
    <meta name="description" content="<?= $descripcion ?>">
    <link rel="canonical" href="<?=ruta('')?>"/>
    <meta name="robots" content="index, follow">
    <?= configuracion('tag_manager_head') ?>
    
</head>
<body class="w-screen overflow-x-clip">
    <?= configuracion('tag_manager_body') ?>
    <main>
    
        <?php $this->componente('navbar');?>
        <?php $this->componente('flotante-whatsapp');?>


        <!-- PRIMERA SECCION HERO -->
        <section class="w-screen h-screen flex items-center justify-center relative">
            <h1 class="text-[90px]">HERO</h1>
        </section>
        <section class="w-screen h-screen flex items-center justify-center relative">
            <h2 class="text-[90px]">SECCION</h2>
        </section>
        <section class="w-screen h-screen flex items-center justify-center relative">
            <h2 class="text-[90px]">SECCION2</h2>
        </section>
        <section class="w-screen h-screen flex items-center justify-center relative"
            id="referencia-navbardiscreto">
            <h2 class="text-[90px]">SECCION3</h2>
        </section>
        <section class="w-screen h-screen flex items-center justify-center relative">
            <h2 class="text-[90px]">SECCION4</h2>
        </section>
        <section id="contacto" class="w-screen min-h-screen flex items-center justify-center relative py-16 px-4">
            <?php $this->componente('formulario-contacto', [
                'landing_id' => $landing_id ?? 0,
                'intereses' => $intereses ?? [],
                'servicios' => $servicios ?? []
            ]);?>
        </section>

    
        <?php $this->componente('footer');?>

    </main>
</body>
</html>