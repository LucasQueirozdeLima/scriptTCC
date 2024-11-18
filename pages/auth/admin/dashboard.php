
<?php 
session_start();

if (isset($_SESSION["verificador"])) {
include "cabecalho_admin.php";
include "sidebar_admin.php"; 
?>


  <body class="b_dashboard">
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
</style>
  <div class="dashboard">
      <div class="card">
         <!-- <img src="../../../estilizacao/images/svg/more.svg" class="more" /> -->  
        <h2>Pessoas Presentes</h2>
        <h3>Dia</h3>
        <var id="pessoas-presentes">0</var>
          <abbr>pessoas</abbr>
      </div>
      <div class="card ">
         <!--<img src="../../../estilizacao/images/svg/more.svg" class="more" /> -->   
        <h2>Máximo de Pessoas</h2>
        <h3>Dia</h3>
        <var id="max-pessoas-dia">0</var>
          <abbr>pessoas</abbr>
        
      </div>
      <div class="card">
        <!--<img src="../../../estilizacao/images/svg/more.svg" class="more" /> -->      
        <h2>Maximo Alcançado</h2>
        <h3>Dia</h3>
        <var id="max-pessoas-alcancadas">0</var>
          <abbr>pessoas</abbr>
        
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

    window.onload = function() {
        listarAcademias();
    };

    async function listarAcademias() {
        const querySnapshot = await db.collection("ACADEMIAS").where("id_admin", "==", id_admin).get();
        let totalPessoasPresentes = 0;
        let maxPessoasDia = 0;
        let maxPessoasAlcancadas = 0;

        if (querySnapshot.empty) {
            alert("Nenhuma academia encontrada.");
            return;
        }

        querySnapshot.forEach((doc) => {
            const academia = doc.data();
            const pessoasPresentes = academia.pessoaPresente || 0;
            const capacidadeMax = academia.maxPessoas || 0;

            totalPessoasPresentes += pessoasPresentes;
            maxPessoasDia = Math.max(maxPessoasDia, pessoasPresentes);
            maxPessoasAlcancadas = Math.max(maxPessoasAlcancadas, capacidadeMax);
        });

        // Atualizando o dashboard com os valores calculados
        document.getElementById("pessoas-presentes").innerText = totalPessoasPresentes;
        document.getElementById("max-pessoas-dia").innerText = maxPessoasDia;
        document.getElementById("max-pessoas-alcancadas").innerText = maxPessoasAlcancadas;
    }

  function selecionarAcademia(academiaId) {
        alert(`Academia selecionada com ID: ${academiaId}`);
       
    }
    </script>

    </body>

<?php 
} else {
  header("Location: ../../index.php?error=auth");
}

include "rodape.php"; 
?>