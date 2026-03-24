<!DOCTYPE html>
<html lang="ES">
<head>
    <?php $this->plantilla('metas-basicas')?>
    <?php $this->plantilla('estilos')?>
        
    <title>Página no encontrada</title>
    <meta name="description" content="Lo sentimos, la página que buscas no existe o ha sido movida.">
    <meta name="robots" content="noindex, nofollow">
</head>
<body class="w-screen overflow-x-clip flex flex-col">
    <?php $this->componente('navbar');?>

    <section class="w-screen h-[80vh] flex flex-col items-center justify-start pt-[5%] text-center">
        <h1 class="text-[64px]">¡Oops, algo salió mal!</h1>
        <label class="text-[100px]">404</label>
        <h2 class="text-[24px] ">Parece que la página que estás buscando no existe, regresemos al inicio</h2>
        <a href="<?=ruta('')?>" class="mt-8 py-2 px-4  font-bold flex items-center gap-2">
            Volver al inicio
        </a>
    </section>

    <?php $this->componente('footer');?>

    
</body>
</html>