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
        <section class="w-full flex flex-col overflow-y-auto pr-4 overflow-x-hidden">

            <div class="w-full h-full relative">
                
                <div class="w-full flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
                    <div class="flex flex-row gap-x-8 items-center">
                        <!-- Ícono de video -->
                        <svg class="size-[50px]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect class="dark:stroke-white" x="2" y="5" width="20" height="14" rx="2" stroke="#50388E" stroke-width="1.91" fill="none"/>
                            <path class="dark:fill-white" d="M10 9.5L15 12L10 14.5V9.5Z" fill="#50388E"/>
                        </svg>
                        <h1 class="text-lg lg:text-2xl font-bold text-teven-primario dark:text-white">
                            Videos de testimonios
                        </h1>
                    </div>
                    
                    <a href="<?=ruta('admin/videos-crear')?>" 
                        class="w-fit rounded-lg bg-teven-secundario-2 py-3 px-2 lg:px-8 text-white font-bold text-xs lg:text-base
                            hover:bg-teven-complementario duration-200 whitespace-nowrap">
                        Agregar nuevo video
                    </a>
                </div>

                <?php if (count($videos) >= 3): ?>
                    <div class="mt-6 bg-yellow-50 border-l-4 border-yellow-400 text-yellow-800 p-4 rounded text-sm font-medium">
                        Ya hay 3 videos registrados. Para agregar uno nuevo, elimina uno existente primero.
                    </div>
                <?php endif; ?>

                <div class="mt-8 lg:mt-16 w-full overflow-x-auto">
                    <?php if (empty($videos)): ?>
                        <p class="text-teven-secundario-3 dark:text-white/60 text-center py-12">No hay videos registrados aún.</p>
                    <?php else: ?>
                    <table class="w-full border-separate border-spacing-0 rounded-xl overflow-hidden shadow-lg">
                        <thead>
                            <tr class="bg-teven-secundario-2 text-white font-semibold">
                                <th class="px-4 py-3 text-left border-b-2 border-teven-secundario-3">Título</th>
                                <th class="px-4 py-3 text-left border-b-2 border-teven-secundario-3 hidden md:table-cell">ID de YouTube</th>
                                <th class="px-4 py-3 text-left border-b-2 border-teven-secundario-3 hidden lg:table-cell">Vista previa</th>
                                <th class="px-4 py-3 text-left border-b-2 border-teven-secundario-3 hidden md:table-cell">Creado</th>
                                <th class="px-4 py-3 text-left border-b-2 border-teven-secundario-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($videos as $video): ?>
                            <tr class="text-teven-secundario-3 dark:text-white/70 odd:bg-teven-primario/5 dark:odd:bg-white/5 even:bg-teven-secundario-1/10 dark:even:bg-white/10 hover:bg-teven-complementario/10 transition-colors">
                                <td class="px-4 py-3 font-medium"><?= htmlspecialchars($video['titulo']); ?></td>
                                <td class="px-4 py-3 hidden md:table-cell font-mono text-sm">
                                    <a href="https://www.youtube.com/watch?v=<?= htmlspecialchars($video['youtube_id']) ?>"
                                       target="_blank" rel="noopener noreferrer"
                                       class="hover:underline text-teven-secundario-2 dark:text-teven-complementario">
                                        <?= htmlspecialchars($video['youtube_id']); ?>
                                    </a>
                                </td>
                                <td class="px-4 py-3 hidden lg:table-cell">
                                    <a href="https://www.youtube.com/watch?v=<?= htmlspecialchars($video['youtube_id']) ?>"
                                       target="_blank" rel="noopener noreferrer">
                                        <img src="https://img.youtube.com/vi/<?= htmlspecialchars($video['youtube_id']) ?>/mqdefault.jpg"
                                             alt="<?= htmlspecialchars($video['titulo']) ?>"
                                             class="h-16 w-28 object-cover rounded-lg">
                                    </a>
                                </td>
                                <td class="px-4 py-3 hidden md:table-cell"><?= htmlspecialchars($video['creado']); ?></td>
                                <td class="px-4 py-3">
                                    <!-- Botón de Borrar -->
                                    <form method="post" action="<?=ruta('admin/videos-borrar')?>" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este video?');">
                                        <input type="hidden" name="video_id" value="<?= htmlspecialchars($video['id']); ?>">
                                        <button type="submit" class="font-bold text-red-500 px-3 py-1.5 rounded-lg border-2 border-red-500
                                            hover:bg-red-500 hover:text-white transition duration-300 text-xs lg:text-sm whitespace-nowrap">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php endif; ?>
                </div>
                
            </div>

        </section>

    </main>
  
</body>
</html>
