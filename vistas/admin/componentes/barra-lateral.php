<?php
$menuItems = [
    ['id' => 'resultados', 'label' => 'Resultados', 'ruta' => 'admin/resultados'],
    ['id' => 'landings', 'label' => 'Landings', 'ruta' => 'admin/landings'],
    ['id' => 'leads', 'label' => 'Leads', 'ruta' => 'admin/leads'],
    ['id' => 'configuraciones', 'label' => 'Configuraciones', 'ruta' => 'admin/configuraciones']
];
?>
<aside id="menu-admin" class="fixed left-0 z-[90] top-[100px] h-full w-[180px] bg-gradient-to-b from-teven-secundario-3 from-[40%] to-[#7148c9] flex flex-col font-inter shadow-2xl shadow-black/40
    -translate-x-[100%] lg:translate-x-0 duration-300">
    <div class="h-fit text-white flex flex-col group relative text-base">
        <?php foreach ($menuItems as $item): ?>
            <a class="<?= ($USUARIO['seleccionado'] === $item['id']) 
                ? 'py-8 bg-teven-complementario group-hover:py-6 hover:group-hover:py-8 font-medium text-xl' 
                : 'py-6 hover:bg-teven-complementario hover:py-8' ?> 
                px-4 border-b border-white hover:underline duration-200 z-20 hover:z-30 hover:shadow-2xl shadow-black"
                href="<?= ruta($item['ruta']) ?>">
                <?= $item['label'] ?>
            </a>
        <?php endforeach; ?>
    </div>
</aside>