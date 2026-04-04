<!DOCTYPE html>
<html lang="es" class="<?= configuracion('modo_dashboard') === 'oscuro' ? 'dark' : '' ?>">
<head>
  <meta charset="UTF-8">
  <?= $this->plantilla_admin('metas-basicas'); ?>
  <title>Agregar Diplomado</title>
</head>
<body class="bg-white dark:bg-gray-800 lg:h-screen w-screen font-inter relative lg:pl-[180px] pt-[100px]">

    <?= $this->componente_admin('header');?>
    <?= $this->componente_admin('barra-lateral');?>
  
    <main class="flex w-full h-full max-w-full max-h-full overflow px-4 lg:px-12">

        <section class="w-full flex flex-col overflow-auto items-center justify-center py-[200px] pb-[80px]">
            <div class="bg-white dark:bg-gray-800 w-full p-6 lg:p-8 rounded-xl shadow-lg border-2 border-teven-secundario-1">
                <div class="flex flex-row gap-x-4 items-center mb-6">
                    <svg class="size-[40px]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 3L2 8l10 5 10-5-10-5z" class="dark:stroke-white" stroke="#50388E" stroke-width="1.8" stroke-linejoin="round"/>
                        <path d="M2 8v8M22 8v8" class="dark:stroke-white" stroke="#50388E" stroke-width="1.8" stroke-linecap="round"/>
                        <path d="M6 10.5v5a6 6 0 0012 0v-5" class="dark:stroke-white" stroke="#50388E" stroke-width="1.8" stroke-linecap="round"/>
                    </svg>
                    <h1 class="text-xl lg:text-3xl font-bold text-teven-primario dark:text-white">Agregar diplomado</h1>
                </div>

                <?php if (!empty($mensaje)): ?>
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                        <p class="font-medium"><?= htmlspecialchars($mensaje) ?></p>
                    </div>
                <?php endif; ?>

                <form method="post" action="<?=ruta('admin/diplomados-crear')?>" enctype="multipart/form-data">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                        <!-- Título -->
                        <div>
                            <label for="titulo" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">Título * <span class="font-normal text-gray-400">(H1 de la página)</span></label>
                            <input type="text" id="titulo" name="titulo" required
                                   value="<?= htmlspecialchars($datos['titulo'] ?? '') ?>"
                                   class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100">
                        </div>

                        <!-- Slug -->
                        <div>
                            <label for="slug" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">Slug (URL interna) *</label>
                            <input type="text" id="slug" name="slug" required
                                   value="<?= htmlspecialchars($datos['slug'] ?? '') ?>"
                                   placeholder="diplomado-2025"
                                   pattern="[a-z0-9\-]+" title="Solo letras minúsculas, números y guiones"
                                   class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100">
                            <p class="text-xs text-gray-500 dark:text-white/40 mt-1">Ej: <code>/diplomado/diplomado-2025</code></p>
                        </div>

                        <!-- Generación -->
                        <div>
                            <label for="generacion" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">
                                Generación <span class="font-normal text-gray-400">(ej. 2025)</span>
                            </label>
                            <input type="text" id="generacion" name="generacion"
                                   value="<?= htmlspecialchars($datos['generacion'] ?? '') ?>"
                                   placeholder="2025"
                                   class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100">
                        </div>

                        <!-- Temario PDF -->
                        <div>
                            <label for="temario" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">
                                Temario <span class="font-normal text-gray-400">(PDF, máx 10 MB)</span>
                            </label>
                            <input type="file" id="temario" name="temario" accept=".pdf,application/pdf"
                                   class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100 file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:text-xs file:font-semibold file:bg-teven-secundario-2 file:text-white">
                        </div>

                        <!-- Imagen del temario (sección 3) -->
                        <div class="lg:col-span-2">
                            <label for="imagen_preview" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">
                                Imagen del temario <span class="font-normal text-gray-400">(preview en la sección 3, máx 5 MB — JPG, PNG, WEBP)</span>
                            </label>
                            <input type="file" id="imagen_preview" name="imagen_preview" accept="image/*"
                                   class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100 file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:text-xs file:font-semibold file:bg-teven-secundario-2 file:text-white">
                        </div>

                        <!-- Subtítulo Hero -->
                        <div class="lg:col-span-2">
                            <label for="subtitulo_hero" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">
                                Subtítulo del hero <span class="font-normal text-gray-400">(H2 debajo del título principal)</span>
                            </label>
                            <input type="text" id="subtitulo_hero" name="subtitulo_hero"
                                   value="<?= htmlspecialchars($datos['subtitulo_hero'] ?? '') ?>"
                                   placeholder="Diplomado en Servicio y Hospitalidad al paciente"
                                   class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100">
                        </div>

                        <!-- Descripción Hero -->
                        <div class="lg:col-span-2">
                            <label for="descripcion_hero" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">
                                Descripción del hero <span class="font-normal text-gray-400">(párrafo debajo del subtítulo en el hero)</span>
                            </label>
                            <textarea id="descripcion_hero" name="descripcion_hero" rows="3"
                                      class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100 resize-y"><?= htmlspecialchars($datos['descripcion_hero'] ?? '') ?></textarea>
                        </div>

                        <!-- Subtítulo Sección 2 -->
                        <div class="lg:col-span-2">
                            <label for="subtitulo" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">
                                Subtítulo sección "Sobre el Diplomado" <span class="font-normal text-gray-400">(línea en azul bajo el H2)</span>
                            </label>
                            <input type="text" id="subtitulo" name="subtitulo"
                                   value="<?= htmlspecialchars($datos['subtitulo'] ?? '') ?>"
                                   placeholder="Servicio y Hospitalidad al Paciente"
                                   class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100">
                        </div>

                        <!-- Descripción Sección 2 -->
                        <div class="lg:col-span-2">
                            <label for="descripcion" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">
                                Descripción sección "Sobre el Diplomado" <span class="font-normal text-gray-400">(párrafo principal)</span>
                            </label>
                            <textarea id="descripcion" name="descripcion" rows="4"
                                      class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100 resize-y"><?= htmlspecialchars($datos['descripcion'] ?? '') ?></textarea>
                        </div>

                        <!-- Extracto / Meta descripción SEO -->
                        <div class="lg:col-span-2">
                            <label for="extracto" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">
                                Extracto <span class="font-normal text-gray-400">(meta descripción SEO y tarjetas)</span>
                            </label>
                            <textarea id="extracto" name="extracto" rows="2"
                                      class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100 resize-y"><?= htmlspecialchars($datos['extracto'] ?? '') ?></textarea>
                        </div>

                    </div>

                    <div class="flex flex-row gap-4 mt-8">
                        <button type="submit"
                                class="rounded-lg bg-teven-secundario-2 py-3 px-8 text-white font-bold
                                       hover:bg-teven-complementario duration-200">
                            Guardar diplomado
                        </button>
                        <a href="<?=ruta('admin/diplomados')?>"
                           class="rounded-lg border-2 border-teven-secundario-2 py-3 px-8 text-teven-secundario-2 dark:text-white font-bold
                                  hover:bg-teven-secundario-2 hover:text-white duration-200">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </section>

    </main>

    <script>
    // Auto-generate slug from title
    const tituloInput = document.getElementById('titulo');
    const slugInput   = document.getElementById('slug');
    let slugManual = false;
    slugInput.addEventListener('input', () => { slugManual = true; });
    tituloInput.addEventListener('input', () => {
        if (slugManual) return;
        slugInput.value = tituloInput.value
            .toLowerCase()
            .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '');
    });
    </script>

</body>
</html>
