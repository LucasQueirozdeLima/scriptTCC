<?php

session_start();

include "cabecalho_admin.php";

if (isset($_SESSION["verificador"])) {
  include "sidebar_admin.php";
} else {
  header("Location: ../../index.php?error=auth");
}

include "rodape.php";
