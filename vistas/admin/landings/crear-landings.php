<!DOCTYPE html>
<html lang="es" class="<?= configuracion('modo_dashboard') === 'oscuro' ? 'dark' : '' ?>">
<head>
  <?= $this->plantilla_admin('metas-basicas'); ?>
  <title>Registrar Nueva Landing</title>
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
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path class="dark:stroke-white" d="M12 6V18M12 6L7 11M12 6L17 11" stroke="#50388E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path class="dark:stroke-white" d="M3 18H21" stroke="#50388E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </g>
                    </svg>
                    <h1 class="text-xl lg:text-3xl font-bold text-teven-primario dark:text-white">Configurar nueva landing</h1>
                </div>

                <!-- Mensaje dinámico debajo del título -->
                <?php if (!empty($mensaje)): ?>
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                        <p class="font-medium"><?= htmlspecialchars($mensaje); ?></p>
                    </div>
                <?php endif; ?>

                <form method="post" action="<?=ruta('admin/landings-crear')?>">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Campo Keyword -->
                        <div class="lg:col-span-2">
                            <label for="keyword" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">Nombre de la landing</label>
                            <input 
                                type="text" 
                                id="keyword" 
                                name="keyword" 
                                required 
                                pattern="[a-z0-9\-]+" 
                                title="Solo se permiten letras minúsculas, números y el carácter -"
                                class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100">
                        </div>
                        <!-- Campo H1 -->
                        <div>
                            <label for="h1" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">H1</label>
                            <input 
                                type="text" 
                                id="h1" 
                                name="h1" 
                                required 
                                value="<?= isset($default['h1']) ? htmlspecialchars($default['h1']) : '' ?>" 
                                class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100">
                        </div>
                        <!-- Campo H2 -->
                        <div>
                            <label for="h2" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">H2</label>
                            <input 
                                type="text" 
                                id="h2" 
                                name="h2" 
                                required 
                                value="<?= isset($default['h2']) ? htmlspecialchars($default['h2']) : '' ?>" 
                                class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100">
                        </div>
                        <!-- Campo Meta Título -->
                        <div class="lg:col-span-2">
                            <label for="meta_titulo" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">Meta Título</label>
                            <input 
                                type="text" 
                                id="meta_titulo" 
                                name="meta_titulo" 
                                required 
                                value="<?= isset($default['meta_titulo']) ? htmlspecialchars($default['meta_titulo']) : '' ?>" 
                                class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100">
                        </div>
                        <!-- Campo Meta Descripción -->
                        <div class="lg:col-span-2">
                            <label for="meta_descripcion" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">Meta Descripción</label>
                            <textarea 
                                id="meta_descripcion" 
                                name="meta_descripcion" 
                                rows="4" 
                                required 
                                class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100 resize-none"><?= isset($default['meta_descripcion']) ? htmlspecialchars($default['meta_descripcion']) : '' ?></textarea>
                        </div>
                    </div>
                    <!-- Botones -->
                    <div class="flex flex-col-reverse lg:flex-row justify-between gap-3 mt-6">
                        <a href="<?=ruta('admin/landings')?>" class="text-center bg-gray-400 text-white py-3 px-6 rounded-lg hover:bg-gray-500 transition font-bold">
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