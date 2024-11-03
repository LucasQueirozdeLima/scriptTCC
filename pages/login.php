<?php
include "../includes/cabecalho.php";
include "../includes/navbar.php";
?>

<main class="mainLogin">
    <div class="login">
        <h2>Login</h2>
        <form class="login-form" action="../intermediarios/verificarLogin.php" method="post">
            <div class="textbox">
                <label for="username"> </label>
                <div class="input-wrapper">
                    <input type="text" id="username" name="verificador" placeholder="Digite seu usuário" required>
                    <i class="fas fa-user"></i>
                </div>
            </div>

            <div class="textbox">
                <label for="password"> </label>
                <div class="input-wrapper">
                    <input type="password" id="password" name="senha" placeholder="Digite sua senha" required>
                    <i class="fas fa-lock"></i>
                </div>
            </div>

            <button type="submit">LOGIN</button>
            <a href="recuperar_senha.php">Esqueceu a senha?</a>
            <a href="../pages/login_cadastro.php">Cadastrar</a>
        </form>
    </div>
</main>



<?php
include "../includes/rodape.php";
?>