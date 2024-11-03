<?php

// Exemplo de código PHP para inserir frequência
require '../config/Dao.php'; // Altere para o caminho correto do seu arquivo Dao.php

$dao = new Dao();
$academiaId = 1; // Substitua pelo ID da academia que você deseja atualizar
$numAtual = 20;  // Atualize conforme necessário

// Inserindo a frequência no banco
$dao->inserirFrequencia($academiaId, $numAtual);



// Configurar URL do endpoint que estamos testando
$url = "http://localhost/scriptTCC/pages/obter_frequencia.php";

// Inicializar a chamada cURL
$ch = curl_init($url);

// Configurar opções para que o cURL retorne a resposta em vez de exibi-la diretamente
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Executar a chamada cURL
$response = curl_exec($ch);

// Verificar se ocorreu algum erro durante a execução
if (curl_errno($ch)) {
    echo "Erro ao acessar o endpoint: " . curl_error($ch);
} else {
    // Decodificar a resposta JSON
    $data = json_decode($response, true);

    // Verificar se a resposta contém os dados esperados
    echo "Número Atual: " . ($data['num_atual'] ?? 'Erro: dado não encontrado') . "<br>";
    echo "Capacidade Máxima: " . ($data['capacidade_max'] ?? 'Erro: dado não encontrado') . "<br>";
}

// Fechar a conexão cURL
curl_close($ch);

