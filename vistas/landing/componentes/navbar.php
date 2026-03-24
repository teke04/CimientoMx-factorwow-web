<nav class="navbarDiscreto fixed top-0 left-0 w-screen overflow-x-clip transiution-all duration-500 z-50" 
     data-bg-class="bg-slate-600" 
     data-shadow-class="shadow-2xl">
    <!--Vista del modo desktop -->
    <div class="z-50 text-black w-screen px-[5%] py-4 flex justify-between items-center">
        <a href="<?=ruta('')?>" class="inline-block transform transition-transform duration-500 hover:scale-125">
            <img src="<?=importAsset('logo.svg')?>" alt="Logo" class="h-[30px]" loading="eager">
        </a>
        <button onclick="toggleMobileMenu()" class="block lg:hidden hover:scale-125 duration-500">
            <svg class="w-[50px]" 
                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" fill="none">
                <path fill="#000000" fill-rule="evenodd" d="M19 4a1 1 0 01-1 1H2a1 1 0 010-2h16a1 1 0 011 1zm0 6a1 1 0 01-1 1H2a1 1 0 110-2h16a1 1 0 011 1zm-1 7a1 1 0 100-2H2a1 1 0 100 2h16z"></path>
            </svg>
        </button>
        <!--Vista del modo desktop -->
        <ul class="flex-row hidden lg:flex justify-start flex-grow pl-32">
            <li class="mx-3 h-[30px] flex justify-center transform transition-all duration-200">
                <button onclick="scrollHacia('seccion1')"
                    class="px-8 text-center transform transition-transform duration-200 hover:scale-110">
                    Sección 1
                </button>
            </li>
            <li class="mx-3 h-[30px] flex justify-center transform transition-all duration-200">
                <button onclick="scrollHacia('seccion2');"
                    class="px-8 text-center transform transition-transform duration-200 hover:scale-110">
                    Sección 2
                </button>
            </li>
            <li class="mx-3 h-[30px] flex justify-center transform transition-all duration-200">
                <button onclick="scrollHacia('seccion3');"
                    class="px-8 text-center transform transition-transform duration-200 hover:scale-110">
                    Sección 3
                </button>
            </li>
        </ul>
        <div class="hidden lg:flex gap-4 items-center">
            <?php $telefono = configuracion('telefono'); if ($telefono): ?>
            <a href="tel:<?= htmlspecialchars($telefono) ?>" 
                class="border-2 rounded-full py-3 px-8 text-black hover:scale-105 transition-transform duration-200 flex items-center gap-2">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 5C3 3.89543 3.89543 3 5 3H8.27924C8.70967 3 9.09181 3.27543 9.22792 3.68377L10.7257 8.17721C10.8831 8.64932 10.6694 9.16531 10.2243 9.38787L7.96701 10.5165C9.06925 12.9612 11.0388 14.9308 13.4835 16.033L14.6121 13.7757C14.8347 13.3306 15.3507 13.1169 15.8228 13.2743L20.3162 14.7721C20.7246 14.9082 21 15.2903 21 15.7208V19C21 20.1046 20.1046 21 19 21H18C9.71573 21 3 14.2843 3 6V5Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <?= htmlspecialchars($telefono) ?>
            </a>
            <?php endif; ?>
            <button onclick="scrollHacia('contacto');" 
                class="border-2 rounded-full py-3 px-12 text-black">
                Contacto
            </button>
        </div>
    </div>
    <!--Vista del modo mobile -->
    <ul id="menu" onclick="toggleMobileMenu()" class="flex-col fixed top-0 left-0 w-screen text-slate-900 bg-black bg-opacity-80 h-screen z-50 transform translate-x-full transition-transform duration-500 lg:hidden">
        <li class="border-b-2 border-black bg-white hover:bg-gray-200">
            <button onclick="scrollHacia('seccion1')"
            class="w-full h-full py-6 duration-500 flex items-center justify-center text-center text-[40px] hover:scale-110">Sección 1</button>
        </li>
        <li class="border-b-2 border-black bg-white hover:bg-gray-200">
            <button onclick="scrollHacia('seccion2')"
            class="w-full h-full py-6 duration-500 flex items-center justify-center text-center text-[40px] hover:scale-110">Sección 2</button>
        </li>
        <li class="border-b-2 border-black bg-white hover:bg-gray-200">
            <button onclick="scrollHacia('seccion3')"
            class="w-full h-full py-6 duration-500 flex items-center justify-center text-center text-[40px] hover:scale-110">Sección 3</button>
        </li>
        <li class="border-b-2 border-black bg-white hover:bg-gray-200">
            <button onclick="scrollHacia('contacto')"
            class="w-full h-full py-6 duration-500 flex items-center justify-center text-center text-[40px] hover:scale-110">Contacto</button>
        </li>
        <?php $telefono = configuracion('telefono'); if ($telefono): ?>
        <li class="border-b-2 border-black bg-white hover:bg-gray-200">
            <a href="tel:<?= htmlspecialchars($telefono) ?>"
            class="w-full h-full py-6 duration-500 flex items-center justify-center text-center text-[40px] hover:scale-110 gap-4">
                <svg class="w-10 h-10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 5C3 3.89543 3.89543 3 5 3H8.27924C8.70967 3 9.09181 3.27543 9.22792 3.68377L10.7257 8.17721C10.8831 8.64932 10.6694 9.16531 10.2243 9.38787L7.96701 10.5165C9.06925 12.9612 11.0388 14.9308 13.4835 16.033L14.6121 13.7757C14.8347 13.3306 15.3507 13.1169 15.8228 13.2743L20.3162 14.7721C20.7246 14.9082 21 15.2903 21 15.7208V19C21 20.1046 20.1046 21 19 21H18C9.71573 21 3 14.2843 3 6V5Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Llamar
            </a>
        </li>
        <?php endif; ?>
    </ul>
</nav>

<?=importarScript('navbar.js')?>

