<?php
class Controlador_Productos extends Controlador_Admin_Base {

    public function verProductos() {
        $this->cambiarSeleccion('productos');
        $sql = "SELECT id, nombre, precio, precio_original, categoria, url_compra, url_interna, imagen_url, activo, creado
                FROM productos ORDER BY creado DESC";
        $productos = db()->ejecutarConsulta($sql, []);
        $this->mostrar('admin/productos/ver-productos', [
            'usuario'   => $_SESSION['usuario'],
            'productos' => $productos,
        ]);
    }

    public function crearProducto() {
        $this->cambiarSeleccion('productos');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre          = isset($_POST['nombre'])          ? trim($_POST['nombre'])          : null;
            $descripcion     = isset($_POST['descripcion'])     ? trim($_POST['descripcion'])     : null;
            $precio          = isset($_POST['precio'])          ? trim($_POST['precio'])          : null;
            $precio_original = isset($_POST['precio_original']) ? trim($_POST['precio_original']) : null;
            $categoria       = isset($_POST['categoria'])       ? trim($_POST['categoria'])       : null;
            $url_compra      = isset($_POST['url_compra'])      ? trim($_POST['url_compra'])      : null;
            $url_interna     = isset($_POST['url_interna'])     ? trim($_POST['url_interna'])     : null;

            $categorias_validas = ['presencial', 'online', 'descargable', 'otros'];

            if ($nombre && $precio !== null && $categoria && $url_compra && in_array($categoria, $categorias_validas)) {
                $imagen_url = $this->subirImagen();

                $sql = "INSERT INTO productos (nombre, descripcion, precio, precio_original, categoria, url_compra, url_interna, imagen_url)
                        VALUES (:nombre, :descripcion, :precio, :precio_original, :categoria, :url_compra, :url_interna, :imagen_url)";
                db()->ejecutarConsulta($sql, [
                    ':nombre'          => $nombre,
                    ':descripcion'     => $descripcion !== '' ? $descripcion : null,
                    ':precio'          => (float)$precio,
                    ':precio_original' => $precio_original !== '' ? (float)$precio_original : null,
                    ':categoria'       => $categoria,
                    ':url_compra'      => $url_compra,
                    ':url_interna'     => $url_interna !== '' ? $url_interna : null,
                    ':imagen_url'      => $imagen_url,
                ]);
                header('Location: ' . ruta('admin/productos'));
                exit;
            } else {
                $this->mostrar('admin/productos/crear-productos', [
                    'usuario' => $_SESSION['usuario'],
                    'mensaje' => 'Por favor, completa todos los campos obligatorios.',
                    'datos'   => $_POST,
                ]);
            }
        } else {
            $this->mostrar('admin/productos/crear-productos', [
                'usuario' => $_SESSION['usuario'],
            ]);
        }
    }

    public function editarProducto() {
        $this->cambiarSeleccion('productos');
        $id = isset($_POST['producto_id']) ? (int)$_POST['producto_id'] : null;

        if (!$id) { $this->verProductos(); return; }

        $producto = db()->ejecutarConsulta(
            "SELECT * FROM productos WHERE id = :id LIMIT 1",
            [':id' => $id]
        );
        if (empty($producto)) { $this->verProductos(); return; }
        $producto = $producto[0];

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre'])) {
            $nombre          = trim($_POST['nombre']          ?? '');
            $descripcion     = trim($_POST['descripcion']     ?? '');
            $precio          = trim($_POST['precio']          ?? '');
            $precio_original = trim($_POST['precio_original'] ?? '');
            $categoria       = trim($_POST['categoria']       ?? '');
            $url_compra      = trim($_POST['url_compra']      ?? '');
            $url_interna     = trim($_POST['url_interna']     ?? '');
            $activo          = isset($_POST['activo']) ? 1 : 0;

            $categorias_validas = ['presencial', 'online', 'descargable', 'otros'];

            if ($nombre && $precio !== '' && $categoria && $url_compra && in_array($categoria, $categorias_validas)) {
                // Si se sube una imagen nueva, usarla; si no, conservar la existente
                $imagen_nueva = $this->subirImagen();
                $imagen_url   = $imagen_nueva ?? $producto['imagen_url'];

                // Si se marcó borrar imagen y no se subió una nueva, limpiar
                if (isset($_POST['borrar_imagen']) && !$imagen_nueva) {
                    $this->eliminarImagenArchivo($producto['imagen_url']);
                    $imagen_url = null;
                }

                $sql = "UPDATE productos
                        SET nombre = :nombre, descripcion = :descripcion, precio = :precio,
                            precio_original = :precio_original, categoria = :categoria,
                            url_compra = :url_compra, url_interna = :url_interna,
                            imagen_url = :imagen_url, activo = :activo
                        WHERE id = :id";
                db()->ejecutarConsulta($sql, [
                    ':nombre'          => $nombre,
                    ':descripcion'     => $descripcion !== '' ? $descripcion : null,
                    ':precio'          => (float)$precio,
                    ':precio_original' => $precio_original !== '' ? (float)$precio_original : null,
                    ':categoria'       => $categoria,
                    ':url_compra'      => $url_compra,
                    ':url_interna'     => $url_interna !== '' ? $url_interna : null,
                    ':imagen_url'      => $imagen_url,
                    ':activo'          => $activo,
                    ':id'              => $id,
                ]);
                header('Location: ' . ruta('admin/productos'));
                exit;
            } else {
                $this->mostrar('admin/productos/editar-productos', [
                    'usuario'  => $_SESSION['usuario'],
                    'mensaje'  => 'Por favor, completa todos los campos obligatorios.',
                    'producto' => array_merge($producto, $_POST),
                ]);
            }
        } else {
            $this->mostrar('admin/productos/editar-productos', [
                'usuario'  => $_SESSION['usuario'],
                'producto' => $producto,
            ]);
        }
    }

    public function borrarProducto() {
        $this->cambiarSeleccion('productos');
        $id = isset($_POST['producto_id']) ? (int)$_POST['producto_id'] : null;
        if ($id) {
            $row = db()->ejecutarConsulta("SELECT imagen_url FROM productos WHERE id = :id LIMIT 1", [':id' => $id]);
            if (!empty($row[0]['imagen_url'])) {
                $this->eliminarImagenArchivo($row[0]['imagen_url']);
            }
            db()->ejecutarConsulta("DELETE FROM productos WHERE id = :id", [':id' => $id]);
        }
        header('Location: ' . ruta('admin/productos'));
        exit;
    }

    // ── Helpers de imagen ──────────────────────────────────────────────────────

    /**
     * Procesa $_FILES['imagen'] y guarda el archivo en recursos/imagenes/productos/.
     * Devuelve la ruta relativa guardada en BD, o null si no se subió nada.
     */
    private function subirImagen() {
        if (empty($_FILES['imagen']['name'])) return null;

        $file     = $_FILES['imagen'];
        $maxBytes = 5 * 1024 * 1024; // 5 MB
        $tiposPermitidos = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
        $extsPermitidas  = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

        if ($file['error'] !== UPLOAD_ERR_OK) return null;
        if ($file['size'] > $maxBytes) return null;

        // Validar tipo MIME real (no solo extensión)
        $finfo    = new finfo(FILEINFO_MIME_TYPE);
        $mimeReal = $finfo->file($file['tmp_name']);
        if (!in_array($mimeReal, $tiposPermitidos)) return null;

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $extsPermitidas)) return null;

        $carpeta = __DIR__ . '/../../recursos/imagenes/productos/';
        if (!is_dir($carpeta)) {
            mkdir($carpeta, 0755, true);
        }

        $nombreArchivo = uniqid('producto_', true) . '.' . $ext;
        $destino       = $carpeta . $nombreArchivo;

        if (!move_uploaded_file($file['tmp_name'], $destino)) return null;

        return 'recursos/imagenes/productos/' . $nombreArchivo;
    }

    /**
     * Elimina el archivo físico de una imagen guardada.
     */
    private function eliminarImagenArchivo($rutaRelativa) {
        if (!$rutaRelativa) return;
        $ruta = __DIR__ . '/../../' . $rutaRelativa;
        if (file_exists($ruta)) {
            unlink($ruta);
        }
    }
}
