function scrollHacia(elementId) {
    const targetElement = document.getElementById(elementId);
    
    if (targetElement) {
        targetElement.scrollIntoView({ behavior: "smooth" });
    } else {
        console.warn(`Elemento con id "${elementId}" no encontrado.`);
    }
}

document.addEventListener("DOMContentLoaded", function() {

    //FUNCION PARA ACTIVAR LAS ANIMACIONES SCROLL-DRIVEN
    const baseClasses = ['float-up','rotate-in-from-left', 'rotate-in-from-right','slide-in-from-left','slide-in-from-right'];
    
    function initializeAnimations(baseClasses) {
        baseClasses.forEach((baseClass) => {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add(`${baseClass}-active`);
                        observer.unobserve(entry.target);
                    }
                });
            });
            const elements = document.querySelectorAll(`.${baseClass}`);
            elements.forEach(element => observer.observe(element));
        });
    }
    // Inicializar todas las animaciones
    initializeAnimations(baseClasses);

    
    console.log("Animaciones cargadas");
});
