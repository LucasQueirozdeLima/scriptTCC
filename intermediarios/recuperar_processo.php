<?php
require_once "../config/Dao.php";
$dao = new Dao();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $novaSenha = $_POST["nova_senha"];

    if ($dao->atualizarSenha($email, $novaSenha)) {
        header("Location: ../pages/login.php?mensagem=senha_alterada");
    } else {
        header("Location: ../pages/recuperar_senha.php?erro=email_nao_encontrado");
    }
}
?>
