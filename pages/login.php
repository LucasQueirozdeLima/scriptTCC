<?php
// Inclui os arquivos de cabeçalho e barra de navegação
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

<head>
    <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,600,0,0"
    />
</head>

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
            <a href="https://website.com">Esqueceu a senha?</a>
        </form>
    </div>
</main>

<?php
// Inclui o rodapé da página
include "../includes/rodape.php";
?>
