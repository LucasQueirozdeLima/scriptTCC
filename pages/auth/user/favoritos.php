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
        <div id="academiaVazia">
          <h2 class="title_fav">Academias Favoritadas</h2>
        </div>
        
        <?php if (count($favoritos) > 0): ?>
          <div class="favoritos-container">
            <?php foreach ($favoritos as $row): ?>
              <div class="favorito-item" id="academia-<?php echo htmlspecialchars($row['id_academia']); ?>">
                <h3><?php echo htmlspecialchars($row['razao_social']); ?></h3>
                <p><strong>Endereço:</strong>
                  <?php echo htmlspecialchars("{$row['rua']}, Nº {$row['numero']}, {$row['bairro']}, {$row['cidade']}"); ?>
                  <?php if (!empty($row['complemento'])): ?>
                    <?php echo htmlspecialchars(" - {$row['complemento']}"); ?>
                  <?php endif; ?>
                  <?php echo htmlspecialchars(", CEP: {$row['cep']}"); ?>
                </p>
                <p><strong>Capacidade Máxima:</strong> <?php echo htmlspecialchars($row['capacidade_max']); ?> pessoas</p>
                <p><strong>Pessoas Presentes:</strong> <span class="pessoa-presente">Carregando...</span></p>

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


  // Inicializar conexão com o Firestore
  const academiasRef = db.collection("ACADEMIAS");

  document.addEventListener("DOMContentLoaded", () => {
    
    const academiaIds = [...document.querySelectorAll('.favorito-item')].map(item => item.id.replace('academia-', ''));

    
    academiaIds.forEach(idAcademia => {
      academiasRef.doc(idAcademia).get().then(doc => {
        if (doc.exists) {
          const pessoaPresente = doc.data().pessoaPresente;
          // Atualizar o valor na página
          const target = document.querySelector(`#academia-${idAcademia} .pessoa-presente`);
          if (target) {
            target.textContent = `${pessoaPresente} pessoas`;
          }
        } else {
          console.error(`Academia com ID ${idAcademia} não encontrada no Firestore.`);
        }
      }).catch(error => {
        console.error(`Erro ao buscar dados da academia ${idAcademia}:`, error);
      });
    });
  });

  document.addEventListener("DOMContentLoaded", () => {
  const academiaIds = [...document.querySelectorAll('.favorito-item')].map(item => item.id.replace('academia-', ''));
  let menosOcupada = null;
  let menorOcupacaoPercentual = 101; // Percentual inicial maior que 100%
  let totalFavoritadas = academiaIds.length;

  academiaIds.forEach(idAcademia => {
    academiasRef.doc(idAcademia).get().then(doc => {
      if (doc.exists) {
        const data = doc.data();
        const pessoaPresente = data.pessoaPresente || 0;
        const maxPessoas = data.maxPessoas || 1; // Evitar divisão por 0
        const ocupacaoPercentual = (pessoaPresente / maxPessoas) * 100;

        // Atualizar o valor na página
        const target = document.querySelector(`#academia-${idAcademia} .pessoa-presente`);
        if (target) {
          target.textContent = `${pessoaPresente} pessoas`;
        }

        // Verificar se esta academia é menos ocupada
        if (ocupacaoPercentual < menorOcupacaoPercentual) {
          menosOcupada = {
            nome: data.nome,
            ocupacaoPercentual,
          };
          menorOcupacaoPercentual = ocupacaoPercentual;
        }

        // Quando todos os dados forem carregados, exibir o resultado
        totalFavoritadas--;
        if (totalFavoritadas === 0 && menosOcupada) {
          mostrarAcademiaMenosOcupada(menosOcupada);
        }
      } else {
        console.error(`Academia com ID ${idAcademia} não encontrada no Firestore.`);
      }
    }).catch(error => {
      console.error(`Erro ao buscar dados da academia ${idAcademia}:`, error);
    });
  });
});

// Exibe a academia menos ocupada
function mostrarAcademiaMenosOcupada(menosOcupada) {
  const comparacaoContainer = document.createElement('p');
  let colorBack = '';
  let color = '';
  
  if (menosOcupada.ocupacaoPercentual <= 50) {
    colorBack = '#098718';
    color = 'white';
  } else if (menosOcupada.ocupacaoPercentual <= 80) {
    colorBack = 'yellow';
    color = 'black';
  } else if (menosOcupada.ocupacaoPercentual >= 81) {
    colorBack = 'red';
    color = 'white';
  }

  comparacaoContainer.style.color = color;
  comparacaoContainer.style.marginTop = '20px';
  comparacaoContainer.textContent = `A academia menos ocupada é "${menosOcupada.nome}" com ${menosOcupada.ocupacaoPercentual.toFixed(2)}% de ocupação.`;
  document.querySelector('#academiaVazia').appendChild(comparacaoContainer);
  comparacaoContainer.style.backgroundColor = colorBack;
  comparacaoContainer.style.padding = '10px';
  comparacaoContainer.style.borderRadius = '5px';

  



}


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