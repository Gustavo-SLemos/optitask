<?php

require_once 'Conexao.php';

class Tarefa {
    private $id;
    private $descricao;
    private $projetoId;
    private $dataInicio;
    private $dataFim;
    private $conexao;

    public function __construct($descricao, $projetoId, $dataInicio, $dataFim, $conexao) {
        $this->descricao = $descricao;
        $this->projetoId = $projetoId;
        $this->dataInicio = $dataInicio;
        $this->dataFim = $dataFim;
        $this->conexao = $conexao;
    }

    
    public function salvar() {
        try {
            $query = "INSERT INTO tarefas (descricao, projeto_id, data_inicio, data_fim) VALUES (:descricao, :projetoId, :dataInicio, :dataFim)";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindParam(':descricao', $this->descricao);
            $stmt->bindParam(':projetoId', $this->projetoId);
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
            $query = "SELECT * FROM tarefas WHERE id = :id";
            $stmt = $conexao->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $tarefa = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($tarefa) {
                return new Tarefa($tarefa['descricao'], $tarefa['projeto_id'], $tarefa['data_inicio'], $tarefa['data_fim'], $conexao);
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

    public function getDescricao() {
        return $this->descricao;
    }

    public function getProjetoId() {
        return $this->projetoId;
    }

    public function getDataInicio() {
        return $this->dataInicio;
    }

    public function getDataFim() {
        return $this->dataFim;
    }
}



?>
