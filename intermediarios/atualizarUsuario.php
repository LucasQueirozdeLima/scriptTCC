<?php 

session_start();
$verificador = $_SESSION["verificador"];
$verificadorID = $_SESSION['id_usuario'];

require_once '../config/Dao.php';
$dao = new Dao();

$nome = $_POST['nome'];
$nome_usuario = $_POST['nome_usuario'];
$email = $_POST['email'];
$senha = $_POST['senha'];

$dao->atualizarUsuario( $nome, $nome_usuario, $email, $senha, $verificadorID);
