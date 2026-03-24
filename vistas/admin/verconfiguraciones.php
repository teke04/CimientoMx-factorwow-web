<!DOCTYPE html>
<html lang="es" class="<?= configuracion('modo_dashboard') === 'oscuro' ? 'dark' : '' ?>">
<head>
  <?= $this->plantilla_admin('metas-basicas'); ?>
  <title>Panel de Administración</title>
</head>
<body class="bg-white dark:bg-gray-800 h-screen w-screen font-inter relative lg:pl-[180px] pt-[100px]">

    <?= $this->componente_admin('header');?>
    <?= $this->componente_admin('barra-lateral');?>
  
    <main class="flex w-full h-full max-w-full max-h-full overflow-clip p-4 lg:p-12">
      
        <!-- Sección de contenido -->
        <section class="w-full flex flex-col overflow-auto">
            <div class="w-full p-6 lg:p-8">
                <div class="flex flex-row gap-x-4 items-center mb-6">
                    <svg class="size-[40px]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                      <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                      <g id="SVGRepo_iconCarrier">
                        <path class="dark:stroke-white" d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" stroke="#50388E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path class="dark:stroke-white" d="M18.7273 14.7273C18.6063 15.0015 18.5702 15.3056 18.6236 15.6005C18.6771 15.8954 18.8177 16.1676 19.0273 16.3818L19.0818 16.4364C19.2509 16.6052 19.385 16.8057 19.4765 17.0265C19.568 17.2472 19.6151 17.4838 19.6151 17.7227C19.6151 17.9617 19.568 18.1983 19.4765 18.419C19.385 18.6397 19.2509 18.8402 19.0818 19.0091C18.913 19.1781 18.7124 19.3122 18.4917 19.4037C18.271 19.4952 18.0344 19.5423 17.7955 19.5423C17.5565 19.5423 17.3199 19.4952 17.0992 19.4037C16.8785 19.3122 16.678 19.1781 16.5091 19.0091L16.4545 18.9545C16.2403 18.745 15.9682 18.6044 15.6733 18.5509C15.3784 18.4974 15.0742 18.5335 14.8 18.6545C14.5311 18.7698 14.3018 18.9611 14.1403 19.205C13.9788 19.4489 13.8921 19.7347 13.8909 20.0273V20.1818C13.8909 20.664 13.6994 21.1265 13.3584 21.4675C13.0174 21.8084 12.5549 22 12.0727 22C11.5905 22 11.1281 21.8084 10.7871 21.4675C10.4461 21.1265 10.2545 20.664 10.2545 20.1818V20.1C10.2475 19.7991 10.1501 19.5073 9.97501 19.2625C9.79991 19.0176 9.55521 18.8312 9.27273 18.7273C8.99853 18.6063 8.69437 18.5702 8.39947 18.6236C8.10456 18.6771 7.83244 18.8177 7.61818 19.0273L7.56364 19.0818C7.39478 19.2509 7.19425 19.385 6.97353 19.4765C6.7528 19.568 6.51621 19.6151 6.27727 19.6151C6.03834 19.6151 5.80174 19.568 5.58102 19.4765C5.36029 19.385 5.15977 19.2509 4.99091 19.0818C4.82186 18.913 4.68775 18.7124 4.59626 18.4917C4.50476 18.271 4.45766 18.0344 4.45766 17.7955C4.45766 17.5565 4.50476 17.3199 4.59626 17.0992C4.68775 16.8785 4.82186 16.678 4.99091 16.5091L5.04545 16.4545C5.25503 16.2403 5.39562 15.9682 5.4491 15.6733C5.50257 15.3784 5.46647 15.0742 5.34545 14.8C5.23022 14.5311 5.03887 14.3018 4.79497 14.1403C4.55107 13.9788 4.26526 13.8921 3.97273 13.8909H3.81818C3.33597 13.8909 2.87351 13.6994 2.53253 13.3584C2.19156 13.0174 2 12.5549 2 12.0727C2 11.5905 2.19156 11.1281 2.53253 10.7871C2.87351 10.4461 3.33597 10.2545 3.81818 10.2545H3.9C4.2009 10.2475 4.49273 10.1501 4.73754 9.97501C4.98236 9.79991 5.16883 9.55521 5.27273 9.27273C5.39374 8.99853 5.42984 8.69437 5.37637 8.39947C5.3229 8.10456 5.18231 7.83244 4.97273 7.61818L4.91818 7.56364C4.74913 7.39478 4.61503 7.19425 4.52353 6.97353C4.43203 6.7528 4.38493 6.51621 4.38493 6.27727C4.38493 6.03834 4.43203 5.80174 4.52353 5.58102C4.61503 5.36029 4.74913 5.15977 4.91818 4.99091C5.08704 4.82186 5.28757 4.68775 5.50829 4.59626C5.72901 4.50476 5.96561 4.45766 6.20455 4.45766C6.44348 4.45766 6.68008 4.50476 6.9008 4.59626C7.12152 4.68775 7.32205 4.82186 7.49091 4.99091L7.54545 5.04545C7.75971 5.25503 8.03183 5.39562 8.32674 5.4491C8.62164 5.50257 8.9258 5.46647 9.2 5.34545H9.27273C9.54161 5.23022 9.77093 5.03887 9.93245 4.79497C10.094 4.55107 10.1807 4.26526 10.1818 3.97273V3.81818C10.1818 3.33597 10.3734 2.87351 10.7144 2.53253C11.0553 2.19156 11.5178 2 12 2C12.4822 2 12.9447 2.19156 13.2856 2.53253C13.6266 2.87351 13.8182 3.33597 13.8182 3.81818V3.9C13.8193 4.19253 13.906 4.47834 14.0676 4.72224C14.2291 4.96614 14.4584 5.15749 14.7273 5.27273C15.0015 5.39374 15.3056 5.42984 15.6005 5.37637C15.8954 5.3229 16.1676 5.18231 16.3818 4.97273L16.4364 4.91818C16.6052 4.74913 16.8057 4.61503 17.0265 4.52353C17.2472 4.43203 17.4838 4.38493 17.7227 4.38493C17.9617 4.38493 18.1983 4.43203 18.419 4.52353C18.6397 4.61503 18.8402 4.74913 19.0091 4.91818C19.1781 5.08704 19.3122 5.28757 19.4037 5.50829C19.4952 5.72901 19.5423 5.96561 19.5423 6.20455C19.5423 6.44348 19.4952 6.68008 19.4037 6.9008C19.3122 7.12152 19.1781 7.32205 19.0091 7.49091L18.9545 7.54545C18.745 7.75971 18.6044 8.03183 18.5509 8.32674C18.4974 8.62164 18.5335 8.9258 18.6545 9.2V9.27273C18.7698 9.54161 18.9611 9.77093 19.205 9.93245C19.4489 10.094 19.7347 10.1807 20.0273 10.1818H20.1818C20.664 10.1818 21.1265 10.3734 21.4675 10.7144C21.8084 11.0553 22 11.5178 22 12C22 12.4822 21.8084 12.9447 21.4675 13.2856C21.1265 13.6266 20.664 13.8182 20.1818 13.8182H20.1C19.8075 13.8193 19.5217 13.906 19.2778 14.0676C19.0339 14.2291 18.8425 14.4584 18.7273 14.7273Z" stroke="#50388E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                      </g>
                    </svg>
                    <h1 class="text-xl lg:text-3xl font-bold text-teven-primario dark:text-white">Configuraciones del sistema</h1>
                </div>

                <!-- Mensaje de éxito -->
                <?php if (isset($mensaje)): ?>
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                        <p class="font-medium"><?= htmlspecialchars($mensaje); ?></p>
                    </div>
                <?php endif; ?>

                <!-- Mensaje de error -->
                <?php if (isset($mensaje_error)): ?>
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                        <p class="font-medium"><?= htmlspecialchars($mensaje_error); ?></p>
                    </div>
                <?php endif; ?>

                <form method="post" action="<?=ruta('admin/configuraciones')?>">
                    
                    <!-- Primera fila: Analíticas y Contacto -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                        
                        <!-- Isla: Analíticas -->
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg border-2 border-teven-secundario-1">
                            <h2 class="text-lg font-bold text-teven-secundario-2 dark:text-white/80 mb-4">Analíticas</h2>
                            
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label for="tag_manager_head" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">Código para el &lt;head&gt;</label>
                                    <textarea 
                                        id="tag_manager_head" 
                                        name="tag_manager_head" 
                                        rows="4" 
                                        placeholder="<!-- Google Tag Manager (HEAD) -->"
                                        class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 duration-100 resize-none font-mono"><?= isset($configuraciones['tag_manager_head']) ? htmlspecialchars($configuraciones['tag_manager_head']) : '' ?></textarea>
                                </div>
                                
                                <div>
                                    <label for="tag_manager_body" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">Código para el &lt;body&gt;</label>
                                    <textarea 
                                        id="tag_manager_body" 
                                        name="tag_manager_body" 
                                        rows="4" 
                                        placeholder="<!-- Google Tag Manager (BODY) -->"
                                        class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 duration-100 resize-none font-mono"><?= isset($configuraciones['tag_manager_body']) ? htmlspecialchars($configuraciones['tag_manager_body']) : '' ?></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Isla: Información de contacto -->
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg border-2 border-teven-secundario-1">
                            <h2 class="text-lg font-bold text-teven-secundario-2 dark:text-white/80 mb-4">Información de contacto</h2>
                            
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label for="telefono" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">Teléfono</label>
                                    <input 
                                        type="tel" 
                                        id="telefono" 
                                        name="telefono" 
                                        value="<?= isset($configuraciones['telefono']) ? htmlspecialchars($configuraciones['telefono']) : '' ?>"
                                        placeholder="+52 123 456 7890"
                                        class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 duration-100">
                                </div>
                                
                                <div>
                                    <label for="whatsapp_num" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">WhatsApp (número)</label>
                                    <input 
                                        type="tel" 
                                        id="whatsapp_num" 
                                        name="whatsapp_num" 
                                        value="<?= isset($configuraciones['whatsapp_num']) ? htmlspecialchars($configuraciones['whatsapp_num']) : '' ?>"
                                        placeholder="521234567890"
                                        class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 duration-100">
                                </div>

                                <div>
                                    <label for="whatsapp_msg" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">Mensaje de WhatsApp</label>
                                    <textarea 
                                        id="whatsapp_msg" 
                                        name="whatsapp_msg" 
                                        rows="2" 
                                        placeholder="¡Hola! Me gustaría más información..."
                                        class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 duration-100 resize-none"><?= isset($configuraciones['whatsapp_msg']) ? htmlspecialchars($configuraciones['whatsapp_msg']) : '' ?></textarea>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Segunda fila: Notificaciones y Apariencia -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                        
                        <!-- Isla: Notificaciones por correo -->
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg border-2 border-teven-secundario-1">
                            <h2 class="text-lg font-bold text-teven-secundario-2 dark:text-white/80 mb-4">Notificaciones por correo</h2>
                            
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label for="correo_leads" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">Correo de notificación de leads</label>
                                    <input 
                                        type="text" 
                                        id="correo_leads" 
                                        name="correo_leads" 
                                        value="<?= isset($configuraciones['correo_leads']) ? htmlspecialchars($configuraciones['correo_leads']) : '' ?>"
                                        placeholder="leads@ejemplo.com,otro@ejemplo.com"
                                        class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 duration-100">
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Puedes agregar múltiples correos separados por comas</p>
                                </div>
                                
                                <div>
                                    <label for="correo_errores" class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-2">Correo de notificación de errores</label>
                                    <input 
                                        type="text" 
                                        id="correo_errores" 
                                        name="correo_errores" 
                                        value="<?= isset($configuraciones['correo_errores']) ? htmlspecialchars($configuraciones['correo_errores']) : '' ?>"
                                        placeholder="errores@ejemplo.com,otro@ejemplo.com"
                                        class="w-full rounded-lg px-4 py-2 text-sm bg-gray-300 outline-none focus:ring-2 focus:ring-teven-secundario-2 duration-100">
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Puedes agregar múltiples correos separados por comas</p>
                                </div>
                            </div>
                        </div>

                        <!-- Isla: Apariencia del dashboard -->
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg border-2 border-teven-secundario-1">
                            <h2 class="text-lg font-bold text-teven-secundario-2 dark:text-white/80 mb-4">Apariencia del dashboard</h2>
                            
                            <div>
                                <label class="block text-teven-secundario-3 dark:text-white/70 font-bold mb-4">Tema del dashboard</label>
                                <div class="flex items-center justify-start gap-4 p-4 bg-gray-100 rounded-lg w-fit">
                                    <!-- Icono Sol (Claro) -->
                                    <div class="flex items-center gap-2">
                                        <svg class="w-6 h-6 text-teven-secundario-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                        </svg>
                                    </div>
                                    
                                    <!-- Switch -->
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="modo_dashboard" id="modo_dashboard" class="sr-only peer" value="oscuro" <?= (isset($configuraciones['modo_dashboard']) && $configuraciones['modo_dashboard'] === 'oscuro') ? 'checked' : '' ?>>
                                        <div class="w-14 h-7 bg-gray-300 rounded-full peer
                                          peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-teven-secundario-2 duration-500 
                                          peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] peer-checked:bg-teven-secundario-2
                                          after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all"></div>
                                    </label>
                                    
                                    <!-- Icono Luna (Oscuro) -->
                                    <div class="flex items-center gap-2">
                                        <svg class="w-6 h-6 text-teven-secundario-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Botones -->
                    <div class="flex flex-col-reverse lg:flex-row justify-between gap-3">
                        <a href="<?=ruta('admin')?>" class="text-center bg-gray-400 text-white py-3 px-6 rounded-lg hover:bg-gray-500 transition font-bold">
                            Cancelar
                        </a>
                        <button type="submit" class="bg-teven-secundario-2 text-white py-3 px-6 rounded-lg hover:bg-teven-complementario transition font-bold">
                            Guardar configuraciones
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </main>
  
</body>
</html>