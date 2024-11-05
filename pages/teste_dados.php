<?php
include "../config/Dao.php";
include "../includes/cabecalho.php";

session_start();

if (isset($_SESSION["verificador"])) {
    $verificador = $_SESSION["verificador"];

    $dao = new Dao();
    $dados = $dao->recuperarDadosUsuario($verificador);
    $linha = $dados->fetch();
    ?>

    <p class="card-text">
        nome:<?php echo $linha["nome"]; ?><br>
        username: <?php echo $linha["nome_usuario"]; ?><br>
        email: <?php echo $linha["email"]; ?><br>
        senha: <?php echo $linha["senha"]; ?><br>
    </p>

<?php
} else {
    ?>
    <a href="../pages/login.php">crie uma conta</a>
    <?php
}

include "../includes/rodape.php";