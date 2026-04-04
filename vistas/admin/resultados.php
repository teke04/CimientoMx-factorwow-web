<!DOCTYPE html>
<html lang="es" class="<?= configuracion('modo_dashboard') === 'oscuro' ? 'dark' : '' ?>">
<head>
  <?= $this->plantilla_admin('metas-basicas'); ?>
  <title>Panel de Administración</title>
</head>

<body class="bg-white dark:bg-gray-800 lg:h-screen w-screen font-inter relative lg:pl-[180px] pt-[100px]">
    
    <?= $this->componente_admin('header');?>
    <?= $this->componente_admin('barra-lateral');?>
    
  
    <main class="flex w-full h-full max-w-full max-h-full overflow-clip p-4 lg:p-12">
      
        <!-- Sección de contenido -->
        <section class="w-full flex flex-col overflow-y-auto pr-2">

            <div class="w-full">
                <div class="flex flex-row gap-x-8 items-center mb-8 lg:mb-12">
                    <svg class="dark:[&_path]:fill-white size-[50px]" fill="#50388E" viewBox="0 0 325.498 325.498" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" stroke="#50388E"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><g><g id="Layer_5_45_"><g><g><path d="M104.998,289.047c0,8.25-6.75,15-15,15h-62c-8.25,0-15-6.75-15-15v-68c0-8.25,6.75-15,15-15h62c8.25,0,15,6.75,15,15V289.047z"/></g><g><path d="M215.248,289.047c0,8.25-6.75,15-15,15h-62c-8.25,0-15-6.75-15-15v-104c0-8.25,6.75-15,15-15h62c8.25,0,15,6.75,15,15V289.047z"/></g><g><path d="M325.498,289.047c0,8.25-6.75,15-15,15h-62c-8.25,0-15-6.75-15-15v-144c0-8.25,6.75-15,15-15h62c8.25,0,15,6.75,15,15V289.047z"/></g><path d="M312.522,21.731l-67.375,16.392c-5.346,1.294-6.537,5.535-2.648,9.424l14.377,14.041c1.207,1.376-0.225,3.206-1.361,3.981c-9.053,6.18-23.42,15.248-43.279,25.609c-108.115,56.407-197.238,52.947-198.578,52.886c-7.154-0.363-13.271,5.148-13.641,12.314c-0.369,7.17,5.143,13.283,12.313,13.652c0.527,0.027,2.67,0.124,6.273,0.124c23.107,0,106.111-3.987,205.66-55.924c23.555-12.289,39.881-22.888,49.414-29.598c1.348-0.949,3.697-2.585,5.865-0.378l15.725,15.724c3.889,3.889,8.109,2.692,9.381-2.659l15.285-68.211C321.203,23.756,317.867,20.437,312.522,21.731z"/></g></g></g></g></svg>
                    <h1 class="text-lg lg:text-2xl font-bold text-teven-primario dark:text-white">
                        Resultados
                    </h1>
                </div>

                <?php
                $tarjetas = [
                    [
                        'label' => 'Leads recibidos',
                        'valor' => $stats['total_leads'] ?? 0,
                        'ruta'  => 'admin/leads',
                        'icono' => '<svg class="size-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                    ],
                    [
                        'label' => 'Videos',
                        'valor' => $stats['total_videos'] ?? 0,
                        'ruta'  => 'admin/videos',
                        'icono' => '<svg class="size-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="2" y="5" width="20" height="14" rx="2" stroke="currentColor" stroke-width="2"/><path d="M10 9.5L15 12L10 14.5V9.5Z" fill="currentColor"/></svg>',
                    ],
                    [
                        'label' => 'Productos activos',
                        'valor' => $stats['total_productos'] ?? 0,
                        'ruta'  => 'admin/productos',
                        'icono' => '<svg class="size-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><line x1="3" y1="6" x2="21" y2="6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M16 10a4 4 0 01-8 0" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                    ],
                    [
                        'label' => 'Pedidos recibidos',
                        'valor' => $stats['total_pedidos'] ?? 0,
                        'ruta'  => 'admin/pedidos',
                        'icono' => '<svg class="size-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 5h12M9 21a1 1 0 100-2 1 1 0 000 2zm10 0a1 1 0 100-2 1 1 0 000 2z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                    ],
                    [
                        'label' => 'Art&iacute;culos de blog',
                        'valor' => $stats['total_articulos'] ?? 0,
                        'ruta'  => 'admin/blog',
                        'icono' => '<svg class="size-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 6H20M4 10H20M4 14H14M4 18H10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                    ],
                    [
                        'label' => 'Webinars activos',
                        'valor' => $stats['total_webinars'] ?? 0,
                        'ruta'  => 'admin/webinars',
                        'icono' => '<svg class="size-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="2" y="5" width="20" height="14" rx="3" stroke="currentColor" stroke-width="2"/><path d="M9.5 9.5l5 2.5-5 2.5V9.5z" stroke="currentColor" stroke-width="1.5" fill="currentColor"/></svg>',
                    ],
                    [
                        'label' => 'Diplomados activos',
                        'valor' => $stats['total_diplomados'] ?? 0,
                        'ruta'  => 'admin/diplomados',
                        'icono' => '<svg class="size-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 3L2 8l10 5 10-5-10-5z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="M2 8v8M22 8v8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><path d="M6 10.5v5a6 6 0 0012 0v-5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>',
                    ],
                ];
                ?>

                <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 lg:gap-6">
                    <?php foreach ($tarjetas as $tarjeta): ?>
                    <a href="<?= ruta($tarjeta['ruta']) ?>" class="flex flex-col gap-3 bg-white dark:bg-gray-700 border border-teven-primario/10 dark:border-white/10 rounded-2xl shadow-sm p-5 lg:p-7 hover:shadow-md hover:border-teven-primario/30 dark:hover:border-white/30 hover:-translate-y-0.5 transition-all duration-200">
                        <div class="text-teven-primario dark:text-teven-secundario-1">
                            <?= $tarjeta['icono'] ?>
                        </div>
                        <p class="text-3xl lg:text-4xl font-extrabold text-teven-primario dark:text-white">
                            <?= number_format((int)$tarjeta['valor']) ?>
                        </p>
                        <p class="text-sm font-medium text-teven-secundario-3/70 dark:text-white/50 leading-tight">
                            <?= $tarjeta['label'] ?>
                        </p>
                    </a>
                    <?php endforeach; ?>
                </div>

            </div>

        </section>

    </main>

  
</body>
</html>