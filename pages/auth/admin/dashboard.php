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
          100
          <abbr>pessoas</abbr>
        </var>
      </div>
      <div class="card">
        <h2>Máximo Alcançado</h2>
        <h3>Dia</h3>
        <var>
          80
          <abbr>pessoas</abbr>
        </var>
      </div>
      <div id="containerAcademias" class="container-academias">
        <!-- Os cards serão gerados aqui pelo JavaScript -->
      </div>

    </div>

    <script src="https://www.gstatic.com/firebasejs/10.9.0/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/10.9.0/firebase-firestore-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/10.9.0/firebase-auth-compat.js"></script>

    <script>
      // Passando o id_admin do PHP para o JavaScript
      const id_admin = <?php echo json_encode($_SESSION['id_admin']); ?>;

      document.addEventListener("DOMContentLoaded", () => {
        getTotalPessoasPresentes();
        getTotalPessoas();
        gerarCardsAcademias();
      });

      function getTotalPessoasPresentes() {
        var userId = id_admin; // ID do usuário logado

        // Refere-se à coleção 'ACADEMIAS' no Firestore
        var academiasRef = db.collection("ACADEMIAS");

        // Escuta as mudanças na coleção onde id_admin é igual ao usuário logado
        academiasRef.where("id_admin", "==", userId).onSnapshot((querySnapshot) => {
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


      function gerarCardsAcademias() {
        var userId = id_admin; // ID do usuário logado

        // Refere-se à coleção 'ACADEMIAS' no Firestore
        var academiasRef = db.collection("ACADEMIAS");

        // Escuta as mudanças na coleção onde id_admin é igual ao usuário logado
        academiasRef.where("id_admin", "==", userId).onSnapshot((querySnapshot) => {
          // Limpa a área onde os cards serão inseridos (para não duplicar)
          var container = document.getElementById('containerAcademias');
          container.innerHTML = '';

          // Itera sobre cada documento retornado na consulta e cria o card
          querySnapshot.forEach((doc) => {
            var data = doc.data();
            var nomeAcademia = data.nome || "Academia sem nome"; // Caso o nome não exista, coloca um valor padrão
            var pessoasPresentes = data.pessoaPresente || 0; // Pega o valor de pessoas presentes ou 0 se não existir

            // Criação do card de cada academia
            var card = document.createElement('div');
            card.classList.add('card');

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
                <button class="btn-detalhes" onclick="verDetalhes('${doc.id}')">Ver Detalhes</button>
            `;

            // Adiciona o card ao container
            container.appendChild(card);
          });
        }, (error) => {
          console.error("Erro ao ouvir mudanças nas academias: ", error);
        });
      }


      // Função para redirecionar para a página de detalhes da academia
      function verDetalhes(academiaId) {
        // Você pode redirecionar para uma página de detalhes ou mostrar um modal
        window.location.href = `detalhes_academia.php?id=${academiaId}`;
      }

      function getTotalPessoas() {
        var userId = id_admin; // ID do usuário logado

        // Refere-se à coleção 'ACADEMIAS' no Firestore
        var academiasRef = db.collection("ACADEMIAS");

        // Escuta as mudanças na coleção onde id_admin é igual ao usuário logado
        academiasRef.where("id_admin", "==", userId).onSnapshot((querySnapshot) => {
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