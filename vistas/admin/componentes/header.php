


<header class="fixed  top-0 left-0 z-[100] flex justify-between items-center w-full px-4 lg:px-8 h-[100px] bg-teven-primario text-white shadow-2xl shadow-black/40">
    <div class="text-sm lg:text-lg semibold flex flex-row gap-x-4 lg:gap-x-8 items-center">
        <button class="border-white border p-1 rounded-xl  lg:hidden" onclick="toggleSidebar()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <img src="<?= importAsset('/logo-teven-blanco.png') ?>" alt="Logo Teven" class="h-10 w-auto"/>
        <label>Bienvenido, <span class="font-bold"><br class="lg:hidden"><?= $USUARIO['nombre'] ?></span></label>
    </div>
    <a class="px-3 lg:px-4 py-2  text-white font-bold rounded-lg border-white border text-xs lg:text-base
    transition-all duration-300 hover:bg-red-600 hover:text-white hover:border-transparent hover:shadow-2xl" 
        href="<?=ruta('logout')?>">
        Cerrar sesión
    </a>
</header>

<script>
    function toggleSidebar() {
        const menu = document.getElementById('menu-admin');
        if (menu) {
            menu.classList.toggle('-translate-x-[100%]');
        }
    }
</script>