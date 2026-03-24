<?php
class Controlador_Configuraciones extends Controlador_Admin_Base {

    public function verconfiguraciones() {
        $this->cambiarSeleccion('configuraciones');
        
        // Obtener todas las configuraciones de la base de datos
        $sql = "SELECT clave, valor FROM configuraciones";
        $configuraciones_raw = db()->ejecutarConsulta($sql, []);
        
        // Convertir array de configuraciones a formato clave => valor
        $configuraciones = [];
        foreach ($configuraciones_raw as $config) {
            $configuraciones[$config['clave']] = $config['valor'];
        }
        
        // Si es POST, guardar las configuraciones
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $campos = [
                'telefono',
                'whatsapp_num',
                'whatsapp_msg',
                'correo_leads',
                'correo_errores'
            ];
            
            // Procesar el switch del modo dashboard
            $modo_dashboard = isset($_POST['modo_dashboard']) ? 'oscuro' : 'claro';
            
            // Actualizar configuraciones normales con sanitización
            foreach ($campos as $campo) {
                $valor = isset($_POST[$campo]) ? trim($_POST[$campo]) : '';
                $sql = "UPDATE configuraciones SET valor = :valor WHERE clave = :clave";
                $params = [
                    ':valor' => $valor,
                    ':clave' => $campo
                ];
                db()->ejecutarConsulta($sql, $params);
            }
            
            // Actualizar códigos de Tag Manager con validación
            $resultado_head = $this->actualizarTagManager('tag_manager_head', $_POST['tag_manager_head'] ?? '');
            $resultado_body = $this->actualizarTagManager('tag_manager_body', $_POST['tag_manager_body'] ?? '');
            
            // Si hay errores en la validación, mostrarlos
            if ($resultado_head !== true || $resultado_body !== true) {
                $mensaje_error = '';
                if ($resultado_head !== true) $mensaje_error .= $resultado_head . ' ';
                if ($resultado_body !== true) $mensaje_error .= $resultado_body;
                
                $this->mostrar('admin/verconfiguraciones',[
                    'usuario' => $_SESSION['usuario'],
                    'configuraciones' => $configuraciones,
                    'mensaje_error' => trim($mensaje_error)
                ]);
                return;
            }
            
            // Actualizar modo dashboard
            $sql = "UPDATE configuraciones SET valor = :valor WHERE clave = :clave";
            $params = [
                ':valor' => $modo_dashboard,
                ':clave' => 'modo_dashboard'
            ];
            db()->ejecutarConsulta($sql, $params);
            
            // Recargar configuraciones después de guardar
            $configuraciones_raw = db()->ejecutarConsulta("SELECT clave, valor FROM configuraciones", []);
            $configuraciones = [];
            foreach ($configuraciones_raw as $config) {
                $configuraciones[$config['clave']] = $config['valor'];
            }
            
            // Agregar mensaje de éxito
            $mensaje = "Configuraciones guardadas exitosamente";
        }
        
        $this->mostrar('admin/verconfiguraciones',[
            'usuario' => $_SESSION['usuario'],
            'configuraciones' => $configuraciones,
            'mensaje' => isset($mensaje) ? $mensaje : null
        ]);
    }

    /**
     * Actualiza valores de Tag Manager sin sanitización
     * Valida que el código sea legítimo de Google Tag Manager
     * 
     * @param string $clave Nombre de la configuración
     * @param string $valor Código de Tag Manager
     * @return bool|string true si es exitoso, mensaje de error si falla validación
     */
    private function actualizarTagManager($clave, $valor) {
        // Si el valor está vacío, permitirlo (para limpiar configuración)
        $valor = trim($valor);
        if ($valor !== '') {
            // Validar que sea código legítimo de Google Tag Manager
            $errores_validacion = $this->validarCodigoTagManager($valor);
            if (!empty($errores_validacion)) {
                return "Error en {$clave}: " . implode(', ', $errores_validacion);
            }
        }
        
        // Acceder al PDO directamente desde la propiedad de Database
        $reflection = new ReflectionClass($this->db);
        $pdoProperty = $reflection->getProperty('pdo');
        $pdoProperty->setAccessible(true);
        $pdo = $pdoProperty->getValue($this->db);
        
        try {
            $sql = "UPDATE configuraciones SET valor = :valor WHERE clave = :clave";
            $stmt = $pdo->prepare($sql);
            
            // Bind sin sanitización para preservar el código HTML/JS
            $stmt->bindValue(':valor', $valor, PDO::PARAM_STR);
            $stmt->bindValue(':clave', $clave, PDO::PARAM_STR);
            
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            throw new Exception("Error al actualizar Tag Manager: " . $e->getMessage());
        }
    }
    
    /**
     * Valida que el código sea legítimo de Google Tag Manager
     * 
     * @param string $codigo Código a validar
     * @return array Array de errores encontrados (vacío si es válido)
     */
    private function validarCodigoTagManager($codigo) {
        $errores = [];
        
        // 1. Verificar que contenga el dominio de Google Tag Manager
        if (stripos($codigo, 'googletagmanager.com') === false) {
            $errores[] = "Debe contener el dominio 'googletagmanager.com'";
        }
        
        // 2. Verificar que contenga un ID de GTM válido (GTM-XXXXXXX)
        if (!preg_match('/GTM-[A-Z0-9]+/', $codigo)) {
            $errores[] = "Debe contener un ID de GTM válido (formato: GTM-XXXXXXX)";
        }
        
        // 3. Verificar que no contenga patrones sospechosos
        $patrones_maliciosos = [
            '/eval\s*\(/i' => 'No se permite la función eval()',
            '/<script[^>]*src\s*=\s*["\'](?!https:\/\/www\.googletagmanager\.com)/i' => 'Solo se permiten scripts de googletagmanager.com',
            '/document\.write\s*\(\s*["\']<script/i' => 'No se permite document.write con scripts externos',
            '/\.innerHTML\s*=/i' => 'No se permite modificación de innerHTML',
            '/on(load|error|click|mouse)\s*=/i' => 'No se permiten eventos inline maliciosos',
            '/<iframe[^>]*src\s*=\s*["\'](?!https:\/\/www\.googletagmanager\.com)/i' => 'Solo se permiten iframes de googletagmanager.com'
        ];
        
        foreach ($patrones_maliciosos as $patron => $mensaje) {
            if (preg_match($patron, $codigo)) {
                $errores[] = $mensaje;
            }
        }
        
        // 4. Verificar que contenga estructura esperada de GTM
        $tiene_script = (stripos($codigo, '<script') !== false);
        $tiene_noscript = (stripos($codigo, '<noscript') !== false);
        $tiene_iframe = (stripos($codigo, '<iframe') !== false);
        
        // Head debe tener <script>, Body puede tener <noscript> con <iframe>
        if (!$tiene_script && !($tiene_noscript && $tiene_iframe)) {
            $errores[] = "Estructura de código GTM no reconocida";
        }
        
        return $errores;
    }

}
?>
