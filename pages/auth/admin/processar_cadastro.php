<?php
session_start(); // Inicia a sessão

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Conectar ao MySQL (use o arquivo Dao.php)
    require_once '../../../config/Dao.php';
    $dao = new Dao();

    // Dados do formulário
    $razao_social = $_POST['razao_social'];
    $cnpj = $_POST['cnpj'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $cep = $_POST['cep'];
    $status_academia = $_POST['status_academia'];
    $descricao = $_POST['descricao'];
    $capacidade = $_POST['capacidade'];

    try {
        // Chama o método inserirAcademia da classe Dao
        $idAcademia = $dao->inserirAcademia($razao_social, $cnpj, $status_academia, $descricao, $capacidade, $rua, $numero, $bairro, $cidade, $cep);

        // Resposta de sucesso com o ID gerado
        echo json_encode(['success' => true, 'id' => $idAcademia]);
    } catch (Exception $e) {
        // Em caso de erro, retorna a mensagem de erro
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método inválido.']);
}
?>
