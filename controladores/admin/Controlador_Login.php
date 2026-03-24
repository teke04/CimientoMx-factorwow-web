<?php
class Controlador_Login extends Controlador {
    public function login() {
        if (isset($_SESSION['usuario'])) {
            $sql = "
                SELECT 
                    landings.keyword AS landing,
                    COUNT(prospectos.id) AS total_leads
                FROM 
                    landings
                LEFT JOIN 
                    prospectos ON landings.id = prospectos.landing_id
                GROUP BY 
                    landings.id
                ORDER BY 
                    total_leads DESC
                LIMIT 10;
            ";
            $landings = db()->ejecutarConsulta($sql, []);

            $this->mostrar('admin/resultados',[
                'usuario' => $_SESSION['usuario'],
                'landings' => $landings,
            ]);
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            if($this->crear_sesion($username,$password)){
                $sql = "
                    SELECT 
                        landings.keyword AS landing,
                        COUNT(prospectos.id) AS total_leads
                    FROM 
                        landings
                    LEFT JOIN 
                        prospectos ON landings.id = prospectos.landing_id
                    GROUP BY 
                        landings.id
                    ORDER BY 
                        total_leads DESC
                    LIMIT 10;
                ";

                $landings = db()->ejecutarConsulta($sql, []);
        
                $this->mostrar('admin/resultados',[
                    'usuario' => $_SESSION['usuario'],
                    'landings' => $landings,
                ]);
            }else{
                $this->mostrar('admin/cuentas/login', 
                ['mensaje' => "Usuario o contraseña incorrectos"]
            );
            }

            
        }else{
            $this->mostrar('admin/cuentas/login'
            );
        }
        return;
    }

    public function logout() {
        // Destruir la sesión
        session_destroy();
        $this->mostrar('admin/cuentas/login', 
            ['mensaje' => "Sesión cerrada correctamente"]
        );
    }

    public function recuperar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            if($_POST['user']){
                $params = [
                    ':user' => $_POST['user'],
                ];
                $sql = "SELECT email FROM users WHERE BINARY username = :user LIMIT 1";
            }


            if($_POST['email']){
                $params = [
                    ':email' => $_POST['email'],
                ];
                $sql = "SELECT email FROM users WHERE BINARY email = :email LIMIT 1";
            }

            $sqlReply = db()->ejecutarConsulta($sql, $params);

            if (count($sqlReply) < 1){
                $this->mostrar('admin/cuentas/recuperarForm', 
                    ['mensaje' => "Account not found"]
                );
                return;
            }

            $recoveryEmail = $sqlReply[0]['email'];

            if($this->enviarEmail(
                $recoveryEmail,
                "Account Recovery",
                "recuperar",
                []
            )){
                $this->mostrar('admin/cuentas/recuperar', 
                    ['mensaje' => "El link de recuperación ha sido enviado a su correo"]
                );
            }else{
                $this->mostrar('admin/cuentas/recuperar', 
                    ['mensaje' => "Ocurrió un error al enviar el correo, intente de nuevo más tarde"]
                );
            }
            return;
        }
        $this->mostrar('admin/cuentas/recuperarForm');
        return;
    }
}
