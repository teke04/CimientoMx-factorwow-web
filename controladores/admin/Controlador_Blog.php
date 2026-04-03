<?php
class Controlador_Blog extends Controlador_Admin_Base {

    public function verArticulos() {
        $this->cambiarSeleccion('blog');
        $sql = "SELECT id, titulo, slug, extracto, imagen_url, activo, creado
                FROM articulos_blog ORDER BY creado DESC";
        $articulos = db()->ejecutarConsulta($sql, []);
        $this->mostrar('admin/blog/ver-articulos', [
            'usuario'   => $_SESSION['usuario'],
            'articulos' => $articulos,
        ]);
    }

    public function crearArticulo() {
        $this->cambiarSeleccion('blog');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo    = isset($_POST['titulo'])    ? trim($_POST['titulo'])    : null;
            $slug      = isset($_POST['slug'])      ? trim($_POST['slug'])      : null;
            $extracto  = isset($_POST['extracto'])  ? trim($_POST['extracto'])  : null;
            $contenido = isset($_POST['contenido']) ? trim($_POST['contenido']) : null;

            $imagen_url = $this->subirImagen();

            if ($titulo && $slug && $imagen_url) {
                // Sanitize slug: only lowercase letters, numbers and hyphens
                $slug = strtolower(preg_replace('/[^a-z0-9\-]/', '', $slug));

                $sql = "INSERT INTO articulos_blog (titulo, slug, extracto, contenido, imagen_url)
                        VALUES (:titulo, :slug, :extracto, :contenido, :imagen_url)";
                try {
                    db()->ejecutarConsulta($sql, [
                        ':titulo'    => $titulo,
                        ':slug'      => $slug,
                        ':extracto'  => $extracto !== '' ? $extracto : null,
                        ':contenido' => $contenido !== '' ? $contenido : null,
                        ':imagen_url' => $imagen_url,
                    ]);
                    header('Location: ' . ruta('admin/blog'));
                    exit;
                } catch (Exception $e) {
                    $this->mostrar('admin/blog/crear-articulo', [
                        'usuario' => $_SESSION['usuario'],
                        'mensaje' => 'El slug ya existe. Por favor usa uno diferente.',
                        'datos'   => $_POST,
                    ]);
                }
            } else {
                $mensaje = 'Por favor, completa los campos obligatorios (título y slug).';
                if ($titulo && $slug && !$imagen_url) {
                    $mensaje = 'La imagen de portada es obligatoria.';
                }
                $this->mostrar('admin/blog/crear-articulo', [
                    'usuario' => $_SESSION['usuario'],
                    'mensaje' => $mensaje,
                    'datos'   => $_POST,
                ]);
            }
        } else {
            $this->mostrar('admin/blog/crear-articulo', [
                'usuario' => $_SESSION['usuario'],
            ]);
        }
    }

    public function editarArticulo() {
        $this->cambiarSeleccion('blog');
        $id = isset($_POST['articulo_id']) ? (int)$_POST['articulo_id'] : null;

        if (!$id) { $this->verArticulos(); return; }

        $articulo = db()->ejecutarConsulta(
            "SELECT * FROM articulos_blog WHERE id = :id LIMIT 1",
            [':id' => $id]
        );
        if (empty($articulo)) { $this->verArticulos(); return; }
        $articulo = $articulo[0];

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['titulo'])) {
            $titulo    = trim($_POST['titulo']    ?? '');
            $slug      = strtolower(preg_replace('/[^a-z0-9\-]/', '', trim($_POST['slug'] ?? '')));
            $extracto  = trim($_POST['extracto']  ?? '');
            $contenido = trim($_POST['contenido'] ?? '');
            $activo    = isset($_POST['activo']) ? 1 : 0;

            if ($titulo && $slug) {
                $imagen_nueva = $this->subirImagen();
                $imagen_url   = $imagen_nueva ?? $articulo['imagen_url'];

                if (isset($_POST['borrar_imagen']) && !$imagen_nueva) {
                    $this->eliminarImagenArchivo($articulo['imagen_url']);
                    $imagen_url = null;
                }

                try {
                    $sql = "UPDATE articulos_blog
                            SET titulo = :titulo, slug = :slug, extracto = :extracto,
                                contenido = :contenido, imagen_url = :imagen_url, activo = :activo
                            WHERE id = :id";
                    db()->ejecutarConsulta($sql, [
                        ':titulo'    => $titulo,
                        ':slug'      => $slug,
                        ':extracto'  => $extracto !== '' ? $extracto : null,
                        ':contenido' => $contenido !== '' ? $contenido : null,
                        ':imagen_url' => $imagen_url,
                        ':activo'    => $activo,
                        ':id'        => $id,
                    ]);
                    $this->verArticulos();
                } catch (Exception $e) {
                    $this->mostrar('admin/blog/editar-articulo', [
                        'usuario'  => $_SESSION['usuario'],
                        'mensaje'  => 'El slug ya existe. Por favor usa uno diferente.',
                        'articulo' => array_merge($articulo, $_POST),
                    ]);
                }
            } else {
                $this->mostrar('admin/blog/editar-articulo', [
                    'usuario'  => $_SESSION['usuario'],
                    'mensaje'  => 'Por favor, completa los campos obligatorios (título y slug).',
                    'articulo' => array_merge($articulo, $_POST),
                ]);
            }
        } else {
            $this->mostrar('admin/blog/editar-articulo', [
                'usuario'  => $_SESSION['usuario'],
                'articulo' => $articulo,
            ]);
        }
    }

    public function borrarArticulo() {
        $this->cambiarSeleccion('blog');
        $id = isset($_POST['articulo_id']) ? (int)$_POST['articulo_id'] : null;
        if ($id) {
            $row = db()->ejecutarConsulta("SELECT imagen_url FROM articulos_blog WHERE id = :id LIMIT 1", [':id' => $id]);
            if (!empty($row[0]['imagen_url'])) {
                $this->eliminarImagenArchivo($row[0]['imagen_url']);
            }
            db()->ejecutarConsulta("DELETE FROM articulos_blog WHERE id = :id", [':id' => $id]);
        }
        $this->verArticulos();
    }

    // ── Helpers de imagen ─────────────────────────────────────────────────────

    private function subirImagen() {
        if (empty($_FILES['imagen']['name'])) return null;

        $file     = $_FILES['imagen'];
        $maxBytes = 5 * 1024 * 1024;
        $tiposPermitidos = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
        $extsPermitidas  = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

        if ($file['error'] !== UPLOAD_ERR_OK) return null;
        if ($file['size'] > $maxBytes) return null;

        $finfo    = new finfo(FILEINFO_MIME_TYPE);
        $mimeReal = $finfo->file($file['tmp_name']);
        if (!in_array($mimeReal, $tiposPermitidos)) return null;

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $extsPermitidas)) return null;

        $carpeta = __DIR__ . '/../../recursos/imagenes/blog/';
        if (!is_dir($carpeta)) {
            mkdir($carpeta, 0755, true);
        }

        $nombreArchivo = uniqid('articulo_', true) . '.' . $ext;
        $destino       = $carpeta . $nombreArchivo;

        if (!move_uploaded_file($file['tmp_name'], $destino)) return null;

        return 'recursos/imagenes/blog/' . $nombreArchivo;
    }

    private function eliminarImagenArchivo($rutaRelativa) {
        if (!$rutaRelativa) return;
        $ruta = __DIR__ . '/../../' . $rutaRelativa;
        if (file_exists($ruta)) {
            unlink($ruta);
        }
    }
}
