<?php


class Db {
    private static $instance;
    private static $inicializado = false;
    private $pdo;

    private function __construct($config) {
        $dsn = 'mysql:host=' . $config['SERVERNAME'] . ';dbname=' . $config['DBNAME'];
        try {
            $this->pdo = new PDO($dsn, $config['USERNAME'], $config['PASSWORD']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            logger()->critical('Error al conectar a la base de datos', [
                'host' => $config['SERVERNAME'],
                'database' => $config['DBNAME'],
                'error' => $e->getMessage()
            ]);
            if (env('ENVIRONMENT') === 'development') {
                die("Error al conectar a la base de datos: " . $e->getMessage());
            } else {
                die("Error de conexión. Por favor, contacte al administrador.");
            }
        }
    }

    public static function inicializar() {
        if (self::$inicializado) {
            return;
        }
        self::$inicializado = true;
        
        if (!isset(self::$instance)) {
            self::$instance = new self([
                'SERVERNAME' => env('DB_HOST', 'localhost'),
                'DBNAME'     => env('DB_NAME', 'default_db'),
                'USERNAME'   => env('DB_USER', 'root'),
                'PASSWORD'   => env('DB_PASSWORD', '')
            ]);
            self::$instance->montarBaseDatos();
        }
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::inicializar();
        }
        return self::$instance;
    }

    public function ejecutarConsulta($sql, $params = []) {
        try {
            $stmt = $this->pdo->prepare($sql);
            foreach ($params as $key => $value) {
                if ($value === null) {
                    $stmt->bindValue($key, null, PDO::PARAM_NULL);
                } else {
                    $stmt->bindValue($key, filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS));
                }
            }
            $stmt->execute();
            if (stripos(trim($sql), 'SELECT') === 0) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return true;
            }
        } catch (PDOException $e) {
            logger()->error('Error al ejecutar consulta SQL', [
                'sql' => $sql,
                'params' => $params,
                'error' => $e->getMessage(),
                'codigo' => $e->getCode()
            ]);
            throw new Exception("Error al ejecutar la consulta: " . $e->getMessage());
        }
    }

    private function montarBaseDatos() {
        // Crear tabla de versiones si no existe (necesaria para el sistema)
        $sqlVersiones = "CREATE TABLE IF NOT EXISTS db_versiones (
            id INT AUTO_INCREMENT PRIMARY KEY,
            version VARCHAR(50) NOT NULL UNIQUE,
            descripcion TEXT,
            ejecutada_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        $this->ejecutarConsulta($sqlVersiones);

        // Ejecutar migraciones pendientes
        $migraciones = new Migraciones($this);
        $migraciones->ejecutarPendientes();
    }
}

/**
 * Función para montar la base de datos
 * Ejecuta todas las migraciones pendientes
 */


?>