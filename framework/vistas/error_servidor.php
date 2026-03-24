<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 500 - Error Interno del Servidor</title>
    <link href="<?=importAsset('tailwind/output.css'); ?>" rel="stylesheet">
    <style>
        @keyframes pulse-error {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        .animate-pulse-error {
            animation: pulse-error 2s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-teven-primario to-teven-secundario-2 min-h-screen flex items-center justify-center p-4 lg:p-8">
    
    <div class="bg-white rounded-2xl shadow-2xl max-w-[1400px] w-full overflow-hidden">
        
        <!-- Header -->
        <div class="bg-gradient-to-r from-red-600 to-red-900 text-white px-8 py-6 text-center">
            <h1 class="text-3xl lg:text-4xl font-bold mb-3">Error 500</h1>
            <p class="text-lg opacity-90">Error Interno del Servidor</p>
        </div>
        
        <!-- Body -->
        <div class="p-6">
            
 
            
            <?php if (isset($modo_debug) && $modo_debug): ?>
                        <?php if (isset($error_log_creado)): ?>
                        <div class="mb-4 flex gap-4">
                            <div class="w-1/2">
                                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-2 rounded-lg text-sm font-semibold text-center flex items-center justify-center gap-2">
                                    <?php if ($error_log_creado): ?>
                                        <span class="inline-block align-middle">&#10003;</span>
                                        <span>El error ha sido registrado en el log del sistema.</span>
                                    <?php else: ?>
                                        <span class="inline-block align-middle">&#10007;</span>
                                        <span>No se pudo registrar el error en el log del sistema.</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="w-1/2">
                                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-2 rounded-lg text-sm font-semibold text-center flex items-center justify-center gap-2">
                                    <?php if (isset($error_mail_enviado) && $error_mail_enviado): ?>
                                        <span class="inline-block align-middle">&#10003;</span>
                                        <span>Se envió el correo de reporte del error.</span>
                                    <?php else: ?>
                                        <span class="inline-block align-middle">&#10007;</span>
                                        <span>No se envió el correo de reporte del error.</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
            <!-- Debug Info -->
            <div class="bg-red-50 border-l-4 border-red-500 rounded-xl p-6 ">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-red-700 text-xl font-bold flex items-center gap-3">
                        <span>Información del error</span>
                    </h3>
                    <span class="bg-white text-red-600 px-4 py-1 rounded-full text-sm font-bold shadow-sm">
                        Modo Desarrollo
                    </span>
                </div>
                
                <?php if (isset($error_mensaje)): ?>
                <div class="mb-6">
                    <h4 class="text-red-700 font-bold text-sm mb-2 uppercase tracking-wide">Mensaje:</h4>
                    <div class="bg-white border border-red-200 rounded-lg p-4">
                        <pre class="text-red-800 font-mono text-sm whitespace-pre-wrap break-words"><?php echo htmlspecialchars($error_mensaje); ?></pre>
                    </div>
                </div>
                <?php endif; ?>
                
                <?php if (isset($error_archivo) && isset($error_linea)): ?>
                <div class="mb-6">
                    <h4 class="text-red-700 font-bold text-sm mb-2 uppercase tracking-wide">Ubicación:</h4>
                    <div class="bg-white border border-red-200 rounded-lg p-4">
                        <p class="text-gray-700 font-mono text-sm">
                            <span class="text-red-600 font-bold">Archivo:</span> <?php echo htmlspecialchars($error_archivo); ?><br>
                            <span class="text-red-600 font-bold">Línea:</span> <?php echo htmlspecialchars($error_linea); ?>
                        </p>
                    </div>
                </div>
                <?php endif; ?>
                
                <?php if (isset($error_trace)): ?>
                <div class="mb-0">
                    <h4 class="text-red-700 font-bold text-sm mb-3 uppercase tracking-wide">Pila de errores:</h4>
                    <div class="space-y-3">
                        <?php 
                        // Usar el array $error_trace_array si está disponible
                        $traceItems = isset($error_trace_array) ? $error_trace_array : [];
                        $totalItems = count($traceItems);
                        foreach ($traceItems as $i => $item):
                            $isFirst = ($i === 0);
                            $isLast = ($i === $totalItems - 1);
                        ?>
                        <div class="relative">
                            <!-- Línea conectora -->
                            <?php if (!$isLast): ?>
                            <div class="absolute left-6 top-full h-3 w-0.5 bg-red-300"></div>
                            <?php endif; ?>
                            <!-- Caja del trace -->
                            <div class="bg-white border-2 <?php echo $isFirst ? 'border-red-500' : 'border-red-200'; ?> rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex items-start gap-3">
                                    <!-- Número -->
                                    <div class="flex-shrink-0">
                                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full <?php echo $isFirst ? 'bg-red-500 text-white' : 'bg-red-100 text-red-700'; ?> font-bold text-sm">
                                            <?php echo $isFirst ? '!' : ($totalItems - $i); ?>
                                        </span>
                                    </div>
                                    <!-- Contenido -->
                                    <div class="flex-1 min-w-0">
                                        <?php if ($isFirst): ?>
                                        <div class="mb-2">
                                            <span class="inline-block bg-red-100 text-red-700 text-xs font-bold px-2 py-1 rounded uppercase">
                                                Error Inicial
                                            </span>
                                        </div>
                                        <?php endif; ?>
                                        <!-- Función -->
                                        <div class="mb-2">
                                            <code class="text-gray-800 font-mono text-sm font-semibold break-all">
                                                <?php echo isset($item['function']) ? htmlspecialchars($item['function']) : ''; ?>
                                            </code>
                                        </div>
                                        <!-- Archivo y línea -->
                                        <?php if (isset($item['file']) && isset($item['line'])): ?>
                                        <div class="text-xs text-gray-600 space-y-1">
                                            <div class="flex items-center gap-2">
                                                <span class="text-gray-500">📄</span>
                                                <span class="font-mono break-all"><?php echo htmlspecialchars($item['file']); ?></span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span class="text-gray-500">📍</span>
                                                <span class="font-mono">Línea: <?php echo htmlspecialchars($item['line']); ?></span>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <?php if (empty($traceItems)): ?>
                        <div class="bg-gray-100 rounded-lg p-4 text-gray-600 text-center text-sm">
                            No hay información de stack trace disponible
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <?php else: ?>
            <!-- Production Info -->
            <div class="bg-teven-primario/5 border border-teven-primario/20 rounded-xl p-6">
                <h4 class="text-teven-primario font-bold text-lg mb-3 flex items-center gap-2">
                    💡 ¿Qué puedes hacer?
                </h4>
                <ul class="space-y-2 text-gray-700 ml-6 list-disc">
                    <li>Intenta recargar la página en unos momentos</li>
                    <li>Verifica tu conexión a internet</li>
                    <li>Si el problema persiste, contacta con soporte</li>
                </ul>
            </div>
            <?php endif; ?>
            
        </div>
        

        
    </div>
    
</body>
</html>
