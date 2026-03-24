<?php
class Controlador {
    protected $RUTAS;

    /**
     * Constructor de la clase Controlador
     * Inicializa la sesión y carga las rutas del enrutador
     */
    public function __construct() {
        session_start();
        $this->RUTAS = enrutador()->listarRutas();
    }

    /**
     * Función para mostrar una vista con datos
     * @param string $vista - La ruta de la vista a mostrar relativa a la carpeta vistas (ejemplo: 'admin/login', 'web/home')
     * @param array $datos - Array asociativo con los datos a pasar a la vista (por defecto array vacío)
     */
    protected function mostrar($vista, $datos = []) {
        $datos['USUARIO'] = isset($_SESSION['usuario']) ? [
            'nombre' => $_SESSION['usuario'],
            'seleccionado' => isset($_SESSION['seleccion']) ? $_SESSION['seleccion'] : null
        ] : null;
        extract($datos);
        include 'vistas/' . $vista . '.php';
    }

    /**
     * Función para incluir un componente según el modo del proyecto
     * @param string $componente - El nombre del componente a incluir (ejemplo: 'navbar', 'footer')
     * @param array $datos - Array asociativo con los datos a pasar al componente (por defecto array vacío)
     */
    public function componente($componente, $datos = []) {
        $modo = env('MODO_PROYECTO', 'web');
        $this->mostrar($modo . '/componentes/' . $componente, $datos);
    }

    /**
     * Función para incluir una plantilla según el modo del proyecto
     * @param string $plantilla - El nombre de la plantilla a incluir (ejemplo: 'estilos', 'metadatos')
     * @param array $datos - Array asociativo con los datos a pasar a la plantilla (por defecto array vacío)
     */
    public function plantilla($plantilla, $datos = []) {
        $modo = env('MODO_PROYECTO', 'web');
        $this->mostrar($modo . '/plantillas/' . $plantilla, $datos);
    }

    /**
     * Función para incluir un componente de la sección admin
     * @param string $componente - El nombre del componente a incluir (ejemplo: 'sidebar', 'header')
     * @param array $datos - Array asociativo con los datos a pasar al componente (por defecto array vacío)
     */
    public function componente_admin($componente, $datos = []) {
        $this->mostrar('admin/componentes/' . $componente, $datos);
    }

    /**
     * Función para incluir una plantilla de la sección admin
     * @param string $plantilla - El nombre de la plantilla a incluir (ejemplo: 'estilos', 'metadatos')
     * @param array $datos - Array asociativo con los datos a pasar a la plantilla (por defecto array vacío)
     */
    public function plantilla_admin($plantilla, $datos = []) {
        $this->mostrar('admin/plantillas/' . $plantilla, $datos);
    }


    /**
     * Función para verificar si existe una sesión activa
     * Si no hay sesión activa, redirige a la página de login
     */
    protected function verificar_sesion() {
        if (!isset($_SESSION['usuario'])) {
            $this->mostrar('admin/cuentas/login');
            die();
        }
    }

    /**
     * Función para crear una sesión de usuario autenticado
     * @param string $username - El nombre de usuario para autenticar
     * @param string $password - La contraseña del usuario en texto plano
     * @return bool - Retorna true si la autenticación es exitosa, false en caso contrario
     */
    protected function crear_sesion($username, $password) {
        
        $sql = "SELECT id, username, pass FROM users WHERE BINARY username = :nombre LIMIT 1";
        $params = [
            ':nombre' => $username,
        ];

        try {
            $resultado = db()->ejecutarConsulta($sql, $params);

            if (count($resultado) < 1) {
                return false;
            }

            if (!password_verify($password, $resultado[0]['pass'])) {
                return false;
            }

            $_SESSION['id'] = $resultado[0]['id'];
            $_SESSION['usuario'] = $username;
            $_SESSION['seleccion'] = 'resultados';
            
            logger()->info('Sesión iniciada exitosamente', ['username' => $username]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Función para enviar emails utilizando una plantilla
     * @param string $destino - La dirección de email del destinatario
     * @param string $asunto - El asunto del email
     * @param string $vista - El nombre de la plantilla de email (ejemplo: 'lead', 'recuperar')
     * @param array $datos - Array asociativo con los datos a pasar a la plantilla del email
     * @return bool - Retorna true si el email se envió correctamente, false en caso contrario
     */
    protected function enviarEmail($destino, $asunto, $vista, $datos) {
        $cabeceras = 'From: ' . env('EMAIL_REMITENTE') . "\r\n" .
             'Reply-To: ' . env('EMAIL_REMITENTE') . "\r\n" .
             'X-Mailer: PHP/' . phpversion() . "\r\n" .
             'MIME-Version: 1.0' . "\r\n" .
             'Content-Type: text/html; charset=UTF-8' . "\r\n";

        extract($datos);
        ob_start();
        include 'vistas/emails/' . $vista . '.php';
        $mensaje = ob_get_clean();

        try {
            if (@mail($destino, $asunto, $mensaje, $cabeceras)) {
                logger()->info('Email enviado exitosamente', [
                    'destino' => $destino,
                    'asunto' => $asunto,
                    'vista' => $vista
                ]);
                return true;
            } else {
                logger()->error('Fallo al enviar email', [
                    'destino' => $destino,
                    'asunto' => $asunto,
                    'vista' => $vista,
                    'error' => 'mail() retornó false'
                ]);
                return false;
            }
        } catch (Exception $e) {
            logger()->error('Excepción al enviar email', [
                'destino' => $destino,
                'asunto' => $asunto,
                'vista' => $vista,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * Función para mostrar la página de error 404
     * Muestra la vista 404.php sin datos adicionales
     */
    public function show404() {
        $this->mostrar('404',[]);
    }

    /**
     * Función para cambiar la sección seleccionada en el panel admin
     * @param string $seccion - Nombre de la sección ('resultados', 'keywords', 'leads', 'configuraciones')
     */
    protected function cambiarSeleccion($seccion) {
        $_SESSION['seleccion'] = $seccion;
    }
    
}