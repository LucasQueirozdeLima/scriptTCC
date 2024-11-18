
<?php 
session_start();

if (isset($_SESSION["verificador"])) {
include "cabecalho_admin.php";
include "sidebar_admin.php"; 
?>


  <body class="b_dashboard">
    
  <div class="dashboard">
      <div class="card">
         <!-- <img src="../../../estilizacao/images/svg/more.svg" class="more" /> -->  
        <h2>Pessoas Presentes</h2>
        <h3>Dia</h3>
        <var>
          0
          <abbr>pessoas</abbr>
        </var>
      </div>
      <div class="card ">
         <!--<img src="../../../estilizacao/images/svg/more.svg" class="more" /> -->   
        <h2>Máximo de Pessoas</h2>
        <h3>Dia</h3>
        <var>
          100 
          <abbr>pessoas</abbr>
        </var>
      </div>
      <div class="card">
        <!--<img src="../../../estilizacao/images/svg/more.svg" class="more" /> -->      
        <h2>Maximo Alcançado</h2>
        <h3>Dia</h3>
        <var>
          80
          <abbr>pessoas</abbr>
        </var>
      </div>
      <div class="card">
        <h2>Progress</h2>
        <div class="card-progress">
          <progress value="50" max="100"></progress>
          <var>
            16k
            <abbr>TASKS</abbr>
          </var>
        </div>
      </div>
      <div class="card">
        <h2>Products</h2>
        <div class="card-icon">
          <img src="../../../estilizacao/images/svg/cog.svg" />
          <div>
            <h3>Total</h3>
            <var> 41k </var>
          </div>
        <!--<img src="../../../estilizacao/images/svg/chevron.svg" /> -->      
        </div>
      </div>
      <div class="card">
        <h2>Reviews</h2>
        <div class="card-icon">
          <img src="../../../estilizacao/images/svg/heart.svg" />
          <div>
            <h3>Rating</h3>
            <var> 71% </var>
          </div>
        <!--<img src="../../../estilizacao/images/svg/chevron.svg" />  -->  
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
        container.innerHTML = `<p>Nenhuma academia cadastrada.</p>`;
        return;
    }

    let totalPessoasPresentes = 0;
    let maxPessoasDia = 0;
    let maxPessoasAlcancadas = 0;

    querySnapshot.forEach((doc) => {
        const academia = doc.data();
        const pessoasPresentes = academia.pessoaPresente || 0;
        const capacidadeMax = academia.maxPessoas || 0;

        // Atualizando as estatísticas
        totalPessoasPresentes += pessoasPresentes;
        maxPessoasDia = Math.max(maxPessoasDia, pessoasPresentes);
        maxPessoasAlcancadas = Math.max(maxPessoasAlcancadas, capacidadeMax);

        // Exibindo as academias no frontend
        const card = `
            <div class="academia-card">
                <h3>${academia.nome}</h3>
                <p><strong>Capacidade Máxima:</strong> ${academia.maxPessoas}</p>
                <p><strong>Pessoas Presentes:</strong> ${academia.pessoaPresente}</p>
                <button onclick="selecionarAcademia('${doc.id}')">Selecionar</button>
            </div>
        `;
        container.innerHTML += card;
    });

    // Atualizando os valores no painel do dashboard
    document.getElementById("pessoas-presentes").innerText = totalPessoasPresentes;
    document.getElementById("max-pessoas-dia").innerText = maxPessoasDia;
    document.getElementById("max-pessoas-alcancadas").innerText = maxPessoasAlcancadas;
}

    </script>

    </body>

<?php 
} else {
  header("Location: ../../index.php?error=auth");
}

include "rodape.php"; 
?>