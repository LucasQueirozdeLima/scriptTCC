<?php

include "../config/Dao.php";


$dao = new Dao();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $mensagem = $_POST['msg_contato'];

    
    $resultado = $dao->inserirContato($nome, $email, $telefone, $mensagem);

    if ($resultado) {
        
        echo "<script>alert('Mensagem enviada com sucesso!');</script>";
    } else {
        
        echo "<script>alert('Erro ao enviar a mensagem. Tente novamente.');</script>";
    }
}
?>
