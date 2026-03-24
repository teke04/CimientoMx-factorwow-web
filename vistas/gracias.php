<!DOCTYPE html>
<html lang="ES">
<head>
    <?php $this->plantilla('metas-basicas')?>
    <?php $this->plantilla('estilos')?>

    <title>Gracias</title>
    <meta name="description" content="Gracias por tu mensaje. Nos pondremos en contacto contigo a la brevedad.">
    <meta name="robots" content="noindex, nofollow">
    <?= configuracion('tag_manager_head') ?>
</head>
<body class="w-screen overflow-x-clip flex flex-col">
    <?= configuracion('tag_manager_body') ?>
    
    <?php if (env('MODO_PROYECTO') === 'web'): 
        $this->componente('navbar');
    endif; ?>

    <section class="w-screen h-screen flex flex-col items-center justify-center pt-[5%] text-center">
        <h1 class="text-[64px]">¡Mensaje recibido!</h1>
        <h2 class="text-xl">Gracias por contactarnos <?=$nombre?></h2>
        <h3 class="text-lg">Nos pondremos en contacto contigo a la brevedad</h3>
            <a href="<?=ruta($landing)?>" class="mt-8 py-2 px-4 text-[20px] font-bold flex items-center gap-2">
            Volver al inicio
        </a>
    </section>

    <?php $this->componente('footer');?>
</body>
</html>