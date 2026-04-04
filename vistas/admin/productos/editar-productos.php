<!DOCTYPE html>
<html lang="es" class="<?= configuracion('modo_dashboard') === 'oscuro' ? 'dark' : '' ?>">
<head>
  <?= $this->plantilla_admin('metas-basicas'); ?>
  <title>Editar Producto</title>
</head>
<body class="bg-white dark:bg-gray-800 lg:h-screen w-screen font-inter relative lg:pl-[180px] pt-[100px]">

    <?= $this->componente_admin('header');?>
    <?= $this->componente_admin('barra-lateral');?>
  
    <main class="flex w-full h-full max-w-full max-h-full overflow px-4 lg:px-12">

        <section class="w-full flex flex-col overflow-auto items-center justify-center py-[280px] pb-[40px]">
            <div class="bg-white dark:bg-gray-800 w-full p-6 lg:p-8 rounded-xl shadow-lg border-2 border-teven-secundario-1">
                <div class="flex flex-row gap-x-4 items-center mb-6">
                    <svg class="size-[40px]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path class="dark:stroke-white" d="M21.28 6.4L11.74 15.94C10.79 16.89 7.97 17.33 7.34 16.7C6.71 16.07 7.14 13.25 8.09 12.3L17.64 2.75a2.68 2.68 0 013.64 3.65z" stroke="#50388E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path class="dark:stroke-white" d="M11 4H6a4 4 0 00-4 4v10a4 4 0 004 4h11a4 4 0 004-4v-5" stroke="#50388E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <h1 class="text-xl lg:text-3xl font-bold text-teven-primario dark:text-white">Editar producto</h1>
                </div>

                <?php if (!empty($mensaje)): ?>
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                        <p class="font-medium"><?= htmlspecialchars($mensaje) ?></p>
                    </div>
                <?php endif; ?>

                <form method="post" action="<?=ruta('admin/productos-editar')?>" enctype="multipart/form-data">
                    <input type="hidden" name="producto_id" value="<?= htmlspecialchars($producto['id']) ?>">

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                        <!-- Nombre -->
                        <div>
                            <label for="nombre" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">Nombre del producto *</label>
                            <input type="text" id="nombre" name="nombre" required
                                   value="<?= htmlspecialchars($producto['nombre'] ?? '') ?>"
                                   class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100">
                        </div>

                        <!-- Precio con descuento -->
                        <div>
                            <label for="precio" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">Precio con descuento MXN *</label>
                            <input type="number" id="precio" name="precio" required min="0" step="0.01"
                                   value="<?= htmlspecialchars($producto['precio'] ?? '') ?>"
                                   class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100">
                        </div>

                        <!-- Precio sin descuento -->
                        <div>
                            <label for="precio_original" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">Precio sin descuento MXN <span class="font-normal text-gray-400">(tachado)</span></label>
                            <input type="number" id="precio_original" name="precio_original" min="0" step="0.01"
                                   value="<?= htmlspecialchars($producto['precio_original'] ?? '') ?>"
                                   placeholder="0.00"
                                   class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100">
                        </div>

                        <!-- Descripción - ocupa 2 filas en desktop -->
                        <div class="lg:row-span-2 flex flex-col">
                            <label for="descripcion" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">Descripción</label>
                            <textarea id="descripcion" name="descripcion"
                                      class="flex-1 min-h-[120px] w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100 resize-y"><?= htmlspecialchars($producto['descripcion'] ?? '') ?></textarea>
                        </div>

                        <!-- Categoría -->
                        <div>
                            <label for="categoria" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">Categoría *</label>
                            <select id="categoria" name="categoria" required
                                    class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100">
                                <option value="presencial"  <?= (($producto['categoria'] ?? '') === 'presencial')  ? 'selected' : '' ?>>Curso presencial</option>
                                <option value="online"      <?= (($producto['categoria'] ?? '') === 'online')      ? 'selected' : '' ?>>Curso online</option>
                                <option value="descargable" <?= (($producto['categoria'] ?? '') === 'descargable') ? 'selected' : '' ?>>Descargable</option>
                                <option value="otros"       <?= (($producto['categoria'] ?? '') === 'otros')       ? 'selected' : '' ?>>Otros</option>
                            </select>
                        </div>

                        <!-- URL de compra -->
                        <div>
                            <label for="url_compra" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">URL de compra *</label>
                            <input type="url" id="url_compra" name="url_compra" required
                                   value="<?= htmlspecialchars($producto['url_compra'] ?? '') ?>"
                                   class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100">
                        </div>

                        <!-- Imagen - ocupa cols 2-3 -->
                        <div class="lg:col-span-2">
                            <label class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">Imagen del producto</label>
                            <?php if (!empty($producto['imagen_url'])): ?>
                            <div class="mb-3 flex items-center gap-4">
                                <img src="<?= url($producto['imagen_url']) ?>"
                                     alt="Imagen actual"
                                     class="h-24 w-24 object-cover rounded-lg border border-gray-300">
                                <div class="flex flex-col gap-1">
                                    <span class="text-xs text-gray-500 dark:text-white/40">Imagen actual</span>
                                    <label class="flex items-center gap-2 cursor-pointer text-sm text-red-500 font-medium">
                                        <input type="checkbox" name="borrar_imagen" value="1" class="accent-red-500">
                                        Eliminar imagen actual
                                    </label>
                                </div>
                            </div>
                            <?php endif; ?>
                            <input type="file" id="imagen" name="imagen" accept="image/jpeg,image/png,image/webp,image/gif"
                                   class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100 file:mr-4 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teven-secundario-2 file:text-white hover:file:bg-teven-complementario cursor-pointer">
                            <p class="text-xs text-gray-500 dark:text-white/40 mt-1">JPG, PNG, WEBP o GIF. Máximo 5 MB. Deja vacío para conservar la imagen actual.</p>
                        </div>

                        <!-- URL interna -->
                        <div>
                            <label for="url_interna" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">URL interna <span class="font-normal text-gray-400">(slug)</span></label>
                            <input type="text" id="url_interna" name="url_interna"
                                   value="<?= htmlspecialchars($producto['url_interna'] ?? '') ?>"
                                   placeholder="mi-producto"
                                   pattern="[a-z0-9\-]+" title="Solo letras minúsculas, números y guiones"
                                   class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100">
                            <p class="text-xs text-gray-500 dark:text-white/40 mt-1">Solo minúsculas, números y guiones. Ej: <code>curso-de-php</code>.</p>
                        </div>

                        <!-- Stripe Price ID -->
                        <div>
                            <label for="stripe_price_id" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">
                                Stripe Price ID
                                <span class="font-normal text-gray-400">(para cobro nativo)</span>
                            </label>
                            <input type="text" id="stripe_price_id" name="stripe_price_id"
                                   value="<?= htmlspecialchars($producto['stripe_price_id'] ?? '') ?>"
                                   placeholder="price_xxxxxxxxxxxx"
                                   class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100">
                            <p class="text-xs text-gray-500 dark:text-white/40 mt-1">Copia el Price ID desde el <a href="https://dashboard.stripe.com/products" target="_blank" class="underline">Dashboard de Stripe</a>. Si se rellena, el botón "Comprar" usará Stripe Checkout.</p>
                        </div>

                        <!-- Activo - ocupa cols 2-3 -->
                        <div class="lg:col-span-2 flex items-center gap-3">
                            <input type="checkbox" id="activo" name="activo" value="1"
                                   <?= !empty($producto['activo']) ? 'checked' : '' ?>
                                   class="w-5 h-5 accent-teven-secundario-2 cursor-pointer">
                            <label for="activo" class="text-teven-secundario-3 dark:text-white/70 font-bold cursor-pointer">
                                Mostrar en la tienda
                            </label>
                        </div>

                    </div>

                            <!-- Nombre -->
                            <div>
                                <label for="nombre" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">Nombre del producto *</label>
                                <input type="text" id="nombre" name="nombre" required
                                       value="<?= htmlspecialchars($producto['nombre'] ?? '') ?>"
                                       class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100">
                            </div>

                            <!-- Descripción -->
                            <div class="flex-1">
                                <label for="descripcion" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">Descripción</label>
                                <textarea id="descripcion" name="descripcion" rows="5"
                                          class="w-full h-full min-h-[120px] rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100 resize-y"><?= htmlspecialchars($producto['descripcion'] ?? '') ?></textarea>
                            </div>

                            <!-- URL interna (slug) -->
                            <div>
                                <label for="url_interna" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">URL interna <span class="font-normal text-gray-400">(slug)</span></label>
                                <input type="text" id="url_interna" name="url_interna"
                                       value="<?= htmlspecialchars($producto['url_interna'] ?? '') ?>"
                                       placeholder="mi-producto"
                                       pattern="[a-z0-9\-]+" title="Solo letras minúsculas, números y guiones"
                                       class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100">
                                <p class="text-xs text-gray-500 dark:text-white/40 mt-1">Solo minúsculas, números y guiones. Ej: <code>curso-de-php</code>.</p>
                            </div>

                    </div>

                    <div class="flex flex-col-reverse lg:flex-row justify-between gap-3 mt-6">
                        <a href="<?=ruta('admin/productos')?>"
                           class="text-center bg-gray-400 text-white py-3 px-6 rounded-lg hover:bg-gray-500 transition font-bold">
                            Cancelar
                        </a>
                        <button type="submit"
                                class="bg-teven-secundario-2 text-white py-3 px-6 rounded-lg hover:bg-teven-complementario transition font-bold">
                            Guardar cambios
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </main>
  
</body>
</html>
