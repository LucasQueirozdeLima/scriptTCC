
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


<main>
    <h2 style="color: white;">login</h2>
    <form action="processa_login" method="POST">
        <div>
            <label for="usuario">Email</label>
            <input type="text" name="usuario" required>
        </div>
        <div>
            <label for="senha">Senha</label>
            <input type="password" name="senha" required>
        </div>
        <button type="submit" class="btn_cd_user">Entrar</button>
    </form>
</main>



<?php
include "../esqueleto/rodape.php";
?>
