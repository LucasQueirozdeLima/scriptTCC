<?php
session_start();

require_once "../../../config/Dao.php";

if (!isset($_SESSION["verificador"])) {
  header("Location: ../../index.php?error=auth");
  exit();
}


$dao = new Dao();


$idAdmin = $_SESSION['id_admin'];
$dadosAdmin = $dao->recuperarDadosAdmin($idAdmin)->fetch(PDO::FETCH_ASSOC);

if (!$dadosAdmin) {
  echo "Erro ao carregar os dados do administrador.";
  exit();
}

include "cabecalho_admin.php";
include "sidebar_admin.php";
?>

<div class="boxbox">
  <div class="box">
    <h2 style="color: #0d47a1; background-color:white; border-radius:4px; box-shadow: 5px 5px 8px black;">Perfil do Administrador</h2>
    <p style="color:black;">Visualize e gerencie as informações do seu perfil.</p>


    <div class="highlight">
      <h3>Informações do Administrador</h3>
      <table>
        <tr>
          <th>Nome</th>
          <td><?php echo ($dadosAdmin['nome']); ?></td>
        </tr>
        <tr>
          <th>Nome de Usuário</th>
          <td><?php echo ($dadosAdmin['nome_usuario']); ?></td>
        </tr>
        <tr>
          <th>Email</th>
          <td><?php echo ($dadosAdmin['email']); ?></td>
        </tr>
        <tr>
          <th>Cargo</th>
          <td><?php echo ($dadosAdmin['cargo']); ?></td>
        </tr>
      </table>
      <a href="config_admin.php" class="btn-primary">Editar Perfil</a>
    </div>
  </div>
</div>

<?php include "rodape.php"; ?>