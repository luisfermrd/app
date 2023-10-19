<?php
class Database
{
    // Guardar la instancia de la conexión
    private static $instance;
    private $db;

    // Datos de conexión a la base de datos
    private $host = 'localhost';
    private $dbname = 'dislexiaApp';
    private $username = 'root';
    private $password = '1234567890';

    // Constructor privado para evitar instanciar directamente
    private function __construct()
    {
        try {
            $this->db = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo json_encode(['status' => 'error', 'message' => "Error de conexión a la base de datos: " . $e->getMessage()]);
            exit();
        }
    }

    // Método para obtener la instancia única de la conexión
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Método para obtener la instancia de la conexión PDO
    public function getConnection()
    {
        return $this->db;
    }

    // Cerrar la conexión a la base de datos
    public function closeConnection() {
        $this->db = null;
    }

    // Evitar la clonación de la instancia
    private function __clone()
    {
    }

    // Evitar la deserialización de la instancia
    public function __wakeup()
    {
    }
}
