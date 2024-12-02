<?php
session_start();

if (isset($_SESSION["verificador"])) {
  include "cabecalho_admin.php";
  include "sidebar_admin.php";
?>
  <style>
    .academias-container {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
    }

    .academia-card {
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      width: 300px;
      padding: 15px;
      text-align: center;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .academia-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
    }

    .academia-card h3 {
      font-size: 20px;
      color: #555;
      margin-bottom: 10px;
    }

    .academia-card p {
      font-size: 16px;
      margin: 5px 0;
      color: #666;
    }

    .academia-card button {
      margin-top: 10px;
      padding: 10px 15px;
      background-color: #007BFF;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 14px;
      transition: background-color 0.3s ease;
    }

    .academia-card button:hover {
      background-color: #0056b3;
    }

    .academia-card .btn-remover {
      margin-top: 10px;
      padding: 10px 15px;
      background-color: #dc3545;

      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 14px;
      transition: background-color 0.3s ease;
    }

    .academia-card .btn-remover:hover {
      background-color: #a71d2a;

    }


    /* Estilizando o modal para abrir abaixo dos cards */
    #modal-editar {
      position: relative;
      /* Removido o 'absolute' para ele ser posicionado naturalmente no fluxo */
      background-color: #fff;
      padding: 20px 30px;
      width: 400px;
      max-width: 90%;
      border-radius: 10px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
      z-index: 1000;
      display: none;
      margin-top: 20px;
      /* Espaço acima para separá-lo dos cards */

    }

    #modal-editar.open {
      display: block;
    }

    /* Estilo para o fundo escurecido */
    #modal-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.6);
      z-index: 999;
      display: none;
    }

    /* Responsividade */
    @media (max-width: 600px) {
      #modal-editar {
        width: 90%;
        padding: 15px;
      }

      .modal-content button {
        width: 100%;
        margin-bottom: 10px;
      }
    }


    /* Estilização do Formulário */
    .modal-content h3 {
      margin-bottom: 15px;
      font-size: 20px;
      color: #333;
      text-align: center;
    }

    .modal-content .form-group {
      margin-bottom: 15px;
    }

    .modal-content label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
      font-size: 14px;
      color: #555;
    }

    .modal-content input {
      width: 100%;
      padding: 8px 10px;
      border: 1px solid #ddd;
      border-radius: 5px;
      font-size: 14px;
    }

    .modal-content input:focus {
      border-color: #007bff;
      outline: none;
      box-shadow: 0 0 5px rgba(0, 123, 255, 0.2);
    }

    .modal-content button {
      width: 48%;
      padding: 10px 15px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 14px;
      margin-top: 10px;
    }

    .modal-content button[type="submit"] {
      background-color: #28a745;
      color: white;
      transition: background-color 0.3s ease;
    }

    .modal-content button[type="submit"]:hover {
      background-color: #218838;
    }

    .modal-content button[type="button"] {
      background-color: #dc3545;
      color: white;
      transition: background-color 0.3s ease;
    }

    .modal-content button[type="button"]:hover {
      background-color: #c82333;
    }



    .modal-content input {
      width: 100%;
      padding: 8px 10px;
      border: 1px solid #333;
      border-radius: 5px;
      font-size: 14px;
      background-color: #fff;
      color: #333;
    }

    .modal-content input:focus {
      border-color: #007bff;
      outline: none;
      box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .modal-content label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
      font-size: 14px;
      color: #333;
    }


    .modal-content .form-group {
      margin-bottom: 15px;
    }
  </style>

  <div class="boxbox">
    <div class="box">

      <h2 style="color: black;">Minhas Academias</h2>
      <div class="academias-container" id="lista-academias">

      </div>
      <div id="modal-editar" style="display: none;">
        <div class="modal-content">
          <h3>Alterar Academia</h3>
          <form id="formEditarAcademia" method="POST">
            <input type="hidden" id="editar_id_academia" />
            <div class="form-group">
              <label for="editar_nome">Nome:</label>
              <input type="text" id="editar_nome" required minlength="3" maxlength="50" />
            </div>
            <div class="form-group">
              <label for="editar_capacidade">Capacidade Máxima:</label>
              <input type="number" id="editar_capacidade" required />
            </div>
            <div class="form-group">
              <label for="editar_rua">Rua:</label>
              <input type="text" id="editar_rua" required minlength="3" maxlength="100" />
            </div>
            <div class="form-group">
              <label for="editar_numero">Número:</label>
              <input type="number" id="editar_numero" required />
            </div>
            <div class="form-group">
              <label for="editar_bairro">Bairro:</label>
              <input type="text" id="editar_bairro" required minlength="3" maxlength="50" />
            </div>
            <div class="form-group">
              <label for="editar_cidade">Cidade:</label>
              <input type="text" id="editar_cidade" required minlength="2" maxlength="30" />
            </div>
            <button type="submit">Salvar Alterações</button>
            <button type="button" onclick="fecharModal()">Cancelar</button>
          </form>
        </div>
        <div class="academias-container" id="lista-academias"></div>

      </div>


    </div>
  </div>

  <script>
    const id_admin = "<?php echo $_SESSION['id_admin']; ?>";


    async function listarAcademias() {
      const container = document.getElementById("lista-academias");
      container.innerHTML = ""; // Limpar lista anterior

      const querySnapshot = await db.collection("ACADEMIAS").where("id_admin", "==", id_admin).get();

      if (querySnapshot.empty) {
        container.innerHTML = `<p style="color: black;">Nenhuma academia cadastrada.</p>`;
        return;
      }

      querySnapshot.forEach((doc) => {
        const academia = doc.data();
        const card = `
    <div class="academia-card">
        <h3>${academia.nome}</h3>
        <p><strong>Capacidade Máxima:</strong> ${academia.maxPessoas}</p>
        <p><strong>Pessoas Presentes:</strong> ${academia.pessoaPresente}</p>
        <button onclick="abrirModalEditar('${doc.id}', decodeURIComponent('${encodeURIComponent(JSON.stringify(academia))}'))">Alterar</button>

        <button class="btn-remover" onclick="removerAcademia('${doc.id}')">Remover</button>
    </div>
  `; // Fechamento correto do template string
        container.innerHTML += card;
      });

    }

    async function removerAcademia(idAcademia) {
      if (confirm("Tem certeza de que deseja remover esta academia?")) {
        try {
          // Remover do Firebase
          await db.collection("ACADEMIAS").doc(idAcademia).delete();

          // Fazer requisição ao servidor para remover do MySQL
          const response = await fetch('remover_academia.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({
              id_academia: idAcademia
            })
          });

          const result = await response.json();

          if (result.success) {
            alert("Academia removida com sucesso!");
          } else {
            alert("Erro ao remover do banco de dados: " + result.message);
          }

          listarAcademias();
        } catch (error) {
          console.error("Erro ao remover academia:", error);
          alert("Ocorreu um erro ao tentar remover a academia.");
        }
      }
    }




    function abrirModalEditar(idAcademia, dados) {
      console.log("Modal aberto com:", idAcademia, dados);

      // Ocultar os cards
      document.getElementById("lista-academias").style.display = "none";

      // Mostrar o formulário
      document.getElementById("modal-editar").style.display = "block";
      document.getElementById("editar_id_academia").value = idAcademia;
      document.getElementById("editar_nome").value = dados.nome || "";
      document.getElementById("editar_capacidade").value = dados.maxPessoas;
      document.getElementById("editar_rua").value = dados.rua || "";
      document.getElementById("editar_numero").value = dados.numero || "";
      document.getElementById("editar_bairro").value = dados.bairro || "";
      document.getElementById("editar_cidade").value = dados.cidade || "";
    }

    function fecharModal() {
      // Reexibir os cards
      document.getElementById("lista-academias").style.display = "flex";

      // Ocultar o formulário
      document.getElementById("modal-editar").style.display = "none";
    }


    async function atualizarAcademia() {
      const idAcademia = document.getElementById("editar_id_academia").value;
      const dadosAtualizados = {
        nome: document.getElementById("editar_nome").value,
        maxPessoas: parseInt(document.getElementById("editar_capacidade").value, 10),
        rua: document.getElementById("editar_rua").value,
        bairro: document.getElementById("editar_bairro").value,
        cidade: document.getElementById("editar_cidade").value
      };

      try {
        await db.collection("ACADEMIAS").doc(idAcademia).update(dadosAtualizados);
        alert("Academia atualizada com sucesso!");
        fecharModal();
        listarAcademias(); // Atualiza a listagem
      } catch (error) {
        console.error("Erro ao atualizar academia:", error);
        alert("Erro ao tentar atualizar a academia.");
      }
    }

    document.getElementById("formEditarAcademia").addEventListener("submit", function(event) {
      event.preventDefault();
      atualizarAcademia();
    });


    document.getElementById("formEditarAcademia").addEventListener("submit", async (e) => {
      e.preventDefault(); // Evitar recarregar a página

      const idAcademia = document.getElementById("editarIdAcademia").value;
      const nome = document.getElementById("editarNome").value;
      const maxPessoas = parseInt(document.getElementById("editarMaxPessoas").value);
      const pessoasPresentes = parseInt(document.getElementById("editarPessoasPresentes").value);

      try {
        // Atualizar os dados no Firebase
        await db.collection("ACADEMIAS").doc(idAcademia).update({
          nome: nome,
          maxPessoas: maxPessoas,
          pessoaPresente: pessoasPresentes,
        });

        alert("Academia atualizada com sucesso!");
        fecharModal();
        listarAcademias(); // Atualiza a lista de academias
      } catch (error) {
        console.error("Erro ao atualizar academia:", error);
        alert("Erro ao atualizar a academia.");
      }
    });
    listarAcademias();
  </script>

<?php
} else {
  header("Location: ../../index.php?error=auth");
}
include "rodape.php";
?>