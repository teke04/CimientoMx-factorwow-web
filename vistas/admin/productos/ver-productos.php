<!DOCTYPE html>
<html lang="es" class="<?= configuracion('modo_dashboard') === 'oscuro' ? 'dark' : '' ?>">
<head>
  <?= $this->plantilla_admin('metas-basicas'); ?>
  <title>Productos - Tienda</title>
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
                            <path class="dark:stroke-white" d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z" stroke="#50388E" stroke-width="1.91" stroke-linecap="round" stroke-linejoin="round"/>
                            <line class="dark:stroke-white" x1="3" y1="6" x2="21" y2="6" stroke="#50388E" stroke-width="1.91" stroke-linecap="round"/>
                            <path class="dark:stroke-white" d="M16 10a4 4 0 01-8 0" stroke="#50388E" stroke-width="1.91" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <h1 class="text-lg lg:text-2xl font-bold text-teven-primario dark:text-white">
                            Productos de la tienda
                        </h1>
                    </div>
                    <a href="<?=ruta('admin/productos-crear')?>"
                       class="w-fit rounded-lg bg-teven-secundario-2 py-3 px-2 lg:px-8 text-white font-bold text-xs lg:text-base
                              hover:bg-teven-complementario duration-200 whitespace-nowrap">
                        Agregar nuevo producto
                    </a>
                </div>

                <div class="mt-8 lg:mt-16 w-full overflow-x-auto">
                    <?php if (empty($productos)): ?>
                        <p class="text-teven-secundario-3 dark:text-white/60 text-center py-12">No hay productos registrados aún.</p>
                    <?php else: ?>
                    <table class="w-full border-separate border-spacing-0 rounded-xl overflow-hidden shadow-lg">
                        <thead>
                            <tr class="bg-teven-secundario-2 text-white font-semibold">
                                <th class="px-4 py-3 text-left border-b-2 border-teven-secundario-3">Imagen</th>
                                <th class="px-4 py-3 text-left border-b-2 border-teven-secundario-3">Nombre</th>
                                <th class="px-4 py-3 text-left border-b-2 border-teven-secundario-3 hidden md:table-cell">Categoría</th>
                                <th class="px-4 py-3 text-left border-b-2 border-teven-secundario-3 hidden lg:table-cell">Precio con descuento</th>
                                <th class="px-4 py-3 text-left border-b-2 border-teven-secundario-3 hidden lg:table-cell">Precio sin descuento</th>
                                <th class="px-4 py-3 text-left border-b-2 border-teven-secundario-3 hidden lg:table-cell">URL interna</th>
                                <th class="px-4 py-3 text-left border-b-2 border-teven-secundario-3 hidden md:table-cell">Activo</th>
                                <th class="px-4 py-3 text-left border-b-2 border-teven-secundario-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $labels_cat = [
                                'presencial'   => 'Presencial',
                                'online'       => 'Online',
                                'descargable'  => 'Descargable',
                            ];
                            foreach ($productos as $producto):
                            ?>
                            <tr class="text-teven-secundario-3 dark:text-white/70 odd:bg-teven-primario/5 dark:odd:bg-white/5 even:bg-teven-secundario-1/10 dark:even:bg-white/10 hover:bg-teven-complementario/10 transition-colors">
                                <td class="px-4 py-3">
                                    <?php if ($producto['imagen_url']): ?>
                                        <img src="<?= url($producto['imagen_url']) ?>"
                                             alt="<?= htmlspecialchars($producto['nombre']) ?>"
                                             class="h-14 w-14 object-cover rounded-lg">
                                    <?php else: ?>
                                        <div class="h-14 w-14 bg-gray-200 dark:bg-white/10 rounded-lg flex items-center justify-center text-gray-400 text-xs">Sin img</div>
                                    <?php endif; ?>
                                </td>
                                <td class="px-4 py-3 font-medium"><?= htmlspecialchars($producto['nombre']) ?></td>
                                <td class="px-4 py-3 hidden md:table-cell capitalize"><?= htmlspecialchars($labels_cat[$producto['categoria']] ?? $producto['categoria']) ?></td>
                                <td class="px-4 py-3 hidden lg:table-cell">$<?= number_format($producto['precio'], 2) ?> MXN</td>
                                <td class="px-4 py-3 hidden lg:table-cell">
                                    <?= $producto['precio_original'] ? '$' . number_format($producto['precio_original'], 2) . ' MXN' : '—' ?>
                                </td>
                                <td class="px-4 py-3 hidden lg:table-cell">
                                    <?php if ($producto['url_interna']): ?>
                                        <a href="<?= ruta('tienda/' . htmlspecialchars($producto['url_interna'])) ?>" target="_blank"
                                           class="text-teven-secundario-2 underline text-xs">
                                            /tienda/<?= htmlspecialchars($producto['url_interna']) ?>
                                        </a>
                                    <?php else: ?>
                                        <span class="text-gray-400">—</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-4 py-3 hidden md:table-cell">
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold <?= $producto['activo'] ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' ?>">
                                        <?= $producto['activo'] ? 'Sí' : 'No' ?>
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex flex-col lg:flex-row gap-2">
                                        <form method="post" action="<?=ruta('admin/productos-editar')?>">
                                            <input type="hidden" name="producto_id" value="<?= htmlspecialchars($producto['id']) ?>">
                                            <button type="submit"
                                                    class="font-bold text-teven-secundario-2 dark:text-white/70 px-3 py-1.5 rounded-lg border-2 border-teven-secundario-2
                                                           hover:bg-teven-secundario-2 hover:text-white transition duration-300 text-xs lg:text-sm whitespace-nowrap">
                                                Editar
                                            </button>
                                        </form>
                                        <form method="post" action="<?=ruta('admin/productos-borrar')?>"
                                              onsubmit="return confirm('¿Eliminar este producto?');">
                                            <input type="hidden" name="producto_id" value="<?= htmlspecialchars($producto['id']) ?>">
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
