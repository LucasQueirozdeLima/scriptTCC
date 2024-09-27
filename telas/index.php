<?php include "../esqueleto/cabecalho.php"; ?>
<?php include "../esqueleto/navbar.php"; ?>


<main>
    <form class="form_academias" action="buscar_academias.php" method="GET">
        <h2 id="nav_acad">Localizar Academias</h2>
        <div class="input-group w-75">
            <span class="input-group-text" id="search-icon">
                <i class="bi bi-search"></i> <!-- Ícone de lupa -->
            </span>
            <input type="text" class="form-control" name="query" id="searchInput" placeholder="Ex.: São Paulo ou Academia XYZ" aria-label="Search" aria-describedby="search-icon" required>
        </div>
        <button type="submit" class="btn btn-primary">Pesquisar</button>
    </form>

<!-- Gráfico de pessoas na academia -->
<h2 id="nav_acad" style="text-align: center;">Pessoas Presentes em Tempo Real</h2>
<div class="chart-container">
    <canvas id="presencaChart"></canvas>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Configuração do gráfico
    const ctx = document.getElementById('presencaChart').getContext('2d');
    const presencaChart = new Chart(ctx, {
        type: 'bar',  // Tipo de gráfico (barra)
        data: {
            labels: ['Academia XYZ'], // Nome da academia
            datasets: [{
                label: 'Pessoas Presentes',
                data: [15],  // Número de pessoas (pode ser atualizado dinamicamente)
                backgroundColor: 'rgba(54, 162, 235, 0.8)',  // Cor das barras
                borderColor: 'rgba(54, 162, 235, 1)',  // Cor da borda das barras
                borderWidth: 2  // Largura da borda das barras
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(255, 255, 255, 0.2)',  // Cor da grade no eixo Y
                    },
                    ticks: {
                        color: '#ffffff' // Cor dos números do eixo Y
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(255, 255, 255, 0.2)',  // Cor da grade no eixo X
                    },
                    ticks: {
                        color: '#ffffff' // Cor dos textos no eixo X
                    }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        color: '#ffffff', // Cor da legenda
                        font: {
                            size: 14
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.7)',  // Fundo da tooltip
                    titleColor: '#ffffff',  // Cor do título da tooltip
                    bodyColor: '#ffffff'    // Cor do texto da tooltip
                }
            }
        }
    });

    // Atualize os dados dinamicamente com Firebase ou outra API
</script>

   
      <!-- Video e texto -->
      <div class="sobreIndex">
        <div class="sobre_texto">
          <span>NÃO DESANIME<br> CONTINUE TREINANDO,CUIDE DA SUA SAÚDE</span>  <br>
          <p>Imagine você saber quantas pessoas estão presentes naquela academia que você tanto frequenta? Pois é , aqui você consegue fazer isso entra outras coisas, dê aquele ânimo antes mesmo de treinar. Aquele espaço pra treinar tranquilo, sem revezamento de aparelhos,sem aquela multidão para atrapalhar.</p>
        </div>
        <div class="sobre_video">
          <video src="estilizacao/img_acad/video_acad.mp4" autoplay muted loop></video>
        </div>
      </div>

        
</main>


 
<?php include "../esqueleto/rodape.php"; ?>




