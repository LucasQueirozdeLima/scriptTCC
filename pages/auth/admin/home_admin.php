<?php

session_start();

include "cabecalho_admin.php";

if (isset($_SESSION["verificador"])) {
  include "sidebar_admin.php";
} else {
  header("Location: ../../index.php?error=auth");
}
?>


<div class="boxbox">
  <div class="box">
  <h2 class="titulo-bem-vindo">Seja Bem-vindo, <?php echo $_SESSION['verificador']; ?>!</h2>
  <h3 style="color: black;">Tenha o controle de suas academias.</h3>
  </div>
</div>


<?php
include "rodape.php";
?>