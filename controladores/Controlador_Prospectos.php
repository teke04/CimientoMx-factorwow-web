<?php
class Controlador_Prospectos extends Controlador {

    public function guardarLead() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre      = isset($_POST['nombre'])      ? trim($_POST['nombre'])      : null;
            $email       = isset($_POST['email'])       ? trim($_POST['email'])       : null;
            $telefono    = isset($_POST['tel'])         ? trim($_POST['tel'])         : null;
            
            // Validar interes_id: debe existir en POST, no estar vacío y ser numérico
            $interes_id  = (isset($_POST['interes']) && $_POST['interes'] !== '' && is_numeric($_POST['interes'])) 
                           ? (int)$_POST['interes'] 
                           : null;
            
            // Validar servicio_id: debe existir en POST, no estar vacío y ser numérico
            $servicio_id = (isset($_POST['servicio']) && $_POST['servicio'] !== '' && is_numeric($_POST['servicio'])) 
                           ? (int)$_POST['servicio'] 
                           : null;
            
            // Validar landing_id: debe existir en POST, no estar vacío y ser numérico, sino 0
            $landing_id  = (isset($_POST['landing_id']) && $_POST['landing_id'] !== '' && is_numeric($_POST['landing_id'])) 
                           ? (int)$_POST['landing_id'] 
                           : 0;
    
            if ($nombre && $email) {
    
                // Convertir valores vacíos o NULL en NULL real para la BD
                $interes_id = ($interes_id === '' || $interes_id === null) ? null : $interes_id;
                $servicio_id = ($servicio_id === '' || $servicio_id === null) ? null : $servicio_id;
                $landing_id = ($landing_id === '' || $landing_id === null) ? 0 : $landing_id;

                // Insertar prospecto con campos opcionales
                $sql = "INSERT INTO prospectos (nombre, telefono, correo, interes_id, servicio_id, landing_id) 
                        VALUES (:nombre, :telefono, :correo, :interes_id, :servicio_id, :landing_id)";
                $params = [
                    ':nombre'      => $nombre,
                    ':telefono'    => $telefono,
                    ':correo'      => $email,
                    ':interes_id'  => $interes_id,
                    ':servicio_id' => $servicio_id,
                    ':landing_id'  => $landing_id
                ];
                db()->ejecutarConsulta($sql, $params);

                // Obtener información para el email
                $interes_texto = null;
                if ($interes_id) {
                    $sql_interes = "SELECT interes FROM intereses WHERE id = :interes_id";
                    $resultado = db()->ejecutarConsulta($sql_interes, [':interes_id' => $interes_id]);
                    $interes_texto = $resultado ? $resultado[0]['interes'] : null;
                }

                $servicio_texto = null;
                if ($servicio_id) {
                    $sql_servicio = "SELECT servicio FROM servicios WHERE id = :servicio_id";
                    $resultado = db()->ejecutarConsulta($sql_servicio, [':servicio_id' => $servicio_id]);
                    $servicio_texto = $resultado ? $resultado[0]['servicio'] : null;
                }

                $keyword = null;
                $landing_url = null;
                if ($landing_id && $landing_id > 0) {
                    $sql_keyword = "SELECT keyword FROM landings WHERE id = :landing_id";
                    $resultado = db()->ejecutarConsulta($sql_keyword, [':landing_id' => $landing_id]);
                    if ($resultado) {
                        $keyword = $resultado[0]['keyword'];
                        $landing_url =  $keyword;
                    }
                }

                // Enviar email con información del lead
                $datosEmail = [
                    'nombre'   => $nombre,
                    'correo'   => $email,
                    'telefono' => $telefono
                ];
                
                // Agregar campos opcionales solo si tienen valor
                if ($interes_texto) {
                    $datosEmail['interes'] = $interes_texto;
                }
                
                if ($servicio_texto) {
                    $datosEmail['servicio'] = $servicio_texto;
                }
                
                if ($landing_url) {
                    $datosEmail['landing'] = $landing_url;
                }
                
                // Obtener correo de leads desde configuración
                $correo_destino = configuracion('correo_leads');
                if (!$correo_destino) {
                    $correo_destino = 'tekeperera@gmail.com'; // Fallback por defecto
                }
                
                $this->enviarEmail($correo_destino, 'Nuevo Lead', 'lead', $datosEmail);
    
                // Mostrar vista de agradecimiento
                $this->mostrar('gracias', [
                    'nombre'  => ' ' . $nombre,
                    'landing' => $landing_url
                ]);
            } else {
                // Mostrar un mensaje de error
                $this->mostrar('web/home', [
                    'mensaje' => 'Por favor, complete todos los campos requeridos (nombre y email)'
                ]);
            }
        } else {
            $this->mostrar('gracias', [
                'nombre' => '',
                'landing' => ''
            ]);
            exit;
        }
    }

}
?>