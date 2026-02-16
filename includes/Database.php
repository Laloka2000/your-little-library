<?php 
class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ];

            $this->pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            die("Database connection failed: ". $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->pdo;
    }

    public function query($sql, $params = []){
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($params);
            return $statement->fetchAll();
        } catch (PDOException $e) {
            error_log("Query error: " . $e->getMessage());
            return false;
        }
    }

    public function queryOne($sql, $params = []){
        $statement = $this->pdo->prepare($sql);
        $statement->execute($params);
        return $statement->fetch();
    }

    public function excecute($sql, $params = []){
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($params);
            return $statement->fetch();
        } catch (PDOException $e) {
            error_log("Execute error: " . $e->getMessage());
            return false;
        } 
    }

    public function lastInsertId(){
        return $this->pdo->lastInsertId();
    }
}




?>