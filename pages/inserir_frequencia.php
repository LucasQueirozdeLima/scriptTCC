
<?php /*
require_once '../config/Dao.php';

$dao = new Dao();

$academiaId = 1; // Substitua pelo ID da academia desejada
$numAtual = rand(1, 50); // Gera um número aleatório para simular a quantidade de pessoas

// Insere uma nova entrada na tabela de frequência
$dao->inserirFrequencia($academiaId, $numAtual);

echo json_encode(["status" => "Frequência inserida com sucesso", "num_atual" => $numAtual]);
?>


<script>
    // Função para inserir frequência automaticamente
    function inserirFrequenciaPeriodicamente() {
        fetch('inserir_frequencia.php')
            .then(response => response.json())
            .then(data => console.log(data.status + ": " + data.num_atual))
            .catch(error => console.error("Erro ao inserir frequência:", error));
    }

    // Chama a função a cada 30 segundos
    setInterval(inserirFrequenciaPeriodicamente, 30000); // 30 segundos = 30000 ms
</script>
*/?>