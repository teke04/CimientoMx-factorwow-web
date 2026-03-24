<!DOCTYPE html>
<html lang="es" class="<?= configuracion('modo_dashboard') === 'oscuro' ? 'dark' : '' ?>">
<head>
  <?= $this->plantilla_admin('metas-basicas'); ?>
  <title>Editar Keyword</title>
</head>
<body class="bg-white dark:bg-gray-800 lg:h-screen w-screen font-inter relative lg:pl-[180px] pt-[100px]">

    <?= $this->componente_admin('header');?>
    <?= $this->componente_admin('barra-lateral');?>
  
    <main class="flex w-full h-full max-w-full max-h-full overflow-clip p-4 lg:p-12">
      
        <!-- Sección de contenido -->
        <section class="w-full flex flex-col overflow-auto items-center justify-center">
            <div class="bg-white dark:bg-gray-800 w-full max-w-[800px] p-6 lg:p-8 rounded-xl shadow-lg border-2 border-teven-secundario-1">
                <div class="flex flex-row gap-x-4 items-center mb-6">
                    <svg class="size-[40px]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path class="dark:stroke-white" d="M21.2799 6.40005L11.7399 15.94C10.7899 16.89 7.96987 17.33 7.33987 16.7C6.70987 16.07 7.13987 13.25 8.08987 12.3L17.6399 2.75002C17.8754 2.49308 18.1605 2.28654 18.4781 2.14284C18.7956 1.99914 19.139 1.92124 19.4875 1.9139C19.8359 1.90657 20.1823 1.96991 20.5056 2.10012C20.8289 2.23033 21.1225 2.42473 21.3686 2.67153C21.6147 2.91833 21.8083 3.21243 21.9376 3.53609C22.0669 3.85976 22.1294 4.20626 22.1211 4.55471C22.1128 4.90316 22.0339 5.24635 21.8894 5.5635C21.7448 5.88065 21.5375 6.16524 21.2799 6.40005V6.40005Z" stroke="#50388E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path class="dark:stroke-white" d="M11 4H6C4.93913 4 3.92178 4.42142 3.17163 5.17157C2.42149 5.92172 2 6.93913 2 8V18C2 19.0609 2.42149 20.0783 3.17163 20.8284C3.92178 21.5786 4.93913 22 6 22H17C19.21 22 20 20.2 20 18V13" stroke="#50388E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
                    <h1 class="text-xl lg:text-3xl font-bold text-teven-primario dark:text-white">Editar landing</h1>
                </div>

                <!-- Mensaje dinámico debajo del título -->
                <?php if (!empty($mensaje)): ?>
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                        <p class="font-medium"><?= htmlspecialchars($mensaje); ?></p>
                    </div>
                <?php endif; ?>

                <form method="post" action="<?=ruta('admin/landings-editar')?>">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Campo Keyword -->
                        <div class="lg:col-span-2">
                            <label for="keyword" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">Nombre de la landing</label>
                            <input 
                                type="text" 
                                id="keyword" 
                                name="keyword" 
                                required 
                                value="<?= isset($landing['keyword']) ? htmlspecialchars($landing['keyword']) : '' ?>" 
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
                                value="<?= isset($landing['h1']) ? htmlspecialchars($landing['h1']) : '' ?>" 
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
                                value="<?= isset($landing['h2']) ? htmlspecialchars($landing['h2']) : '' ?>" 
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
                                value="<?= isset($landing['meta_titulo']) ? htmlspecialchars($landing['meta_titulo']) : '' ?>" 
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
                                class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100 resize-none"><?= isset($landing['meta_descripcion']) ? htmlspecialchars($landing['meta_descripcion']) : '' ?></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="keyword_id" value="<?= isset($landing['id']) ? htmlspecialchars($landing['id']) : '' ?>">
                    <!-- Botones -->
                    <div class="flex flex-col-reverse lg:flex-row justify-between gap-3 mt-6">
                        <a href="<?=ruta('admin/landings')?>" class="text-center bg-gray-400 text-white py-3 px-6 rounded-lg hover:bg-gray-500 transition font-bold">
                            Cancelar
                        </a>
                        <button type="submit" class="bg-teven-secundario-2 text-white py-3 px-6 rounded-lg hover:bg-teven-complementario transition font-bold">
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </main>
  
</body>
</html>