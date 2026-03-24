<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar</title>
    <link href="<?=importAsset('tailwind/output.css'); ?>" rel="stylesheet">
</head>
<body class="bg-teven-primario flex flex-col items-center justify-center h-screen font-inter">

    <div class="bg-white rounded-md shadow-2xl shadow-black/50 flex flex-row max-w-[800px]">

        <div class="w-1/2 h-full flex items-center justify-center p-8">
            <img src="<?=importAsset('imgs/logo.png')?>" alt="Logo" class="object-fit">
        </div>

        <div class="w-1/2 h-full flex flex-col p-8">
            <h1 class="text-2xl font-bold text-teven-secundario-3">Panel de administrador</h1>

            <form action="<?=ruta('login')?>" method="post" class="mt-4 flex flex-col w-full gap-y-4 h-full">

                <div>
                    <label for="username" class="font-semibold text-md">Usuario:</label>
                    <input type="text" id="username" name="username" required 
                        class="mt-2 w-full rounded-lg px-4 py-2 text-sm bg-gray-300 bg
                           outline-none focus:ring-2 focus:ring-teven-secundario-2 duration-100">
                </div>

                <div>
                    <label for="password" class="font-semibold text-md">Contraseña:</label>
                    <input type="password" id="password" name="password" required 
                        class="mt-2 w-full rounded-lg px-4 py-2 text-sm bg-gray-300
                            outline-none focus:ring-2 focus:ring-teven-secundario-2 duration-100">
                </div>

                <div class="h-full">
                    <p class="text-red-500 text-sm font-bold">
                        <?= isset($mensaje) ? htmlspecialchars($mensaje) : ''; ?>
                    </p>
                </div>

                <button type="submit" class="w-full rounded-lg bg-teven-secundario-3 py-2 text-white font-bold
                    hover:bg-teven-secundario-2 duration-200">
                    Iniciar sesión 
                </button>
                
                <a href="<?=ruta('recuperar-cuenta')?>" class="text-center text-sm
                hover:underline hover:text-azulActivo duration-300 hidden">
                    Olvide mi contraseña
                </a>
            </div>   
            </form>

        </div>

    </div>

    <!-- Etiqueta de agencia -->
    <div class="fixed bottom-4 left-4 text-white/70 text-sm font-mono">
        Diseñado por <?= env('AGENCIA', 'Agencia') ?>
    </div>

    <!-- Etiqueta de versión -->
    <div class="fixed bottom-4 right-4 text-white/70 text-sm font-mono">
        Soren Framework v3.0.0
    </div>
</body>
</html>