<?php

require_once 'Conexao.php';

class Usuario {
    private $id;
    private $nome;
    private $email;
    private $conexao;

    public function __construct($nome, $email, $conexao) {
        $this->nome = $nome;
        $this->email = $email;
        $this->conexao = $conexao;
    }


    public function salvar() {
        try {
            $query = "INSERT INTO usuarios (nome, email) VALUES (:nome, :email)";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':email', $this->email);
            $stmt->execute();

            $this->id = $this->conexao->lastInsertId();

            return true;
        } catch (PDOException $e) {
            
            return false;
        }
    }

    
    public static function obterPorId($id, $conexao) {
        try {
            $query = "SELECT * FROM usuarios WHERE id = :id";
            $stmt = $conexao->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario) {
                return new Usuario($usuario['nome'], $usuario['email'], $conexao);
            } else {
                return null;
            }
        } catch (PDOException $e) {
            
            return null;
        }
    }

    
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getEmail() {
        return $this->email;
    }
}


?>

