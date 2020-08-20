<?php


class Database
{
    private $db_host = DB_HOST;
    private $db_name = DB_NAME;
    private $db_user = DB_USER;
    private $db_pass = DB_PASS;
    private $conn = null;

    public function connect()
    {
        try {
            $dsn = 'mysql:host=' . $this->db_host . ';dbname=' . $this->db_name . ';charset=utf8';
            $this->conn = new PDO($dsn, $this->db_user, $this->db_pass );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
            exit;
        }

        return $this->conn;
    }
}
