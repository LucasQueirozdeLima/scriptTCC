<?php
session_start();

if (isset($_SESSION["verificador"])) {
  include "cabecalho_user.php"; ?>

  <?php include "sidebar.php"; ?>

  <div class="boxbox">
    <div class="box">
      <h2 style="color: black;">VOCÊ ESTÁ NA HOME MEU MANO</h2>

      <div class="content-home">

      </div>

    </div>
  </div>


<?php
} else {
  header("Location: ../../index.php?error=auth");
}

include "rodapeUser.php";
?>