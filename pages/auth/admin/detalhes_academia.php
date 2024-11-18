<?php 
session_start();

if (isset($_SESSION["verificador"])) {
include "cabecalho_admin.php";
include "sidebar_admin.php"; 
?>





<?php 
} else {
  header("Location: ../../index.php?error=auth");
}

include "rodape.php"; 
?>