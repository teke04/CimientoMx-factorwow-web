<!DOCTYPE html>
<html lang="ES">
<?php
$titulo = '¡Pago exitoso! - ' . env('EMPRESA');
?>
<head>
    <?php $this->plantilla('metas-basicas') ?>
    <?php $this->plantilla('estilos') ?>
    <title><?= $titulo ?></title>
    <meta name="robots" content="noindex, nofollow">
    <?= configuracion('tag_manager_head') ?>
</head>
<body class="w-screen overflow-x-clip">
    <?= configuracion('tag_manager_body') ?>
    <main>
        <?php $this->componente('navbar'); ?>

        <section class="w-screen min-h-screen flex items-center justify-center pt-[100px] pb-[60px] px-4"
                 style="background: linear-gradient(135deg, #553CC8 0%, #FF3D81 100%);">
            <div class="bg-white rounded-[30px] shadow-2xl max-w-[560px] w-full px-10 py-14 flex flex-col items-center gap-6 text-center">

                <!-- Ícono ✓ -->
                <div class="w-[80px] h-[80px] rounded-full flex items-center justify-center"
                     style="background: linear-gradient(135deg, #553CC8 0%, #FF3D81 100%);">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>

                <h1 class="font-montserrat font-extrabold text-[32px] text-[#553CC8] leading-tight">
                    ¡Pago completado!
                </h1>

                <?php if (!empty($pedido)): ?>
                <p class="font-montserrat text-[16px] text-[#4B4B4B] leading-relaxed">
                    Gracias por tu compra de <strong><?= htmlspecialchars($pedido['producto_nombre']) ?></strong>.
                    <?php if (!empty($pedido['email'])): ?>
                        Recibirás un correo de confirmación en
                        <strong><?= htmlspecialchars($pedido['email']) ?></strong>.
                    <?php else: ?>
                        En breve recibirás un correo de confirmación con los detalles de tu pedido.
                    <?php endif; ?>
                </p>
                <?php else: ?>
                <p class="font-montserrat text-[16px] text-[#4B4B4B] leading-relaxed">
                    Tu pago fue procesado exitosamente. Recibirás un correo de confirmación en breve.
                </p>
                <?php endif; ?>

                <a href="<?= ruta('tienda') ?>"
                   class="mt-4 inline-block px-10 py-3 rounded-full font-montserrat font-semibold text-white text-[16px] hover:opacity-90 transition-opacity duration-200"
                   style="background: linear-gradient(90deg, #553CC8 0%, #FF3D81 100%);">
                    Seguir explorando
                </a>
            </div>
        </section>

        <?php $this->componente('footer'); ?>
    </main>
</body>
</html>
