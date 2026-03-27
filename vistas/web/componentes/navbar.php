<!-- NAVBAR DESKTOP -->
<header class="hidden xl:flex fixed top-0 left-0 w-full bg-white z-50">
    <!-- Gradient divider at bottom -->
    <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-[#ff3d81] to-[#553cc8]"></div>
    
    <!-- Main navbar row: Logo | Navigation Rows | Profile -->
    <div class="h-[120px] flex items-center justify-between px-[7%] w-full">
        <!-- Logo (left) -->
        <div class="flex-shrink-0">
            <a href="#" class="inline-block hover:text-[#FF3D81] transition-colors">
                <img src="<?=importAsset('logo.svg')?>" alt="WOW EXPERIENCE" class="h-16">
            </a>
        </div>
        
        <!-- Navigation Container (center) - Two rows stacked -->
        <div class="flex-1 flex flex-col items-center justify-end gap-2">
            <!-- Top Row: Webinars, Blog, Social Icons - Aligned to right -->
            <div class="flex gap-[40px] items-center justify-end w-full pr-0">
                <!-- Webinars -->
                <a href="#" class="font-montserrat font-medium text-sm text-[#553cc8] uppercase hover:text-[#FF3D81] transition-colors">
                    Webinars
                </a>
                
                <!-- Blog -->
                <a href="#" class="font-montserrat font-medium text-sm text-[#553cc8] uppercase hover:text-[#FF3D81] transition-colors">
                    Blog
                </a>
                
                <!-- Social Icons (24px each, gap 14px) -->
                <div class="flex gap-[14px] items-center">
                    <!-- Facebook -->
                    <a href="#" class="hover:opacity-100 transition-opacity flex-shrink-0" title="Facebook">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <g clip-path="url(#clip0_9_1259)">
                                <path d="M12 23.7188C5.53828 23.7188 0.28125 18.4617 0.28125 12C0.28125 5.53828 5.53828 0.28125 12 0.28125C18.4617 0.28125 23.7188 5.53828 23.7188 12C23.7188 18.4617 18.4617 23.7188 12 23.7188Z" fill="#FF3D81"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.1627 12.0553V18.8475C10.1627 18.945 10.242 19.0242 10.3395 19.0242H12.8618C12.9593 19.0242 13.0385 18.945 13.0385 18.8475V11.9447H14.8671C14.959 11.9447 15.0354 11.8744 15.0434 11.7825L15.2191 9.70266C15.228 9.59953 15.1465 9.51094 15.0429 9.51094H13.0385V8.03531C13.0385 7.68937 13.3188 7.40906 13.6648 7.40906H15.0738C15.1713 7.40906 15.2505 7.32984 15.2505 7.23234V5.1525C15.2505 5.055 15.1713 4.97578 15.0738 4.97578H12.6926C11.2952 4.97578 10.1623 6.10875 10.1623 7.50609V9.51094H8.90133C8.80383 9.51094 8.72461 9.59016 8.72461 9.68765V11.7675C8.72461 11.865 8.80383 11.9442 8.90133 11.9442H10.1623V12.0548L10.1627 12.0553Z" fill="white"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_9_1259">
                                    <rect width="24" height="24" fill="white"/>
                                </clipPath>
                            </defs>
                        </svg>
                    </a>
                    
                    <!-- Instagram -->
                    <a href="#" class="hover:opacity-100 transition-opacity flex-shrink-0" title="Instagram">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <g clip-path="url(#clip0_9_1262)">
                                <path d="M11.9912 22.1653C17.6603 22.1653 22.2559 17.5697 22.2559 11.9006C22.2559 6.23159 17.6603 1.63594 11.9912 1.63594C6.32222 1.63594 1.72656 6.23159 1.72656 11.9006C1.72656 17.5697 6.32222 22.1653 11.9912 22.1653Z" fill="white"/>
                                <path d="M12 23.7188C5.53828 23.7188 0.28125 18.4617 0.28125 12C0.28125 5.53828 5.53828 0.28125 12 0.28125C18.4617 0.28125 23.7188 5.53828 23.7188 12C23.7188 18.4617 18.4617 23.7188 12 23.7188ZM15.9516 7.24547C15.4725 7.24547 15.0844 7.63359 15.0844 8.11266C15.0844 8.59172 15.4725 8.97984 15.9516 8.97984C16.4306 8.97984 16.8187 8.59172 16.8187 8.11266C16.8187 7.63359 16.4306 7.24547 15.9516 7.24547ZM12.0961 8.35734C10.0875 8.35734 8.45344 9.99141 8.45344 12C8.45344 14.0086 10.0875 15.6427 12.0961 15.6427C14.1047 15.6427 15.7388 14.0086 15.7388 12C15.7388 9.99141 14.1047 8.35734 12.0961 8.35734ZM12.0961 14.3334C10.8094 14.3334 9.76266 13.2867 9.76266 12C9.76266 10.7133 10.8094 9.66656 12.0961 9.66656C13.3828 9.66656 14.4295 10.7133 14.4295 12C14.4295 13.2867 13.3828 14.3334 12.0961 14.3334ZM19.4461 8.97281C19.4461 6.51891 17.4567 4.53 15.0028 4.53H9.13875C6.68484 4.53 4.69547 6.51891 4.69547 8.97281V14.8373C4.69547 17.2913 6.68484 19.2802 9.13875 19.2802H15.0028C17.4567 19.2802 19.4461 17.2913 19.4461 14.8373V8.97281ZM18.0548 14.8373C18.0548 16.5225 16.6884 17.8889 15.0033 17.8889H9.13922C7.45406 17.8889 6.08766 16.523 6.08766 14.8373V8.97281C6.08766 7.28766 7.45406 5.92125 9.13922 5.92125H15.0033C16.6884 5.92125 18.0548 7.28719 18.0548 8.97281V14.8373Z" fill="#FF3D81"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_9_1262">
                                    <rect width="24" height="24" fill="white"/>
                                </clipPath>
                            </defs>
                        </svg>
                    </a>
                    
                    <!-- YouTube -->
                    <a href="#" class="hover:opacity-100 transition-opacity flex-shrink-0" title="YouTube">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <g clip-path="url(#clip0_682_3602)">
                                <path d="M12 23.7188C5.53828 23.7188 0.28125 18.4617 0.28125 12C0.28125 5.53828 5.53828 0.28125 12 0.28125C18.4617 0.28125 23.7188 5.53828 23.7188 12C23.7188 18.4617 18.4617 23.7188 12 23.7188Z" fill="#FF3D81"/>
                                <path d="M19.0168 10.223C19.0168 8.56078 17.6696 7.21359 16.0074 7.21359H8.20176C6.53957 7.21359 5.19238 8.56078 5.19238 10.223V13.8811C5.19238 15.5433 6.53957 16.8905 8.20176 16.8905H16.0074C17.6696 16.8905 19.0168 15.5433 19.0168 13.8811V10.223ZM14.0921 12.2362L10.9791 13.9434C10.8436 14.0166 10.7222 13.9186 10.7222 13.7648V10.2605C10.7222 10.1048 10.8479 10.0069 10.9833 10.0842L14.1179 11.8814C14.2561 11.9602 14.2327 12.1608 14.0925 12.2367L14.0921 12.2362Z" fill="white"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_682_3602">
                                    <rect width="24" height="24" fill="white"/>
                                </clipPath>
                            </defs>
                        </svg>
                    </a>
                </div>
            </div>
            
            <!-- Bottom Row: Main Navigation Links - Aligned to right to match top row -->
            <div class="flex gap-[60px] items-center justify-end w-full pr-0">
                <!-- Diplomado with dropdown -->
                <a href="#" class="flex gap-[10px] items-center hover:text-[#FF3D81] transition-colors">
                    <span class="font-montserrat font-medium text-base text-[#553cc8] uppercase whitespace-nowrap">Diplomado</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" class="flex-shrink-0">
                        <path d="M15.5917 6.84167C15.5142 6.76356 15.422 6.70156 15.3205 6.65926C15.2189 6.61695 15.11 6.59517 15 6.59517C14.89 6.59517 14.7811 6.61695 14.6795 6.65926C14.578 6.70156 14.4858 6.76356 14.4083 6.84167L10.5917 10.6583C10.5142 10.7364 10.422 10.7984 10.3205 10.8407C10.2189 10.883 10.11 10.9048 10 10.9048C9.89 10.9048 9.78108 10.883 9.67953 10.8407C9.57798 10.7984 9.48581 10.7364 9.40834 10.6583L5.59168 6.84167C5.51421 6.76356 5.42204 6.70156 5.32049 6.65926C5.21894 6.61695 5.11002 6.59517 5.00001 6.59517C4.89 6.59517 4.78108 6.61695 4.67953 6.65926C4.57798 6.70156 4.48581 6.76356 4.40834 6.84167C4.25313 6.9978 4.16602 7.20901 4.16602 7.42917C4.16602 7.64932 4.25313 7.86053 4.40834 8.01666L8.23334 11.8417C8.70209 12.3098 9.33751 12.5728 10 12.5728C10.6625 12.5728 11.2979 12.3098 11.7667 11.8417L15.5917 8.01666C15.7469 7.86053 15.834 7.64932 15.834 7.42917C15.834 7.20901 15.7469 6.9978 15.5917 6.84167Z" fill="#553CC8"/>
                    </svg>
                </a>
                
                <!-- Tienda -->
                <a href="#" class="font-montserrat font-medium text-base text-[#553cc8] uppercase whitespace-nowrap hover:text-[#FF3D81] transition-colors">
                    Tienda
                </a>
                
                <!-- Acerca de WOW! -->
                <a href="#" class="font-montserrat font-medium text-base text-[#553cc8] uppercase whitespace-nowrap hover:text-[#FF3D81] transition-colors">
                    Acerca de wow!
                </a>
                
                <!-- Contacto -->
                <a href="#" class="font-montserrat font-medium text-base text-[#553cc8] uppercase whitespace-nowrap hover:text-[#FF3D81] transition-colors">
                    Contacto
                </a>
            </div>
        </div>
        
        <!-- Profile Picture + Login Text (vertical stack) -->
        <div class="flex flex-col items-center gap-1 flex-shrink-0 ml-20">
            <!-- Profile Picture Circle -->
            <div class="w-16 h-16 rounded-full overflow-hidden bg-gradient-to-r from-[#ff3d81] to-[#0064ff] flex items-center justify-center hover:opacity-100 transition-opacity flex-shrink-0">
                <img src="<?=importAsset('profile-picture.svg')?>" alt="Perfil" class="w-full h-full object-cover">
            </div>
            
            <!-- Iniciar Sesión button -->
            <a href="#" class="font-montserrat font-bold text-[10px] text-[#0064ff] uppercase hover:text-[#FF3D81] transition-colors whitespace-nowrap">
                Iniciar sesión
            </a>
        </div>
    </div>
</header>

<!-- Padding to account for fixed header (desktop only) -->
<div class="hidden xl:block h-[120px]"></div>

<!-- NAVBAR MOBILE - Top bar with hamburger button -->
<div class="xl:hidden fixed top-0 left-0 w-screen h-16 bg-white z-50 flex items-center justify-between px-4 border-b border-gray-100">
    <!-- Logo (left) -->
    <a href="#" class="inline-block hover:text-[#FF3D81] transition-colors">
        <img src="<?=importAsset('logo.svg')?>" alt="WOW EXPERIENCE" class="h-10">
    </a>
    
    <!-- Hamburger Button (right) -->
    <button id="mobile-menu-toggle" class="p-2 hover:bg-gray-100 rounded-lg transition-colors" aria-label="Toggle menu">
        <svg class="w-6 h-6 text-[#553cc8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>
</div>

<!-- NAVBAR MOBILE - Full screen menu overlay (hidden by default) -->
<div id="mobile-menu" class="xl:hidden hidden fixed top-16 left-0 w-screen h-[calc(100vh-64px)] bg-white z-40 flex flex-col overflow-y-auto">
    <!-- Logo centrado en header -->
    <div class="flex items-center justify-center pt-6 pb-8">
        <a href="#" class="inline-block hover:text-[#FF3D81] transition-colors">
            <img src="<?=importAsset('logo.svg')?>" alt="WOW EXPERIENCE" class="h-12">
        </a>
    </div>

    <!-- Navigation links centrados -->
    <nav class="flex flex-col items-center gap-5 px-4 mt-8 flex-shrink-0">
        <!-- Diplomado with dropdown -->
        <a href="#" class="flex gap-2 items-center hover:text-[#FF3D81] transition-colors">
            <span class="font-montserrat font-medium text-base text-[#553cc8] uppercase">Diplomado</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" class="flex-shrink-0">
                <path d="M15.5917 6.84167C15.5142 6.76356 15.422 6.70156 15.3205 6.65926C15.2189 6.61695 15.11 6.59517 15 6.59517C14.89 6.59517 14.7811 6.61695 14.6795 6.65926C14.578 6.70156 14.4858 6.76356 14.4083 6.84167L10.5917 10.6583C10.5142 10.7364 10.422 10.7984 10.3205 10.8407C10.2189 10.883 10.11 10.9048 10 10.9048C9.89 10.9048 9.78108 10.883 9.67953 10.8407C9.57798 10.7984 9.48581 10.7364 9.40834 10.6583L5.59168 6.84167C5.51421 6.76356 5.42204 6.70156 5.32049 6.65926C5.21894 6.61695 5.11002 6.59517 5.00001 6.59517C4.89 6.59517 4.78108 6.61695 4.67953 6.65926C4.57798 6.70156 4.48581 6.76356 4.40834 6.84167C4.25313 6.9978 4.16602 7.20901 4.16602 7.42917C4.16602 7.64932 4.25313 7.86053 4.40834 8.01666L8.23334 11.8417C8.70209 12.3098 9.33751 12.5728 10 12.5728C10.6625 12.5728 11.2979 12.3098 11.7667 11.8417L15.5917 8.01666C15.7469 7.86053 15.834 7.64932 15.834 7.42917C15.834 7.20901 15.7469 6.9978 15.5917 6.84167Z" fill="#553CC8"/>
            </svg>
        </a>
        
        <!-- Tienda -->
        <a href="#" class="font-montserrat font-medium text-base text-[#553cc8] uppercase hover:text-[#FF3D81] transition-colors">
            Tienda
        </a>
        
        <!-- Acerca de WOW! -->
        <a href="#" class="font-montserrat font-medium text-base text-[#553cc8] uppercase hover:text-[#FF3D81] transition-colors">
            Acerca de wow!
        </a>
        
        <!-- Webinars -->
        <a href="#" class="font-montserrat font-medium text-sm text-[#553cc8] uppercase hover:text-[#FF3D81] transition-colors">
            Webinars
        </a>
        
        <!-- Blog -->
        <a href="#" class="font-montserrat font-medium text-sm text-[#553cc8] uppercase hover:text-[#FF3D81] transition-colors">
            Blog
        </a>
    </nav>

    <!-- Profile section (flex-grow to push it down) -->
    <div class="flex flex-col items-center gap-3 mt-auto mb-12 flex-shrink-0">
        <!-- Profile Picture Circle -->
        <div class="w-20 h-20 rounded-full overflow-hidden bg-gradient-to-r from-[#ff3d81] to-[#0064ff] flex items-center justify-center hover:opacity-100 transition-opacity flex-shrink-0">
            <img src="<?=importAsset('profile-picture.svg')?>" alt="Perfil" class="w-full h-full object-cover">
        </div>
        
        <!-- Iniciar Sesión button -->
        <a href="#" class="font-montserrat font-bold text-sm text-[#0064ff] uppercase hover:text-[#FF3D81] transition-colors">
            Iniciar sesión
        </a>
    </div>

    <!-- Contacto link -->
    <div class="text-center pb-6 flex-shrink-0">
        <a href="#" class="font-montserrat font-medium text-base text-[#553cc8] uppercase hover:text-[#FF3D81] transition-colors">
            Contacto
        </a>
    </div>

    <!-- Social Icons -->
    <div class="flex gap-4 items-center justify-center pb-8 flex-shrink-0">
        <!-- Facebook -->
        <a href="#" class="hover:opacity-100 transition-opacity flex-shrink-0" title="Facebook">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <g clip-path="url(#clip0_9_1259)">
                    <path d="M12 23.7188C5.53828 23.7188 0.28125 18.4617 0.28125 12C0.28125 5.53828 5.53828 0.28125 12 0.28125C18.4617 0.28125 23.7188 5.53828 23.7188 12C23.7188 18.4617 18.4617 23.7188 12 23.7188Z" fill="#FF3D81"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10.1627 12.0553V18.8475C10.1627 18.945 10.242 19.0242 10.3395 19.0242H12.8618C12.9593 19.0242 13.0385 18.945 13.0385 18.8475V11.9447H14.8671C14.959 11.9447 15.0354 11.8744 15.0434 11.7825L15.2191 9.70266C15.228 9.59953 15.1465 9.51094 15.0429 9.51094H13.0385V8.03531C13.0385 7.68937 13.3188 7.40906 13.6648 7.40906H15.0738C15.1713 7.40906 15.2505 7.32984 15.2505 7.23234V5.1525C15.2505 5.055 15.1713 4.97578 15.0738 4.97578H12.6926C11.2952 4.97578 10.1623 6.10875 10.1623 7.50609V9.51094H8.90133C8.80383 9.51094 8.72461 9.59016 8.72461 9.68765V11.7675C8.72461 11.865 8.80383 11.9442 8.90133 11.9442H10.1623V12.0548L10.1627 12.0553Z" fill="white"/>
                </g>
                <defs>
                    <clipPath id="clip0_9_1259">
                        <rect width="24" height="24" fill="white"/>
                    </clipPath>
                </defs>
            </svg>
        </a>
        
        <!-- Instagram -->
        <a href="#" class="hover:opacity-100 transition-opacity flex-shrink-0" title="Instagram">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <g clip-path="url(#clip0_9_1262)">
                    <path d="M11.9912 22.1653C17.6603 22.1653 22.2559 17.5697 22.2559 11.9006C22.2559 6.23159 17.6603 1.63594 11.9912 1.63594C6.32222 1.63594 1.72656 6.23159 1.72656 11.9006C1.72656 17.5697 6.32222 22.1653 11.9912 22.1653Z" fill="white"/>
                    <path d="M12 23.7188C5.53828 23.7188 0.28125 18.4617 0.28125 12C0.28125 5.53828 5.53828 0.28125 12 0.28125C18.4617 0.28125 23.7188 5.53828 23.7188 12C23.7188 18.4617 18.4617 23.7188 12 23.7188ZM15.9516 7.24547C15.4725 7.24547 15.0844 7.63359 15.0844 8.11266C15.0844 8.59172 15.4725 8.97984 15.9516 8.97984C16.4306 8.97984 16.8187 8.59172 16.8187 8.11266C16.8187 7.63359 16.4306 7.24547 15.9516 7.24547ZM12.0961 8.35734C10.0875 8.35734 8.45344 9.99141 8.45344 12C8.45344 14.0086 10.0875 15.6427 12.0961 15.6427C14.1047 15.6427 15.7388 14.0086 15.7388 12C15.7388 9.99141 14.1047 8.35734 12.0961 8.35734ZM12.0961 14.3334C10.8094 14.3334 9.76266 13.2867 9.76266 12C9.76266 10.7133 10.8094 9.66656 12.0961 9.66656C13.3828 9.66656 14.4295 10.7133 14.4295 12C14.4295 13.2867 13.3828 14.3334 12.0961 14.3334ZM19.4461 8.97281C19.4461 6.51891 17.4567 4.53 15.0028 4.53H9.13875C6.68484 4.53 4.69547 6.51891 4.69547 8.97281V14.8373C4.69547 17.2913 6.68484 19.2802 9.13875 19.2802H15.0028C17.4567 19.2802 19.4461 17.2913 19.4461 14.8373V8.97281ZM18.0548 14.8373C18.0548 16.5225 16.6884 17.8889 15.0033 17.8889H9.13922C7.45406 17.8889 6.08766 16.523 6.08766 14.8373V8.97281C6.08766 7.28766 7.45406 5.92125 9.13922 5.92125H15.0033C16.6884 5.92125 18.0548 7.28719 18.0548 8.97281V14.8373Z" fill="#FF3D81"/>
                </g>
                <defs>
                    <clipPath id="clip0_9_1262">
                        <rect width="24" height="24" fill="white"/>
                    </clipPath>
                </defs>
            </svg>
        </a>
        
        <!-- YouTube -->
        <a href="#" class="hover:opacity-100 transition-opacity flex-shrink-0" title="YouTube">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <g clip-path="url(#clip0_682_3602)">
                    <path d="M12 23.7188C5.53828 23.7188 0.28125 18.4617 0.28125 12C0.28125 5.53828 5.53828 0.28125 12 0.28125C18.4617 0.28125 23.7188 5.53828 23.7188 12C23.7188 18.4617 18.4617 23.7188 12 23.7188Z" fill="#FF3D81"/>
                    <path d="M19.0168 10.223C19.0168 8.56078 17.6696 7.21359 16.0074 7.21359H8.20176C6.53957 7.21359 5.19238 8.56078 5.19238 10.223V13.8811C5.19238 15.5433 6.53957 16.8905 8.20176 16.8905H16.0074C17.6696 16.8905 19.0168 15.5433 19.0168 13.8811V10.223ZM14.0921 12.2362L10.9791 13.9434C10.8436 14.0166 10.7222 13.9186 10.7222 13.7648V10.2605C10.7222 10.1048 10.8479 10.0069 10.9833 10.0842L14.1179 11.8814C14.2561 11.9602 14.2327 12.1608 14.0925 12.2367L14.0921 12.2362Z" fill="white"/>
                </g>
                <defs>
                    <clipPath id="clip0_682_3602">
                        <rect width="24" height="24" fill="white"/>
                    </clipPath>
                </defs>
            </svg>
        </a>
    </div>
</div>

<!-- Padding to account for fixed header (mobile) -->
<div class="xl:hidden h-16"></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggle = document.getElementById('mobile-menu-toggle');
    const menu = document.getElementById('mobile-menu');
    
    if (toggle && menu) {
        toggle.addEventListener('click', function() {
            menu.classList.toggle('hidden');
        });
        
        // Cerrar menú al hacer clic en un link
        const links = menu.querySelectorAll('a');
        links.forEach(link => {
            link.addEventListener('click', function() {
                menu.classList.add('hidden');
            });
        });
    }
});
</script>

