<!DOCTYPE html>
<html lang="es" class="<?= configuracion('modo_dashboard') === 'oscuro' ? 'dark' : '' ?>">
<head>
  <?= $this->plantilla_admin('metas-basicas'); ?>
  <title>Agregar Webinar</title>
</head>
<body class="bg-white dark:bg-gray-800 lg:h-screen w-screen font-inter relative lg:pl-[180px] pt-[100px]">

    <?= $this->componente_admin('header');?>
    <?= $this->componente_admin('barra-lateral');?>
  
    <main class="flex w-full h-full max-w-full max-h-full overflow px-4 lg:px-12">

        <section class="w-full flex flex-col overflow-auto items-center justify-center py-[200px] pb-[80px]">
            <div class="bg-white dark:bg-gray-800 w-full p-6 lg:p-8 rounded-xl shadow-lg border-2 border-teven-secundario-1">
                <div class="flex flex-row gap-x-4 items-center mb-6">
                    <svg class="size-[40px]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="2" y="5" width="20" height="14" rx="3" class="dark:stroke-white" stroke="#50388E" stroke-width="1.91"/>
                        <path d="M9.5 9.5l5 2.5-5 2.5V9.5z" class="dark:stroke-white dark:fill-white" stroke="#50388E" stroke-width="1.5" fill="#50388E"/>
                    </svg>
                    <h1 class="text-xl lg:text-3xl font-bold text-teven-primario dark:text-white">Agregar webinar</h1>
                </div>

                <?php if (!empty($mensaje)): ?>
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                        <p class="font-medium"><?= htmlspecialchars($mensaje) ?></p>
                    </div>
                <?php endif; ?>

                <form method="post" action="<?=ruta('admin/webinars-crear')?>">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                        <!-- Título -->
                        <div>
                            <label for="titulo" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">Título *</label>
                            <input type="text" id="titulo" name="titulo" required
                                   value="<?= htmlspecialchars($datos['titulo'] ?? '') ?>"
                                   class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100">
                        </div>

                        <!-- Slug -->
                        <div>
                            <label for="slug" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">Slug (URL interna) *</label>
                            <input type="text" id="slug" name="slug" required
                                   value="<?= htmlspecialchars($datos['slug'] ?? '') ?>"
                                   placeholder="mi-webinar"
                                   pattern="[a-z0-9\-]+" title="Solo letras minúsculas, números y guiones"
                                   class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100">
                            <p class="text-xs text-gray-500 dark:text-white/40 mt-1">Solo minúsculas, números y guiones. <code>/webinars/mi-webinar</code></p>
                        </div>

                        <!-- Link YouTube -->
                        <div class="lg:col-span-2">
                            <label for="link_youtube" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">
                                Link de YouTube <span class="font-normal text-gray-400">(trailer del video)</span>
                            </label>
                            <input type="url" id="link_youtube" name="link_youtube"
                                   value="<?= htmlspecialchars($datos['link_youtube'] ?? '') ?>"
                                   placeholder="https://www.youtube.com/watch?v=..."
                                   class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100">
                            <p class="text-xs text-gray-500 dark:text-white/40 mt-1">
                                Acepta: youtube.com/watch?v=..., youtu.be/..., youtube.com/embed/...
                            </p>
                            <!-- Preview -->
                            <div id="yt-preview" class="mt-3 hidden">
                                <p class="text-xs text-gray-500 dark:text-white/40 mb-1">Preview del thumbnail:</p>
                                <img id="yt-thumb" src="" alt="YouTube thumbnail"
                                     class="h-24 rounded-lg object-cover border border-gray-300">
                            </div>
                        </div>

                        <!-- Extracto -->
                        <div class="lg:col-span-2">
                            <label for="extracto" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">
                                Extracto <span class="font-normal text-gray-400">(resumen corto para las tarjetas)</span>
                            </label>
                            <textarea id="extracto" name="extracto" rows="3"
                                      class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100 resize-y"><?= htmlspecialchars($datos['extracto'] ?? '') ?></textarea>
                        </div>

                    </div>

                    <div class="flex flex-row gap-4 mt-8">
                        <button type="submit"
                                class="rounded-lg bg-teven-secundario-2 py-3 px-8 text-white font-bold
                                       hover:bg-teven-complementario duration-200">
                            Guardar webinar
                        </button>
                        <a href="<?=ruta('admin/webinars')?>"
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

    // YouTube thumbnail preview
    function extractYtId(url) {
        const m = url.match(/(?:youtube\.com\/(?:watch\?(?:.*&)?v=|embed\/|v\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/);
        return m ? m[1] : null;
    }
    const ytInput   = document.getElementById('link_youtube');
    const ytPreview = document.getElementById('yt-preview');
    const ytThumb   = document.getElementById('yt-thumb');
    ytInput.addEventListener('input', () => {
        const id = extractYtId(ytInput.value);
        if (id) {
            ytThumb.src = 'https://img.youtube.com/vi/' + id + '/hqdefault.jpg';
            ytPreview.classList.remove('hidden');
        } else {
            ytPreview.classList.add('hidden');
        }
    });
    // Show preview on load if value present
    if (ytInput.value) ytInput.dispatchEvent(new Event('input'));
    </script>
</body>
</html>
