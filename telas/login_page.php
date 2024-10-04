
<?php
include "../esqueleto/cabecalho.php";
include "../esqueleto/navbar.php";
//include "../banco/Dao.php";

//$dao = new Dao();
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //  $usuario = $_POST['email'];
    //$senha = $_POST['senha'];
    //$dao->verificarLoginUsuario($usuario, $senha);
//}
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

      <form class="login-form">
        <div class="textbox">
          <input type="email" placeholder="Digite seu email..." />
          <span class="material-symbols-outlined"> account_circle </span>
        </div>
        <div class="textbox">
          <input type="password" placeholder="Digite sua senha..." />
          <span class="material-symbols-outlined"> lock </span>
        </div>
        <button type="submit">LOGIN</button>
        <a href="https://website.com">Esqueceu a senha?</a>
      </form>
    </div>
</main>



<?php
include "../esqueleto/rodape.php";
?>
