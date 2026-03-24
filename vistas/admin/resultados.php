<!DOCTYPE html>
<html lang="es" class="<?= configuracion('modo_dashboard') === 'oscuro' ? 'dark' : '' ?>">
<head>
  <?= $this->plantilla_admin('metas-basicas'); ?>
  <title>Panel de Administración</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-white dark:bg-gray-800 lg:h-screen w-screen font-inter relative lg:pl-[180px] pt-[100px]">
    
    <?= $this->componente_admin('header');?>
    <?= $this->componente_admin('barra-lateral');?>
    
  
    <main class="flex w-full h-full max-w-full max-h-full overflow-clip p-4 lg:p-12">
      
        <!-- Sección de contenido -->
        <section class="w-full flex flex-col overflow-hidden">

            <div class="w-full h-full relative">
                <div class="w-full flex flex-row justify-between items-center">
                    <div class="flex flex-row gap-x-8 items-center">
                        <svg class="dark:[&_path]:fill-white" fill="#50388E" height="50px" width="50px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 325.498 325.498" xml:space="preserve" stroke="#50388E"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g id="Layer_5_45_"> <g> <g> <path d="M104.998,289.047c0,8.25-6.75,15-15,15h-62c-8.25,0-15-6.75-15-15v-68c0-8.25,6.75-15,15-15h62c8.25,0,15,6.75,15,15 V289.047z"></path> </g> <g> <path d="M215.248,289.047c0,8.25-6.75,15-15,15h-62c-8.25,0-15-6.75-15-15v-104c0-8.25,6.75-15,15-15h62c8.25,0,15,6.75,15,15 V289.047z"></path> </g> <g> <path d="M325.498,289.047c0,8.25-6.75,15-15,15h-62c-8.25,0-15-6.75-15-15v-144c0-8.25,6.75-15,15-15h62c8.25,0,15,6.75,15,15 V289.047z"></path> </g> <path d="M312.522,21.731l-67.375,16.392c-5.346,1.294-6.537,5.535-2.648,9.424l14.377,14.041 c1.207,1.376-0.225,3.206-1.361,3.981c-9.053,6.18-23.42,15.248-43.279,25.609c-108.115,56.407-197.238,52.947-198.578,52.886 c-7.154-0.363-13.271,5.148-13.641,12.314c-0.369,7.17,5.143,13.283,12.313,13.652c0.527,0.027,2.67,0.124,6.273,0.124 c23.107,0,106.111-3.987,205.66-55.924c23.555-12.289,39.881-22.888,49.414-29.598c1.348-0.949,3.697-2.585,5.865-0.378 l15.725,15.724c3.889,3.889,8.109,2.692,9.381-2.659l15.285-68.211C321.203,23.756,317.867,20.437,312.522,21.731z"></path> </g> </g> </g> </g></svg>
                        <h1 class="mt-2 text-lg lg:text-2xl font-bold text-teven-primario dark:text-white">
                            Resultados <span class="whitespace-nowrap">por landing</span>
                        </h1>
                    </div>
                    
                    <button 
                        id="downloadButton" 
                        class="w-fit rounded-lg bg-teven-secundario-2 py-3 px-2 lg:px-8 text-white font-bold text-xs lg:text-base
                            hover:bg-teven-complementario duration-200 whitespace-nowrap">
                            Descargar Gráfica
                    </button>
                </div>


                <div class="mt-8 lg:mt-16 w-full overflow-x-auto">
                     <div id="chartContainer" class="w-full min-h-[400px] lg:min-h-[400px] h-[400px]">
                         <canvas id="landingChart" class="w-full h-full rounded-xl max-w-full lg:max-w-[1000px] p-2 lg:p-8 border-2 border-teven-secundario-1"></canvas>
                     </div>
                </div>
                
            </div>

        </section>

    </main>
    <script>
        // Detectar modo oscuro desde el HTML
        const isDarkMode = document.documentElement.classList.contains('dark');
        
        // Colores dinámicos según modo
        const textColor = isDarkMode ? 'rgba(255, 255, 255, 0.7)' : 'rgba(80, 56, 142, 1)';
        const gridColor = isDarkMode ? 'rgba(255, 255, 255, 0.1)' : 'rgba(80, 56, 142, 0.2)';
        const canvasBackground = isDarkMode ? '#1f2937' : 'white'; // gray-800 : white
        
        // Convertir los datos de $landing en etiquetas y valores
        const labels = <?php echo json_encode(array_column($landings, 'landing')); ?>; // Extrae nombres de las landings
        const data = <?php echo json_encode(array_column($landings, 'total_leads')); ?>; // Extrae los totales de leads

        // Calcular el total de formularios completados
        const totalFormularios = data.reduce((total, num) => total + num, 0); // Suma todos los valores del array

        // Obtener el canvas y su contexto
        const canvas = document.getElementById('landingChart');
        const ctx = canvas.getContext('2d');

        // Aplicar fondo dinámico al canvas
        ctx.save(); // Guarda el estado actual del contexto
        ctx.fillStyle = canvasBackground; // Define el color de fondo
        ctx.fillRect(0, 0, canvas.width, canvas.height); // Llena todo el canvas
        ctx.restore(); // Restaura el estado del contexto para que Chart.js lo maneje

        // Detectar si es móvil (ancho menor a 1024px)
        const isMobile = window.innerWidth < 1024;

        // Calcular altura dinámica en móvil según número de landings
        const chartContainer = document.getElementById('chartContainer');
        if (isMobile && labels.length > 0) {
            const chartHeight = Math.max(400, labels.length * 50); // 50px por landing, mínimo 400px
            chartContainer.style.height = `${chartHeight}px`;
        }

        // Colores dinámicos para las barras según modo
        const barBackgroundColors = isDarkMode ? [
            'rgba(147, 129, 201, 0.6)',    // teven-primario más claro
            'rgba(157, 153, 211, 0.6)',    // teven-secundario-1 más claro
            'rgba(177, 149, 215, 0.6)',    // teven-secundario-2 más claro
            'rgba(137, 118, 191, 0.6)',    // teven-secundario-3 más claro
            'rgba(129, 139, 244, 0.6)'     // teven-complementario más claro
        ] : [
            'rgba(80, 56, 142, 0.2)',      // teven-primario
            'rgba(77, 72, 151, 0.2)',      // teven-secundario-1
            'rgba(117, 79, 155, 0.2)',     // teven-secundario-2
            'rgba(67, 38, 131, 0.2)',      // teven-secundario-3
            'rgba(69, 79, 224, 0.2)'       // teven-complementario
        ];
        
        const barBorderColors = isDarkMode ? [
            'rgba(177, 159, 231, 1)',      // teven-primario más claro
            'rgba(187, 183, 241, 1)',      // teven-secundario-1 más claro
            'rgba(207, 179, 245, 1)',      // teven-secundario-2 más claro
            'rgba(167, 148, 221, 1)',      // teven-secundario-3 más claro
            'rgba(159, 169, 255, 1)'       // teven-complementario más claro
        ] : [
            'rgba(80, 56, 142, 1)',        // teven-primario
            'rgba(77, 72, 151, 1)',        // teven-secundario-1
            'rgba(117, 79, 155, 1)',       // teven-secundario-2
            'rgba(67, 38, 131, 1)',        // teven-secundario-3
            'rgba(69, 79, 224, 1)'         // teven-complementario
        ];
        
        // Configurar la gráfica
        const chart = new Chart(ctx, {
            type: isMobile ? 'bar' : 'bar', // Tipo de gráfica
            data: {
                labels: labels, // Nombres de las landings (ejemplo: "Landing 1")
                datasets: [{
                    label: `Total de formularios completados: ${totalFormularios}`, // Etiqueta con el total
                    data: data, // Cantidad de leads
                    backgroundColor: barBackgroundColors,
                    borderColor: barBorderColors,
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: isMobile ? 'y' : 'x', // En móvil, barras horizontales (landings en Y)
                responsive: true, // Ajusta automáticamente al tamaño del contenedor
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: isMobile ? undefined : 1,
                            color: textColor,
                            font: {
                                size: isMobile ? 10 : 12
                            }
                        },
                        grid: {
                            color: gridColor
                        }
                    },
                    x: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: isMobile ? 1 : undefined,
                            color: textColor,
                            font: {
                                size: isMobile ? 10 : 12
                            }
                        },
                        grid: {
                            color: gridColor
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: textColor,
                            font: {
                                size: isMobile ? 10 : 12
                            }
                        }
                    }
                }
            }
        });

        // Función para descargar la gráfica
        document.getElementById('downloadButton').addEventListener('click', function() {
            const link = document.createElement('a');
            link.download = 'Resultados.png';
            link.href = canvas.toDataURL('image/png'); // Convierte el canvas a imagen PNG
            link.click(); // Ejecuta la descarga
        });

        // Recargar la gráfica si cambia el tamaño de la ventana
        let resizeTimeout;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(function() {
                location.reload();
            }, 500);
        });
    </script>
  
</body>
</html>