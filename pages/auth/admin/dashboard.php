<?php
session_start();

if (isset($_SESSION["verificador"])) {
  include "cabecalho_admin.php";
  include "sidebar_admin.php";
?>

  <body class="b_dashboard">

    <div class="dashboard">
      <div class="card" id="cardPessoasPresentes">
        <h2>Pessoas Presentes</h2>
        <h3>Dia</h3>
        <var>
          0
          <abbr>pessoas</abbr>
        </var>
      </div>
      <div class="card" id="cardMaxPessoas">
        <h2>Máximo de Pessoas</h2>
        <h3>Dia</h3>
        <var>
          0
          <abbr>pessoas</abbr>
        </var>
      </div>
      <div class="card">
        <h2>Máximo Alcançado</h2>
        <h3>Dia</h3>
        <var>
          0
          <abbr>pessoas</abbr>
        </var>
      </div>

    </div>
    <div id="containerAcademias" class="container-academias">
      <!-- Os cards serão gerados aqui pelo JavaScript -->
    </div>

    <script>
      // Passando o id_admin do PHP para o JavaScript
      const id_admin = <?php echo json_encode($_SESSION['id_admin']); ?>;

      document.addEventListener("DOMContentLoaded", () => {
        getTotalPessoasPresentes();
        getTotalPessoas();
        gerarCardsAcademias();
        getMaxAlcancado();
      });

      function getTotalPessoasPresentes() {
        const id_admin = "<?php echo $_SESSION['id_admin']; ?>";

        // Refere-se à coleção 'ACADEMIAS' no Firestore
        var academiasRef = db.collection("ACADEMIAS");

        // Escuta as mudanças na coleção onde id_admin é igual ao usuário logado
        academiasRef.where("id_admin", "==", id_admin).onSnapshot((querySnapshot) => {
          var totalPessoasPresentes = 0;

          // Itera sobre cada documento retornado na consulta
          querySnapshot.forEach((doc) => {
            var data = doc.data();
            var pessoasPresentes = data.pessoaPresente || 0; // Caso o campo pessoaPresente não exista, trata como 0
            totalPessoasPresentes += pessoasPresentes; // Soma o valor de pessoasPresentes
          });

          // Atualiza o conteúdo do card de "Pessoas Presentes" com o valor atualizado
          document.querySelector('#cardPessoasPresentes var').innerText = totalPessoasPresentes + " pessoas";
        }, (error) => {
          console.error("Erro ao ouvir mudanças nas academias: ", error);
        });
      }

      querySnapshot.forEach((doc) => {
        const progresso = (data.pessoaPresente / data.maxPessoas) * 100;

        var card = document.createElement('div');
        card.classList.add('card');

        card.innerHTML = `
      <h2>${data.nome}</h2>
      <div class="card-progress">
          <progress value="${progresso}" max="100"></progress>
          <span>${Math.round(progresso)}% de ocupação</span>
      </div>
  `;
        container.appendChild(card);
      });


      function atualizarDados() {
        getTotalPessoasPresentes();
        getTotalPessoas();
        gerarCardsAcademias();
        getMaxAlcancado();
      }

      // Atualiza os dados a cada 30 segundos
      setInterval(atualizarDados, 30000);


      function gerarCardsAcademias() {
        const id_admin = "<?php echo $_SESSION['id_admin']; ?>";

        // Refere-se à coleção 'ACADEMIAS' no Firestore
        var academiasRef = db.collection("ACADEMIAS");

        // Escuta as mudanças na coleção onde id_admin é igual ao usuário logado
        academiasRef.where("id_admin", "==", id_admin).onSnapshot((querySnapshot) => {
          // Limpa a área onde os cards serão inseridos (para não duplicar)
          var container = document.getElementById('containerAcademias');
          container.innerHTML = '';

          // Itera sobre cada documento retornado na consulta e cria o card
          querySnapshot.forEach((doc) => {
            var data = doc.data();
            var nomeAcademia = data.nome || "Academia sem nome";
            var pessoasPresentes = data.pessoaPresente || 0;



            // Criação do card de cada academia
            var card = document.createElement('div');
            card.classList.add('card-academia');
            // Conteúdo do card
            card.innerHTML = `
  <h2>${nomeAcademia}</h2>
  <div class="card-icon">
    <img src="../../../estilizacao/images/svg/heart.svg" alt="Icone de coração" />
    <div>
      <h3>Pessoas Presentes</h3>
      <var>${pessoasPresentes}</var>
    </div>
  </div>
  <a href="detalhes_academia.php?id=${doc.id}" class="btn-detalhes">Ver Detalhes</a>
`;


            // Adiciona o card ao container
            container.appendChild(card);
          });
        }, (error) => {
          console.error("Erro ao ouvir mudanças nas academias: ", error);
        });
      }

      document.querySelectorAll('.card h2').forEach((header) => {
        header.addEventListener('click', () => {
          const parentCard = header.parentElement;
          parentCard.classList.toggle('collapsed');
          const content = parentCard.querySelector('var, .card-icon');
          if (parentCard.classList.contains('collapsed')) {
            content.style.display = 'none';
          } else {
            content.style.display = 'block';
          }
        });
      });

      function getMaxAlcancado() {
        const id_admin = "<?php echo $_SESSION['id_admin']; ?>";
        var academiasRef = db.collection("ACADEMIAS");

        academiasRef.where("id_admin", "==", id_admin).onSnapshot((querySnapshot) => {
          let maxAlcancado = 0;

          querySnapshot.forEach((doc) => {
            const data = doc.data();
            const maximoPessoas = data.maxAlcancado || 0;
            maxAlcancado = Math.max(maxAlcancado, maximoPessoas); // Verifica o maior valor de pessoas presentes
          });

          // Atualiza o conteúdo do card de "Máximo Alcançado" com o valor atualizado
          document.querySelector('.dashboard .card:nth-child(3) var').innerText = maxAlcancado + " pessoas";
        }, (error) => {
          console.error("Erro ao ouvir mudanças nas academias para o máximo alcançado: ", error);
        });
      }


      function getTotalPessoas() {

        const id_admin = "<?php echo $_SESSION['id_admin']; ?>";
        // Refere-se à coleção 'ACADEMIAS' no Firestore
        var academiasRef = db.collection("ACADEMIAS");

        // Escuta as mudanças na coleção onde id_admin é igual ao usuário logado
        academiasRef.where("id_admin", "==", id_admin).onSnapshot((querySnapshot) => {
          var totalMaxPessoas = 0;

          // Itera sobre cada documento retornado na consulta
          querySnapshot.forEach((doc) => {
            var data = doc.data();
            var maxPessoas = data.maxPessoas || 0; // Caso o campo maxPessoas não exista, trata como 0
            totalMaxPessoas += maxPessoas; // Soma o valor de maxPessoas
          });

          // Atualiza o conteúdo do card de "Máximo de Pessoas" com o valor atualizado
          document.querySelector('#cardMaxPessoas var').innerText = totalMaxPessoas + " pessoas";
        }, (error) => {
          console.error("Erro ao ouvir mudanças nas academias: ", error);
        });
      }
    </script>

  </body>

<?php
} else {
  header("Location: ../../index.php?error=auth");
}

include "rodape.php";
?>