<?php

require_once 'Conexao.php';

class Atribuicao {
    private $id;
    private $usuarioId;
    private $tarefaId;
    private $dataAtribuicao;
    private $conexao;

    public function __construct($usuarioId, $tarefaId, $dataAtribuicao, $conexao) {
        $this->usuarioId = $usuarioId;
        $this->tarefaId = $tarefaId; 
        $this->dataAtribuicao = $dataAtribuicao;
        $this->conexao = $conexao;
    }

    
    public function salvar() {
        try {
            $query = "INSERT INTO atribuicoes (usuario_id, tarefa_id, data_atribuicao) VALUES (:usuarioId, :tarefaId, :dataAtribuicao)";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindParam(':usuarioId', $this->usuarioId);
            $stmt->bindParam(':tarefaId', $this->tarefaId);
            $stmt->bindParam(':dataAtribuicao', $this->dataAtribuicao);
            $stmt->execute();

            $this->id = $this->conexao->lastInsertId();

            return true;
        } catch (PDOException $e) {
            
            return false;
        }
    }

    
    public static function obterPorId($id, $conexao) {
        try {
            $query = "SELECT * FROM atribuicoes WHERE id = :id";
            $stmt = $conexao->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $atribuicao = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($atribuicao) {
                return new Atribuicao($atribuicao['usuario_id'], $atribuicao['tarefa_id'], $atribuicao['data_atribuicao'], $conexao);
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

    public function getUsuarioId() {
        return $this->usuarioId;
    }

    public function getTarefaId() {
        return $this->tarefaId;
    }

    public function getDataAtribuicao() {
        return $this->dataAtribuicao;
    }
}


?>
