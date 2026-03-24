<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar</title>
    <link href="<?=importAsset('tailwind/output.css'); ?>" rel="stylesheet">
</head>
<body class="bg-azulDefault flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center">
            <?php if (isset($mensaje)): ?>
                <label><?= htmlspecialchars($mensaje); ?></label>
            <?php endif; ?>
        </h1>
        <a href="<?=ruta('login')?>" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-xl shadow-sm 
            text-xl font-bold text-white bg-azulDefault hover:azulActivo transition-all duration-500 hover:text-white
            focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Volver
        </a>
    </div>
</body>
</html>