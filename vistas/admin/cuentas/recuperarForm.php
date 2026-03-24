<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar</title>
    <link href="<?=importAsset('tailwind/output.css'); ?>" rel="stylesheet">
</head>
<body class="bg-azulDefault flex items-center justify-center h-screen">
    <form method="post" action="<?=ruta('recuperar-cuenta')?>"
    class="bg-white p-8 rounded-xl shadow-md text-azulDefault flex flex-col justify-items-center">
        <h1 class="text-4xl font-bold text-center">
            Recibe un email para<br>cambiar tu contraseña
        </h1>
        <div class="flex flex-row items-center justify-center space-x-12 text-2xl my-12">
            <div class="flex flex-col items-center justify-center hover:underline hover:font-bold">
                <label for="email" class="mb-3">Buscar por email</label>
                <input name="email" id="email" class="w-[263px] px-2 rounded-xl text-azulOscuro no-underline font-normal border-2 border-azulDefault"
                type="email" oninput="clearOtherField('email')">
            </div>
            
            <div class="flex flex-col items-center justify-center hover:underline hover:font-bold">
                <label for="user" class="mb-3">Buscar por usuario</label>
                <input name="user" id="user" class="w-[230px] px-2 rounded-xl text-azulOscuro no-underline font-normal border-2 border-azulDefault"
                type="text" oninput="clearOtherField('user')">
            </div>
        </div>
        <button type="submit" class="h-[70px] px-8 text-center text-white rounded-xl text-3xl font-bold bg-azulDefault
        hover:bg-azulActivo hover:text-4xl transition-all transform duration-500">
            Send email
        </button>
        <label class="w-full text-center text-red-500 my-4 h-6"><?=isset($mensaje)?$mensaje:""?></label>
        <a class="text-lg hover:text-azulActivo cursor-pointer hover:underline" href="<?=ruta('login')?>">Volver al inicio de sesión</a>
    </form>

    <script>
        function clearOtherField(field) {
            if (field === 'email') {
                document.getElementById('user').value = '';
            } else if (field === 'user') {
                document.getElementById('email').value = '';
            }
        }
    </script>
</body>
</html>