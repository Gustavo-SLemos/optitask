<?php

require_once 'Model/Conexao.php';
require_once 'Model/Usuario.php';
require_once 'Model/Projeto.php';
require_once 'Model/Tarefa.php';
require_once 'Model/Atribuicao.php';


$conexao = Conexao::getInstancia()->getConexao();


$usuario = new Usuario('Bruno', 'bruno@gmail.com', $conexao);
$usuario->salvar();
echo "<pre>";
echo "Usuário salvo com ID: " . $usuario->getId() . "\n";
echo "Nome: " . $usuario->getNome() . "\n";
echo "E-mail: " . $usuario->getEmail() . "\n";
echo "</pre>";


$projeto = new Projeto('Projeto1', 'Simulador de tarefas', '2024-02-05', '2024-12-30', $conexao);
$projeto->salvar();
echo "<pre>";
echo "Projeto salvo com ID: " . $projeto->getId() . "\n";
echo "Nome do Projeto: " . $projeto->getNome() . "\n";
echo "Descrição do Projeto: " . $projeto->getDescricao() . "\n";
echo "Data de Início: " . $projeto->getDataInicio() . "\n";
echo "Data de Fim: " . $projeto->getDataFim() . "\n";
echo "</pre>";


$tarefa = new Tarefa('Criar Classes do projeto', $projeto->getId(), '2024-02-06', '2024-02-15', $conexao);
$tarefa->salvar();
echo "<pre>";
echo "Tarefa salva com ID: " . $tarefa->getId() . "\n";
echo "Descrição da Tarefa: " . $tarefa->getDescricao() . "\n";
echo "ID do Projeto da Tarefa: " . $tarefa->getProjetoId() . "\n";
echo "Data de Início da Tarefa: " . $tarefa->getDataInicio() . "\n";
echo "Data de Fim da Tarefa: " . $tarefa->getDataFim() . "\n";
echo "</pre>";


$usuarioDestinado = 1;
$tarefaSelecionada = 1;
$atribuicao = new Atribuicao($usuarioDestinado, $tarefaSelecionada, '2024-02-08', $conexao);
$atribuicao->salvar();
echo "<pre>";
echo "Atribuição salva com ID: " . $atribuicao->getId() . "\n";
echo "ID do Usuário na Atribuição: " . $atribuicao->getUsuarioId() . "\n";
echo "ID da Tarefa na Atribuição: " . $atribuicao->getTarefaId() . "\n";
echo "Data de Atribuição: " . $atribuicao->getDataAtribuicao() . "\n";
echo "</pre>";


$idAtribuicaoExistente = 1;
$atribuicaoExistente = Atribuicao::obterPorId($idAtribuicaoExistente, $conexao);

if ($atribuicaoExistente) {
    echo "<pre>";
    echo "Atribuição encontrada:\n";
    echo "ID do Usuário na Atribuição: " . $atribuicaoExistente->getUsuarioId() . "\n";
    echo "ID da Tarefa na Atribuição: " . $atribuicaoExistente->getTarefaId() . "\n";
    echo "Data de Atribuição: " . $atribuicaoExistente->getDataAtribuicao() . "\n";
    echo "</pre>";
} else {
    echo "<pre>";
    echo "Atribuição não encontrada.\n";
    echo "</pre>";
}


//SELECT setval('atribuicoes_id_seq', coalesce(max(id), 1), false) FROM atribuicoes;
//SELECT setval('projetos_id_seq', coalesce(max(id), 1), false) FROM projetos;
//SELECT setval('tarefas_id_seq', coalesce(max(id), 1), false) FROM tarefas;
//SELECT setval('usuarios_id_seq', coalesce(max(id), 1), false) FROM usuarios;

?>


