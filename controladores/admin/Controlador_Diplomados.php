<?php
class Controlador_Diplomados extends Controlador_Admin_Base {

    // â”€â”€ Listar â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€

    public function verDiplomados() {
        $this->cambiarSeleccion('diplomados');
        $sql = "SELECT id, titulo, slug, generacion, extracto, url_temario, activo, creado
                FROM diplomados ORDER BY creado DESC";
        $diplomados = db()->ejecutarConsulta($sql, []);
        $this->mostrar('admin/diplomados/ver-diplomados', [
            'usuario'    => $_SESSION['usuario'],
            'diplomados' => $diplomados,
        ]);
    }

    // â”€â”€ Crear â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€

    public function crearDiplomado() {
        $this->cambiarSeleccion('diplomados');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo           = isset($_POST['titulo'])           ? trim($_POST['titulo'])           : null;
            $slug             = isset($_POST['slug'])             ? trim($_POST['slug'])             : null;
            $generacion       = isset($_POST['generacion'])       ? trim($_POST['generacion'])       : null;
            $subtitulo_hero   = isset($_POST['subtitulo_hero'])   ? trim($_POST['subtitulo_hero'])   : null;
            $descripcion_hero = isset($_POST['descripcion_hero']) ? trim($_POST['descripcion_hero']) : null;
            $subtitulo        = isset($_POST['subtitulo'])        ? trim($_POST['subtitulo'])        : null;
            $descripcion      = isset($_POST['descripcion'])      ? trim($_POST['descripcion'])      : null;
            $extracto         = isset($_POST['extracto'])         ? trim($_POST['extracto'])         : null;

            if ($titulo && $slug) {
                $slug           = strtolower(preg_replace('/[^a-z0-9\-]/', '', $slug));
                $url_temario    = $this->subirTemario();
                $imagen_preview = $this->subirImagenPreview();

                $sql = "INSERT INTO diplomados
                            (titulo, slug, generacion, subtitulo_hero, descripcion_hero,
                             subtitulo, descripcion, extracto, url_temario, imagen_preview)
                        VALUES
                            (:titulo, :slug, :generacion, :subtitulo_hero, :descripcion_hero,
                             :subtitulo, :descripcion, :extracto, :url_temario, :imagen_preview)";
                try {
                    db()->ejecutarConsulta($sql, [
                        ':titulo'           => $titulo,
                        ':slug'             => $slug,
                        ':generacion'       => $generacion       !== '' ? $generacion       : null,
                        ':subtitulo_hero'   => $subtitulo_hero   !== '' ? $subtitulo_hero   : null,
                        ':descripcion_hero' => $descripcion_hero !== '' ? $descripcion_hero : null,
                        ':subtitulo'        => $subtitulo        !== '' ? $subtitulo        : null,
                        ':descripcion'      => $descripcion      !== '' ? $descripcion      : null,
                        ':extracto'         => $extracto         !== '' ? $extracto         : null,
                        ':url_temario'      => $url_temario,
                        ':imagen_preview'   => $imagen_preview,
                    ]);
                    header('Location: ' . ruta('admin/diplomados'));
                    exit;
                } catch (Exception $e) {
                    if ($url_temario) $this->eliminarArchivoTemario($url_temario);
                    if ($imagen_preview) $this->eliminarArchivoTemario($imagen_preview);
                    $this->mostrar('admin/diplomados/crear-diplomado', [
                        'usuario' => $_SESSION['usuario'],
                        'mensaje' => 'El slug ya existe. Por favor usa uno diferente.',
                        'datos'   => $_POST,
                    ]);
                }
            } else {
                $this->mostrar('admin/diplomados/crear-diplomado', [
                    'usuario' => $_SESSION['usuario'],
                    'mensaje' => 'Por favor, completa los campos obligatorios (tÃ­tulo y slug).',
                    'datos'   => $_POST,
                ]);
            }
        } else {
            $this->mostrar('admin/diplomados/crear-diplomado', [
                'usuario' => $_SESSION['usuario'],
            ]);
        }
    }

    // â”€â”€ Editar â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€

    public function editarDiplomado() {
        $this->cambiarSeleccion('diplomados');
        $id = isset($_POST['diplomado_id']) ? (int)$_POST['diplomado_id'] : null;

        if (!$id) { $this->verDiplomados(); return; }

        $diplomado = db()->ejecutarConsulta(
            "SELECT * FROM diplomados WHERE id = :id LIMIT 1",
            [':id' => $id]
        );
        if (empty($diplomado)) { $this->verDiplomados(); return; }
        $diplomado = $diplomado[0];

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['titulo'])) {
            $titulo           = trim($_POST['titulo']           ?? '');
            $slug             = strtolower(preg_replace('/[^a-z0-9\-]/', '', trim($_POST['slug'] ?? '')));
            $generacion       = trim($_POST['generacion']       ?? '');
            $subtitulo_hero   = trim($_POST['subtitulo_hero']   ?? '');
            $descripcion_hero = trim($_POST['descripcion_hero'] ?? '');
            $subtitulo        = trim($_POST['subtitulo']        ?? '');
            $descripcion      = trim($_POST['descripcion']      ?? '');
            $extracto         = trim($_POST['extracto']         ?? '');
            $activo           = isset($_POST['activo']) ? 1 : 0;

            $nuevo_temario = $this->subirTemario();
            if ($nuevo_temario) {
                $this->eliminarArchivoTemario($diplomado['url_temario']);
                $url_temario = $nuevo_temario;
            } else {
                $url_temario = $diplomado['url_temario'];
            }

            $nueva_imagen = $this->subirImagenPreview();
            if ($nueva_imagen) {
                $this->eliminarArchivoTemario($diplomado['imagen_preview']);
                $imagen_preview = $nueva_imagen;
            } else {
                $imagen_preview = $diplomado['imagen_preview'];
            }

            if ($titulo && $slug) {
                try {
                    $sql = "UPDATE diplomados
                            SET titulo = :titulo, slug = :slug, generacion = :generacion,
                                subtitulo_hero = :subtitulo_hero, descripcion_hero = :descripcion_hero,
                                subtitulo = :subtitulo, descripcion = :descripcion,
                                extracto = :extracto, url_temario = :url_temario,
                                imagen_preview = :imagen_preview, activo = :activo
                            WHERE id = :id";
                    db()->ejecutarConsulta($sql, [
                        ':titulo'           => $titulo,
                        ':slug'             => $slug,
                        ':generacion'       => $generacion       !== '' ? $generacion       : null,
                        ':subtitulo_hero'   => $subtitulo_hero   !== '' ? $subtitulo_hero   : null,
                        ':descripcion_hero' => $descripcion_hero !== '' ? $descripcion_hero : null,
                        ':subtitulo'        => $subtitulo        !== '' ? $subtitulo        : null,
                        ':descripcion'      => $descripcion      !== '' ? $descripcion      : null,
                        ':extracto'         => $extracto         !== '' ? $extracto         : null,
                        ':url_temario'      => $url_temario,
                        ':imagen_preview'   => $imagen_preview,
                        ':activo'           => $activo,
                        ':id'               => $id,
                    ]);
                    header('Location: ' . ruta('admin/diplomados'));
                    exit;
                } catch (Exception $e) {
                    if ($nuevo_temario) $this->eliminarArchivoTemario($nuevo_temario);
                    if ($nueva_imagen) $this->eliminarArchivoTemario($nueva_imagen);
                    $this->mostrar('admin/diplomados/editar-diplomado', [
                        'usuario'   => $_SESSION['usuario'],
                        'mensaje'   => 'El slug ya existe. Por favor usa uno diferente.',
                        'diplomado' => array_merge($diplomado, $_POST),
                    ]);
                }
            } else {
                $this->mostrar('admin/diplomados/editar-diplomado', [
                    'usuario'   => $_SESSION['usuario'],
                    'mensaje'   => 'Por favor, completa los campos obligatorios (tÃ­tulo y slug).',
                    'diplomado' => array_merge($diplomado, $_POST),
                ]);
            }
        } else {
            $this->mostrar('admin/diplomados/editar-diplomado', [
                'usuario'   => $_SESSION['usuario'],
                'diplomado' => $diplomado,
            ]);
        }
    }

    // â”€â”€ Borrar â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€

    public function borrarDiplomado() {
        $this->cambiarSeleccion('diplomados');
        $id = isset($_POST['diplomado_id']) ? (int)$_POST['diplomado_id'] : null;
        if ($id) {
            $rows = db()->ejecutarConsulta(
                "SELECT url_temario, imagen_preview FROM diplomados WHERE id = :id LIMIT 1", [':id' => $id]
            );
            if (!empty($rows)) {
                $this->eliminarArchivoTemario($rows[0]['url_temario']);
                $this->eliminarArchivoTemario($rows[0]['imagen_preview']);
            }
            db()->ejecutarConsulta("DELETE FROM diplomados WHERE id = :id", [':id' => $id]);
        }
        header('Location: ' . ruta('admin/diplomados'));
        exit;
    }

    // â”€â”€ Helpers â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€

    private function subirTemario() {
        if (empty($_FILES['temario']['name'])) return null;

        $file     = $_FILES['temario'];
        $maxBytes = 10 * 1024 * 1024; // 10 MB

        if ($file['error'] !== UPLOAD_ERR_OK) return null;
        if ($file['size'] > $maxBytes) return null;

        $finfo    = new finfo(FILEINFO_MIME_TYPE);
        $mimeReal = $finfo->file($file['tmp_name']);
        if ($mimeReal !== 'application/pdf') return null;

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if ($ext !== 'pdf') return null;

        $carpeta = __DIR__ . '/../../recursos/diplomados/';
        if (!is_dir($carpeta)) {
            mkdir($carpeta, 0755, true);
        }

        $nombreArchivo = uniqid('temario_', true) . '.pdf';
        $destino       = $carpeta . $nombreArchivo;

        if (!move_uploaded_file($file['tmp_name'], $destino)) return null;

        return 'diplomados/' . $nombreArchivo;
    }

    private function subirImagenPreview() {
        if (empty($_FILES['imagen_preview']['name'])) return null;

        $file     = $_FILES['imagen_preview'];
        $maxBytes = 5 * 1024 * 1024; // 5 MB

        if ($file['error'] !== UPLOAD_ERR_OK) return null;
        if ($file['size'] > $maxBytes) return null;

        $finfo     = new finfo(FILEINFO_MIME_TYPE);
        $mimeReal  = $finfo->file($file['tmp_name']);
        $mimeAllow = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
        if (!in_array($mimeReal, $mimeAllow)) return null;

        $extMap = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp', 'image/gif' => 'gif'];
        $ext    = $extMap[$mimeReal];

        $carpeta = __DIR__ . '/../../recursos/diplomados/';
        if (!is_dir($carpeta)) {
            mkdir($carpeta, 0755, true);
        }

        $nombreArchivo = uniqid('preview_', true) . '.' . $ext;
        $destino       = $carpeta . $nombreArchivo;

        if (!move_uploaded_file($file['tmp_name'], $destino)) return null;

        return 'diplomados/' . $nombreArchivo;
    }

    private function eliminarArchivoTemario($rutaRelativa) {
        if (!$rutaRelativa) return;
        $ruta = __DIR__ . '/../../recursos/' . $rutaRelativa;
        if (file_exists($ruta)) {
            unlink($ruta);
        }
    }
}
