<div class="max-w-2xl w-full">
    <h2 class="text-4xl lg:text-6xl font-bold text-center mb-8 text-teven-primario">Contáctanos</h2>
    <p class="text-center text-gray-600 mb-12">Completa el formulario y nos pondremos en contacto contigo</p>
    
    <form action="<?=ruta('gracias')?>" method="POST" class="bg-white shadow-2xl rounded-2xl p-8 space-y-6">
        <!-- Campo oculto con landing_id -->
        <input type="hidden" name="landing_id" value="<?= htmlspecialchars($landing_id ?? 0) ?>">
        
        <!-- Nombre -->
        <div>
            <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">
                Nombre completo <span class="text-red-500">*</span>
            </label>
            <input 
                type="text" 
                id="nombre" 
                name="nombre" 
                required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teven-primario focus:border-transparent outline-none transition"
                placeholder="Tu nombre completo"
            >
        </div>

        <!-- Correo -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                Correo electrónico <span class="text-red-500">*</span>
            </label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teven-primario focus:border-transparent outline-none transition"
                placeholder="tu@email.com"
            >
        </div>

        <!-- Teléfono -->
        <div>
            <label for="tel" class="block text-sm font-medium text-gray-700 mb-2">
                Teléfono <span class="text-red-500">*</span>
            </label>
            <input 
                type="tel" 
                id="tel" 
                name="tel" 
                required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teven-primario focus:border-transparent outline-none transition"
                placeholder="(555) 123-4567"
            >
        </div>

        <!-- Servicio -->
        <div>
            <label for="servicio" class="block text-sm font-medium text-gray-700 mb-2">
                Servicio de interés
            </label>
            <select 
                id="servicio" 
                name="servicio"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teven-primario focus:border-transparent outline-none transition"
            >
                <option value="">Selecciona un servicio (opcional)</option>
                <?php if (isset($servicios) && is_array($servicios)): ?>
                    <?php foreach ($servicios as $servicio): ?>
                        <option value="<?= htmlspecialchars($servicio['id']) ?>">
                            <?= htmlspecialchars($servicio['servicio']) ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>

        <!-- Botón de envío -->
        <button 
            type="submit"
            class="w-full bg-teven-primario hover:bg-teven-secundario-2 text-white font-bold py-4 rounded-lg transition-colors duration-300 shadow-lg hover:shadow-xl"
        >
            Enviar mensaje
        </button>

        <p class="text-xs text-gray-500 text-center mt-4">
            Al enviar este formulario aceptas nuestra política de privacidad
        </p>
    </form>
</div>
