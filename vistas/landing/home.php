<!DOCTYPE html>
<html lang="ES">
<head> 
    <?php $this->plantilla('metas-basicas')?>
    <?php $this->plantilla('estilos')?>
    <?= configuracion('tag_manager_head') ?>
    <title><?=env('EMPRESA')?></title>
    <meta name="description" content="">
    <meta name="robots" content="noindex, nofollow">

    
</head>
<body class="w-screen overflow-x-clip">
    <main>
        <?= configuracion('tag_manager_body') ?>
        
        <?php $this->componente('navbar');?>
        <?php $this->componente('flotante-whatsapp');?>


        <!-- PRIMERA SECCION HERO -->
        <section id="seccion1" class="w-screen h-screen flex items-center justify-center relative">
            <h1 class="text-[90px]">LANDING HERO</h1>
        </section>
        <section id="seccion2" class="w-screen h-screen flex items-center justify-center relative">
            <h2 class="text-[90px]">SECCION 1</h2>
        </section>
        <section id="seccion1" class="w-screen h-screen flex items-center justify-center relative">
            <h2 class="text-[90px]">SECCION 2</h2>
        </section>
        <section id="seccion3" class="w-screen h-screen flex items-center justify-center relative">
            <h2 id="referencia-navbardiscreto" class="text-[90px]">SECCION 3</h2>
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