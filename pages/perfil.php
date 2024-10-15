<?php include "../includes/cabecalho.php"; ?>
<?php include "../includes/navbar.php"; ?>

<html lang="pt-br" class="cadastro-page">
  <body class="cadastro-page">
    <div
      id="card-cadastro"
      class="card-cadastro"
      onmousemove="onMouseMove(event)"
      onmouseleave="onMouseLeave(event)"
    >
      
      <a href="cadastro_usuario.php"><button class="cadastrar btn btn-secondary btn btn-lg">Cadastrar Usuário</button></a>
      <a href="cadastro_admin.php"><button class="cadastrar btn btn-secondary btn btn-lg">Cadastrar Admin</button></a>
    </div>
    <script type="text/javascript" src="../estilizacao/js/main.js"></script>
  </body>
</html>

<?php include "../includes/rodape.php"; ?>