<?php 

session_start();
$verificador = $_SESSION["verificador"];
$verificadorID = $_SESSION['id_admin'];

require_once '../config/Dao.php';
$dao = new Dao();

$nome = $_POST['nome'];
$nome_usuario = $_POST['nome_usuario'];
$documento = $_POST['documento'];
$email = $_POST['email'];
$cargo = $_POST['cargo'];
$senha = $_POST['senha'];

$dao->atualizarAdmin($nome, $nome_usuario, $documento, $email, $cargo, $senha, $verificadorID);
