<?php 

require_once "../config/Dao.php";
$dao = new Dao();
$dao->verificarLogin($_POST['verificador'],$_POST['senha']);
session_start();
$_SESSION["verificador"] = $_POST['verificador'];