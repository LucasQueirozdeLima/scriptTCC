<?php
session_start();  // Inicia a sessão para acessar as variáveis de sessão

// Verifica se o usuário está logado
if (isset($_SESSION["verificador"])) {
    // Verifica se o id da academia foi enviado via POST
    if (isset($_POST['academia_id'])) {
        // Pega os dados necessários
        $idAcademia = $_POST['academia_id'];
        $usuarioId = $_SESSION['id_usuario']; // Pega o ID do usuário logado

        // Inclui o arquivo de conexão com o banco e cria o objeto DAO
        require_once '../../../config/Dao.php'; 
        $dao = new Dao();

        // Chama o método para desfavoritar a academia
        $dao->desfavoritarAcademia($usuarioId, $idAcademia);

        // Redireciona de volta para a página de favoritos
        header("Location: favoritos.php");
        exit;
    } else {
        echo "ID da academia não foi fornecido.";
    }
} else {
    // Caso o usuário não esteja logado, redireciona para a página de login
    header("Location: ../../index.php?error=auth");
    exit;
}
?>
