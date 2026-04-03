<!DOCTYPE html>
<html lang="ES">
<head>
    <?php $this->plantilla('metas-basicas')?>
    <?php $this->plantilla('estilos')?>

    <title>Página no encontrada — WOW Experience</title>
    <meta name="description" content="Lo sentimos, la página que buscas no existe o ha sido movida.">
    <meta name="robots" content="noindex, nofollow">
</head>
<body class="w-screen relative bg-gradient-to-r from-[#ff3d81] to-[#553cc8] overflow-x-clip">

    <!-- Decoración superior izquierda -->
    <img
        src="<?= importAsset('imagenes/404/deco-superior-izquierda.svg') ?>"
        alt=""
        class="absolute top-0 left-0 w-[55%] h-auto pointer-events-none select-none z-0"
    >

    <!-- Decoración inferior derecha -->
    <img
        src="<?= importAsset('imagenes/404/deco-inferior-derecha.svg') ?>"
        alt=""
        class="absolute bottom-0 right-0 w-[65%] h-auto pointer-events-none select-none z-0"
    >

    <!-- ===== MOBILE LAYOUT (< xl) ===== -->
    <div class="xl:hidden flex flex-col items-center min-h-screen relative z-10">

        <!-- Logo -->
        <div class="pt-8 pb-6">
            <img src="<?= importAsset('logo.svg') ?>" alt="WOW Experience" class="h-14 brightness-0 invert">
        </div>

        <!-- Mensaje -->
        <div class="flex flex-col gap-5 items-center text-center px-6 w-full max-w-[337px]">
            <h1 class="font-montserrat font-extrabold text-[34px] text-white uppercase leading-[1.2]">
                <span class="text-[#00e6ff]">WOW!</span> Te has perdido, pero no te preocupes...
            </h1>
            <div class="flex flex-col gap-[10px] text-white text-[14px] w-full">
                <p class="font-montserrat font-bold leading-[1.8]">La página que buscas no se encuentra aquí.</p>
                <p class="font-montserrat font-normal leading-[1.8]">Cada paso cuenta, y nos acerca al WOW! que estás buscando. Explora nuestras opciones y juntos encontremos el camino.</p>
            </div>
            <div class="flex flex-col gap-4 w-full items-center">
                <a href="<?= ruta('diplomado') ?>" class="w-full border-2 border-white rounded-[40px] px-[40px] py-[10px] font-montserrat font-semibold text-[18px] text-white text-center hover:bg-white hover:text-[#553cc8] transition-colors">
                    Próximos cursos
                </a>
                <a href="<?= ruta('') ?>" class="w-full border-2 border-white rounded-[40px] px-[40px] py-[10px] font-montserrat font-semibold text-[18px] text-white text-center hover:bg-white hover:text-[#553cc8] transition-colors">
                    Home
                </a>
                <a href="<?= ruta('acerca-de') ?>" class="w-full border-2 border-white rounded-[40px] px-[40px] py-[10px] font-montserrat font-semibold text-[18px] text-white text-center hover:bg-white hover:text-[#553cc8] transition-colors">
                    Acerca de WOW
                </a>
            </div>
        </div>

        <!-- Imagen al fondo del contenido -->
        <div class="flex-1 flex items-end justify-center w-full mt-6">
            <img
                src="<?= importAsset('imagenes/404/ale-404.png') ?>"
                alt=""
                class="w-full max-w-[382px] object-contain object-bottom pointer-events-none select-none block"
            >
        </div>
    </div>

    <!-- ===== DESKTOP LAYOUT (xl+) ===== -->
    <div class="hidden xl:block relative h-screen overflow-hidden z-10">

        <!-- Logo superior centrado -->
        <div class="absolute top-[6%] left-1/2 -translate-x-1/2">
            <img src="<?= importAsset('logo.svg') ?>" alt="WOW Experience" class="h-[80px] brightness-0 invert">
        </div>

        <!-- Contenedor de mensaje: centrado en pantalla -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col gap-[40px] items-center w-[735px] text-center">
            <h1 class="font-montserrat font-extrabold text-[48px] text-white uppercase leading-[1.2]">
                <span class="text-[#00e6ff]">WOW!</span> Te has perdido,<br>pero no te preocupes...
            </h1>
            <div class="flex flex-col gap-[20px] text-white w-full">
                <p class="font-montserrat font-bold text-[18px] leading-[1.8]">
                    La página que buscas no se encuentra aquí.
                </p>
                <p class="font-montserrat font-normal text-[18px] leading-[1.8]">
                    Cada paso cuenta, y nos acerca al WOW! que estás buscando. Explora nuestras opciones y juntos encontremos el camino.
                </p>
            </div>
            <div class="flex gap-[40px] items-center justify-center">
                <a href="<?= ruta('diplomado') ?>" class="border-2 border-white rounded-[40px] px-[40px] py-[10px] font-montserrat font-semibold text-[18px] text-white whitespace-nowrap hover:bg-white hover:text-[#553cc8] transition-colors">
                    Próximos cursos
                </a>
                <a href="<?= ruta('') ?>" class="border-2 border-white rounded-[40px] px-[40px] py-[10px] font-montserrat font-semibold text-[18px] text-white whitespace-nowrap hover:bg-white hover:text-[#553cc8] transition-colors">
                    Home
                </a>
                <a href="<?= ruta('acerca-de') ?>" class="border-2 border-white rounded-[40px] px-[40px] py-[10px] font-montserrat font-semibold text-[18px] text-white whitespace-nowrap hover:bg-white hover:text-[#553cc8] transition-colors">
                    Acerca de WOW
                </a>
            </div>
        </div>

        <!-- Imagen a la derecha abajo -->
        <img
            src="<?= importAsset('imagenes/404/ale-404.png') ?>"
            alt=""
            class="absolute right-0 bottom-0 h-[85%] w-auto object-contain object-bottom pointer-events-none select-none"
        >
    </div>

</body>
</html>