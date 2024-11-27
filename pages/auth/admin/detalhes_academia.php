<?php
session_start();

// Verificar se o usuário está logado
if (isset($_SESSION["verificador"])) {
  include "cabecalho_admin.php";
  include "sidebar_admin.php";
?>
<body class="body_detalhes">
  <div class="boxbox_detalhes">
    <div class="box_detalhes">
      
        <h2>Detalhes da Academia</h2>

        <div id="academia-details">
          <!-- Os detalhes da academia serão preenchidos aqui via JavaScript -->
        </div>

        <div id="logs-entrada-saida"></div>


     
    </div>
  </div>
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      // Pegar o ID da academia da URL
      const urlParams = new URLSearchParams(window.location.search);
      const academiaId = urlParams.get("id");

      if (academiaId) {
        // Buscar os dados da academia no Firebase
        db.collection('ACADEMIAS').doc(academiaId).get().then(doc => {
          if (doc.exists) {
            const data = doc.data();

            // Preencher os detalhes da academia na página
            const academiaDetails = document.getElementById('academia-details');
            academiaDetails.innerHTML = `
          <h3>${data.nome}</h3>
          <p><strong>Endereço:</strong> ${data.rua}, ${data.numero} - ${data.bairro}, ${data.cidade}</p>
          <p><strong>Capacidade Máxima:</strong> ${data.maxPessoas} pessoas</p>
          <p><strong>Pessoas Presentes:</strong> ${data.pessoaPresente} pessoas</p>
          <p><strong>Descrição:</strong> ${data.descricao || "Sem descrição disponível."}</p>
        `;

            // Buscar logs de entrada/saída
            const logsEntradaSaidaList = document.getElementById('logs-entrada-saida');

            // Buscar os logs das subcoleções de 'entradas' e 'saidas'
            const entradasRef = db.collection('ACADEMIAS').doc(academiaId).collection('entradas').orderBy('timestamp', 'desc');
            const saidasRef = db.collection('ACADEMIAS').doc(academiaId).collection('saidas').orderBy('timestamp', 'desc');

            // Buscar logs de entrada
            entradasRef.get().then(entradasSnapshot => {
              let entradasHtml = '';
              entradasSnapshot.forEach(entradaDoc => {
                const logEntrada = entradaDoc.data();
                entradasHtml += `<li>Entrada: ${logEntrada.timestamp.toDate().toLocaleString()} - Pessoas presentes: ${logEntrada.pessoaPresente}</li>`;
              });

              // Buscar logs de saída
              saidasRef.get().then(saidasSnapshot => {
                let saidasHtml = '';
                saidasSnapshot.forEach(saidaDoc => {
                  const logSaida = saidaDoc.data();
                  saidasHtml += `<li>Saída: ${logSaida.timestamp.toDate().toLocaleString()} - Pessoas presentes: ${logSaida.pessoaPresente}</li>`;
                });

                // Exibir os logs na página
                logsEntradaSaidaList.innerHTML = `
              <h4>Logs de Entrada:</h4>
              <ul>${entradasHtml || "<li>Sem entradas registradas.</li>"}</ul>
              <h4>Logs de Saída:</h4>
              <ul>${saidasHtml || "<li>Sem saídas registradas.</li>"}</ul>
            `;
              }).catch(error => {
                console.error("Erro ao buscar logs de saída:", error);
                logsEntradaSaidaList.innerHTML = "<p>Erro ao carregar os logs de saída.</p>";
              });
            }).catch(error => {
              console.error("Erro ao buscar logs de entrada:", error);
              logsEntradaSaidaList.innerHTML = "<p>Erro ao carregar os logs de entrada.</p>";
            });

          } else {
            academiaDetails.innerHTML = "<p>Academia não encontrada.</p>";
          }
        }).catch(error => {
          console.error("Erro ao buscar dados da academia:", error);
          document.getElementById('academia-details').innerHTML = "<p>Erro ao carregar os detalhes da academia.</p>";
        });
      } else {
        document.getElementById('academia-details').innerHTML = "<p>ID da academia não fornecido.</p>";
      }
    });

    // Limitar a exibição de logs
const MAX_LOGS = 10;

const limitarLogs = (logsSnapshot) => {
  const logs = [];
  logsSnapshot.forEach((doc) => {
    logs.push(doc.data());
  });
  return logs.slice(0, MAX_LOGS); // Retorna os 10 primeiros registros
};

// Usar a função ao carregar os logs
entradasRef.get().then((snapshot) => {
  const entradasLimitadas = limitarLogs(snapshot);
  // Renderize apenas os logs limitados
});

  </script>

</body>
<?php
  include "rodape.php";
} else {
  header("Location: ../../index.php?error=auth");
  exit;
}
?>