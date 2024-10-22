<?php 

require_once "../config/dao.php";
$dao = new Dao();

$nome = $_POST['nome'];
$nome_usuario = $_POST['nome_usuario'];
$email = $_POST['email'];
$senha = $_POST['senha'];

$dao->inserirUsuario($nome, $nome_usuario, $email, $senha);
