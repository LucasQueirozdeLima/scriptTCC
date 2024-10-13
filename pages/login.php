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
                <input type="email" placeholder="Digite seu email..." name="email" required />
                <span class="material-symbols-outlined">account_circle</span>
            </div>
            <div class="textbox">
                <input type="password" placeholder="Digite sua senha..." name="senha" required />
                <span class="material-symbols-outlined">lock</span>
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