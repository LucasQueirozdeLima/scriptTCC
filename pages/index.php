<?php include "../includes/cabecalho.php"; ?>
<?php include "../includes/navbar.php"; ?>

<main>
    <section class="busca-academias">
        <form class="form_academias" action="buscar_academias.php" method="GET">
            <h2>Localizar Academias</h2>
            <div class="input-group w-90">
                <span class="input-group-text" id="search-icon">
                    <i class="bi bi-search"></i> <!-- Ícone de lupa -->
                </span>
                <input type="text" class="form-control" name="query" id="searchInput" placeholder="Ex.: São Paulo ou Academia XYZ" aria-label="Search" aria-describedby="search-icon" required>
            </div>
            <button type="submit" class="btn btn-primary">Pesquisar</button>
        </form>
    </section>

    <!--  Gráfico -->
    <section class="presenca-academia">
        <h2 style="text-align: center; color: white">Pessoas Presentes na Unidade em Tempo Real</h2>
        <div class="chart-container">
            <canvas id="presencaChart"></canvas>
        </div>
    </section>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Configuração do gráfico
        const ctx = document.getElementById('presencaChart').getContext('2d');
        const presencaChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Academia XYZ'], 
                datasets: [{
                    label: 'Pessoas Presentes',
                    data: [15],  
                    backgroundColor: 'rgba(54, 162, 235, 0.8)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(255, 255, 255, 0.2)' },
                        ticks: { color: '#ffffff' }
                    },
                    x: {
                        grid: { color: 'rgba(255, 255, 255, 0.2)' },
                        ticks: { color: '#ffffff' }
                    }
                },
                plugins: {
                    legend: { labels: { color: '#ffffff', font: { size: 14 } } },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.7)',
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff'
                    }
                }
            }
        });

    </script>

    
    <section class="sobre-index">
        <div class="sobre_texto">
            <span>NÃO DESANIME, CONTINUE TREINANDO !!<br>CUIDE DE SUA SAÚDE</span>
            <p>Imagine saber quantas pessoas estão presentes na academia que você frequenta! Aqui você consegue verificar isso, entre outras funcionalidades. Tenha aquele ânimo antes mesmo de treinar.</p>
        </div>
        <div class="sobre_video">
            <video src="../estilizacao/images/video_acad.mp4" autoplay muted loop></video>
        </div>
    </section>
</main>

<?php include "../includes/rodape.php"; ?>
