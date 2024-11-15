<?php
session_start();

if (isset($_SESSION["verificador"])) {
include "cabecalho_admin.php";
include "sidebar_admin.php";
?>



<div class="boxbox">
    <div class="box">
      <h2 style="color: black;">VOCÊ ESTÁ NO PERFIL MEU MANO</h2>

      <div class="content-home">

      </div>

    </div>
  </div>





<?php
} else {
  header("Location: ../../index.php?error=auth");
}
include "rodape.php";
?>