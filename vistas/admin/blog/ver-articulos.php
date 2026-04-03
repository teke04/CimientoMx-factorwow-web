<!DOCTYPE html>
<html lang="es" class="<?= configuracion('modo_dashboard') === 'oscuro' ? 'dark' : '' ?>">
<head>
  <?= $this->plantilla_admin('metas-basicas'); ?>
  <title>Artículos del Blog</title>
</head>
<body class="bg-white dark:bg-gray-800 lg:h-screen w-screen font-inter relative lg:pl-[180px] pt-[100px]">

    <?= $this->componente_admin('header');?>
    <?= $this->componente_admin('barra-lateral');?>
  
    <main class="flex w-full h-full max-w-full max-h-full overflow-clip p-4 lg:p-12">

        <section class="w-full flex flex-col overflow-y-auto pr-4 overflow-x-hidden">
            <div class="w-full h-full relative">

                <div class="w-full flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
                    <div class="flex flex-row gap-x-8 items-center">
                        <svg class="size-[50px]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path class="dark:stroke-white" d="M4 6H20M4 10H20M4 14H14M4 18H10" stroke="#50388E" stroke-width="1.91" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <h1 class="text-lg lg:text-2xl font-bold text-teven-primario dark:text-white">
                            Artículos del Blog
                        </h1>
                    </div>
                    <a href="<?=ruta('admin/blog-crear')?>"
                       class="w-fit rounded-lg bg-teven-secundario-2 py-3 px-2 lg:px-8 text-white font-bold text-xs lg:text-base
                              hover:bg-teven-complementario duration-200 whitespace-nowrap">
                        Agregar nuevo artículo
                    </a>
                </div>

                <div class="mt-8 lg:mt-16 w-full overflow-x-auto">
                    <?php if (empty($articulos)): ?>
                        <p class="text-teven-secundario-3 dark:text-white/60 text-center py-12">No hay artículos registrados aún.</p>
                    <?php else: ?>
                    <table class="w-full border-separate border-spacing-0 rounded-xl overflow-hidden shadow-lg">
                        <thead>
                            <tr class="bg-teven-secundario-2 text-white font-semibold">
                                <th class="px-4 py-3 text-left border-b-2 border-teven-secundario-3">Imagen</th>
                                <th class="px-4 py-3 text-left border-b-2 border-teven-secundario-3">Título</th>
                                <th class="px-4 py-3 text-left border-b-2 border-teven-secundario-3 hidden md:table-cell">Slug</th>
                                <th class="px-4 py-3 text-left border-b-2 border-teven-secundario-3 hidden lg:table-cell">Extracto</th>
                                <th class="px-4 py-3 text-left border-b-2 border-teven-secundario-3 hidden md:table-cell">Activo</th>
                                <th class="px-4 py-3 text-left border-b-2 border-teven-secundario-3 hidden lg:table-cell">Fecha</th>
                                <th class="px-4 py-3 text-left border-b-2 border-teven-secundario-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($articulos as $articulo): ?>
                            <tr class="text-teven-secundario-3 dark:text-white/70 odd:bg-teven-primario/5 dark:odd:bg-white/5 even:bg-teven-secundario-1/10 dark:even:bg-white/10 hover:bg-teven-complementario/10 transition-colors">
                                <td class="px-4 py-3">
                                    <?php if ($articulo['imagen_url']): ?>
                                        <img src="<?= url($articulo['imagen_url']) ?>"
                                             alt="<?= htmlspecialchars($articulo['titulo']) ?>"
                                             class="h-14 w-14 object-cover rounded-lg">
                                    <?php else: ?>
                                        <div class="h-14 w-14 bg-gray-200 dark:bg-white/10 rounded-lg flex items-center justify-center text-gray-400 text-xs">Sin img</div>
                                    <?php endif; ?>
                                </td>
                                <td class="px-4 py-3 font-medium"><?= htmlspecialchars($articulo['titulo']) ?></td>
                                <td class="px-4 py-3 hidden md:table-cell text-xs text-gray-500 dark:text-white/50">
                                    <a href="<?= ruta('blog/' . htmlspecialchars($articulo['slug'])) ?>" target="_blank"
                                       class="text-teven-secundario-2 underline">
                                        /blog/<?= htmlspecialchars($articulo['slug']) ?>
                                    </a>
                                </td>
                                <td class="px-4 py-3 hidden lg:table-cell text-sm max-w-[200px] truncate">
                                    <?= htmlspecialchars($articulo['extracto'] ?? '—') ?>
                                </td>
                                <td class="px-4 py-3 hidden md:table-cell">
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold <?= $articulo['activo'] ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' ?>">
                                        <?= $articulo['activo'] ? 'Sí' : 'No' ?>
                                    </span>
                                </td>
                                <td class="px-4 py-3 hidden lg:table-cell text-sm">
                                    <?= date('d/m/Y', strtotime($articulo['creado'])) ?>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex flex-col lg:flex-row gap-2">
                                        <form method="post" action="<?=ruta('admin/blog-editar')?>">
                                            <input type="hidden" name="articulo_id" value="<?= htmlspecialchars($articulo['id']) ?>">
                                            <button type="submit"
                                                    class="font-bold text-teven-secundario-2 dark:text-white/70 px-3 py-1.5 rounded-lg border-2 border-teven-secundario-2
                                                           hover:bg-teven-secundario-2 hover:text-white transition duration-300 text-xs lg:text-sm whitespace-nowrap">
                                                Editar
                                            </button>
                                        </form>
                                        <form method="post" action="<?=ruta('admin/blog-borrar')?>"
                                              onsubmit="return confirm('¿Eliminar este artículo?');">
                                            <input type="hidden" name="articulo_id" value="<?= htmlspecialchars($articulo['id']) ?>">
                                            <button type="submit"
                                                    class="font-bold text-red-500 px-3 py-1.5 rounded-lg border-2 border-red-500
                                                           hover:bg-red-500 hover:text-white transition duration-300 text-xs lg:text-sm whitespace-nowrap">
                                                Borrar
                                            </button>
                                        </form>
                                    </div>
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
