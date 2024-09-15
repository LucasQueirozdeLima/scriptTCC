<?php
include "Dao.php";
$dao = new Dao();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['email'];
    $senha = $_POST['senha'];
    $dao->verificaLogin($usuario, $senha);
}
?>
