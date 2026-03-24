<!DOCTYPE html>
<html lang="ES">
<?php 
$titulo = 'Página 3 - ' . env('EMPRESA');
$descripcion = 'Bienvenido a la página 3 de ' . env('EMPRESA') . '. Descubre nuestros servicios y cómo podemos ayudarte a alcanzar tus objetivos.';
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
            <h1 class="text-[90px]">página 3</h1>
        </section>

    
        <?php $this->componente('footer');?>
    
    </main>
</body>
</html>