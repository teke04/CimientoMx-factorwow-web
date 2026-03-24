<?php

class Database {
    private $pdo;

    public function __construct($config) {
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
            
            // Mostrar mensaje amigable según el entorno
            if (env('ENVIRONMENT') === 'development') {
                die("Error al conectar a la base de datos: " . $e->getMessage());
            } else {
                die("Error de conexión. Por favor, contacte al administrador.");
            }
        }
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
    
            // Verificar si la consulta devuelve resultados
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
}

/**
 * Función para montar la base de datos
 * Ejecuta todas las migraciones pendientes
 */
function montarBaseDatos() {
    global $db;
    
    // Crear tabla de versiones si no existe (necesaria para el sistema)
    $sqlVersiones = "CREATE TABLE IF NOT EXISTS db_versiones (
        id INT AUTO_INCREMENT PRIMARY KEY,
        version VARCHAR(50) NOT NULL UNIQUE,
        descripcion TEXT,
        ejecutada_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $db->ejecutarConsulta($sqlVersiones);
    
    // Ejecutar migraciones pendientes
    $migraciones = new Migraciones($db);
    $migraciones->ejecutarPendientes();
}

/**
 * Función para inicializar la conexión a la base de datos
 */
function inicializarDb() {
    global $db;
    
    $db = new Database([
        'SERVERNAME' => env('DB_HOST', 'localhost'),
        'DBNAME'     => env('DB_NAME', 'default_db'),
        'USERNAME'   => env('DB_USER', 'root'),
        'PASSWORD'   => env('DB_PASSWORD', '')
    ]);
    
    // Montar estructura de base de datos automáticamente
    montarBaseDatos();
}

?>