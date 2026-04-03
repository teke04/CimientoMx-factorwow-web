<!DOCTYPE html>
<html lang="es" class="<?= configuracion('modo_dashboard') === 'oscuro' ? 'dark' : '' ?>">
<head>
  <?= $this->plantilla_admin('metas-basicas'); ?>
  <title>Agregar Video de Testimonio</title>
</head>
<body class="bg-white dark:bg-gray-800 lg:h-screen w-screen font-inter relative lg:pl-[180px] pt-[100px]">

    <?= $this->componente_admin('header');?>
    <?= $this->componente_admin('barra-lateral');?>
  
    <main class="flex w-full h-full max-w-full max-h-full overflow-clip p-4 lg:p-12">
      
        <!-- Sección de contenido -->
        <section class="w-full flex flex-col overflow-auto items-center justify-center">
            <div class="bg-white dark:bg-gray-800 w-full max-w-[800px] p-6 lg:p-8 rounded-xl shadow-lg border-2 border-teven-secundario-1">
                <div class="flex flex-row gap-x-4 items-center mb-6">
                    <svg class="size-[40px]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path class="dark:stroke-white" d="M12 6V18M12 6L7 11M12 6L17 11" stroke="#50388E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path class="dark:stroke-white" d="M3 18H21" stroke="#50388E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <h1 class="text-xl lg:text-3xl font-bold text-teven-primario dark:text-white">Agregar video de testimonio</h1>
                </div>

                <!-- Mensaje dinámico debajo del título -->
                <?php if (!empty($mensaje)): ?>
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                        <p class="font-medium"><?= htmlspecialchars($mensaje); ?></p>
                    </div>
                <?php endif; ?>

                <form method="post" action="<?=ruta('admin/videos-crear')?>">
                    <div class="flex flex-col gap-6">
                        <!-- Campo Título -->
                        <div>
                            <label for="titulo" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">
                                Título del video
                            </label>
                            <input 
                                type="text" 
                                id="titulo" 
                                name="titulo" 
                                required 
                                placeholder="Ej: Testimonio de la Dra. López"
                                class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100">
                        </div>

                        <!-- Campo URL de YouTube -->
                        <div>
                            <label for="youtube_url" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">
                                URL del video de YouTube
                            </label>
                            <input 
                                type="text" 
                                id="youtube_url" 
                                name="youtube_url" 
                                required 
                                placeholder="Ej: https://www.youtube.com/watch?v=dQw4w9WgXcQ"
                                class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100">
                            <p class="text-xs text-gray-500 dark:text-white/40 mt-1">
                                Acepta URLs de youtube.com/watch, youtu.be o youtube.com/embed
                            </p>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="flex flex-col-reverse lg:flex-row justify-between gap-3 mt-6">
                        <a href="<?=ruta('admin/videos')?>" class="text-center bg-gray-400 text-white py-3 px-6 rounded-lg hover:bg-gray-500 transition font-bold">
                            Cancelar
                        </a>
                        <button type="submit" class="bg-teven-secundario-2 text-white py-3 px-6 rounded-lg hover:bg-teven-complementario transition font-bold">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </main>
  
</body>
</html>
