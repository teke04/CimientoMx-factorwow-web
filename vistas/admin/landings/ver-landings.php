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
                        <svg class="size-[50px]" viewBox="0 0 24 24" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" fill="#50388E" stroke="#50388E">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <defs>
                                    <style>.cls-1{fill:none;stroke:#50388E;stroke-miterlimit:10;stroke-width:1.91px;}</style>
                                </defs>
                                <line class="cls-1 dark:stroke-white" x1="15.82" y1="10.09" x2="15.82" y2="16.77"></line>
                                <line class="cls-1 dark:stroke-white" x1="12" y1="12" x2="12" y2="16.77"></line>
                                <line class="cls-1 dark:stroke-white" x1="8.18" y1="13.91" x2="8.18" y2="16.77"></line>
                                <polyline class="cls-1 dark:stroke-white" points="15.82 2.46 15.82 2.46 20.59 2.46 20.59 22.5 3.41 22.5 3.41 2.46 8.18 2.46 8.18 2.46"></polyline>
                                <path class="cls-1 dark:stroke-white" d="M15.82,1.5V3.41a1.92,1.92,0,0,1-1.91,1.91H10.09A1.92,1.92,0,0,1,8.18,3.41V1.5Z"></path>
                            </g>
                        </svg>
                        <h1 class="text-lg lg:text-2xl font-bold text-teven-primario dark:text-white">
                            Lista de landings
                        </h1>
                    </div>
                    
                    <a href="<?=ruta('admin/landings-crear')?>" 
                        class="w-fit rounded-lg bg-teven-secundario-2 py-3 px-2 lg:px-8 text-white font-bold text-xs lg:text-base
                            hover:bg-teven-complementario duration-200 whitespace-nowrap">
                        Configurar nueva landing
                    </a>
                </div>


                <div class="mt-8 lg:mt-16 w-full overflow-x-auto">
                    <table class="w-full border-separate border-spacing-0 rounded-xl overflow-hidden shadow-lg">
                        <thead>
                            <tr class="bg-teven-secundario-2 text-white font-semibold">
                                <th class="px-4 py-3 text-left border-b-2 border-teven-secundario-3">Landing</th>
                                <th class="px-4 py-3 text-left border-b-2 border-teven-secundario-3 hidden lg:table-cell">H1</th>
                                <th class="px-4 py-3 text-left border-b-2 border-teven-secundario-3 hidden lg:table-cell">H2</th>
                                <th class="px-4 py-3 text-left border-b-2 border-teven-secundario-3 hidden xl:table-cell">Meta Título</th>
                                <th class="px-4 py-3 text-left border-b-2 border-teven-secundario-3 hidden xl:table-cell">Meta Descripción</th>
                                <th class="px-4 py-3 text-left border-b-2 border-teven-secundario-3 hidden md:table-cell">Creada</th>
                                <th class="px-4 py-3 text-left border-b-2 border-teven-secundario-3">Leads</th>
                                <th class="px-4 py-3 text-left border-b-2 border-teven-secundario-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($landings as $landing): ?>
                            <tr class="text-teven-secundario-3 dark:text-white/70 odd:bg-teven-primario/5 dark:odd:bg-white/5 even:bg-teven-secundario-1/10 dark:even:bg-white/10 hover:bg-teven-complementario/10 transition-colors">
                                <td class="px-4 py-3">
                                    <a target="_BLANK" href="<?= url($landing['keyword'])?>"
                                        class="hover:underline font-medium"><?=$landing['keyword'];?></a>
                                </td>
                                <td class="px-4 py-3 hidden lg:table-cell"><?= $landing['h1']; ?></td>
                                <td class="px-4 py-3 hidden lg:table-cell"><?= $landing['h2']; ?></td>
                                <td class="px-4 py-3 hidden xl:table-cell truncate max-w-xs"><?= $landing['meta_titulo']; ?></td>
                                <td class="px-4 py-3 hidden xl:table-cell truncate max-w-xs"><?= $landing['meta_descripcion']; ?></td>
                                <td class="px-4 py-3 hidden md:table-cell"><?= $landing['creada']; ?></td>
                                <td class="px-4 py-3 font-semibold"><?= $landing['leads']; ?></td>
                                <td class="px-4 py-3">
                                    <div class="flex flex-col lg:flex-row gap-2">
                                        <!-- Botón de Editar -->
                                        <form method="post" action="<?=ruta('admin/landings-editar')?>">
                                            <input type="hidden" name="keyword_id" value="<?php echo htmlspecialchars($landing['id']); ?>">
                                            <button type="submit" class="font-bold text-teven-secundario-2 dark:text-white/70 px-3 py-1.5 rounded-lg border-2 border-teven-secundario-2
                                            hover:bg-teven-secundario-2 hover:text-white transition duration-300 text-xs lg:text-sm whitespace-nowrap">
                                                Editar
                                            </button>
                                        </form>
                                        <!-- Botón de Borrar -->
                                        <form method="post" action="<?=ruta('admin/landings-borrar')?>" onsubmit="return confirm('¿Estás seguro de que deseas borrar esta landing?');">
                                            <input type="hidden" name="keyword_id" value="<?php echo htmlspecialchars($landing['id']); ?>">
                                            <button type="submit" class="font-bold text-red-500 px-3 py-1.5 rounded-lg border-2 border-red-500
                                            hover:bg-red-500 hover:text-white transition duration-300 text-xs lg:text-sm whitespace-nowrap <?=$landing['id'] == 1 ? 'hidden' : ''?>">
                                                Borrar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
            </div>

        </section>

    </main>
  
</body>
</html>





