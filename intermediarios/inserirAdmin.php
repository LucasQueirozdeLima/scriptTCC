<?php 

require_once "../config/dao.php";
$dao = new Dao();

$nome = $_POST['nome'];
$nome_usuario = $_POST['nome_usuario'];
$documento = $_POST['documento'];
$email = $_POST['email'];
$cargo = $_POST['cargo'];
$senha = $_POST['senha'];

$dao->inserirUsuarioAdmin($nome, $nome_usuario, $documento, $email, $cargo, $senha);
