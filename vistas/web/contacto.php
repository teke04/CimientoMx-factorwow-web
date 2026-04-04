<!DOCTYPE html>
<html lang="ES">
<?php
$titulo      = 'Contacto - ' . env('EMPRESA');
$descripcion = 'Ponte en contacto con nosotros. Especialistas del Factor WOW! en el sector salud.';
?>
<head>
    <?php $this->plantilla('metas-basicas') ?>
    <?php $this->plantilla('estilos') ?>
    <?php $this->plantilla('metadatos', [
        'titulo'      => $titulo,
        'descripcion' => $descripcion,
        'imagen'      => '',
        'url'         => '',
    ]) ?>
    <title><?= $titulo ?></title>
    <meta name="description" content="<?= $descripcion ?>">
    <link rel="canonical" href="<?= ruta('contacto') ?>"/>
    <meta name="robots" content="index, follow">
    <?= configuracion('tag_manager_head') ?>
</head>
<body class="w-screen overflow-x-clip">
    <?= configuracion('tag_manager_body') ?>
    <main>
        <?php $this->componente('navbar'); ?>
        <?php $this->componente('flotante-whatsapp'); ?>

        <!-- ── HERO: fondo morado ──────────────────────────────── -->
        <section class="relative w-screen overflow-hidden bg-gradient-to-r from-[#8160ae] to-[#553CC8] pt-28 pb-20 md:pt-32 md:pb-24">

            <!-- Decoración (curvas/anillos) -->
            <img src="<?= importAsset('imagenes/contacto/decoracion.svg') ?>" alt=""
                 class="absolute top-0 right-0 w-[55%] max-w-[650px] pointer-events-none select-none"
                 aria-hidden="true">

            <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-12
                        flex flex-col lg:flex-row gap-12 lg:gap-16 items-start">

                <!-- Columna izquierda: contenido -->
                <div class="flex-1 flex flex-col gap-8 text-white">

                    <div class="flex flex-col gap-5">
                        <h1 class="font-montserrat font-extrabold text-[34px] xl:text-[48px] uppercase leading-[1.2]">
                            Especialistas del Factor <span class="text-[#00E6FF]">WOW!</span> en el sector salud
                        </h1>
                        <p class="font-montserrat font-bold text-[14px] xl:text-[18px] leading-[1.8]">
                            Mejora la hospitalidad en tu consultorio a través del Diplomado, Cursos y/o Asesoría 1 a 1
                        </p>
                    </div>

                    <div class="flex flex-col gap-5">
                        <h2 class="font-montserrat font-bold text-[24px] xl:text-[30px] uppercase leading-[1.2]">
                            Lleva tu consulta al siguiente nivel
                        </h2>
                        <p class="font-montserrat font-bold text-[14px] xl:text-[18px] leading-[1.8]">Contáctanos si:</p>

                        <?php
                        $bullets = [
                            'Tienes preguntas sobre nuestro Diplomado o próximos cursos',
                            'Estás buscando asesoría para llegar al siguiente nivel.',
                            'Tienes un consultorio y quieres que hagamos una Colaboración WOW!, es decir.',
                            'Necesitas un orador o profesor para un evento relacionado con el Factor WOW! en la odontopediatra, odontología o el sector salud.',
                        ];
                        foreach ($bullets as $bullet):
                        ?>
                        <div class="flex gap-[10px] items-start">
                            <!-- Ícono flecha rosa -->
                            <span class="flex-shrink-0 mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="9" height="29" viewBox="0 0 9 29" fill="none">
                                    <path d="M4.14521 29C2.89944 29 1.89779 28.6316 1.13867 27.8963C0.379555 27.161 0 26.1938 0 24.996C0 24.1933 0.170089 23.4847 0.513424 22.8717C0.855184 22.2587 1.34026 21.7821 1.97023 21.4419C2.59863 21.1017 3.32467 20.9308 4.14521 20.9308C4.96575 20.9308 5.69022 21.1017 6.3202 21.4419C6.94859 21.7821 7.43839 22.2587 7.78803 22.8717C8.13766 23.4847 8.31091 24.1933 8.31091 24.996C8.31091 26.1938 7.93135 27.161 7.17223 27.8963C6.41311 28.6316 5.40358 29 4.14521 29Z" fill="#FF3D81"/>
                                    <path d="M0.37624 0C0.310093 0 0.248671 0.0172451 0.174649 0.0987676C0.0943273 0.186561 0.0581055 0.274355 0.0581055 0.373122L0.673904 18.0322C0.673904 18.0902 0.686504 18.1654 0.787299 18.2595C0.869195 18.3363 0.951092 18.3724 1.04874 18.3724H7.14372C7.20199 18.3724 7.29491 18.3598 7.40988 18.2454C7.49493 18.1607 7.5217 18.098 7.51855 18.0698L8.17372 0.363716C8.1816 0.255542 8.15325 0.181858 8.0808 0.114445C8.00048 0.0376258 7.91701 0.00313548 7.82094 0.00313548H0.412465C0.40144 0.00313548 0.390416 0.00313548 0.377816 0.00313548L0.37624 0Z" fill="#FF3D81"/>
                                </svg>
                            </span>
                            <p class="font-montserrat font-normal text-[14px] xl:text-[18px] leading-[1.8]">
                                <?= htmlspecialchars($bullet) ?>
                            </p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Columna derecha: formulario -->
                <div class="w-full lg:w-[420px] xl:w-[460px] flex-shrink-0 flex flex-col gap-7">
                    <h2 class="font-montserrat font-bold text-[#00E6FF] text-[24px] xl:text-[30px] uppercase text-center lg:text-left">
                        Comparte el WOW!
                    </h2>

                    <form action="<?= ruta('gracias') ?>" method="POST" class="flex flex-col gap-[10px]">
                        <input type="hidden" name="landing_id" value="0">

                        <input type="text" name="nombre" required placeholder="Nombre completo"
                               class="bg-[#E6F0F0] rounded-[14px] h-[48px] md:h-[60px] px-6
                                      font-montserrat text-[14px] text-black placeholder:text-black
                                      outline-none focus:ring-2 focus:ring-[#553CC8] w-full">

                        <input type="tel" name="tel" required placeholder="Número"
                               class="bg-[#E6F0F0] rounded-[14px] h-[48px] md:h-[60px] px-6
                                      font-montserrat text-[14px] text-black placeholder:text-black
                                      outline-none focus:ring-2 focus:ring-[#553CC8] w-full">

                        <input type="email" name="email" required placeholder="Correo electrónico"
                               class="bg-[#E6F0F0] rounded-[14px] h-[48px] md:h-[60px] px-6
                                      font-montserrat text-[14px] text-black placeholder:text-black
                                      outline-none focus:ring-2 focus:ring-[#553CC8] w-full">

                        <!-- País -->
                        <div class="relative">
                            <select name="pais"
                                    class="bg-[#E6F0F0] rounded-[14px] h-[48px] md:h-[60px] px-6
                                           font-montserrat text-[14px] text-black
                                           outline-none focus:ring-2 focus:ring-[#553CC8]
                                           w-full appearance-none cursor-pointer">
                                <option value="" disabled selected>País</option>
                                <option value="México">México</option>
                                <option value="Estados Unidos">Estados Unidos</option>
                                <option value="Colombia">Colombia</option>
                                <option value="Argentina">Argentina</option>
                                <option value="España">España</option>
                                <option value="Otro">Otro</option>
                            </select>
                            <svg class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none"
                                 width="14" height="8" viewBox="0 0 14 8" fill="none">
                                <path d="M1 1L7 7L13 1" stroke="#000" stroke-width="1.5"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>

                        <!-- Ciudad -->
                        <div class="relative">
                            <input type="text" name="ciudad" placeholder="Ciudad"
                                   class="bg-[#E6F0F0] rounded-[14px] h-[48px] md:h-[60px] px-6
                                          font-montserrat text-[14px] text-black placeholder:text-black
                                          outline-none focus:ring-2 focus:ring-[#553CC8] w-full pr-12">
                            <svg class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none"
                                 width="14" height="8" viewBox="0 0 14 8" fill="none">
                                <path d="M1 1L7 7L13 1" stroke="#000" stroke-width="1.5"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>

                        <textarea name="mensaje" placeholder="Mensaje" rows="4"
                                  class="bg-[#E6F0F0] rounded-[14px] px-6 py-4
                                         font-montserrat text-[14px] text-black placeholder:text-black
                                         outline-none focus:ring-2 focus:ring-[#553CC8]
                                         w-full resize-none min-h-[96px] md:min-h-0"></textarea>

                        <button type="submit"
                                class="bg-[#FF3D81] hover:bg-[#e02d6e] text-white
                                       font-montserrat font-semibold text-[18px]
                                       h-[48px] md:h-[60px] rounded-full transition-colors duration-300 w-full mt-1">
                            Enviar
                        </button>
                    </form>
                </div>
            </div>
        </section>

        <!-- ── BANNER COMUNIDAD: fondo rosa ───────────────────── -->
        <section class="relative w-screen overflow-hidden bg-gradient-to-r from-[#FF3D81] to-[#FF8A8A]">
            <div class="max-w-7xl mx-auto px-6 lg:px-12
                        flex flex-col md:flex-row items-center gap-6 md:gap-12 pt-10 md:pt-0">

                <!-- Mascota -->
                <div class="flex-shrink-0 flex justify-center md:justify-start w-full md:w-auto order-last md:order-first">
                    <img src="<?= importAsset('imagenes/contacto/Nubin-Amigos.svg') ?>" alt="Nubin y amigos"
                         class="h-[240px] md:h-[250px] lg:h-[300px] object-contain">
                </div>

                <!-- Texto + redes -->
                <div class="flex flex-col gap-6 items-center md:items-start pb-6 md:pb-0 order-first md:order-last">
                    <h2 class="font-montserrat font-bold text-[24px] xl:text-[30px] uppercase leading-[1.2]
                               text-white text-center md:text-left">
                        Sé la primera persona en conocer todo lo nuevo en la
                        <span class="text-[#00E6FF]">Comunidad WOW!</span>
                    </h2>

                    <div class="flex gap-5 items-center">
                        <!-- Facebook -->
                        <a href="#" title="Facebook" class="hover:scale-110 transition-transform flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none">
                                <g clip-path="url(#clip_fb_cnt)">
                                    <circle cx="12" cy="12" r="12" fill="#553CC8"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10.1627 12.0553V18.8475C10.1627 18.945 10.242 19.0242 10.3395 19.0242H12.8618C12.9593 19.0242 13.0385 18.945 13.0385 18.8475V11.9447H14.8671C14.959 11.9447 15.0354 11.8744 15.0434 11.7825L15.2191 9.70266C15.228 9.59953 15.1465 9.51094 15.0429 9.51094H13.0385V8.03531C13.0385 7.68937 13.3188 7.40906 13.6648 7.40906H15.0738C15.1713 7.40906 15.2505 7.32984 15.2505 7.23234V5.1525C15.2505 5.055 15.1713 4.97578 15.0738 4.97578H12.6926C11.2952 4.97578 10.1623 6.10875 10.1623 7.50609V9.51094H8.90133C8.80383 9.51094 8.72461 9.59016 8.72461 9.68765V11.7675C8.72461 11.865 8.80383 11.9442 8.90133 11.9442H10.1623V12.0548L10.1627 12.0553Z" fill="white"/>
                                </g>
                                <defs><clipPath id="clip_fb_cnt"><rect width="24" height="24" fill="white"/></clipPath></defs>
                            </svg>
                        </a>
                        <!-- Instagram -->
                        <a href="#" title="Instagram" class="hover:scale-110 transition-transform flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none">
                                <g clip-path="url(#clip_ig_cnt)">
                                    <circle cx="12" cy="12" r="12" fill="#553CC8"/>
                                    <path d="M15.9516 7.24547C15.4725 7.24547 15.0844 7.63359 15.0844 8.11266C15.0844 8.59172 15.4725 8.97984 15.9516 8.97984C16.4306 8.97984 16.8187 8.59172 16.8187 8.11266C16.8187 7.63359 16.4306 7.24547 15.9516 7.24547ZM12.0961 8.35734C10.0875 8.35734 8.45344 9.99141 8.45344 12C8.45344 14.0086 10.0875 15.6427 12.0961 15.6427C14.1047 15.6427 15.7388 14.0086 15.7388 12C15.7388 9.99141 14.1047 8.35734 12.0961 8.35734ZM12.0961 14.3334C10.8094 14.3334 9.76266 13.2867 9.76266 12C9.76266 10.7133 10.8094 9.66656 12.0961 9.66656C13.3828 9.66656 14.4295 10.7133 14.4295 12C14.4295 13.2867 13.3828 14.3334 12.0961 14.3334ZM19.4461 8.97281C19.4461 6.51891 17.4567 4.53 15.0028 4.53H9.13875C6.68484 4.53 4.69547 6.51891 4.69547 8.97281V14.8373C4.69547 17.2913 6.68484 19.2802 9.13875 19.2802H15.0028C17.4567 19.2802 19.4461 17.2913 19.4461 14.8373V8.97281ZM18.0548 14.8373C18.0548 16.5225 16.6884 17.8889 15.0033 17.8889H9.13922C7.45406 17.8889 6.08766 16.523 6.08766 14.8373V8.97281C6.08766 7.28766 7.45406 5.92125 9.13922 5.92125H15.0033C16.6884 5.92125 18.0548 7.28719 18.0548 8.97281V14.8373Z" fill="white"/>
                                </g>
                                <defs><clipPath id="clip_ig_cnt"><rect width="24" height="24" fill="white"/></clipPath></defs>
                            </svg>
                        </a>
                        <!-- YouTube -->
                        <a href="https://youtube.com/@FactorWOWenOdontolog%C3%ADa" target="_blank"
                           rel="noopener noreferrer" title="YouTube"
                           class="hover:scale-110 transition-transform flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none">
                                <g clip-path="url(#clip_yt_cnt)">
                                    <circle cx="12" cy="12" r="12" fill="#553CC8"/>
                                    <path d="M19.0168 10.223C19.0168 8.56078 17.6696 7.21359 16.0074 7.21359H8.20176C6.53957 7.21359 5.19238 8.56078 5.19238 10.223V13.8811C5.19238 15.5433 6.53957 16.8905 8.20176 16.8905H16.0074C17.6696 16.8905 19.0168 15.5433 19.0168 13.8811V10.223ZM14.0921 12.2362L10.9791 13.9434C10.8436 14.0166 10.7222 13.9186 10.7222 13.7648V10.2605C10.7222 10.1048 10.8479 10.0069 10.9833 10.0842L14.1179 11.8814C14.2561 11.9602 14.2327 12.1608 14.0925 12.2367L14.0921 12.2362Z" fill="white"/>
                                </g>
                                <defs><clipPath id="clip_yt_cnt"><rect width="24" height="24" fill="white"/></clipPath></defs>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <?php $this->componente('footer'); ?>
    </main>
</body>
</html>