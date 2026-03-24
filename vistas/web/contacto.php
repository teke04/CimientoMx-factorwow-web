<!DOCTYPE html>
<html lang="ES">
<?php 
$titulo = 'Contacto - ' . env('EMPRESA');
$descripcion = 'Bienvenido a la página de contacto de ' . env('EMPRESA') . '. Descubre nuestros servicios y cómo podemos ayudarte a alcanzar tus objetivos.';
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


        <!-- PRIMERA SECCION HERO -->
        <section class="w-screen h-screen flex items-center justify-center relative">
            <h1 class="text-[90px]">Contacto</h1>
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