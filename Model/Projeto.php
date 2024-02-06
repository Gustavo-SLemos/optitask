<?php

require_once 'Conexao.php';

class Projeto {
    private $id;
    private $nome;
    private $descricao;
    private $dataInicio;
    private $dataFim;
    private $conexao;

    public function __construct($nome, $descricao, $dataInicio, $dataFim, $conexao) {
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->dataInicio = $dataInicio;
        $this->dataFim = $dataFim;
        $this->conexao = $conexao;
    }

    
    public function salvar() {
        try {
            $query = "INSERT INTO projetos (nome, descricao, data_inicio, data_fim) VALUES (:nome, :descricao, :dataInicio, :dataFim)";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':descricao', $this->descricao);
            $stmt->bindParam(':dataInicio', $this->dataInicio);
            $stmt->bindParam(':dataFim', $this->dataFim);
            $stmt->execute();

            $this->id = $this->conexao->lastInsertId();

            return true;
        } catch (PDOException $e) {
            
            return false;
        }
    }

    
    public static function obterPorId($id, $conexao) {
        try {
            $query = "SELECT * FROM projetos WHERE id = :id";
            $stmt = $conexao->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $projeto = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($projeto) {
                return new Projeto($projeto['nome'], $projeto['descricao'], $projeto['data_inicio'], $projeto['data_fim'], $conexao);
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

    public function getDescricao() {
        return $this->descricao;
    }

    public function getDataInicio() {
        return $this->dataInicio;
    }

    public function getDataFim() {
        return $this->dataFim;
    }
}


?>

