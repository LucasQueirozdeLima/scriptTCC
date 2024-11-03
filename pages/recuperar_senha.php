<?php
include "../includes/cabecalho.php";
include "../includes/navbar.php";
?>

<main class="mainLogin">
    <div class="login">
        <h2>Recuperar senha</h2>
        <form class="login-form" action="../intermediarios/recuperar_processo.php" method="post">
        <div class="textbox">
                <label for="email"></label>
                <input type="email" id="email" name="email" placeholder="Digite seu e-mail cadastrado" required>
                <i class="fas fa-user"></i>
            </div>

            <div class="textbox">
                <label for="nova_senha"></label>
                <input type="password" id="nova_senha" name="nova_senha" placeholder="Digite a nova senha" required>
                <i class="fas fa-lock"></i>
            </div>

            <button type="submit">RECUPERAR SENHA</button>
        </form>
    </div>
</main>



<?php
include "../includes/rodape.php";
?>
