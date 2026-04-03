<?php
class Controlador_Videos extends Controlador_Admin_Base {

    public function verVideos() {
        $this->cambiarSeleccion('videos');
        $sql = "SELECT id, titulo, youtube_id, creado FROM videos ORDER BY creado DESC";
        $videos = db()->ejecutarConsulta($sql, []);
        $this->mostrar('admin/videos/ver-videos', [
            'usuario' => $_SESSION['usuario'],
            'videos'  => $videos,
        ]);
    }

    public function crearVideo() {
        $this->cambiarSeleccion('videos');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo      = isset($_POST['titulo']) ? trim($_POST['titulo']) : null;
            $youtube_url = isset($_POST['youtube_url']) ? trim($_POST['youtube_url']) : null;

            if ($titulo && $youtube_url) {
                $youtube_id = $this->extraerYoutubeId($youtube_url);
                if (!$youtube_id) {
                    $this->mostrar('admin/videos/crear-videos', [
                        'usuario' => $_SESSION['usuario'],
                        'mensaje' => 'La URL de YouTube no es válida. Asegúrate de ingresar un enlace correcto.',
                    ]);
                    return;
                }

                $sql = "INSERT INTO videos (titulo, youtube_id) VALUES (:titulo, :youtube_id)";
                db()->ejecutarConsulta($sql, [
                    ':titulo'     => $titulo,
                    ':youtube_id' => $youtube_id,
                ]);
                $this->verVideos();
            } else {
                $this->mostrar('admin/videos/crear-videos', [
                    'usuario' => $_SESSION['usuario'],
                    'mensaje' => 'Por favor, complete todos los campos.',
                ]);
            }
        } else {
            $this->mostrar('admin/videos/crear-videos', [
                'usuario' => $_SESSION['usuario'],
            ]);
        }
    }

    public function borrarVideo() {
        $this->cambiarSeleccion('videos');
        $id = isset($_POST['video_id']) ? (int)$_POST['video_id'] : null;
        if ($id) {
            $sql = "DELETE FROM videos WHERE id = :id";
            db()->ejecutarConsulta($sql, [':id' => $id]);
        }
        $this->verVideos();
    }

    /**
     * Extrae el ID de YouTube de una URL o devuelve el ID si ya fue ingresado directamente.
     * Soporta formatos:
     *   https://www.youtube.com/watch?v=VIDEO_ID
     *   https://youtu.be/VIDEO_ID
     *   https://www.youtube.com/embed/VIDEO_ID
     *   VIDEO_ID (11 caracteres)
     */
    private function extraerYoutubeId($url) {
        $url = trim($url);

        // Si ya es un ID (11 chars alfanuméricos + - _)
        if (preg_match('/^[a-zA-Z0-9_-]{11}$/', $url)) {
            return $url;
        }

        // Extraer de URL
        if (preg_match(
            '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/',
            $url,
            $matches
        )) {
            return $matches[1];
        }

        return null;
    }
}
