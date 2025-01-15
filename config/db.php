<?php

class Database {
    private static ?Database $instance = null;
    private $host;
    private $db;
    private $user;
    private $pass;
    private $charset;
    private $pdo;

    private function __construct() {
        $this->host = 'localhost';
        $this->db = 'youdemy';
        $this->user = 'root';
        $this->pass = '';
        $this->charset = 'utf8mb4';

        $this->connect();
    }

    
    private function connect() {
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    
    public static function getInstance(): Database {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    
    public function getConnection() {
        return $this->pdo;
    }
}
