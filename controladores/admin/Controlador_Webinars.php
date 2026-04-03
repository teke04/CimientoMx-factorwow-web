<?php
class Controlador_Webinars extends Controlador_Admin_Base {

    // ── Listar ────────────────────────────────────────────────────────────────

    public function verWebinars() {
        $this->cambiarSeleccion('webinars');
        $sql = "SELECT id, titulo, slug, extracto, link_youtube, activo, creado
                FROM webinars ORDER BY creado DESC";
        $webinars = db()->ejecutarConsulta($sql, []);
        $this->mostrar('admin/webinars/ver-webinars', [
            'usuario'  => $_SESSION['usuario'],
            'webinars' => $webinars,
        ]);
    }

    // ── Crear ─────────────────────────────────────────────────────────────────

    public function crearWebinar() {
        $this->cambiarSeleccion('webinars');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo       = isset($_POST['titulo'])       ? trim($_POST['titulo'])       : null;
            $slug         = isset($_POST['slug'])         ? trim($_POST['slug'])         : null;
            $extracto     = isset($_POST['extracto'])     ? trim($_POST['extracto'])     : null;
            $link_youtube = isset($_POST['link_youtube']) ? trim($_POST['link_youtube']) : null;

            if ($titulo && $slug) {
                $slug = strtolower(preg_replace('/[^a-z0-9\-]/', '', $slug));

                $sql = "INSERT INTO webinars (titulo, slug, extracto, link_youtube)
                        VALUES (:titulo, :slug, :extracto, :link_youtube)";
                try {
                    db()->ejecutarConsulta($sql, [
                        ':titulo'       => $titulo,
                        ':slug'         => $slug,
                        ':extracto'     => $extracto !== '' ? $extracto : null,
                        ':link_youtube' => $link_youtube !== '' ? $link_youtube : null,
                    ]);
                    header('Location: ' . ruta('admin/webinars'));
                    exit;
                } catch (Exception $e) {
                    $this->mostrar('admin/webinars/crear-webinar', [
                        'usuario' => $_SESSION['usuario'],
                        'mensaje' => 'El slug ya existe. Por favor usa uno diferente.',
                        'datos'   => $_POST,
                    ]);
                }
            } else {
                $this->mostrar('admin/webinars/crear-webinar', [
                    'usuario' => $_SESSION['usuario'],
                    'mensaje' => 'Por favor, completa los campos obligatorios (título y slug).',
                    'datos'   => $_POST,
                ]);
            }
        } else {
            $this->mostrar('admin/webinars/crear-webinar', [
                'usuario' => $_SESSION['usuario'],
            ]);
        }
    }

    // ── Editar ────────────────────────────────────────────────────────────────

    public function editarWebinar() {
        $this->cambiarSeleccion('webinars');
        $id = isset($_POST['webinar_id']) ? (int)$_POST['webinar_id'] : null;

        if (!$id) { $this->verWebinars(); return; }

        $webinar = db()->ejecutarConsulta(
            "SELECT * FROM webinars WHERE id = :id LIMIT 1",
            [':id' => $id]
        );
        if (empty($webinar)) { $this->verWebinars(); return; }
        $webinar = $webinar[0];

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['titulo'])) {
            $titulo       = trim($_POST['titulo']       ?? '');
            $slug         = strtolower(preg_replace('/[^a-z0-9\-]/', '', trim($_POST['slug'] ?? '')));
            $extracto     = trim($_POST['extracto']     ?? '');
            $link_youtube = trim($_POST['link_youtube'] ?? '');
            $activo       = isset($_POST['activo']) ? 1 : 0;

            if ($titulo && $slug) {
                try {
                    $sql = "UPDATE webinars
                            SET titulo = :titulo, slug = :slug, extracto = :extracto,
                                link_youtube = :link_youtube, activo = :activo
                            WHERE id = :id";
                    db()->ejecutarConsulta($sql, [
                        ':titulo'       => $titulo,
                        ':slug'         => $slug,
                        ':extracto'     => $extracto !== '' ? $extracto : null,
                        ':link_youtube' => $link_youtube !== '' ? $link_youtube : null,
                        ':activo'       => $activo,
                        ':id'           => $id,
                    ]);
                    header('Location: ' . ruta('admin/webinars'));
                    exit;
                } catch (Exception $e) {
                    $this->mostrar('admin/webinars/editar-webinar', [
                        'usuario' => $_SESSION['usuario'],
                        'mensaje' => 'El slug ya existe. Por favor usa uno diferente.',
                        'webinar' => array_merge($webinar, $_POST),
                    ]);
                }
            } else {
                $this->mostrar('admin/webinars/editar-webinar', [
                    'usuario' => $_SESSION['usuario'],
                    'mensaje' => 'Por favor, completa los campos obligatorios (título y slug).',
                    'webinar' => array_merge($webinar, $_POST),
                ]);
            }
        } else {
            $this->mostrar('admin/webinars/editar-webinar', [
                'usuario' => $_SESSION['usuario'],
                'webinar' => $webinar,
            ]);
        }
    }

    // ── Borrar ────────────────────────────────────────────────────────────────

    public function borrarWebinar() {
        $this->cambiarSeleccion('webinars');
        $id = isset($_POST['webinar_id']) ? (int)$_POST['webinar_id'] : null;
        if ($id) {
            db()->ejecutarConsulta("DELETE FROM webinars WHERE id = :id", [':id' => $id]);
        }
        header('Location: ' . ruta('admin/webinars'));
        exit;
    }

    // ── Helper ────────────────────────────────────────────────────────────────

    public static function extraerYoutubeId($url) {
        if (empty($url)) return null;
        if (preg_match(
            '/(?:youtube\.com\/(?:watch\?(?:.*&)?v=|embed\/|v\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/',
            $url, $m
        )) {
            return $m[1];
        }
        return null;
    }
}
