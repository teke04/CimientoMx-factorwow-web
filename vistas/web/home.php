<!DOCTYPE html>
<html lang="ES">
<head> 
    <?php $this->plantilla('metas-basicas')?>
    <?php $this->plantilla('estilos')?>
    <title><?=env('EMPRESA')?></title>
    <meta name="description" content="">
    <meta name="robots" content="noindex, nofollow">

    
</head>
<body class="w-screen overflow-x-clip">
    <main>
        
        <?php $this->componente('navbar');?>
        <?php $this->componente('flotante-whatsapp');?>


        <!-- PRIMERA SECCION HERO - CARRUSEL -->
        <section id="seccion1" class="-mt-20 w-screen h-screen relative overflow-hidden bg-gradient-to-r from-[#ff3d81] to-[#553cc8] flex items-center justify-center">
            
            <!-- Contenedor del carrusel -->
            <div class="hero-carousel relative w-full h-full flex items-center justify-center">
                
                <!-- Slides - Imágenes -->
                <div class="hero-slides flex transition-transform duration-700 ease-in-out w-full h-full">
                    <?php for ($i = 1; $i <= 6; $i++): ?>
                    <div class="hero-slide flex-shrink-0 w-full h-full relative flex items-center justify-center">
                        <img src="<?=importAsset('imagenes/hero-' . $i . '.png')?>" alt="Hero <?=$i?>" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/20"></div>
                    </div>
                    <?php endfor; ?>
                </div>
                
                <!-- Contenido superpuesto centrado -->
                <div class="absolute z-10 w-full h-full flex flex-col sm:items-center items-start sm:justify-end justify-end text-left sm:text-center px-4 sm:px-6 pb-12 sm:pb-16 md:pb-20">
                    <!-- Título con WOW! en cian -->
                    <h1 class="font-montserrat font-extrabold text-2xl sm:text-3xl md:text-5xl lg:text-6xl leading-tight text-white mb-1 sm:mb-2 md:mb-4 tracking-tight">
                        VIVE LA
                    </h1>
                    <h1 class="font-montserrat font-extrabold text-2xl sm:text-3xl md:text-5xl lg:text-6xl leading-tight text-white mb-1 sm:mb-2 md:mb-4 tracking-tight">
                        EXPERIENCIA
                    </h1>
                    <h1 class="font-montserrat font-extrabold text-2xl sm:text-3xl md:text-5xl lg:text-6xl leading-tight text-white mb-4 sm:mb-6 md:mb-8 tracking-tight">
                        <span class="text-[#00E6FF]">WOW!</span> EN SALUD
                    </h1>
                    
                    <!-- Descripción -->
                    <p class="font-montserrat font-normal text-xs sm:text-sm md:text-base lg:text-lg text-white mb-4 sm:mb-6 md:mb-8 leading-relaxed max-w-2xl">
                        Lleva tu consultoría al siguiente nivel con nuestros diplomados, curso y congresos WOW!. Diseñados para transformar la atención y el servicio en salud.
                    </p>
                    
                    <!-- CTA Button -->
                    <a href="<?=ruta('diplomado')?>" class="inline-block bg-[#ff3d81] text-white font-montserrat font-bold px-6 sm:px-8 py-2 sm:py-3 rounded-full hover:opacity-90 transition-all text-sm sm:text-base mb-4 sm:mb-6 md:mb-8">
                        Texto
                    </a>
                    
                    <!-- Puntos de navegación -->
                    <div class="flex gap-1.5 sm:gap-2 justify-center">
                        <?php for ($i = 0; $i < 6; $i++): ?>
                        <button class="hero-dot w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full transition-all duration-300 <?=$i === 0 ? 'bg-[#0064FF]' : 'bg-white'?>" data-slide="<?=$i?>"></button>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
            
            <!-- Script para carrusel automático -->
            <script>
                (function() {
                    let currentSlide = 0;
                    const slides = document.querySelectorAll('.hero-slide');
                    const dots = document.querySelectorAll('.hero-dot');
                    const carousel = document.querySelector('.hero-slides');
                    const totalSlides = slides.length;
                    let autoPlayInterval;

                    function updateCarousel() {
                        carousel.style.transform = `translateX(-${currentSlide * 100}%)`;
                        
                        // Actualizar dots - cambiar color en lugar de ancho
                        dots.forEach((dot, index) => {
                            if (index === currentSlide) {
                                dot.classList.add('bg-[#0064FF]');
                                dot.classList.remove('bg-white');
                            } else {
                                dot.classList.remove('bg-[#0064FF]');
                                dot.classList.add('bg-white');
                            }
                        });
                    }

                    function nextSlide() {
                        currentSlide = (currentSlide + 1) % totalSlides;
                        updateCarousel();
                    }

                    function goToSlide(slideIndex) {
                        currentSlide = slideIndex;
                        updateCarousel();
                        clearInterval(autoPlayInterval);
                        startAutoPlay();
                    }

                    function startAutoPlay() {
                        autoPlayInterval = setInterval(nextSlide, 5000);
                    }

                    // Event listeners para los dots
                    dots.forEach((dot, index) => {
                        dot.addEventListener('click', () => goToSlide(index));
                    });

                    // Iniciar carrusel automático
                    updateCarousel();
                    startAutoPlay();
                })();
            </script>

            <!-- Máscara/Overlay con gradientes -->
            <div class="absolute inset-0 z-5 pointer-events-none" style="background: linear-gradient(180deg, rgba(85, 60, 200, 0.00) 30.29%, #553CC8 100%), linear-gradient(0deg, rgba(75, 75, 75, 0.20) 0%, rgba(75, 75, 75, 0.20) 100%); background-blend-mode: normal, multiply;"></div>
        </section>

        <section id="seccion2" class="w-screen flex items-center justify-center relative flex-col">
            <div class="w-full h-[80px] lg:h-[120px] bg-[#E6F0F0]"></div>
            <div class="w-full flex flex-col-reverse lg:flex-row gap-x-[120px]">
                <div class="w-full xl:w-1/2 relative flex flex-col items-center justify-center mt-[80px] xl:mt-0">
                    <img src="<?=importAsset('imagenes/home/nosotros1.png')?>" alt="Imagen acerca de nosotros" class="w-[700px] h-auto object-cover relative xl:absolute z-10 flex-shrink-0">
                    <img src="<?=importAsset('imagenes/home/nosotros2.png')?>" alt="Imagen acerca de nosotros" class="w-[250px] xl:w-[460px] h-auto object-cover relative xl:absolute translate-y-[-400px] xl:translate-y-[-300px] xl:translate-x-[60px] z-20 flex-shrink-0">
                    <img src="<?=importAsset('imagenes/home/nosotros-deco.svg')?>" alt="" class="w-[915px] h-auto object-fill absolute xl:translate-y-[200px] z-0 xl:flex-shrink-0">
                </div>
                <div class="w-full xl:w-1/2 relative flex flex-col gap-10 items-start justify-center py-[80px] xl:py-[200px] px-[28px] xl:px-0 xl:pr-[80px]">
                    <!-- Título -->
                    <h2 class="font-montserrat font-bold text-[30px] leading-[1.2] uppercase">
                        <span class="text-[#553cc8]">Acerca de </span>
                        <span class="text-[#ff3d81]">WOW! Experience</span>
                    </h2>
                    
                    <!-- Descripción -->
                    <div class="font-montserrat font-normal text-[18px] leading-[1.8] text-[#4b4b4b] space-y-4">
                        <p>
                            La <span class="font-bold">metodología WOW!</span> abarca todo el journey del paciente,
                        </p>
                        <p>
                            desde la primera interacción (incluso antes de su cita) hasta la fidelización. No se trata solo de crear un momento WOW!, sino de diseñar y ejecutar una experiencia completa, cuidando desde los aspectos tangibles hasta los intangibles en cada punto de contacto con el paciente.
                        </p>
                        <p>&nbsp;</p>
                        <p>
                            En términos de formación, <span class="font-bold">WOW! Experience</span> es un curso intensivo a nivel nacional e internacional, donde explicamos en profundidad cómo transformar la experiencia del paciente en el sector salud.
                        </p>
                    </div>
                    
                    <!-- Botón -->
                    <a href="#contacto" class="border-2 border-[#ff3d81] px-10 py-3 rounded-full font-montserrat font-semibold text-[18px] text-[#ff3d81] hover:bg-[#ff3d81] hover:text-white transition-all duration-300">
                        Conocer más
                    </a>
                </div>
            </div>
        </section>





        <section id="seccion3" class="hidden xl:block w-screen flex items-center justify-center relative py-16" style="background: linear-gradient(90deg, #FF8A8A 0%, #FF3D81 100%); display: flex;">

            <img src="<?=importAsset('imagenes/home/sticker-wow.svg')?>" alt="" class="absolute left-0 bottom-0 transform translate-y-1/2 hidden xl:block">

            <svg class="absolute right-[5%] bottom-0 hidden xl:block" xmlns="http://www.w3.org/2000/svg" width="206" height="208" viewBox="0 0 206 208" fill="none">
                <g clip-path="url(#clip0_35_2194)">
                    <path d="M151.218 101.473L145.116 132.878C145.116 132.878 161.132 140.733 167.217 120.804C173.319 100.875 151.201 101.473 151.201 101.473" fill="#FED296"/>
                    <path d="M101.957 15.8989C101.957 15.8989 119.375 -0.973327 128.314 3.91074C137.253 8.79482 126.536 23.43 126.536 23.43C126.536 23.43 144.398 19.5193 149.765 28.314C155.132 37.1088 143.509 41.9758 143.509 41.9758C143.509 41.9758 166.738 47.8332 165.849 56.628C164.96 65.4057 151.56 67.3695 151.56 67.3695C151.56 67.3695 170.328 84.9419 166.738 90.7994C163.166 96.6569 149.765 91.7728 149.765 91.7728C149.765 91.7728 158.705 110.319 150.654 117.149C142.62 123.98 138.142 114.212 138.142 114.212C138.142 114.212 134.57 139.589 123.853 139.589C113.136 139.589 114.025 128.847 114.025 128.847C114.025 128.847 100.624 147.393 93.4792 146.42C86.3345 145.446 84.5398 131.768 84.5398 131.768C84.5398 131.768 79.1727 145.429 73.8227 145.429C68.4727 145.429 53.2774 123.946 53.2774 123.946C53.2774 123.946 47.9103 135.661 41.6544 131.75C35.3986 127.84 32.715 103.437 32.715 103.437C32.715 103.437 29.9289 113.41 25.5703 111.241C13.52 105.247 21.1091 80.98 21.1091 80.98C21.1091 80.98 12.9731 95.7347 7.70854 90.7482C-0.324982 83.1318 23.7927 56.5768 23.7927 56.5768C23.7927 56.5768 13.0756 59.497 6.81972 51.6927C0.563833 43.8884 32.7321 34.1203 32.7321 34.1203C32.7321 34.1203 21.1262 29.2362 22.9039 20.4585C24.6815 11.6638 62.2168 20.4585 62.2168 20.4585C62.2168 20.4585 47.0386 7.77019 54.1833 1.91272C61.328 -3.94476 87.2404 13.6277 87.2404 13.6277C87.2404 13.6277 87.2404 0.222075 91.7016 -0.0340827C99.2907 -0.478089 101.974 15.8648 101.974 15.8648" fill="#DCA66D"/>
                    <path d="M149.526 139.316C147.509 147.649 145.15 155.915 142.535 164.095C141.509 167.322 140.433 170.533 139.322 173.726C137.852 177.995 136.313 182.231 134.724 186.449C133.373 190.018 132.143 193.723 130.297 197.088C127.1 202.86 121.614 207.01 114.742 206.822C108.623 206.651 105.324 202.023 103.769 196.678C103.735 196.575 103.718 196.49 103.683 196.388C102.367 191.657 101.752 186.841 100.162 182.162C99.8889 181.343 99.5812 180.523 99.2735 179.703C98.3505 178.815 97.2908 178.064 96.1798 177.432C92.3681 175.28 87.6848 174.546 83.3432 175.195C78.677 175.895 75.0533 178.542 71.9767 181.991C71.0878 182.982 70.2503 184.075 69.5153 185.236C69.447 187.063 69.464 188.925 69.5153 190.786C69.6008 193.928 69.6692 197.651 68.6265 200.862C68.0454 202.672 67.1053 204.294 65.6182 205.558C60.2169 210.169 51.7048 207.419 46.9018 203.355C43.5859 200.554 41.3809 196.883 39.7058 192.938C38.3213 189.71 37.3129 186.295 36.3386 183.016C33.8944 174.819 32.0313 166.485 29.1426 158.425C26.4078 150.723 23.7413 143.004 21.3826 135.183C14.9045 117.389 13.161 92.6437 13.161 92.6437C12.7679 81.2703 14.3746 69.9823 19.5708 59.7189C20.6305 57.6184 21.8441 55.6204 23.2115 53.7248C26.8693 47.1501 32.0996 41.4805 38.0991 36.955C51.4997 26.8453 68.7633 22.5077 85.3943 22.0637C92.0605 21.8759 98.8975 22.2857 105.512 23.5153C107.786 23.7373 110.059 24.0788 112.315 24.5741C124.109 27.221 134.467 34.069 141.851 43.5126C149.218 52.9392 153.662 64.4151 155.577 76.1471C156.431 81.441 156.739 86.7691 156.653 92.0631C156.653 92.0631 154.038 116.996 149.526 139.281" fill="#FFECBA"/>
                    <path d="M24.9547 79.3917C24.9206 78.0426 23.2455 76.7618 21.9806 77.701C20.7329 78.6232 19.9124 79.8357 19.6389 81.3726C19.5193 82.0728 19.4509 82.8242 19.5364 83.4902C19.4851 83.8659 19.4509 84.2416 19.4338 84.6344C19.3825 85.8469 20.9722 86.8544 22.0148 86.103C22.4079 85.8127 22.7669 85.5053 23.0746 85.1808C23.2797 85.0272 23.4506 84.8393 23.5873 84.6173C23.6215 84.5661 23.6386 84.5148 23.6557 84.4807C24.6642 83.0462 25.006 81.3214 24.9718 79.3917" fill="#EBC17D"/>
                    <path d="M17.5028 93.5658C17.2977 93.7366 17.1097 93.9244 16.9216 94.1123C15.2808 95.4614 14.7851 99.0305 15.2979 100.602C15.7764 102.07 17.6224 102.241 18.4771 101.011C18.6138 100.824 18.7335 100.619 18.8702 100.414C19.1608 100.277 19.4172 100.055 19.5539 99.7307C19.7248 99.3379 19.9129 98.9622 19.9129 98.5353C19.9129 98.484 19.9129 98.4499 19.9129 98.3986C20.306 97.4594 20.5966 96.4689 20.7846 95.4614C21.1606 93.4975 19.0411 92.3021 17.5028 93.5658Z" fill="#EBC17D"/>
                    <path d="M29.0399 92.8485C27.8776 91.7385 25.553 92.4728 25.6727 94.2317C25.6898 94.5904 25.7069 95.0002 25.7069 95.4272C25.1257 97.9546 26.5444 100.858 29.0228 101.814C30.1851 102.258 31.1252 101.148 31.2278 100.158C31.4842 97.613 30.9714 94.7099 29.0228 92.8485M30.0142 96.9299C29.9629 96.8275 29.8945 96.725 29.8091 96.6396C29.8091 96.6055 29.8091 96.5713 29.8091 96.5372C30.168 96.8104 30.1167 96.9299 29.9971 96.9299" fill="#EBC17D"/>
                    <path d="M145.937 75.4812C145.168 74.1663 142.826 74.32 142.501 75.9252C142.279 77.0011 142.228 78.094 142.399 79.1528C142.296 80.8776 142.792 82.6366 143.971 83.9344C144.757 84.8054 146.467 84.3955 146.689 83.2172C147.185 80.6556 147.321 77.8037 145.937 75.4641" fill="#EBC17D"/>
                    <path d="M140.791 89.4674C139.749 90.7311 138.142 94.0441 138.928 95.8372C138.962 96.0763 139.014 96.2983 139.065 96.5374C139.458 98.0402 141.304 98.006 142.107 96.9301C143.424 95.1883 143.782 92.8999 143.988 90.7824C144.124 89.2283 141.8 88.2549 140.774 89.4674" fill="#EBC17D"/>
                    <path d="M152.671 89.4161C151.628 88.4769 149.782 88.8013 149.423 90.27C149.269 90.9189 149.184 91.6191 149.133 92.3192C148.979 92.7461 148.927 93.2585 148.945 93.7025C148.945 94.1806 149.064 94.6417 149.201 95.0686C149.201 95.1199 149.201 95.154 149.201 95.2053C149.321 96.3836 149.816 97.5619 151.167 97.7498C152.209 97.8864 152.978 97.3058 153.32 96.469C154.705 94.2489 154.688 91.2775 152.637 89.4332" fill="#EBC17D"/>
                    <path d="M47.9789 156.325C47.825 155.454 47.6541 154.6 47.4148 153.78C47.4148 153.746 47.4148 153.695 47.4148 153.66C47.3635 153.37 47.261 153.114 47.1242 152.858C46.8166 152.004 46.4405 151.167 45.9449 150.365C44.6629 148.298 41.3811 148.657 40.7145 151.048C40.2872 152.602 40.5949 154.395 41.6033 155.641C42.1161 156.803 42.9195 157.879 43.8254 158.749C44.6116 159.518 45.8936 159.689 46.8679 159.142C47.8934 158.545 48.2011 157.435 48.0131 156.342" fill="#EBC17D"/>
                    <path d="M57.1578 150.365C56.3374 149.067 55.0725 148.742 53.6367 148.947C51.9104 149.186 50.5772 150.45 50.543 152.26C50.543 153.046 50.8677 153.78 51.3634 154.378C51.3805 154.395 51.4147 154.429 51.4318 154.446C51.5172 156.239 52.2351 157.998 52.9701 159.638C53.8589 161.601 57.1749 161.516 58.0808 159.638C59.6875 156.308 59.0722 153.404 57.1407 150.365" fill="#EBC17D"/>
                    <path d="M53.5173 168.791C52.2182 167.22 48.9364 167.971 48.6288 170.072C48.4066 171.677 48.492 172.958 49.2099 174.426C49.4492 174.905 49.7056 175.417 50.0133 175.861C50.5261 176.834 51.2269 177.739 51.9789 178.559C53.5685 180.284 56.047 178.781 56.235 176.817C56.5427 173.743 55.4487 171.13 53.5002 168.808" fill="#EBC17D"/>
                    <path d="M121.546 157.827C120.862 155.351 117.409 154.958 116.093 157.127C115.068 158.818 115.05 160.577 115.683 162.353C115.734 163.343 115.888 164.316 116.144 165.273C116.708 167.322 119.939 167.954 120.965 165.905C122.246 163.309 122.298 160.611 121.546 157.844" fill="#EBC17D"/>
                    <path d="M136.485 160.764C136.655 159.62 136.485 158.544 135.459 157.81C134.502 157.093 133.374 157.076 132.297 157.588C130.707 158.357 129.562 159.774 129.801 161.601C129.801 161.704 129.836 161.806 129.87 161.909C129.528 162.899 129.374 163.958 129.374 164.761C129.374 166.912 131.989 167.834 133.51 166.468C134.245 165.802 134.809 165.102 135.271 164.334C135.647 163.907 135.869 163.394 135.955 162.848C136.177 162.199 136.348 161.499 136.467 160.764" fill="#EBC17D"/>
                    <path d="M126.537 177.91C127.152 176.339 127.511 174.699 127.58 172.94C127.665 170.242 123.392 168.859 122.195 171.489C121.922 172.087 121.648 172.701 121.409 173.316C120.811 174.102 120.486 175.161 120.366 176.236C119.956 177.568 119.683 178.917 120.469 180.198C121.392 181.701 123.306 182.452 124.93 181.513C125.956 180.916 126.383 179.925 126.503 178.798C126.503 178.695 126.52 178.61 126.537 178.525C126.469 178.678 126.383 178.866 126.263 179.14C126.469 178.73 126.554 178.303 126.554 177.876" fill="#EBC17D"/>
                    <path d="M126.52 178.559C126.605 178.166 126.708 178.081 126.52 178.559V178.559Z" fill="#EBC17D"/>
                    <path d="M48.2353 77.001C48.2353 77.001 67.8918 78.3501 85.7023 79.8358C103.513 81.3215 123.391 82.2266 123.391 82.2266C123.391 82.2266 123.067 102.275 107.547 121.487C92.0266 140.682 71.5154 138.752 60.7984 121.743C51.8077 107.484 46.0475 88.4085 48.2353 77.001Z" fill="#56585A"/>
                    <path d="M110.589 92.1313C116.845 92.5411 118.417 85.5736 118.828 82.0045C115.255 81.8166 109.871 81.5263 103.769 81.1506C103.547 85.8639 104.401 91.7385 110.606 92.1483" fill="#EDD180"/>
                    <path d="M69.3786 85.9835C73.8227 85.7785 74.609 80.9799 74.7457 78.9989C70.37 78.6574 66.4216 78.3841 63.6184 78.1792C63.2082 81.8679 64.2338 86.2225 69.3786 85.9835Z" fill="#EDD180"/>
                    <path d="M95.3425 121.043C91.6846 123.912 93.7699 129.445 95.069 132.075C98.4533 130.316 101.769 127.789 104.931 124.441C102.863 122.034 98.8123 118.311 95.3254 121.043" fill="#EDD180"/>
                    <path d="M71.3445 119.626C68.1311 116.364 63.4306 119.113 60.5762 121.367C60.6445 121.487 60.73 121.607 60.7984 121.726C63.2426 125.585 66.1825 128.676 69.4472 130.914C71.8915 127.242 74.0964 122.426 71.3445 119.626Z" fill="#EDD180"/>
                    <path d="M64.0291 58.2843C64.0291 61.2899 61.5678 63.7148 58.5424 63.7148C55.517 63.7148 53.0557 61.2728 53.0557 58.2843C53.0557 55.2958 55.517 52.8538 58.5424 52.8538C61.5678 52.8538 64.0291 55.2958 64.0291 58.2843Z" fill="#665A44"/>
                    <path d="M124.4 61.9047C124.4 64.9102 121.939 67.3352 118.913 67.3352C115.888 67.3352 113.427 64.8932 113.427 61.9047C113.427 58.9162 115.888 56.4741 118.913 56.4741C121.939 56.4741 124.4 58.9162 124.4 61.9047Z" fill="#665A44"/>
                    <path d="M13.1613 92.6777C13.1613 92.6777 0 94.2147 0 112.334C0 130.452 24.3911 126.832 24.3911 126.832L13.1613 92.6777Z" fill="#FFECBA"/>
                    <path d="M32.3223 160.064C32.3223 160.064 38.1167 201.733 54.2692 205.661C57.3116 206.258 61.2771 206.258 64.3367 202.945C58.85 199.325 48.1842 206.258 32.3223 160.064Z" fill="white"/>
                    <path d="M110.162 23.7544C110.162 23.7544 130.895 38.2529 125.203 44.2811C119.512 50.3264 105.12 40.7461 103.376 25.001C102.846 45.4936 95.5307 53.1442 87.8049 47.9015C80.079 42.6588 91.8729 20.9195 91.8729 20.9195C91.8729 20.9195 82.5233 50.7192 69.926 39.841C57.3288 28.9629 82.1301 18.1018 82.1301 18.1018L110.179 23.7373L110.162 23.7544Z" fill="#DCA66D"/>
                    <path d="M177.506 66.9767C177.506 66.9767 179.045 65.8154 180.207 67.3524L183.677 71.9632C183.677 71.9632 184.839 73.5002 183.301 74.6614L170.977 83.9172C170.977 83.9172 169.439 85.0785 168.276 83.5415L164.807 78.9307C164.807 78.9307 163.644 77.3937 165.183 76.2325L177.506 66.9767Z" fill="#898D8D"/>
                    <path d="M181.762 75.8228L182.549 80.0579C182.549 80.0579 192.941 74.6444 201.06 85.4201C218.426 108.491 184.549 124.322 184.549 124.322C184.549 124.322 193.779 107.757 191.454 104.683L186.053 103.915L176.823 110.865L171.028 103.18L178.72 97.3912L174.088 91.2434L176.395 84.7029L172.532 82.7902L181.762 75.8398V75.8228Z" fill="#B7BABB"/>
                    <path d="M142.945 141.143C139.116 144.029 133.681 143.26 130.809 139.435C127.921 135.61 128.69 130.179 132.518 127.31C133.647 126.474 138.809 123.007 145.594 118.652C153.252 113.734 162.995 107.672 171.353 102.941L177.147 110.626C170.276 117.337 161.747 125.005 154.893 130.999C148.825 136.31 144.056 140.306 142.945 141.16" fill="#F5896B"/>
                    <path d="M175.61 111.326C175.61 111.326 165.559 101.08 155.577 114.571C145.595 128.062 157.03 134.227 162.141 133.492C167.252 132.758 180.037 123.81 175.593 111.326" fill="#FFECBA"/>
                    <g opacity="0.4">
                    <mask id="mask0_35_2194" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="38" y="41" width="100" height="51">
                        <path d="M137.801 41.8904H38.2705V91.0556H137.801V41.8904Z" fill="white"/>
                    </mask>
                    <g mask="url(#mask0_35_2194)">
                        <mask id="mask1_35_2194" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="38" y="41" width="100" height="51">
                        <path d="M137.801 41.8904H38.2705V91.0556H137.801V41.8904Z" fill="white"/>
                        </mask>
                        <g mask="url(#mask1_35_2194)">
                        <path d="M135.151 45.0497L137.784 72.5952C137.955 75.0543 137.51 83.1831 124.964 84.3785C115.956 85.2323 110.948 80.4849 105.632 75.4813C104.726 74.6274 103.786 73.7394 102.812 72.8855C100.231 70.5801 97.3767 68.4967 94.0265 67.4892C92.3002 66.9768 90.4542 66.7378 88.4202 66.9427H88.3689C87.3262 67.0452 86.3349 67.2501 85.4119 67.5404C79.7542 69.2823 76.216 74.1834 73.0539 78.5893C68.7979 84.5151 64.764 90.1164 55.7562 90.9703C43.2102 92.1657 41.2446 84.276 40.9369 81.8169L38.3047 54.2714C38.2192 53.4176 37.9799 50.8218 41.4326 50.4803L131.357 41.9246C134.809 41.6002 135.066 44.1959 135.151 45.0497Z" fill="white"/>
                        </g>
                    </g>
                    </g>
                    <path d="M31.4333 54.9543L24.5108 55.6033C24.5108 55.6033 21.0581 55.9277 21.3829 59.3944L23.3485 80.109C23.3485 80.109 23.6733 83.5586 27.126 83.2341L34.0485 82.5852L31.4162 54.9543H31.4333Z" fill="#B7BABB"/>
                    <path d="M23.0411 76.6765L12.6659 77.667C12.6659 77.667 5.7605 78.333 5.09389 71.4167C4.44437 64.5005 11.3498 63.8516 11.3498 63.8516L21.725 62.8611L23.0411 76.6765Z" fill="#CDCFCE"/>
                    <path d="M130.759 35.0594L85.8221 39.3287H85.7708L40.8344 43.598C40.8344 43.598 30.4592 44.5885 31.4506 54.9543L34.0828 82.5852C34.0828 82.5852 35.7237 99.8502 56.4741 97.8864C77.2246 95.9225 78.6945 74.8663 89.0697 73.8758H89.121C99.4962 72.8854 104.915 93.2755 125.665 91.3116C146.415 89.3478 144.757 72.0657 144.757 72.0657L142.125 44.4348C141.134 34.069 130.776 35.0594 130.776 35.0594M135.186 45.1008L137.818 72.6463C137.989 75.1054 137.544 83.2341 124.998 84.4125C115.991 85.2663 110.982 80.5189 105.667 75.5153C104.761 74.6614 103.821 73.7734 102.846 72.9195C100.265 70.6141 97.4109 68.5307 94.0608 67.5231C92.3344 67.0108 90.4884 66.7717 88.4544 66.9767H88.4031C87.3605 67.0791 86.3691 67.2841 85.4461 67.5744C79.7884 69.3162 76.2503 74.2174 73.0881 78.6233C68.8321 84.5491 64.7982 90.1504 55.7904 91.0043C43.2445 92.1997 41.2788 84.31 40.9711 81.8509L38.3389 54.3054C38.2534 53.4515 38.0141 50.8558 41.4668 50.5143L131.391 41.9586C134.844 41.6341 135.1 44.2299 135.186 45.0837" fill="#F5896B"/>
                    <path d="M142.107 44.4349L149.03 43.786C149.03 43.786 152.483 43.4615 152.807 46.9111L154.773 67.6257C154.773 67.6257 155.098 71.0753 151.645 71.3998L144.74 72.0658L142.107 44.4349Z" fill="#B7BABB"/>
                    <path d="M154.449 64.1759L164.824 63.1855C164.824 63.1855 171.73 62.5195 171.08 55.6203C170.413 48.7211 163.508 49.37 163.508 49.37L153.133 50.3605L154.449 64.1759Z" fill="#CDCFCE"/>
                </g>
                <defs>
                    <clipPath id="clip0_35_2194">
                    <rect width="206" height="208" fill="white"/>
                    </clipPath>
                </defs>
            </svg>

            <div class="w-full max-w-6xl px-4 flex flex-col items-center">
                <!-- Título -->
                <h2 class="text-center font-montserrat font-bold text-[40px] text-white mb-6 xl:mb-[80px]">
                    Lo que los doctores dicen
                </h2>
                
                <!-- Contenedor con flechas y tarjetas -->
                <div class="hidden xl:flex items-center gap-8 justify-center">
                    <!-- Flecha izquierda -->
                    <button id="cards-prev" class="z-20 p-3 rounded-full bg-[#553cc8] hover:bg-[#6b4dd9] transition-all flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>

                    <!-- Contenedor de las tarjetas -->
                    <div class="relative" style="width: 900px; height: 450px;">
                        <!-- Div decorativo detrás de la tarjeta grande -->
                        <div id="card-1-backdrop" class="absolute transition-all duration-500 ease-out" style="width: 600px; height: 100px; z-index: 1; left: 100px; top: -50px; transform: translateY(-100px);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="442" height="253" viewBox="0 0 442 253" fill="none">
                            <path d="M440.793 141.797C446.877 99.8515 418.776 60.5784 377.112 52.7985L101.634 1.35936C56.7928 -7.0138 14.1985 24.2235 8.70802 69.5085L0.582898 136.523C-4.746 180.476 27.0807 220.226 71.1343 224.639L348.448 252.418C390.51 256.632 428.435 226.987 434.504 185.152L440.793 141.797Z" fill="url(#paint0_linear_992_570)"/>
                            <defs>
                                <linearGradient id="paint0_linear_992_570" x1="437.57" y1="164.017" x2="2.16944" y2="100.859" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FF3D81"/>
                                <stop offset="1" stop-color="#553CC8"/>
                                </linearGradient>
                            </defs>
                            </svg>
                        </div>
                        
                        <!-- Tarjeta 1 (izquierda - más grande) -->
                        <div id="card-1" class="card-large absolute rounded-lg transition-all duration-500 ease-out overflow-hidden" style="width: 600px; height: 400px; z-index: 2; left: 0; top: 0;">
                            <!-- SVG Background -->
                            <svg class="absolute inset-0 w-full h-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 624 427" fill="none">
                              
                                <path d="M624 141.865C624 77.4657 573.642 24.3087 509.337 20.829L127.763 0.180902C57.5064 -3.62087 -1.21519 52.9946 0.019111 123.343L3.2574 307.907C4.46632 376.808 62.799 430.842 131.591 426.783L509.927 404.459C573.986 400.679 624 347.628 624 283.457V141.865Z" fill="white"/>

                            </svg>
                            
                            <!-- Quote decoration -->
                            <svg class="absolute top-6 left-6 w-20 h-20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80" fill="none">
                              <path d="M25.55 14.3999C30.4833 14.3999 33.6167 16.2332 34.95 19.8999C32.35 43.8332 30.1167 55.7999 28.25 55.7999H25.55C22.6833 55.7999 21.25 46.1666 21.25 26.8999V22.5999C21.7833 17.1332 23.2167 14.3999 25.55 14.3999ZM53.25 22.5999C56.9167 23.9332 58.75 25.3666 58.75 26.8999C53.95 36.6999 51.15 49.1332 50.35 64.1999L48.95 65.5999H47.65C43.9833 65.5999 42.15 60.0666 42.15 48.9999C43.95 31.3999 47.65 22.5999 53.25 22.5999Z" fill="#0064FF" opacity="1"/>
                            </svg>
                            
                            <div class="relative w-full h-full flex items-center justify-center p-6">
                                <p class="font-montserrat text-[14px] text-gray-600 text-center">Me abrió un panorama enorme de lo que es el manejo de la odontología desde un punto de vista de negocio, pero a la vez humanizado. Lo necesita realmente. ¡Muchas gracias!</p>
                            </div>
                            
                            <!-- Author name at bottom -->
                            <p class="absolute bottom-10 left-0 right-0 font-montserrat font-semibold text-[14px] text-[#0064ff] text-center">Dra. Anallely Cuadras Iribe</p>
                        </div>

                        <!-- Tarjeta 2 (derecha - más pequeña, encimada) -->
                        <div id="card-2" class="card-small absolute rounded-lg transition-all duration-500 ease-out overflow-hidden" style="width: 400px; height: 270px; right: 0; top: 75px; z-index: 1;">
                            <!-- SVG Background -->
                            <svg class="absolute inset-0 w-full h-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 624 427" fill="none">
                              
                                <path d="M624 141.865C624 77.4657 573.642 24.3087 509.337 20.829L127.763 0.180902C57.5064 -3.62087 -1.21519 52.9946 0.019111 123.343L3.2574 307.907C4.46632 376.808 62.799 430.842 131.591 426.783L509.927 404.459C573.986 400.679 624 347.628 624 283.457V141.865Z" fill="#e5e5e5"/>

                            </svg>
                            
                            <!-- Quote decoration -->
                            <svg class="absolute top-6 left-6 w-16 h-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80" fill="none">
                              <path d="M25.55 14.3999C30.4833 14.3999 33.6167 16.2332 34.95 19.8999C32.35 43.8332 30.1167 55.7999 28.25 55.7999H25.55C22.6833 55.7999 21.25 46.1666 21.25 26.8999V22.5999C21.7833 17.1332 23.2167 14.3999 25.55 14.3999ZM53.25 22.5999C56.9167 23.9332 58.75 25.3666 58.75 26.8999C53.95 36.6999 51.15 49.1332 50.35 64.1999L48.95 65.5999H47.65C43.9833 65.5999 42.15 60.0666 42.15 48.9999C43.95 31.3999 47.65 22.5999 53.25 22.5999Z" fill="#0064FF" opacity="1"/>
                            </svg>
                            
                            <div class="relative w-full h-full flex items-center justify-center p-6">
                                <p class="font-montserrat text-[14px] text-gray-600 text-center">Ese WOW! se contagia desde el primer momento. Como en todo, implica mucha constancia y tenacidad… El contenido ha sido de gran valor y superó mis expectativas.</p>
                            </div>
                            
                            <!-- Author name at bottom -->
                            <p class="absolute bottom-10 left-0 right-0 font-montserrat font-semibold text-[14px] text-[#0064ff] text-center">Dra. Victoria Melián</p>
                        </div>
                        
                        <!-- Div decorativo detrás de la tarjeta pequeña (sobresale por debajo) -->
                        <div id="card-2-backdrop" class="absolute transition-all duration-500 ease-out" style="width: 400px; height: 80px; z-index: 0; right: -150px; top: 220px; transform: translateY(-200px);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="225" height="155" viewBox="0 0 225 155" fill="none">
                            <path d="M0.777237 91.2724C-4.3204 59.7459 16.1705 29.7511 47.3926 23.0364L148.199 1.35672C182.209 -5.95762 215.291 17.0918 220.211 51.5301L223.582 75.1211C228.394 108.805 204.262 139.745 170.421 143.282L68.2793 153.956C36.6235 157.264 7.89269 135.278 2.81225 103.858L0.777237 91.2724Z" fill="url(#paint0_linear_992_560)"/>
                            <defs>
                                <linearGradient id="paint0_linear_992_560" x1="1.84459" y1="97.8735" x2="223.119" y2="62.0949" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#00E6FF"/>
                                <stop offset="1" stop-color="#0064FF"/>
                                </linearGradient>
                            </defs>
                            </svg>
                        </div>
                    </div>

                    <!-- Flecha derecha -->
                    <button id="cards-next" class="z-20 p-3 rounded-full bg-[#553cc8] hover:bg-[#6b4dd9] transition-all flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>

                <script>
                    (function() {
                        let isSwapped = false;
                        const card1 = document.getElementById('card-1');
                        const card2 = document.getElementById('card-2');
                        const card1Backdrop = document.getElementById('card-1-backdrop');
                        const card2Backdrop = document.getElementById('card-2-backdrop');
                        
                        // Get the SVG paths for background colors
                        const card1Svg = card1.querySelector('svg path');
                        const card2Svg = card2.querySelector('svg path');
                        
                        // Get the quote decoration SVGs
                        const card1QuoteSvg = card1.querySelector('.top-6.left-6');
                        const card2QuoteSvg = card2.querySelector('.top-6.left-6');

                        function updateCards() {
                            if (isSwapped) {
                                // Tarjeta 1: pequeña (400x270), se mueve a la derecha (donde estaba la 2)
                                card1.style.width = '400px';
                                card1.style.height = '270px';
                                card1.style.zIndex = '1';
                                card1.style.transform = 'translateX(500px) translateY(100px)';
                                card1Svg.setAttribute('fill', '#e5e5e5'); // Cambiar a gris
                                
                                // Quote decoration de card1 se hace pequeño
                                card1QuoteSvg.classList.remove('w-20', 'h-20');
                                card1QuoteSvg.classList.add('w-16', 'h-16');
                                
                                // Backdrop 1 se hace pequeño también
                                card1Backdrop.style.width = '400px';
                                card1Backdrop.style.height = '60px';
                                card1Backdrop.style.transform = 'translateX(500px) translateY(100px)';
                                card1Backdrop.style.zIndex = '0';
                                
                                // Tarjeta 2: grande (600x400), se mueve a la izquierda (donde estaba la 1)
                                card2.style.width = '600px';
                                card2.style.height = '400px';
                                card2.style.zIndex = '2';
                                card2.style.transform = 'translateX(-300px) translateY(-100px)';
                                card2Svg.setAttribute('fill', 'white'); // Cambiar a blanco
                                
                                // Quote decoration de card2 se hace grande
                                card2QuoteSvg.classList.remove('w-16', 'h-16');
                                card2QuoteSvg.classList.add('w-20', 'h-20');
                                
                                // Backdrop 2 se hace grande también
                                card2Backdrop.style.width = '600px';
                                card2Backdrop.style.height = '100px';
                                card2Backdrop.style.transform = 'translateX(-300px) translateY(-100px)';
                                card2Backdrop.style.zIndex = '0';
                            } else {
                                // Tarjeta 1: grande (600x400), posición inicial izquierda
                                card1.style.width = '600px';
                                card1.style.height = '400px';
                                card1.style.zIndex = '2';
                                card1.style.transform = 'translateX(0) translateY(0)';
                                card1Svg.setAttribute('fill', 'white'); // Cambiar a blanco
                                
                                // Quote decoration de card1 vuelve a tamaño grande
                                card1QuoteSvg.classList.remove('w-16', 'h-16');
                                card1QuoteSvg.classList.add('w-20', 'h-20');
                                
                                // Backdrop 1 vuelve a tamaño grande
                                card1Backdrop.style.width = '600px';
                                card1Backdrop.style.height = '100px';
                                card1Backdrop.style.transform = 'translateX(0) translateY(0)';
                                card1Backdrop.style.zIndex = '1';
                                
                                // Tarjeta 2: pequeña (400x270), posición inicial derecha
                                card2.style.width = '400px';
                                card2.style.height = '270px';
                                card2.style.zIndex = '1';
                                card2.style.transform = 'translateX(0px) translateY(0)';
                                card2Svg.setAttribute('fill', '#e5e5e5'); // Cambiar a gris
                                
                                // Quote decoration de card2 vuelve a tamaño pequeño
                                card2QuoteSvg.classList.remove('w-20', 'h-20');
                                card2QuoteSvg.classList.add('w-16', 'h-16');
                                
                                // Backdrop 2 vuelve a tamaño pequeño
                                card2Backdrop.style.width = '400px';
                                card2Backdrop.style.height = '60px';
                                card2Backdrop.style.transform = 'translateX(0) translateY(0)';
                                card2Backdrop.style.zIndex = '0';
                            }
                        }

                        document.getElementById('cards-next').addEventListener('click', () => {
                            isSwapped = !isSwapped;
                            updateCards();
                        });

                        document.getElementById('cards-prev').addEventListener('click', () => {
                            isSwapped = !isSwapped;
                            updateCards();
                        });

                        updateCards();
                    })();
                </script>
            </div>
        </section>

        <!-- SECCIÓN TESTIMONIOS MÓVIL -->
        <section class="xl:hidden w-screen flex items-center justify-center pb-16" style="background: linear-gradient(90deg, #FF8A8A 0%, #FF3D81 100%);">
            <div class="w-full px-4 flex flex-col items-center gap-12">
                <!-- Tarjetas en scroll horizontal -->
                <div class="flex flex-row gap-8 w-full overflow-x-auto snap-x snap-mandatory">
                    <!-- Tarjeta 1 -->
                    <div class="relative rounded-lg overflow-hidden p-6 h-64 flex-shrink-0" style="width: 320px;">
                        <!-- SVG Background -->
                        <svg class="absolute inset-0 w-full h-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 624 427" fill="none">
                            <path d="M624 141.865C624 77.4657 573.642 24.3087 509.337 20.829L127.763 0.180902C57.5064 -3.62087 -1.21519 52.9946 0.019111 123.343L3.2574 307.907C4.46632 376.808 62.799 430.842 131.591 426.783L509.927 404.459C573.986 400.679 624 347.628 624 283.457V141.865Z" fill="white"/>
                        </svg>
                        
                        <!-- Quote decoration -->
                        <svg class="absolute top-4 left-4 w-12 h-12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80" fill="none">
                          <path d="M25.55 14.3999C30.4833 14.3999 33.6167 16.2332 34.95 19.8999C32.35 43.8332 30.1167 55.7999 28.25 55.7999H25.55C22.6833 55.7999 21.25 46.1666 21.25 26.8999V22.5999C21.7833 17.1332 23.2167 14.3999 25.55 14.3999ZM53.25 22.5999C56.9167 23.9332 58.75 25.3666 58.75 26.8999C53.95 36.6999 51.15 49.1332 50.35 64.1999L48.95 65.5999H47.65C43.9833 65.5999 42.15 60.0666 42.15 48.9999C43.95 31.3999 47.65 22.5999 53.25 22.5999Z" fill="#0064FF"/>
                        </svg>
                        
                        <div class="relative w-full h-full flex flex-col items-center justify-center">
                            <p class="font-montserrat text-[13px] text-gray-600 mb-6">Me abrió un panorama enorme de lo que es el manejo de la odontología desde un punto de vista de negocio, pero a la vez humanizado. Lo necesita realmente. ¡Muchas gracias!</p>
                            <p class="font-montserrat font-semibold text-[12px] text-[#0064ff]">Dra. Anallely Cuadras Iribe</p>
                        </div>
                    </div>

                    <!-- Tarjeta 2 -->
                    <div class="relative rounded-lg overflow-hidden p-6 h-64 flex-shrink-0" style="width: 320px;">
                        <!-- SVG Background -->
                        <svg class="absolute inset-0 w-full h-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 624 427" fill="none">
                            <path d="M624 141.865C624 77.4657 573.642 24.3087 509.337 20.829L127.763 0.180902C57.5064 -3.62087 -1.21519 52.9946 0.019111 123.343L3.2574 307.907C4.46632 376.808 62.799 430.842 131.591 426.783L509.927 404.459C573.986 400.679 624 347.628 624 283.457V141.865Z" fill="#e5e5e5"/>
                        </svg>
                        
                        <!-- Quote decoration -->
                        <svg class="absolute top-4 left-4 w-12 h-12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80" fill="none">
                          <path d="M25.55 14.3999C30.4833 14.3999 33.6167 16.2332 34.95 19.8999C32.35 43.8332 30.1167 55.7999 28.25 55.7999H25.55C22.6833 55.7999 21.25 46.1666 21.25 26.8999V22.5999C21.7833 17.1332 23.2167 14.3999 25.55 14.3999ZM53.25 22.5999C56.9167 23.9332 58.75 25.3666 58.75 26.8999C53.95 36.6999 51.15 49.1332 50.35 64.1999L48.95 65.5999H47.65C43.9833 65.5999 42.15 60.0666 42.15 48.9999C43.95 31.3999 47.65 22.5999 53.25 22.5999Z" fill="#0064FF"/>
                        </svg>
                        
                        <div class="relative w-full h-full flex flex-col items-center justify-center">
                            <p class="font-montserrat text-[13px] text-gray-600 mb-6">Ese WOW! se contagia desde el primer momento. Como en todo, implica mucha constancia y tenacidad… El contenido ha sido de gran valor y superó mis expectativas.</p>
                            <p class="font-montserrat font-semibold text-[12px] text-[#0064ff]">Dra. Victoria Melián</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="w-full flex items-center justify-center py-[120px] overflow-hidden">
            <div class="w-full flex flex-col max-w-[600px] overflow-visible gap-[40px] items-center">
                <!-- Foto de la fundadora arriba -->
                <div class="flex items-center justify-center relative w-full max-w-[350px]">
                    <img src=<?=importAsset("imagenes/home/fundadora.png")?> alt="Dra. Ale Martínez" class="w-full object-cover relative z-10 rounded-full">
                    <img src=<?=importAsset("imagenes/home/decoracion-fundadora.png")?> alt="Decoración" class="object-cover absolute right-0 z-0">
                </div>

                <!-- Texto centrado abajo -->
                <div class="flex flex-col gap-10 justify-center items-center text-center px-[28px]">
                    <!-- Título -->
                    <h2 class="font-montserrat font-bold text-[30px] text-[#553cc8] uppercase">
                        Nuestra fundadora e inspiración:
                        <span class="text-[#ff3d81]"> Dra. Ale Martínez</span>
                    </h2>
                    
                    <!-- Descripción -->
                    <p class="font-montserrat font-normal text-[18px] text-[#4b4b4b] leading-relaxed">
                        ¡Hola! Soy la Dra. Ale Martínez, Especialista en Odontopediatría. Tengo una visión empresarial humanizada enfocada en algunos puntos.
                    </p>
                    
                    <!-- Botón -->
                    <a href="#" class="border-2 border-[#ff3d81] px-10 py-2.5 rounded-full font-montserrat font-semibold text-[18px] text-[#ff3d81] hover:bg-[#ff3d81] hover:text-white transition-all duration-300 inline-block w-fit">
                        Quiero saber más
                    </a>
                </div>
            </div>
        </section>

        <!-- Sección testimonios en video -->
        <section class="w-screen min-h-screen flex items-center justify-center py-16 overflow-hidden" style="background: linear-gradient(90deg, #FF8A8A 0%, #FF3D81 100%);">
            <div class="w-full max-w-7xl px-8 flex flex-col items-center gap-10">
                <!-- Título -->
                <h2 class="text-center font-montserrat font-bold text-[40px] text-white">
                    Testimonios en video
                </h2>

                <!-- Carrusel / grid de tarjetas -->
                <div class="relative w-full">

                    <!-- Track: scroll-snap en mobile, flex normal en desktop -->
                    <div id="testimonios-track"
                         class="flex gap-5 pb-4
                                overflow-x-auto snap-x snap-mandatory
                                lg:overflow-x-visible lg:justify-center lg:items-center">
                        <?php
                        $videosTestimonios = isset($videos) ? $videos : [];
                        for($i = 0; $i < 3; $i++):
                            $video = isset($videosTestimonios[$i]) ? $videosTestimonios[$i] : null;
                        ?>
                        <!-- Tarjeta <?=$i+1?> -->
                        <div id="testimonio-slide-<?=$i?>"
                             class="snap-center flex-shrink-0 w-[292px] h-[530px] relative group <?= $video ? 'cursor-pointer' : '' ?>"
                             <?= $video ? 'onclick="abrirVideoModal(\'' . htmlspecialchars($video['youtube_id'], ENT_QUOTES) . '\')"' : '' ?>>
                            <?php if($video): ?>
                            <!-- maxresdefault = 1280×720 (16:9 sin barras negras); fallback a mqdefault = 320×180 (16:9) -->
                            <img src="https://img.youtube.com/vi/<?= htmlspecialchars($video['youtube_id']) ?>/maxresdefault.jpg"
                                 onerror="this.onerror=null;this.src='https://img.youtube.com/vi/<?= htmlspecialchars($video['youtube_id']) ?>/mqdefault.jpg'"
                                 alt="<?= htmlspecialchars($video['titulo']) ?>"
                                 class="w-full h-full object-cover rounded-[20px]">
                            <?php else: ?>
                            <img src="https://via.placeholder.com/292x530" alt="Testimonio <?=$i+1?>" class="w-full h-full object-cover rounded-[20px]">
                            <?php endif; ?>
                            <!-- Gradiente oscuro -->
                            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black/60 rounded-[20px]"></div>
                            <!-- Botón Play -->
                            <div class="absolute inset-0 flex items-center justify-center">
                                <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="40" cy="40" r="40" fill="black" fill-opacity="0.3"/>
                                    <path d="M48.494 35.9679L38.954 28.9679C38.2089 28.4223 37.3272 28.0937 36.4068 28.0185C35.4863 27.9434 34.563 28.1247 33.7393 28.5422C32.9156 28.9598 32.2236 29.5973 31.7401 30.3842C31.2565 31.171 31.0004 32.0763 31 32.9999V46.9999C31.0002 47.9238 31.2563 48.8296 31.7401 49.6168C32.2238 50.404 32.9162 51.0417 33.7404 51.4593C34.5646 51.8768 35.4884 52.0578 36.4092 51.9822C37.3301 51.9066 38.212 51.5773 38.957 51.0309L48.497 44.0309C49.1303 43.5665 49.6452 42.9594 50.0002 42.2589C50.3552 41.5584 50.5401 40.7842 50.5401 39.9989C50.5401 39.2136 50.3552 38.4393 50.0002 37.7388C49.6452 37.0383 49.1303 36.4313 48.497 35.9669L48.494 35.9679ZM47.31 42.4179L37.77 49.4179C37.323 49.7445 36.7944 49.9411 36.2426 49.9858C35.6908 50.0306 35.1374 49.9218 34.6436 49.6715C34.1498 49.4212 33.7349 49.0391 33.4448 48.5676C33.1547 48.0961 33.0008 47.5535 33 46.9999V32.9999C32.9945 32.4452 33.1455 31.9002 33.4358 31.4276C33.7261 30.9549 34.1438 30.5738 34.641 30.3279C35.0639 30.1128 35.5315 30.0004 36.006 29.9999C36.6419 30.0023 37.2602 30.2088 37.77 30.5889L47.31 37.5889C47.6895 37.8676 47.9981 38.2317 48.2107 38.6517C48.4234 39.0718 48.5343 39.536 48.5343 40.0069C48.5343 40.4777 48.4234 40.9419 48.2107 41.362C47.9981 41.7821 47.6895 42.1462 47.31 42.4249V42.4179Z" fill="white"/>
                                </svg>
                            </div>
                        </div>
                        <?php endfor; ?>
                    </div>

                </div>

                <!-- Dots — solo mobile -->
                <div class="flex justify-center gap-3 lg:hidden">
                    <?php for($d = 0; $d < 3; $d++): ?>
                    <button onclick="irATestimonio(<?=$d?>)"
                            id="dot-testimonio-<?=$d?>"
                            class="rounded-full transition-all duration-300 <?= $d === 0 ? 'w-4 h-4 bg-white' : 'w-3 h-3 bg-white/40' ?>"
                            aria-label="Testimonio <?=$d+1?>">
                    </button>
                    <?php endfor; ?>
                </div>
            </div>
        </section>

        <!-- Modal de video -->
        <div id="video-modal"
             class="fixed inset-0 z-[200] bg-black/80 backdrop-blur-sm flex items-center justify-center p-4 hidden"
             onclick="if(event.target===this) cerrarVideoModal()">
            <div class="relative w-full max-w-5xl">
                <!-- Botón cerrar -->
                <button onclick="cerrarVideoModal()"
                        class="absolute -top-10 right-0 text-white text-4xl leading-none font-bold hover:text-gray-300 transition"
                        aria-label="Cerrar video">&times;</button>
                <!-- Contenedor 16:9 con iframe escalado para eliminar barras negras del player -->
                <div class="relative w-full overflow-hidden rounded-2xl" style="padding-bottom: 56.25%;">
                    <iframe id="video-modal-iframe"
                            class="absolute w-full h-full"
                            style="top: 0; left: 0;"
                            src=""
                            frameborder="0"
                            allow="autoplay; encrypted-media; fullscreen; picture-in-picture"
                            allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>

        <style>
            /* Ocultar barra de scroll del carrusel */
            #testimonios-track { -ms-overflow-style: none; scrollbar-width: none; }
            #testimonios-track::-webkit-scrollbar { display: none; }
        </style>

        <script>
        // ── Carrusel de testimonios (mobile) ─────────────────────────────
        let testimonioActual = 0;
        const TOTAL_TESTIMONIOS = 3;

        function initCarruselTestimonios() {
            if (window.innerWidth >= 1024) return;
            const track = document.getElementById('testimonios-track');
            // Añadir padding para centrar la primera y última tarjeta
            const pad = Math.max(0, (track.offsetWidth - 292) / 2);
            track.style.paddingLeft  = pad + 'px';
            track.style.paddingRight = pad + 'px';
            irATestimonio(testimonioActual, false);
        }

        function irATestimonio(index, animar = true) {
            if (window.innerWidth >= 1024) return;
            testimonioActual = Math.max(0, Math.min(index, TOTAL_TESTIMONIOS - 1));
            const track = document.getElementById('testimonios-track');
            const slide = document.getElementById('testimonio-slide-' + testimonioActual);
            if (slide && track) {
                const slideCenter = slide.offsetLeft + slide.offsetWidth / 2;
                const targetScrollLeft = slideCenter - track.offsetWidth / 2;
                track.scrollTo({ left: targetScrollLeft, behavior: animar ? 'smooth' : 'instant' });
            }
            actualizarDotsTestimonios(testimonioActual);
        }

        function testimonioAnterior() {
            irATestimonio((testimonioActual - 1 + TOTAL_TESTIMONIOS) % TOTAL_TESTIMONIOS);
        }

        function testimonioSiguiente() {
            irATestimonio((testimonioActual + 1) % TOTAL_TESTIMONIOS);
        }

        function actualizarDotsTestimonios(index) {
            for (let i = 0; i < TOTAL_TESTIMONIOS; i++) {
                const dot = document.getElementById('dot-testimonio-' + i);
                if (!dot) continue;
                dot.className = i === index
                    ? 'rounded-full transition-all duration-300 w-4 h-4 bg-white'
                    : 'rounded-full transition-all duration-300 w-3 h-3 bg-white/40';
            }
        }

        // Actualizar dot activo al hacer swipe manual
        document.getElementById('testimonios-track').addEventListener('scroll', function () {
            if (window.innerWidth >= 1024) return;
            const trackCenter = this.scrollLeft + this.offsetWidth / 2;
            let closest = 0, minDist = Infinity;
            for (let i = 0; i < TOTAL_TESTIMONIOS; i++) {
                const slide = document.getElementById('testimonio-slide-' + i);
                if (!slide) continue;
                const slideCenter = slide.offsetLeft + slide.offsetWidth / 2;
                const dist = Math.abs(trackCenter - slideCenter);
                if (dist < minDist) { minDist = dist; closest = i; }
            }
            if (closest !== testimonioActual) {
                testimonioActual = closest;
                actualizarDotsTestimonios(closest);
            }
        }, { passive: true });

        window.addEventListener('load', initCarruselTestimonios);
        window.addEventListener('resize', initCarruselTestimonios);

        // ── Modal de video ────────────────────────────────────────────────
        function abrirVideoModal(youtubeId) {
            document.getElementById('video-modal-iframe').src =
                'https://www.youtube.com/embed/' + youtubeId + '?autoplay=1&rel=0&modestbranding=1';
            document.getElementById('video-modal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        function cerrarVideoModal() {
            document.getElementById('video-modal-iframe').src = '';
            document.getElementById('video-modal').classList.add('hidden');
            document.body.style.overflow = '';
        }
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') cerrarVideoModal();
        });
        </script>

        <!-- Nueva sección -->
        <section class="w-screen min-h-screen flex items-center justify-center pb-[400px] relative" style="background: #E6F0F0;">
            <div class="w-full max-w-7xl flex flex-col gap-12 pt-16">
                <!-- Título -->
                <h2 class="font-montserrat font-bold text-[24px] lg:text-[30px] text-[#553cc8] uppercase leading-[1.2] px-8">
                    Preguntas frecuentes
                </h2>

                <!-- Contenedor principal con decoración debajo -->
                <div class="flex flex-col gap-12 w-full">
                    <!-- FAQ Items -->
                    <div class="w-full flex flex-col gap-6 px-8">
                        <?php 
                        $faqs = [
                            [
                                'pregunta' => '¿Qué es WOW! Experience?',
                                'respuesta' => 'WOW! Experience es una metodología, donde a través de conferencias, diplomados y cursos, creados y enseñados por la Dra. Alejandra Martínez, conocerás cómo mejorar la experiencia de servicio al cliente en el sector salud.'
                            ],
                            [
                                'pregunta' => '¿Quién puede participar en WOW! Experience?',
                                'respuesta' => 'La metodología WOW! fue diseñada para profesionales de la salud, ya que, la mayoría de los ejemplos están aterrizados a nuestro nicho médico. Sin embargo, cualquier emprendedor o empresario puede tomarlo.'
                            ],
                            [
                                'pregunta' => '¿Cómo funciona?',
                                'respuesta' => 'Una vez que hagas tu inscripción, podrás tener acceso al material, además la posibilidad de participar en una comunidad privada en la que podrás resolver dudas con tus compañeras y compañeros y la Dra. Ale.'
                            ],
                            [
                                'pregunta' => 'Si ya tomé otro curso WOW!, ¿puedo tomar uno nuevo o una actualización?',
                                'respuesta' => 'Totalmente, cada conferencia, diplomado y/o curso son actualizados de forma constante, por lo que el aprendizaje es y siempre será nuevo y adaptado a las tendencias actuales.'
                            ]
                        ];
                        ?>
                        
                        <?php foreach($faqs as $index => $faq): ?>
                        <div class="faq-item bg-white w-full rounded-[40px] p-10 cursor-pointer overflow-hidden border-b-4 border-b-transparent transition-all duration-500 hover:shadow-lg" data-faq="<?=$index?>">
                            <!-- Header -->
                            <div class="faq-header flex gap-10 items-center justify-between w-full">
                                <h3 class="font-montserrat font-bold text-[24px] text-[#553cc8] leading-tight flex-1">
                                    <?=$faq['pregunta']?>
                                </h3>
                                <div class="faq-toggle text-[#ff3d81] text-[28px] font-bold flex-shrink-0 transition-transform duration-500">+</div>
                            </div>
                            
                            <!-- Respuesta (oculta por defecto) -->
                            <div class="faq-content max-h-0 transition-all duration-700 ease-in-out overflow-hidden">
                                <div class="h-0.5 bg-[#ff3d81] my-6"></div>
                                <p class="font-montserrat font-normal text-[18px] text-[#4b4b4b] leading-relaxed pb-10 opacity-0 transition-opacity duration-700">
                                    <?=$faq['respuesta']?>
                                </p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Div decorativo (imagen) debajo -->
                    <div class="w-full max-w-[300px] absolute left-0 bottom-0">
                        <img src="<?=importAsset('imagenes/home/deco-faq.png')?>" alt="Decoración FAQ" class="w-full h-auto">
                    </div>
                </div>
            </div>
        </section>

        <script>
            document.querySelectorAll('.faq-item').forEach(item => {
                item.addEventListener('click', function() {
                    const content = this.querySelector('.faq-content');
                    const text = content.querySelector('p');
                    const toggle = this.querySelector('.faq-toggle');
                    const isOpen = content.classList.contains('open');
                    
                    if (!isOpen) {
                        // Abrir
                        content.classList.add('open');
                        content.style.maxHeight = content.scrollHeight + 'px';
                        
                        // Aparecer el texto gradualmente
                        setTimeout(() => {
                            text.classList.remove('opacity-0');
                            text.classList.add('opacity-100');
                        }, 200);
                        
                        // Cambiar color del borde
                        this.classList.add('border-b-[#ff3d81]');
                        
                        // Cambiar icono de + a -
                        toggle.textContent = '−';
                    } else {
                        // Cerrar
                        content.classList.remove('open');
                        content.style.maxHeight = '0';
                        
                        // Desaparecer el texto gradualmente
                        text.classList.add('opacity-0');
                        text.classList.remove('opacity-100');
                        
                        // Quitar color del borde
                        this.classList.remove('border-b-[#ff3d81]');
                        
                        // Cambiar icono de - a +
                        toggle.textContent = '+';
                    }
                });
            });
        </script>
        

    
        <?php $this->componente('footer');?>

    </main>
</body>
</html>