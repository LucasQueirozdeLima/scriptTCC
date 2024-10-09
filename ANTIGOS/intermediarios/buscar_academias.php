<?php
//Deixar o nome do arquivo como padrão "buscarAcademia.php" (DUVIDA)

if (isset($_GET['query'])) {
    $query = $_GET['query'];

    // Conecte-se ao banco de dados
    include "conexao.php";

    // Pesquisa por nome de academia ou cidade
    $sql = "SELECT * FROM academias WHERE nome LIKE ? OR cidade LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchTerm = '%' . $query . '%';
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Exibir os resultados da pesquisa
        echo "<h2>Academias encontradas em '$query':</h2>";
        while ($row = $result->fetch_assoc()) {
            echo "<p><strong>" . $row['nome'] . "</strong><br>" . $row['endereco'] . ", " . $row['cidade'] . ", " . $row['estado'] . "<br>CEP: " . $row['cep'] . "</p>";
        }
    } else {
        echo "<p>Nenhuma academia encontrada em '$query'.</p>";
    }

    $stmt->close();
    $conn->close();
}
?>
