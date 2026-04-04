<!DOCTYPE html>
<html lang="es" class="<?= configuracion('modo_dashboard') === 'oscuro' ? 'dark' : '' ?>">
<head>
  <?= $this->plantilla_admin('metas-basicas'); ?>
  <title>Pedidos</title>
</head>
<body class="bg-white dark:bg-gray-800 lg:h-screen w-screen font-inter relative lg:pl-[180px] pt-[100px]">

    <?= $this->componente_admin('header'); ?>
    <?= $this->componente_admin('barra-lateral'); ?>

    <main class="flex w-full h-full max-w-full max-h-full overflow-clip p-4 lg:p-12">

        <section class="w-full flex flex-col overflow-y-auto pr-4 overflow-x-hidden">
            <div class="w-full h-full relative">

                <!-- Header -->
                <div class="w-full flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
                    <div class="flex flex-row gap-x-8 items-center">
                        <svg class="size-[50px]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path class="dark:stroke-white" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 5h12M9 21a1 1 0 100-2 1 1 0 000 2zm10 0a1 1 0 100-2 1 1 0 000 2z"
                                  stroke="#50388E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <h1 class="text-lg lg:text-2xl font-bold text-teven-primario dark:text-white">Pedidos</h1>
                    </div>

                    <!-- Filtros de estado -->
                    <div class="flex flex-wrap gap-2">
                        <?php
                        $estados = ['' => 'Todos', 'pendiente' => 'Pendientes', 'pagado' => 'Pagados', 'cancelado' => 'Cancelados'];
                        foreach ($estados as $val => $label):
                            $activo = ($estado_filtro === $val);
                        ?>
                        <a href="<?= ruta('admin/pedidos') . ($val ? '?estado=' . $val : '') ?>"
                           class="px-4 py-1.5 rounded-full text-sm font-semibold transition-colors duration-200
                                  <?= $activo ? 'bg-teven-secundario-2 text-white' : 'bg-gray-100 dark:bg-white/10 text-teven-secundario-3 dark:text-white/70 hover:bg-teven-secundario-2/20' ?>">
                            <?= $label ?>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Tabla -->
                <div class="mt-8 lg:mt-12 w-full overflow-x-auto">
                    <?php if (empty($pedidos)): ?>
                        <p class="text-teven-secundario-3 dark:text-white/60 text-center py-12">No hay pedidos registrados.</p>
                    <?php else: ?>
                    <table class="w-full border-separate border-spacing-0 rounded-xl overflow-hidden shadow-lg">
                        <thead>
                            <tr class="bg-teven-secundario-2 text-white font-semibold text-sm">
                                <th class="px-4 py-3 text-left">#</th>
                                <th class="px-4 py-3 text-left">Producto</th>
                                <th class="px-4 py-3 text-left hidden md:table-cell">Cliente</th>
                                <th class="px-4 py-3 text-left hidden lg:table-cell">Email</th>
                                <th class="px-4 py-3 text-left">Monto</th>
                                <th class="px-4 py-3 text-left">Estado</th>
                                <th class="px-4 py-3 text-left hidden lg:table-cell">Fecha</th>
                                <th class="px-4 py-3 text-left hidden xl:table-cell">Session ID</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($pedidos as $pedido): ?>
                            <?php
                            $estado_styles = [
                                'pagado'    => 'bg-green-100 text-green-700',
                                'pendiente' => 'bg-yellow-100 text-yellow-700',
                                'cancelado' => 'bg-red-100 text-red-600',
                            ];
                            $badge = $estado_styles[$pedido['estado']] ?? 'bg-gray-100 text-gray-600';
                            ?>
                            <tr class="text-teven-secundario-3 dark:text-white/70 odd:bg-teven-primario/5 dark:odd:bg-white/5 even:bg-teven-secundario-1/10 dark:even:bg-white/10 hover:bg-teven-complementario/10 transition-colors text-sm">
                                <td class="px-4 py-3 font-medium"><?= $pedido['id'] ?></td>
                                <td class="px-4 py-3 font-medium max-w-[160px] truncate"><?= htmlspecialchars($pedido['producto_nombre'] ?? '—') ?></td>
                                <td class="px-4 py-3 hidden md:table-cell"><?= htmlspecialchars($pedido['nombre'] ?? '—') ?></td>
                                <td class="px-4 py-3 hidden lg:table-cell text-xs"><?= htmlspecialchars($pedido['email'] ?? '—') ?></td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    $<?= number_format($pedido['monto'], 2) ?> <?= strtoupper($pedido['moneda']) ?>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold <?= $badge ?>">
                                        <?= ucfirst($pedido['estado']) ?>
                                    </span>
                                </td>
                                <td class="px-4 py-3 hidden lg:table-cell text-xs">
                                    <?= date('d/m/Y H:i', strtotime($pedido['creado'])) ?>
                                </td>
                                <td class="px-4 py-3 hidden xl:table-cell text-xs text-gray-400 max-w-[160px] truncate" title="<?= htmlspecialchars($pedido['stripe_session_id']) ?>">
                                    <?= htmlspecialchars($pedido['stripe_session_id']) ?>
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
