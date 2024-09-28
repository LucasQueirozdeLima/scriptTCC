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

 <div class="sobreIndex">
        <div class="sobre_texto">
          <span>A ARTE DE FAZER DELÍCIAS NA CONSTANTE <br> BUSCA DA PERFEIÇÃO</span> <br>
          <p>Bem-vindo à nossa doce e irresistível confeitaria! Aqui, na nossa loja de bolos de pote, cada sobremesa é uma obra de arte cuidadosamente montada em camadas, oferecendo uma explosão de sabor em cada colherada. Desde o momento em que você entra, é transportado para um mundo de aromas tentadores e cores vibrantes, onde cada bocado é uma experiência deliciosa. Nossa paixão pela confeitaria se reflete em cada detalhe, desde a seleção dos ingredientes frescos até a apresentação impecável de nossos produtos. Seja para celebrar uma ocasião especial, satisfazer um desejo por algo doce ou simplesmente desfrutar de um momento de indulgência, estamos aqui para satisfazer os seus desejos mais doces com os nossos bolos de pote feitos com amor e dedicação.</p>
        </div>
        <div class="sobre_video">
          <video src="../estilizacao/img_acad/video_academia.mp4" autoplay muted loop></video>
        </div>
      </div>
      <div class="siga_nos">
        <div class="siga_img">
          <img src="img/docinhos/emojis_brigadeiro.png" alt="Siga nós">
        </div>
        <div class="siga_txt">
          <h3><strong>Siga a GihCakes</strong></h3> <br>
          <p>Siga a página da GihCakes no Facebook ou Instagram. Fique sabendo em primeira mão das novidades, promoções, eventos e descontos exclusivos.</p> <br>
          <p>Todas as ações que são feitas em nossa loja estarão em nossas Redes Sociais e você poderá curtir e compartilhar nossas publicações.</p>
        </div>
      </div>


</main>
<?php include "../esqueleto/rodape.php"; ?>




