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
                        <svg class="size-[50px]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path class="dark:stroke-white" d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z" stroke="#50388E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path class="dark:stroke-white" d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z" stroke="#50388E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
                        <h1 class="text-lg lg:text-2xl font-bold text-teven-primario dark:text-white">
                            Lista de leads
                        </h1>
                    </div>
                </div>


                <div class="mt-8 lg:mt-16 w-full overflow-x-auto">
                    <?php
                    // Verificar si hay al menos un lead con interés
                    $hayIntereses = false;
                    foreach ($leads as $lead) {
                        if (!empty($lead['interes'])) {
                            $hayIntereses = true;
                            break;
                        }
                    }
                    
                    // Verificar si hay al menos un lead con servicio
                    $hayServicios = false;
                    foreach ($leads as $lead) {
                        if (!empty($lead['servicio'])) {
                            $hayServicios = true;
                            break;
                        }
                    }
                    ?>
                    
                    <table class="w-full border-separate border-spacing-0 rounded-xl overflow-hidden shadow-lg">
                        <thead>
                            <tr class="bg-teven-secundario-2 text-white font-semibold">
                                <th class="px-4 py-3 text-left border-b-2 border-teven-secundario-3 hidden md:table-cell">Creado</th>
                                <th class="px-4 py-3 text-left border-b-2 border-teven-secundario-3">Keyword</th>
                                <th class="px-4 py-3 text-left border-b-2 border-teven-secundario-3">Nombre</th>
                                <th class="px-4 py-3 text-left border-b-2 border-teven-secundario-3 hidden lg:table-cell">Teléfono</th>
                                <th class="px-4 py-3 text-left border-b-2 border-teven-secundario-3 hidden xl:table-cell">Correo</th>
                                <?php if ($hayIntereses): ?>
                                <th class="px-4 py-3 text-left border-b-2 border-teven-secundario-3 hidden lg:table-cell">Interés</th>
                                <?php endif; ?>
                                <?php if ($hayServicios): ?>
                                <th class="px-4 py-3 text-left border-b-2 border-teven-secundario-3 hidden lg:table-cell">Servicio</th>
                                <?php endif; ?>
                                <th class="px-4 py-3 text-left border-b-2 border-teven-secundario-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($leads as $lead): ?>
                            <tr class="text-teven-secundario-3 dark:text-white/70 odd:bg-teven-primario/5 dark:odd:bg-white/5 even:bg-teven-secundario-1/10 dark:even:bg-white/10 hover:bg-teven-complementario/10 transition-colors">
                                <td class="px-4 py-3 hidden md:table-cell"><?php echo htmlspecialchars($lead['creada']); ?></td>
                                <td class="px-4 py-3 font-medium"><?php echo $lead['keyword'] ? htmlspecialchars($lead['keyword']) : 'Sin landing'; ?></td>
                                <td class="px-4 py-3"><?php echo htmlspecialchars($lead['nombre']); ?></td>
                                <td class="px-4 py-3 hidden lg:table-cell"><?php echo htmlspecialchars($lead['telefono']); ?></td>
                                <td class="px-4 py-3 hidden xl:table-cell truncate max-w-xs"><?php echo htmlspecialchars($lead['correo']); ?></td>
                                <?php if ($hayIntereses): ?>
                                <td class="px-4 py-3 hidden lg:table-cell"><?php echo $lead['interes'] ? htmlspecialchars($lead['interes']) : '-'; ?></td>
                                <?php endif; ?>
                                <?php if ($hayServicios): ?>
                                <td class="px-4 py-3 hidden lg:table-cell"><?php echo $lead['servicio'] ? htmlspecialchars($lead['servicio']) : '-'; ?></td>
                                <?php endif; ?>
                                <td class="px-4 py-3">
                                    <!-- Botón de Borrar -->
                                    <form method="post" action="<?=ruta('admin/leads-borrar')?>" onsubmit="return confirm('¿Estás seguro de que deseas borrar este lead?');">
                                        <input type="hidden" name="lead_id" value="<?php echo htmlspecialchars($lead['id']); ?>">
                                        <button type="submit" class="font-bold text-red-500 px-3 py-1.5 rounded-lg border-2 border-red-500
                                        hover:bg-red-500 hover:text-white transition duration-300 text-xs lg:text-sm whitespace-nowrap">
                                            Borrar
                                        </button>
                                    </form>
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