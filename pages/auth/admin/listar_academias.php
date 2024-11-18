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
  background-color: #dc3545; /* Vermelho */
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 14px;
  transition: background-color 0.3s ease;
}

.academia-card .btn-remover:hover {
  background-color: #a71d2a; /* Vermelho mais escuro */
}
</style>

<div class="boxbox">
  <div class="box">

    <h2 style="color: black;">Minhas Academias</h2>
    <div class="academias-container" id="lista-academias">
        
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
                    <button onclick="selecionarAcademia('${doc.id}')">Selecionar</button>
                    <button onclick="removerAcademia('${doc.id}')">Remover</button>
                </div>
            `;
            container.innerHTML += card;
        });
    }

    async function removerAcademia(academiaId) {
        if (confirm("Tem certeza de que deseja remover esta academia?")) {
            try {
                await db.collection("ACADEMIAS").doc(academiaId).delete();
                alert("Academia removida com sucesso!");
                listarAcademias(); // Atualiza a lista após a remoção
            } catch (error) {
                console.error("Erro ao remover academia:", error);
                alert("Ocorreu um erro ao tentar remover a academia.");
            }
        }
    }



    // Função ao selecionar uma academia
    function selecionarAcademia(academiaId) {
        alert(`Academia selecionada com ID: ${academiaId}`);
       
    }

   
    listarAcademias();
</script>

<?php
} else {
    header("Location: ../../index.php?error=auth");
}
include "rodape.php";
?>
