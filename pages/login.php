<?php

include "../includes/cabecalho.php";
include "../includes/navbar.php";
// include "../banco/Dao.php";

// Cria uma instância da classe Dao (descomentada caso você utilize)
// $dao = new Dao();

// Verifica se o método de requisição é POST para processar o login
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $usuario = $_POST['email'];
//     $senha = $_POST['senha'];
//     $dao->verificarLoginUsuario($usuario, $senha);
// }
?>

<main class="mainLogin">
    <div class="login">
        <h2>Login</h2>
        <form class="login-form" method="POST">
        <div class="textbox">
    <label for="username"> </label>
    <div class="input-wrapper">
        <input type="text" id="username" placeholder="Digite seu usuário">
        <i class="fas fa-user"></i>
    </div>
</div>

<div class="textbox">
    <label for="password"> </label>
    <div class="input-wrapper">
        <input type="password" id="password" placeholder="Digite sua senha">
        <i class="fas fa-lock"></i>
    </div>
</div>

            <button type="submit">LOGIN</button>
            <a href="">Esqueceu a senha?</a>
            <a href="../pages/perfil.php">Cadastrar</a>
        </form>
    </div>
</main>



<?php
include "../includes/rodape.php";
?>