<!DOCTYPE html>
<html lang="es" class="<?= configuracion('modo_dashboard') === 'oscuro' ? 'dark' : '' ?>">
<head>
  <?= $this->plantilla_admin('metas-basicas'); ?>
  <title>Diplomados</title>
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
                            <path d="M12 3L2 8l10 5 10-5-10-5z" class="dark:stroke-white" stroke="#50388E" stroke-width="1.8" stroke-linejoin="round"/>
                            <path d="M2 8v8M22 8v8" class="dark:stroke-white" stroke="#50388E" stroke-width="1.8" stroke-linecap="round"/>
                            <path d="M6 10.5v5a6 6 0 0012 0v-5" class="dark:stroke-white" stroke="#50388E" stroke-width="1.8" stroke-linecap="round"/>
                        </svg>
                        <h1 class="text-lg lg:text-2xl font-bold text-teven-primario dark:text-white">
                            Diplomados
                        </h1>
                    </div>
                    <a href="<?=ruta('admin/diplomados-crear')?>"
                       class="w-fit rounded-lg bg-teven-secundario-2 py-3 px-2 lg:px-8 text-white font-bold text-xs lg:text-base
                              hover:bg-teven-complementario duration-200 whitespace-nowrap">
                        Agregar nuevo diplomado
                    </a>
                </div>

                <div class="mt-8 lg:mt-16 w-full overflow-x-auto">
                    <?php if (empty($diplomados)): ?>
                        <p class="text-teven-secundario-3 dark:text-white/60 text-center py-12">No hay diplomados registrados aún.</p>
                    <?php else: ?>
                    <table class="w-full border-separate border-spacing-0 rounded-xl overflow-hidden shadow-lg">
                        <thead>
                            <tr class="bg-teven-secundario-2 text-white font-semibold">
                                <th class="px-4 py-3 text-left border-b-2 border-teven-secundario-3">Título</th>
                                <th class="px-4 py-3 text-left border-b-2 border-teven-secundario-3 hidden md:table-cell">Generación</th>
                                <th class="px-4 py-3 text-left border-b-2 border-teven-secundario-3 hidden lg:table-cell">Extracto</th>
                                <th class="px-4 py-3 text-left border-b-2 border-teven-secundario-3 hidden lg:table-cell">Temario</th>
                                <th class="px-4 py-3 text-left border-b-2 border-teven-secundario-3 hidden md:table-cell">Activo</th>
                                <th class="px-4 py-3 text-left border-b-2 border-teven-secundario-3 hidden lg:table-cell">Fecha</th>
                                <th class="px-4 py-3 text-left border-b-2 border-teven-secundario-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($diplomados as $diplomado): ?>
                            <tr class="text-teven-secundario-3 dark:text-white/70 odd:bg-teven-primario/5 dark:odd:bg-white/5 even:bg-teven-secundario-1/10 dark:even:bg-white/10 hover:bg-teven-complementario/10 transition-colors">
                                <td class="px-4 py-3 font-medium">
                                    <?= htmlspecialchars($diplomado['titulo']) ?>
                                    <div class="text-xs text-gray-400 mt-0.5">/diplomado/<?= htmlspecialchars($diplomado['slug']) ?></div>
                                </td>
                                <td class="px-4 py-3 hidden md:table-cell text-sm">
                                    <?= htmlspecialchars($diplomado['generacion'] ?? '—') ?>
                                </td>
                                <td class="px-4 py-3 hidden lg:table-cell text-sm max-w-[180px] truncate">
                                    <?= htmlspecialchars($diplomado['extracto'] ?? '—') ?>
                                </td>
                                <td class="px-4 py-3 hidden lg:table-cell text-sm">
                                    <?php if (!empty($diplomado['url_temario'])): ?>
                                        <a href="<?= url('recursos/' . $diplomado['url_temario']) ?>" target="_blank" rel="noopener"
                                           class="text-[#0064FF] hover:underline text-xs">Ver PDF</a>
                                    <?php else: ?>
                                        <span class="text-gray-400">—</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-4 py-3 hidden md:table-cell">
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold <?= $diplomado['activo'] ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' ?>">
                                        <?= $diplomado['activo'] ? 'Sí' : 'No' ?>
                                    </span>
                                </td>
                                <td class="px-4 py-3 hidden lg:table-cell text-sm">
                                    <?= date('d/m/Y', strtotime($diplomado['creado'])) ?>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex flex-col lg:flex-row gap-2">
                                        <form method="post" action="<?=ruta('admin/diplomados-editar')?>">
                                            <input type="hidden" name="diplomado_id" value="<?= $diplomado['id'] ?>">
                                            <button type="submit"
                                                    class="w-full rounded-lg bg-teven-secundario-2 py-1 px-3 text-white text-xs font-semibold
                                                           hover:bg-teven-complementario duration-200">
                                                Editar
                                            </button>
                                        </form>
                                        <form method="post" action="<?=ruta('admin/diplomados-borrar')?>"
                                              onsubmit="return confirm('¿Seguro que deseas borrar este diplomado?')">
                                            <input type="hidden" name="diplomado_id" value="<?= $diplomado['id'] ?>">
                                            <button type="submit"
                                                    class="w-full rounded-lg bg-red-500 py-1 px-3 text-white text-xs font-semibold
                                                           hover:bg-red-600 duration-200">
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
