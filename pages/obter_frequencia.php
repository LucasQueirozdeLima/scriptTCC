<?php
require_once '../config/Dao.php';
$dao = new Dao();


$dao = new Dao();
$academiaId = 1; // Substitua pelo ID da academia que você deseja atualizar
$numAtual = 20;  // Atualize conforme necessário

// Inserindo a frequência no banco
$dao->inserirFrequencia($academiaId, $numAtual);

$idAcademia = 1;
$result = $dao->obterFrequenciaAtual($idAcademia);

// Enviar JSON com verificação do resultado
echo json_encode([
    "num_atual" => $result['num_atual'] ?? 0,
    "capacidade_max" => $result['capacidade_max'] ?? 0
]);


