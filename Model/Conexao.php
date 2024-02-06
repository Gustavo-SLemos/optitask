<?php

class Conexao {
    private static $instancia;
    private $host = 'localhost';
    private $dbname = 'optitask';
    private $user = 'postgres';
    private $password = '';
    private $pdo;

    private function __construct() {
        $dsn = "pgsql:host={$this->host};dbname={$this->dbname}";
        $this->pdo = new PDO($dsn, $this->user, $this->password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstancia() {
        if (!self::$instancia) {
            self::$instancia = new Conexao();
        }

        return self::$instancia;
    }

    public function getConexao() {
        return $this->pdo;
    }
}
?>

