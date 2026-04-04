<!DOCTYPE html>
<html lang="es" class="<?= configuracion('modo_dashboard') === 'oscuro' ? 'dark' : '' ?>">
<head>
  <meta charset="UTF-8">
  <?= $this->plantilla_admin('metas-basicas'); ?>
  <title>Editar Diplomado</title>
</head>
<body class="bg-white dark:bg-gray-800 lg:h-screen w-screen font-inter relative lg:pl-[180px] pt-[100px]">

    <?= $this->componente_admin('header');?>
    <?= $this->componente_admin('barra-lateral');?>
  
    <main class="flex w-full h-full max-w-full max-h-full overflow px-4 lg:px-12">

        <section class="w-full flex flex-col overflow-auto items-center justify-center py-[200px] pb-[80px]">
            <div class="bg-white dark:bg-gray-800 w-full p-6 lg:p-8 rounded-xl shadow-lg border-2 border-teven-secundario-1">
                <div class="flex flex-row gap-x-4 items-center mb-6">
                    <svg class="size-[40px]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path class="dark:stroke-white" d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" stroke="#50388E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path class="dark:stroke-white" d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" stroke="#50388E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <h1 class="text-xl lg:text-3xl font-bold text-teven-primario dark:text-white">Editar diplomado</h1>
                </div>

                <?php if (!empty($mensaje)): ?>
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                        <p class="font-medium"><?= htmlspecialchars($mensaje) ?></p>
                    </div>
                <?php endif; ?>

                <form method="post" action="<?=ruta('admin/diplomados-editar')?>" enctype="multipart/form-data">
                    <input type="hidden" name="diplomado_id" value="<?= htmlspecialchars($diplomado['id']) ?>">

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                        <!-- Título -->
                        <div>
                            <label for="titulo" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">Título * <span class="font-normal text-gray-400">(H1 de la página)</span></label>
                            <input type="text" id="titulo" name="titulo" required
                                   value="<?= htmlspecialchars($diplomado['titulo']) ?>"
                                   class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100">
                        </div>

                        <!-- Slug -->
                        <div>
                            <label for="slug" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">Slug (URL interna) *</label>
                            <input type="text" id="slug" name="slug" required
                                   value="<?= htmlspecialchars($diplomado['slug']) ?>"
                                   pattern="[a-z0-9\-]+" title="Solo letras minúsculas, números y guiones"
                                   class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100">
                            <p class="text-xs text-gray-500 dark:text-white/40 mt-1">URL pública: <code>/diplomado/<?= htmlspecialchars($diplomado['slug']) ?></code></p>
                        </div>

                        <!-- Generación -->
                        <div>
                            <label for="generacion" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">
                                Generación <span class="font-normal text-gray-400">(ej. 2025)</span>
                            </label>
                            <input type="text" id="generacion" name="generacion"
                                   value="<?= htmlspecialchars($diplomado['generacion'] ?? '') ?>"
                                   placeholder="2025"
                                   class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100">
                        </div>

                        <!-- Temario PDF -->
                        <div>
                            <label for="temario" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">
                                Temario <span class="font-normal text-gray-400">(PDF, máx 10 MB)</span>
                            </label>
                            <?php if (!empty($diplomado['url_temario'])): ?>
                                <p class="text-xs text-gray-500 dark:text-white/40 mb-2">
                                    Archivo actual:
                                    <a href="<?= url('recursos/' . $diplomado['url_temario']) ?>" target="_blank" rel="noopener"
                                       class="text-[#0064FF] hover:underline">
                                        <?= htmlspecialchars(basename($diplomado['url_temario'])) ?>
                                    </a>
                                    — sube un nuevo PDF para reemplazarlo.
                                </p>
                            <?php endif; ?>
                            <input type="file" id="temario" name="temario" accept=".pdf,application/pdf"
                                   class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100 file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:text-xs file:font-semibold file:bg-teven-secundario-2 file:text-white">
                        </div>

                        <!-- Imagen del temario (sección 3) -->
                        <div class="lg:col-span-2">
                            <label for="imagen_preview" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">
                                Imagen del temario <span class="font-normal text-gray-400">(preview en la sección 3, máx 5 MB — JPG, PNG, WEBP)</span>
                            </label>
                            <?php if (!empty($diplomado['imagen_preview'])): ?>
                                <div class="mb-2 flex items-center gap-4">
                                    <img src="<?= url('recursos/' . $diplomado['imagen_preview']) ?>" alt="Preview actual"
                                         class="h-20 rounded shadow object-contain border border-gray-200">
                                    <p class="text-xs text-gray-500 dark:text-white/40">Imagen actual — sube una nueva para reemplazarla.</p>
                                </div>
                            <?php endif; ?>
                            <input type="file" id="imagen_preview" name="imagen_preview" accept="image/*"
                                   class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100 file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:text-xs file:font-semibold file:bg-teven-secundario-2 file:text-white">
                        </div>

                        <!-- Subtítulo Hero -->
                        <div class="lg:col-span-2">
                            <label for="subtitulo_hero" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">
                                Subtítulo del hero <span class="font-normal text-gray-400">(H2 debajo del título principal)</span>
                            </label>
                            <input type="text" id="subtitulo_hero" name="subtitulo_hero"
                                   value="<?= htmlspecialchars($diplomado['subtitulo_hero'] ?? '') ?>"
                                   placeholder="Diplomado en Servicio y Hospitalidad al paciente"
                                   class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100">
                        </div>

                        <!-- Descripción Hero -->
                        <div class="lg:col-span-2">
                            <label for="descripcion_hero" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">
                                Descripción del hero <span class="font-normal text-gray-400">(párrafo debajo del subtítulo en el hero)</span>
                            </label>
                            <textarea id="descripcion_hero" name="descripcion_hero" rows="3"
                                      class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100 resize-y"><?= htmlspecialchars($diplomado['descripcion_hero'] ?? '') ?></textarea>
                        </div>

                        <!-- Subtítulo Sección 2 -->
                        <div class="lg:col-span-2">
                            <label for="subtitulo" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">
                                Subtítulo sección "Sobre el Diplomado" <span class="font-normal text-gray-400">(línea en azul bajo el H2)</span>
                            </label>
                            <input type="text" id="subtitulo" name="subtitulo"
                                   value="<?= htmlspecialchars($diplomado['subtitulo'] ?? '') ?>"
                                   placeholder="Servicio y Hospitalidad al Paciente"
                                   class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100">
                        </div>

                        <!-- Descripción Sección 2 -->
                        <div class="lg:col-span-2">
                            <label for="descripcion" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">
                                Descripción sección "Sobre el Diplomado" <span class="font-normal text-gray-400">(párrafo principal)</span>
                            </label>
                            <textarea id="descripcion" name="descripcion" rows="4"
                                      class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100 resize-y"><?= htmlspecialchars($diplomado['descripcion'] ?? '') ?></textarea>
                        </div>

                        <!-- Extracto / Meta descripción SEO -->
                        <div class="lg:col-span-2">
                            <label for="extracto" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">
                                Extracto <span class="font-normal text-gray-400">(meta descripción SEO y tarjetas)</span>
                            </label>
                            <textarea id="extracto" name="extracto" rows="2"
                                      class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100 resize-y"><?= htmlspecialchars($diplomado['extracto'] ?? '') ?></textarea>
                        </div>

                        <!-- Activo -->
                        <div class="lg:col-span-2">
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox" name="activo" value="1" <?= $diplomado['activo'] ? 'checked' : '' ?>
                                       class="w-5 h-5 accent-teven-secundario-2">
                                <span class="text-teven-secundario-3 dark:text-white/70 font-bold">Diplomado activo (visible en el selector del navbar)</span>
                            </label>
                        </div>

                    </div>

                    <div class="flex flex-row gap-4 mt-8">
                        <button type="submit"
                                class="rounded-lg bg-teven-secundario-2 py-3 px-8 text-white font-bold
                                       hover:bg-teven-complementario duration-200">
                            Guardar cambios
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

</body>
</html>
