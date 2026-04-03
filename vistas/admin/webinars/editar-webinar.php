<!DOCTYPE html>
<html lang="es" class="<?= configuracion('modo_dashboard') === 'oscuro' ? 'dark' : '' ?>">
<head>
  <?= $this->plantilla_admin('metas-basicas'); ?>
  <title>Editar Webinar</title>
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
                    <h1 class="text-xl lg:text-3xl font-bold text-teven-primario dark:text-white">Editar webinar</h1>
                </div>

                <?php if (!empty($mensaje)): ?>
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                        <p class="font-medium"><?= htmlspecialchars($mensaje) ?></p>
                    </div>
                <?php endif; ?>

                <form method="post" action="<?=ruta('admin/webinars-editar')?>">
                    <input type="hidden" name="webinar_id" value="<?= htmlspecialchars($webinar['id']) ?>">

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                        <!-- Título -->
                        <div>
                            <label for="titulo" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">Título *</label>
                            <input type="text" id="titulo" name="titulo" required
                                   value="<?= htmlspecialchars($webinar['titulo']) ?>"
                                   class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100">
                        </div>

                        <!-- Slug -->
                        <div>
                            <label for="slug" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">Slug (URL interna) *</label>
                            <input type="text" id="slug" name="slug" required
                                   value="<?= htmlspecialchars($webinar['slug']) ?>"
                                   pattern="[a-z0-9\-]+" title="Solo letras minúsculas, números y guiones"
                                   class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100">
                            <p class="text-xs text-gray-500 dark:text-white/40 mt-1">URL pública: <code>/webinars/<?= htmlspecialchars($webinar['slug']) ?></code></p>
                        </div>

                        <!-- Link YouTube -->
                        <div class="lg:col-span-2">
                            <label for="link_youtube" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">
                                Link de YouTube <span class="font-normal text-gray-400">(trailer del video)</span>
                            </label>
                            <input type="url" id="link_youtube" name="link_youtube"
                                   value="<?= htmlspecialchars($webinar['link_youtube'] ?? '') ?>"
                                   placeholder="https://www.youtube.com/watch?v=..."
                                   class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100">
                            <p class="text-xs text-gray-500 dark:text-white/40 mt-1">
                                Acepta: youtube.com/watch?v=..., youtu.be/..., youtube.com/embed/...
                            </p>
                            <div id="yt-preview" class="mt-3 <?= empty($webinar['link_youtube']) ? 'hidden' : '' ?>">
                                <p class="text-xs text-gray-500 dark:text-white/40 mb-1">Preview del thumbnail:</p>
                                <?php $ytIdActual = Controlador_Webinars::extraerYoutubeId($webinar['link_youtube'] ?? ''); ?>
                                <img id="yt-thumb"
                                     src="<?= $ytIdActual ? 'https://img.youtube.com/vi/' . htmlspecialchars($ytIdActual) . '/hqdefault.jpg' : '' ?>"
                                     alt="YouTube thumbnail"
                                     class="h-24 rounded-lg object-cover border border-gray-300">
                            </div>
                        </div>

                        <!-- Extracto -->
                        <div class="lg:col-span-2">
                            <label for="extracto" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">
                                Extracto <span class="font-normal text-gray-400">(resumen corto para las tarjetas)</span>
                            </label>
                            <textarea id="extracto" name="extracto" rows="3"
                                      class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 dark:focus:ring-teven-complementario duration-100 resize-y"><?= htmlspecialchars($webinar['extracto'] ?? '') ?></textarea>
                        </div>

                        <!-- Activo -->
                        <div class="lg:col-span-2">
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox" name="activo" value="1" <?= $webinar['activo'] ? 'checked' : '' ?>
                                       class="w-5 h-5 accent-teven-secundario-2">
                                <span class="text-teven-secundario-3 dark:text-white/70 font-bold">Webinar activo (visible en la página pública)</span>
                            </label>
                        </div>

                    </div>

                    <div class="flex flex-row gap-4 mt-8">
                        <button type="submit"
                                class="rounded-lg bg-teven-secundario-2 py-3 px-8 text-white font-bold
                                       hover:bg-teven-complementario duration-200">
                            Guardar cambios
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
    </script>
</body>
</html>
