<!DOCTYPE html>
<html lang="es" class="<?= configuracion('modo_dashboard') === 'oscuro' ? 'dark' : '' ?>">
<head>
  <?= $this->plantilla_admin('metas-basicas'); ?>
  <title>Editar Artículo</title>
  <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
  <style>
    .ql-container { font-family: inherit; font-size: 14px; height: auto !important; min-height: 280px; background: rgb(209 213 219); border-bottom-left-radius: 0.5rem; border-bottom-right-radius: 0.5rem; position: relative; z-index: 0; }
    .ql-editor    { height: auto !important; min-height: 280px; }
    .ql-toolbar   { background: rgb(229 231 235); border-top-left-radius: 0.5rem; border-top-right-radius: 0.5rem; }
    .dark .ql-container { background: rgb(55 65 81); color: white; }
    .dark .ql-toolbar   { background: rgb(75 85 99); }
    .dark .ql-toolbar .ql-stroke { stroke: #e5e7eb; }
    .dark .ql-toolbar .ql-fill   { fill: #e5e7eb; }
    .dark .ql-toolbar .ql-picker  { color: #e5e7eb; }
  </style>
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
                    <h1 class="text-xl lg:text-3xl font-bold text-teven-primario dark:text-white">Editar artículo</h1>
                </div>

                <?php if (!empty($mensaje)): ?>
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                        <p class="font-medium"><?= htmlspecialchars($mensaje) ?></p>
                    </div>
                <?php endif; ?>

                <form method="post" action="<?=ruta('admin/blog-editar')?>" enctype="multipart/form-data">
                    <input type="hidden" name="articulo_id" value="<?= htmlspecialchars($articulo['id']) ?>">

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                        <!-- Título -->
                        <div>
                            <label for="titulo" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">Título *</label>
                            <input type="text" id="titulo" name="titulo" required
                                   value="<?= htmlspecialchars($articulo['titulo']) ?>"
                                   class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100">
                        </div>

                        <!-- Slug -->
                        <div>
                            <label for="slug" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">Slug (URL interna) *</label>
                            <input type="text" id="slug" name="slug" required
                                   value="<?= htmlspecialchars($articulo['slug']) ?>"
                                   pattern="[a-z0-9\-]+" title="Solo letras minúsculas, números y guiones"
                                   class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100">
                            <p class="text-xs text-gray-500 dark:text-white/40 mt-1">URL pública: <code>/blog/<?= htmlspecialchars($articulo['slug']) ?></code></p>
                        </div>

                        <!-- Imagen actual / subir portada -->
                        <?php if (!empty($articulo['imagen_url'])): ?>
                        <div class="lg:col-span-2">
                            <p class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">Imagen actual</p>
                            <div class="flex items-center gap-4">
                                <img src="<?= url($articulo['imagen_url']) ?>"
                                     alt="Imagen del artículo"
                                     class="h-24 w-40 object-cover rounded-lg">
                                <label class="flex items-center gap-2 text-sm text-red-600 dark:text-red-400 cursor-pointer">
                                    <input type="checkbox" name="borrar_imagen" value="1">
                                    Eliminar imagen actual
                                </label>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="lg:col-span-2">
                            <label for="imagen" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">
                                <?= !empty($articulo['imagen_url']) ? 'Reemplazar imagen' : 'Imagen de portada' ?>
                            </label>
                            <input type="file" id="imagen" name="imagen" accept="image/jpeg,image/png,image/webp,image/gif"
                                   class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100 file:mr-4 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teven-secundario-2 file:text-white hover:file:bg-teven-complementario cursor-pointer">
                            <p class="text-xs text-gray-500 dark:text-white/40 mt-1">JPG, PNG, WEBP o GIF. Máximo 5 MB.</p>
                        </div>

                        <!-- Extracto -->
                        <div class="lg:col-span-2">
                            <label for="extracto" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">Extracto <span class="font-normal text-gray-400">(resumen corto para las tarjetas del blog)</span></label>
                            <textarea id="extracto" name="extracto" rows="3"
                                      class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100 resize-y"><?= htmlspecialchars($articulo['extracto'] ?? '') ?></textarea>
                        </div>

                        <!-- Contenido -->
                        <div class="lg:col-span-2">
                            <label class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">Contenido</label>
                            <div id="quill-editor"></div>
                            <textarea id="contenido" name="contenido" class="hidden"><?= htmlspecialchars($articulo['contenido'] ?? '') ?></textarea>
                        </div>

                        <!-- Activo -->
                        <div class="lg:col-span-2">
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox" name="activo" value="1" <?= $articulo['activo'] ? 'checked' : '' ?>
                                       class="w-5 h-5 accent-teven-secundario-2">
                                <span class="text-teven-secundario-3 dark:text-white/70 font-bold">Artículo activo (visible en el blog público)</span>
                            </label>
                        </div>

                    </div>

                    <div class="flex flex-row gap-4 mt-8">
                        <button type="submit"
                                class="rounded-lg bg-teven-secundario-2 py-3 px-8 text-white font-bold
                                       hover:bg-teven-complementario duration-200">
                            Guardar cambios
                        </button>
                        <a href="<?=ruta('admin/blog')?>"
                           class="rounded-lg border-2 border-teven-secundario-2 py-3 px-8 text-teven-secundario-2 dark:text-white font-bold
                                  hover:bg-teven-secundario-2 hover:text-white duration-200">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </section>

    </main>

    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <script>
    const quill = new Quill('#quill-editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                ['link', 'blockquote'],
                ['clean']
            ]
        }
    });

    // Pre-fill with existing content
    const existingContent = document.getElementById('contenido').value;
    if (existingContent) quill.clipboard.dangerouslyPasteHTML(existingContent);

    // On submit, copy HTML to hidden textarea
    document.querySelector('form').addEventListener('submit', function () {
        document.getElementById('contenido').value = quill.root.innerHTML;
    });
    </script>

</body>
</html>
