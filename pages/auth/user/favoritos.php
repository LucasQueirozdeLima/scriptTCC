<?php
session_start();

if (isset($_SESSION["verificador"])) {
  include "cabecalho_user.php";
  include "sidebar.php";

  require_once '../../../config/Dao.php';
  $dao = new Dao();

  // Verifica se o usuário está logado e busca os favoritos
  $usuarioId = $_SESSION['id_usuario'];
  $favoritos = $dao->getFavoritos($usuarioId);
?>
  <div class="boxbox">
    <div class="box">
      <section>
        <h2 class="title_fav">Academias Favoritadas</h2>
        <?php if (count($favoritos) > 0): ?>
          <div class="favoritos-container">
            <?php foreach ($favoritos as $row): ?>
              <div class="favorito-item">
                <h3><?php echo htmlspecialchars($row['razao_social']); ?></h3>
                <p><strong>Endereço:</strong>
                  <?php echo htmlspecialchars("{$row['rua']}, Nº {$row['numero']}, {$row['bairro']}, {$row['cidade']}"); ?>
                  <?php if (!empty($row['complemento'])): ?>
                    <?php echo htmlspecialchars(" - {$row['complemento']}"); ?>
                  <?php endif; ?>
                  <?php echo htmlspecialchars(", CEP: {$row['cep']}"); ?>
                </p>
                <p><strong>Capacidade Máxima:</strong> <?php echo htmlspecialchars($row['capacidade_max']); ?> pessoas</p>

                <form action="buscar_academias.php" method="GET">
                  <input type="hidden" name="id_academia" value="<?php echo htmlspecialchars($row['id_academia']); ?>">
                  <button type="submit" class="btn btn-primary">Selecionar</button>
                </form>

                <form action="desfavoritar_academia.php" method="POST">
                  <input type="hidden" name="academia_id" value="<?php echo htmlspecialchars($row['id_academia']); ?>">
                  <button type="submit" class="btn btn-danger">Remover dos Favoritos</button>
                </form>
              </div>
            <?php endforeach; ?>
          </div>

        <?php else: ?>
          <p style="color: black;">Você ainda não favoritou nenhuma academia.</p>
        <?php endif; ?>
      </section>
    </div>
  </div>

  <script>
    function updateHiddenInput(uid) {
      document.getElementById('selectedAcademyUid').value = uid; // Atualiza o campo oculto com o ID da academia
    }
  </script>

<?php
  include "rodapeUser.php";
} else {
  header("Location: ../../index.php?error=auth");
  exit;
}
?>