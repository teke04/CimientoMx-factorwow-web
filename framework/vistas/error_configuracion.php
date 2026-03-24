<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error de Configuración</title>
    <link href="<?=importAsset('tailwind/output.css'); ?>" rel="stylesheet">
    <style>
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }
        .animate-shake {
            animation: shake 0.5s ease-in-out;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-teven-primario to-teven-secundario-2 min-h-screen flex items-center justify-center p-4 lg:p-8">
    
    <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full overflow-hidden">
        
        <!-- Header -->
        <div class="bg-gradient-to-r from-red-500 to-red-600 text-white px-8 py-10 text-center">
            <div class="text-7xl mb-4 animate-shake">⚠️</div>
            <h1 class="text-3xl lg:text-4xl font-bold mb-3">Error de Configuración</h1>
            <p class="text-lg opacity-90">Se detectaron problemas en la configuración del sistema</p>
        </div>
        
        <!-- Body -->
        <div class="px-8 py-10">
            
            
            <!-- Error List -->
            <div class="bg-red-50 border-l-4 border-red-500 rounded-xl p-6 mb-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-red-700 text-xl font-bold flex items-center gap-3">
                        <span>🔍 Errores Detectados</span>
                    </h3>
                    <span class="bg-white text-red-600 px-4 py-1 rounded-full text-sm font-bold shadow-sm">
                        <?php echo count($errores); ?>
                    </span>
                </div>
                
                <ul class="space-y-3">
                    <?php foreach ($errores as $error): ?>
                        <li class="text-red-800 font-mono text-sm bg-white/50 px-4 py-3 rounded-lg border border-red-200 flex items-start gap-3">
                            <span class="text-red-500 font-bold text-lg flex-shrink-0">→</span>
                            <span class="leading-relaxed"><?php echo htmlspecialchars($error); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
            <!-- Instructions -->
            <div class="bg-teven-primario/5 border border-teven-primario/20 rounded-xl p-6">
                <h4 class="text-teven-primario font-bold text-lg mb-3 flex items-center gap-2">
                    💡 ¿Cómo solucionar?
                </h4>
                <ol class="space-y-2 text-gray-700 ml-6 list-decimal">
                    <li>Abra el archivo <code class="bg-gray-200 px-2 py-1 rounded text-sm font-mono">config.php</code> en su editor</li>
                    <li>Corrija cada uno de los errores listados arriba</li>
                    <li>Guarde los cambios y recargue esta página</li>
                </ol>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="bg-gray-50 px-8 py-6 border-t border-gray-200 text-center">
            <p class="text-gray-600 text-sm">
                Una vez corregidos los errores, recargue la página para continuar. Si necesita ayuda, consulte la 
                <a href="#" class="text-teven-primario hover:text-teven-secundario-2 font-semibold underline">documentación</a>.
            </p>
        </div>
        
    </div>
    
</body>
</html>
