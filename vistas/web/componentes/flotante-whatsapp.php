<?php
$whatsapp_num = configuracion('whatsapp_num');
$whatsapp_msg = configuracion('whatsapp_msg');

// Construir URL solo si hay número configurado
if ($whatsapp_num):
    $url_whatsapp = 'https://api.whatsapp.com/send/?phone=' . urlencode($whatsapp_num);
    if ($whatsapp_msg) {
        $url_whatsapp .= '&text=' . urlencode($whatsapp_msg);
    }
?>
<!-- Componente Flotante de WhatsApp -->
<div class="fixed bottom-8 right-8 z-[100] flex items-center justify-center hover:scale-125 duration-700 hover:brightness-150 rotate-in-from-right">
    <a href="<?= $url_whatsapp ?>"
    target="_blank" rel="noopener">
        <img 
            src='<?=importAsset('logoWA.svg')?>'
            alt="WhatsApp" 
            class="size-12 rounded-full shadow-lg hover:scale-130 transition-transform duration-300 animate-scale-pulse" 
        />
    </a>

    <span class="absolute size-12 -z-10 rounded-full border-2 border-green-500/50 animate-ping-slow"></span>
</div>
<?php endif; ?>