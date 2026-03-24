<?php
class Controlador_Landings extends Controlador_Admin_Base {
    public function verLandings() {
        $this->cambiarSeleccion('landings');
        $sql = "
            SELECT 
                landings.id,
                landings.keyword,
                landings.h1,
                landings.h2,
                landings.meta_titulo,
                landings.meta_descripcion,
                landings.creada,
                COUNT(prospectos.id) AS leads
            FROM 
                landings
            LEFT JOIN 
                prospectos ON landings.id = prospectos.landing_id
            GROUP BY 
                landings.id
            ORDER BY 
                landings.creada DESC;
        ";
        $landings = db()->ejecutarConsulta($sql, []);
        $this->mostrar('admin/landings/ver-landings',[
            'usuario' => $_SESSION['usuario'],
            'landings' => $landings,
        ]);
    }

    public function crearLanding() {
        $this->cambiarSeleccion('landings');
        $sql_default = "SELECT keyword, h1, h2, meta_titulo, meta_descripcion FROM landings WHERE keyword = 'default' LIMIT 1";
        $default = db()->ejecutarConsulta($sql_default, []);

        //revisar si se esta creando una landing o se esta mostrando el formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $keyword          = isset($_POST['keyword']) ? trim($_POST['keyword']) : null;
            $h1               = isset($_POST['h1']) ? trim($_POST['h1']) : null;
            $h2               = isset($_POST['h2']) ? trim($_POST['h2']) : null;
            $meta_titulo      = isset($_POST['meta_titulo']) ? trim($_POST['meta_titulo']) : null;
            $meta_descripcion = isset($_POST['meta_descripcion']) ? trim($_POST['meta_descripcion']) : null;
            if ($keyword && $h1 && $h2 && $meta_titulo && $meta_descripcion) {

                // Validar la keyword
                $error = $this->validarKeyword($keyword);
                if ($error) {
                    $this->mostrar('admin/landings/crear-landings', [
                        'usuario' => $_SESSION['usuario'],
                        'mensaje' => $error['mensaje'],
                        'default' => $default ? $default[0] : []
                    ]);
                    return;
                }

                $sql_insert = "INSERT INTO landings (keyword, h1, h2, meta_titulo, meta_descripcion) VALUES (:keyword, :h1, :h2, :meta_titulo, :meta_descripcion)";
                $params_insert = [
                    ':keyword' => $keyword,
                    ':h1' => $h1,
                    ':h2' => $h2,
                    ':meta_titulo' => $meta_titulo,
                    ':meta_descripcion' => $meta_descripcion
                ];
                db()->ejecutarConsulta($sql_insert, $params_insert);
                $this->verLandings();
            } else {
                $this->mostrar('admin/landings/crear-landings', [
                    'usuario' => $_SESSION['usuario'],
                    'mensaje' => "Por favor, complete todos los campos.",
                    'default' => $default ? $default[0] : []
                ]);
            }
        } else {
            $this->mostrar('admin/landings/crear-landings', [
                'usuario' => $_SESSION['usuario'],
                'default' => $default ? $default[0] : []
            ]);
        }
    }

    public function editarLanding() {
        $this->cambiarSeleccion('landings');
        $id = $_POST['keyword_id'];
        $sql_default = "SELECT id, keyword, h1, h2, meta_titulo, meta_descripcion FROM landings  WHERE id = :id";
        $params_check = [':id' => $id];
        $landing = db()->ejecutarConsulta($sql_default, $params_check);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $keyword          = isset($_POST['keyword']) ? trim($_POST['keyword']) : null;
            $h1               = isset($_POST['h1']) ? trim($_POST['h1']) : null;
            $h2               = isset($_POST['h2']) ? trim($_POST['h2']) : null;
            $meta_titulo      = isset($_POST['meta_titulo']) ? trim($_POST['meta_titulo']) : null;
            $meta_descripcion = isset($_POST['meta_descripcion']) ? trim($_POST['meta_descripcion']) : null;
            $keyword_id       = isset($_POST['keyword_id']) ? trim($_POST['keyword_id']) : null;
            if ($keyword && $h1 && $h2 && $meta_titulo && $meta_descripcion) {
                // Validar la keyword (excluyendo el registro actual)
                $error = $this->validarKeyword($keyword, $keyword_id);
                if ($error) {
                    $this->mostrar('admin/landings/editar-landings', [
                        'usuario' => $_SESSION['usuario'],
                        'mensaje' => $error['mensaje'],
                        'landing' => $landing ? $landing[0] : []
                    ]);
                    return;
                }

                $sql_insert = "UPDATE landings SET keyword = :keyword, h1 = :h1, h2 = :h2, meta_titulo = :meta_titulo, meta_descripcion = :meta_descripcion WHERE id = :id";
                $params_insert = [
                    ':keyword' => $keyword,
                    ':h1' => $h1,
                    ':h2' => $h2,
                    ':meta_titulo' => $meta_titulo,
                    ':meta_descripcion' => $meta_descripcion,
                    ':id' => $keyword_id
                ];
                db()->ejecutarConsulta($sql_insert, $params_insert);
                $this->verLandings();
            } else {
                $this->mostrar('admin/landings/editar-landings', [
                    'usuario' => $_SESSION['usuario'],
                    'mensaje' => "Por favor, complete todos los campos.",
                    'landing' => $landing ? $landing[0] : []
                ]);
            }
        } else {
            $this->mostrar('admin/landings/editar-landings', [
                'usuario' => $_SESSION['usuario'],
                'default' => $landing ? $landing[0] : []
            ]);
        }
    }

    /**
     * Valida que una keyword no exista en la base de datos ni coincida con rutas del sistema
     * @param string $keyword La keyword a validar
     * @param int|null $excludeId ID a excluir de la validación (para edición)
     * @return array|null Retorna array con error si hay conflicto, null si es válida
     */
    private function validarKeyword($keyword, $excludeId = null) {
        // Si estamos editando, obtener la keyword actual de esta landing
        $keywordActual = null;
        if ($excludeId) {
            $sql_actual = "SELECT keyword FROM landings WHERE id = :id";
            $params_actual = [':id' => $excludeId];
            $result_actual = db()->ejecutarConsulta($sql_actual, $params_actual);
            if ($result_actual) {
                $keywordActual = $result_actual[0]['keyword'];
            }
        }

        // Obtener todas las rutas registradas en el enrutador
        $rutasRegistradas = enrutador()->listarRutas();
        
        // Verificar que la keyword no coincida con ninguna ruta existente
        if (array_key_exists($keyword, $rutasRegistradas)) {
            // Si estamos editando y la keyword es la misma que la actual, permitirla
            if ($excludeId && $keyword === $keywordActual) {
                // Es la misma keyword, no hay cambio, es válida
                return null;
            }
            
            // La keyword coincide con una ruta existente
            return [
                'mensaje' => "El nombre '$keyword' ya está en uso. Por favor, elige otro."
            ];
        }

        // Si llegamos aquí, la keyword es válida
        return null;
    }

    public function borrarLanding(){
        $id = $_POST['keyword_id'];
        $sql = "DELETE FROM landings WHERE id = :id";
        $params = [':id' => $id];
        db()->ejecutarConsulta($sql, $params);
        $this->verLandings();
    }

}
