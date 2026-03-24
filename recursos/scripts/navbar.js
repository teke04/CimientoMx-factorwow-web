document.addEventListener("DOMContentLoaded", function() {
    // CACHE DE ELEMENTOS DOM
    const navbar = document.querySelector(".navbarDiscreto");
    const referenceElement = document.getElementById("referencia-navbardiscreto");
    const mobileMenu = document.getElementById('menu');
    
    // Validar elementos críticos
    if (!navbar) {
        console.warn("Navbar no encontrado");
        return;
    }

    // CONFIGURACIÓN NAVBAR
    let prevScrollPos = window.scrollY;
    const scrollThreshold = 50;
    const bgClass = navbar.dataset.bgClass || "bg-slate-500";
    const shadowClass = navbar.dataset.shadowClass || "shadow-xl";
    
    // CONFIGURACIÓN MENÚ MÓVIL
    let isMenuOpen = false;
    
    // Inicializar menú móvil oculto
    if (mobileMenu) {
        mobileMenu.classList.add('translate-x-full');
        mobileMenu.classList.remove('translate-x-0');
    }

    // FUNCIONES UTILITARIAS PARA MENÚ MÓVIL
    const mobileMenuActions = {
        show() {
            if (!mobileMenu) return false;
            mobileMenu.classList.remove('translate-x-full');
            mobileMenu.classList.add('translate-x-0');
            isMenuOpen = true;
            return true;
        },
        
        hide() {
            if (!mobileMenu) return false;
            mobileMenu.classList.add('translate-x-full');
            mobileMenu.classList.remove('translate-x-0');
            isMenuOpen = false;
            return true;
        },
        
        toggle() {
            return isMenuOpen ? this.hide() : this.show();
        }
    };

    // FUNCIONES GLOBALES (API PÚBLICA)
    window.toggleMobileMenu = () => mobileMenuActions.toggle();
    window.closeMobileMenu = () => isMenuOpen ? mobileMenuActions.hide() : false;
    window.openMobileMenu = () => !isMenuOpen ? mobileMenuActions.show() : false;
    window.isMobileMenuOpen = () => isMenuOpen;

    // OPTIMIZACIÓN: THROTTLE PARA SCROLL
    let ticking = false;
    
    function updateNavbar() {
        const currentScrollPos = window.scrollY;
        
        // Solo ejecutar si hay elementos necesarios
        if (referenceElement) {
            const referencePosition = referenceElement.getBoundingClientRect().top;
            
            // Cambiar color del navbar después del elemento de referencia
            if (referencePosition <= 0) {
                navbar.classList.add(bgClass, shadowClass);
            } else {
                navbar.classList.remove(bgClass, shadowClass);
            }
        }

        // Mostrar/ocultar navbar basado en scroll
        if (currentScrollPos > prevScrollPos && currentScrollPos > scrollThreshold) {
            navbar.style.transform = "translateY(-100%)";
        } else {
            navbar.style.transform = "translateY(0)";
        }

        prevScrollPos = currentScrollPos;
        ticking = false;
    }

    // EVENT LISTENER OPTIMIZADO PARA SCROLL
    window.addEventListener("scroll", () => {
        if (!ticking) {
            requestAnimationFrame(updateNavbar);
            ticking = true;
        }
    }, { passive: true });

    // EVENT LISTENERS PARA MENÚ MÓVIL
    if (mobileMenu) {
        // Optimizar event delegation para links
        mobileMenu.addEventListener('click', (e) => {
            if (e.target.tagName === 'A') {
                e.stopPropagation();
                mobileMenuActions.hide();
            }
        });

        // Event listener optimizado para Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && isMenuOpen) {
                mobileMenuActions.hide();
            }
        }, { passive: true });
    }

    console.log("Funciones del navbar cargadas");
});