<?php
session_start();

if (isset($_SESSION["verificador"])) {
  include "cabecalho_user.php";
  include "sidebar.php";

  require_once '../../../config/Dao.php';
  $dao = new Dao();

  // Verifica se o usuário está logado e busca os favoritos
  $usuarioId = $_SESSION['id_usuario']; // Ajuste de acordo com a sua sessão
  $favoritos = $dao->getFavoritos($usuarioId); // Chama o método do DAO para buscar os favoritos
?>
  <div class="favoritosGeral">
    <section class="favoritos-lista">
      <h2 class="h2-person">Academias Favoritadas</h2>
      <?php if (count($favoritos) > 0): ?>
        <div class="favoritos-container">
          <?php foreach ($favoritos as $row): ?>
            <div class="favorito-item">
              <h3><?php echo htmlspecialchars($row['razao_social']); ?></h3>
              <p><strong>Endereço:</strong> <?php echo htmlspecialchars($row['endereco_id']); ?></p>
              <p><strong>Capacidade Máxima:</strong> <?php echo htmlspecialchars($row['capacidade_max']); ?> pessoas</p>
              <form action="desfavoritar_academia.php" method="POST">
                <input type="hidden" name="academia_id" value="<?php echo $row['id_academia']; ?>">
                <button type="submit" class="btn btn-danger">Remover dos Favoritos</button>
              </form>
            </div>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <p>Você ainda não favoritou nenhuma academia.</p>
      <?php endif; ?>
    </section>
  </div>

  <style>
  .favoritosGeral {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
    margin-left: 250px;
    box-sizing: border-box;
    overflow-y: auto;
  }

  .favoritos-lista h2 {
    margin-bottom: 20px;
    text-align: center;
    color: #FFF; /* Cor do título para garantir visibilidade */
  }

  .favoritos-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    width: 100%;
  }

  .favorito-item {
    background-color: #f4f4f4; /* Cor de fundo suave */
    padding: 15px;
    border: 1px solid #ddd; /* Cor de borda mais suave */
    border-radius: 8px;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Adicionando sombra para destacar o card */
  }

  .favorito-item h3 {
    margin-bottom: 10px;
    color: #333; /* Cor do título para garantir boa visibilidade */
  }

  .favorito-item p {
    color: #555; /* Cor do texto para melhor legibilidade */
  }

  .btn-danger {
    background-color: #d9534f;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
  }

  .btn-danger:hover {
    background-color: #c9302c;
  }
</style>


<?php
  include "rodapeUser.php";
} else {
  header("Location: ../../index.php?error=auth");
  exit;
}
?>