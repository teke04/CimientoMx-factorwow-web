<!DOCTYPE html>
<html lang="es" class="<?= configuracion('modo_dashboard') === 'oscuro' ? 'dark' : '' ?>">
<head>
  <?= $this->plantilla_admin('metas-basicas'); ?>
  <title>Agregar Producto</title>
</head>
<body class="bg-white dark:bg-gray-800 lg:h-screen w-screen font-inter relative lg:pl-[180px] pt-[100px]">

    <?= $this->componente_admin('header');?>
    <?= $this->componente_admin('barra-lateral');?>
  
    <main class="flex w-full h-full max-w-full max-h-full overflow-clip p-4 lg:p-12">

        <section class="w-full flex flex-col overflow-auto items-center justify-center">
            <div class="bg-white dark:bg-gray-800 w-full max-w-[800px] p-6 lg:p-8 rounded-xl shadow-lg border-2 border-teven-secundario-1">
                <div class="flex flex-row gap-x-4 items-center mb-6">
                    <svg class="size-[40px]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path class="dark:stroke-white" d="M12 6V18M12 6L7 11M12 6L17 11" stroke="#50388E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path class="dark:stroke-white" d="M3 18H21" stroke="#50388E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <h1 class="text-xl lg:text-3xl font-bold text-teven-primario dark:text-white">Agregar producto</h1>
                </div>

                <?php if (!empty($mensaje)): ?>
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                        <p class="font-medium"><?= htmlspecialchars($mensaje) ?></p>
                    </div>
                <?php endif; ?>

                <form method="post" action="<?=ruta('admin/productos-crear')?>" enctype="multipart/form-data">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                        <!-- Nombre -->
                        <div class="lg:col-span-2">
                            <label for="nombre" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">Nombre del producto *</label>
                            <input type="text" id="nombre" name="nombre" required
                                   value="<?= htmlspecialchars($datos['nombre'] ?? '') ?>"
                                   class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100">
                        </div>

                        <!-- Precio con descuento -->
                        <div>
                            <label for="precio" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">Precio con descuento MXN *</label>
                            <input type="number" id="precio" name="precio" required min="0" step="0.01"
                                   value="<?= htmlspecialchars($datos['precio'] ?? '') ?>"
                                   placeholder="0.00"
                                   class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100">
                        </div>

                        <!-- Precio sin descuento -->
                        <div>
                            <label for="precio_original" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">Precio sin descuento MXN <span class="font-normal text-gray-400">(tachado)</span></label>
                            <input type="number" id="precio_original" name="precio_original" min="0" step="0.01"
                                   value="<?= htmlspecialchars($datos['precio_original'] ?? '') ?>"
                                   placeholder="0.00"
                                   class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100">
                        </div>

                        <!-- Categoría -->
                        <div>
                            <label for="categoria" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">Categoría *</label>
                            <select id="categoria" name="categoria" required
                                    class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100">
                                <option value="" disabled selected>Selecciona una categoría</option>
                                <option value="presencial" <?= (($datos['categoria'] ?? '') === 'presencial') ? 'selected' : '' ?>>Curso presencial</option>
                                <option value="online"     <?= (($datos['categoria'] ?? '') === 'online')     ? 'selected' : '' ?>>Curso online</option>
                                <option value="descargable"<?= (($datos['categoria'] ?? '') === 'descargable')? 'selected' : '' ?>>Descargable</option>
                            </select>
                        </div>

                        <!-- URL de compra -->
                        <div>
                            <label for="url_compra" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">URL de compra *</label>
                            <input type="url" id="url_compra" name="url_compra" required
                                   value="<?= htmlspecialchars($datos['url_compra'] ?? '') ?>"
                                   placeholder="https://..."
                                   class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100">
                        </div>

                        <!-- URL interna (slug) -->
                        <div>
                            <label for="url_interna" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">URL interna <span class="font-normal text-gray-400">(slug de la página del producto)</span></label>
                            <input type="text" id="url_interna" name="url_interna"
                                   value="<?= htmlspecialchars($datos['url_interna'] ?? '') ?>"
                                   placeholder="mi-producto"
                                   pattern="[a-z0-9\-]+" title="Solo letras minúsculas, números y guiones"
                                   class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100">
                            <p class="text-xs text-gray-500 dark:text-white/40 mt-1">Solo minúsculas, números y guiones. Ej: <code>curso-de-php</code>. Déjalo vacío si no tendrá página interna.</p>
                        </div>

                        <!-- Imagen del producto -->
                        <div class="lg:col-span-2">
                            <label for="imagen" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">Imagen del producto</label>
                            <input type="file" id="imagen" name="imagen" accept="image/jpeg,image/png,image/webp,image/gif"
                                   class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100 file:mr-4 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teven-secundario-2 file:text-white hover:file:bg-teven-complementario cursor-pointer">
                            <p class="text-xs text-gray-500 dark:text-white/40 mt-1">JPG, PNG, WEBP o GIF. Máximo 5 MB.</p>
                        </div>

                    </div>

                    <div class="flex flex-col-reverse lg:flex-row justify-between gap-3 mt-6">
                        <a href="<?=ruta('admin/productos')?>"
                           class="text-center bg-gray-400 text-white py-3 px-6 rounded-lg hover:bg-gray-500 transition font-bold">
                            Cancelar
                        </a>
                        <button type="submit"
                                class="bg-teven-secundario-2 text-white py-3 px-6 rounded-lg hover:bg-teven-complementario transition font-bold">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </main>
  
</body>
</html>
