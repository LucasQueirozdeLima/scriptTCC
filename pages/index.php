<?php include "../includes/cabecalho.php";
include "../includes/navbar.php";
require_once "../config/Dao.php"


?>



<main>
    <section class="busca-academias">
        <h2>Localizar Academias</h2>
        <div class="input-group w-90">
            <span class="input-group-text" id="search-icon">
                <i class="bi bi-search"></i>
            </span>
            <div class="form-group">
                <label for="searchInput">Digite o nome da Academia:</label>
                <input type="text" id="searchInput" class="form-control" placeholder="Ex.: São Paulo ou Academia XYZ" aria-label="Search" aria-describedby="search-icon">
            </div>

            <!-- Select para as academias (preenchido dinamicamente) -->
            <div class="form-group">
                <label for="academySelect">Selecione uma Academia:</label>
                <select class="form-control" name="academy" id="academySelect" required>
                    <option value="" disabled selected>Selecione uma academia...</option>
                    <!-- As opções serão preenchidas dinamicamente via JavaScript -->
                </select>
            </div>


        </div>
        <!-- Botão de busca -->
        <button id="searchButton" class="btn btn-primary">Buscar</button>
    </section>

    <!-- Gráfico -->
    <section class="presenca-academia">
        <h2 class="h2-person">Pessoas Presentes na Unidade em Tempo Real</h2>
        <div class="chart-container">
            <canvas id="presencaChart"></canvas>
        </div>

        <!-- Informações abaixo do gráfico -->
        <div class="info-presenca">
            <div class="info-item">
                <p><strong>Pessoas Presentes:</strong>
                <p id="pessoasPresentes">15</p>
                </p>
            </div>
            <div class="info-item">
                <p> <strong>Número Máximo Suportado:</strong>
                <p id="maxPessoas"> 50 </p>
                </p>
            </div>
        </div>
    </section>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('presencaChart').getContext('2d');
        const presencaChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Academia XYZ'],
                datasets: [{
                        label: 'Pessoas Presentes',
                        data: [0],
                        backgroundColor: 'rgba(54, 162, 235, 0.8)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 2
                    },
                    {
                        label: 'Capacidade Max',
                        data: [0],
                        backgroundColor: 'rgba(51, 122, 105, 0.8)',
                        borderColor: 'rgba(24, 62, 235, 1)',
                        borderWidth: 2
                    }

                ]

            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(255, 255, 255, 0.2)'
                        },
                        ticks: {
                            color: '#ffffff'
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(255, 255, 255, 0.2)'
                        },
                        ticks: {
                            color: '#ffffff'
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: '#ffffff',
                            font: {
                                size: 14
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.7)',
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff'
                    }
                }
            }
        });

        function updateGrafico(academiaId) {
            db.collection('ACADEMIAS').doc(academiaId)
                .onSnapshot(doc => {
                    if (doc.exists) {
                        console.log("fazendo grafico");
                        const data = doc.data();
                        presencaChart.data.datasets[0].data[0] = data.pessoaPresente;
                        presencaChart.data.datasets[1].data[0] = data.maxPessoas;
                        presencaChart.update();

                        document.getElementById('pessoasPresentes').innerText = data.pessoaPresente;
                        document.getElementById('maxPessoas').innerText = data.maxPessoas;
                    }
                })
        }
        // Referência para a coleção 'ACADEMIAS' no Firestore
        const academiasRef = db.collection("ACADEMIAS");

        // Função para popular o select com as academias
        function populateAcademySelect(academias) {
            // Limpar o select antes de adicionar as opções
            const selectElement = document.getElementById('academySelect');
            selectElement.innerHTML = '<option value="" disabled selected>Selecione uma academia...</option>'; // Reseta as opções

            // Adicionar as opções ao select
            academias.forEach(academia => {
                const option = document.createElement('option');
                option.value = academia.id; // O valor será o ID da academia
                option.textContent = academia.nome; // O texto visível será o nome da academia
                selectElement.appendChild(option);
            });
        }

        function preencherSelect() {
            // Limpar o select antes de adicionar as opções
            const selectElement = document.getElementById('academySelect');
            selectElement.innerHTML = '<option value="" disabled selected>Selecione uma academia...</option>'; // Reseta as opções

            // Buscar as academias no Firestore
            academiasRef.get()
                .then(snapshot => {
                    snapshot.forEach(doc => {
                        // Pega o nome da academia e o ID do documento
                        const nomeAcademia = doc.data().nome; // Nome da academia
                        const academiaId = doc.id; // ID do documento

                        // Criar uma nova opção no select para cada academia
                        const option = document.createElement('option');
                        option.value = academiaId; // O valor será o ID da academia
                        option.textContent = nomeAcademia; // O texto visível será o nome da academia
                        selectElement.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error("Erro ao carregar as academias: ", error);
                });
        }

        // Função para filtrar academias com base no texto digitado
        function searchAcademy(query) {
            // Se a pesquisa for vazia, não fazer nada
            if (!query.trim()) return;

            // Filtrar academias no Firestore que contenham o nome correspondente à pesquisa
            academiasRef.where("nome", ">=", query)
                .where("nome", "<=", query + '\uf8ff') // Isso faz a busca por prefixo
                .get()
                .then(snapshot => {
                    const academias = snapshot.docs.map(doc => ({
                        id: doc.id,
                        nome: doc.data().nome,
                    }));
                    populateAcademySelect(academias); // Popular o select com as academias filtradas
                })
                .catch(error => {
                    console.error("Erro ao buscar academias: ", error);
                });
        }

        // Evento para capturar a digitação no input de pesquisa
        document.getElementById('searchInput').addEventListener('input', (event) => {
            const query = event.target.value;
            searchAcademy(query); // Filtra as academias conforme o texto digitado
        });

        // Função para buscar e renderizar o gráfico (quando uma academia for selecionada)
        function buscarAcademia() {
            const selectedAcademyId = document.getElementById('academySelect').value;

            if (selectedAcademyId) {
                console.log('Buscando gráfico para a academia com ID:', selectedAcademyId);
                updateGrafico(selectedAcademyId);
            } else {
                alert('Por favor, selecione uma academia.');
            }
        }

        // Evento para capturar a digitação no input de pesquisa
        document.getElementById('searchInput').addEventListener('input', (event) => {
            const query = event.target.value;
            searchAcademy(query); // Filtra as academias conforme o texto digitado
        });
        // Evento do botão de busca
        document.getElementById('searchButton').addEventListener('click', buscarAcademia);
        window.onload = preencherSelect;
    </script>


    <section class="sobre-index">
        <div class="sobre_texto">
            <span>NÃO DESANIME, CONTINUE TREINANDO !<br>CUIDE DE SUA SAÚDE</span>
            <p>Imagine saber quantas pessoas estão presentes na academia que você frequenta! Aqui você consegue verificar isso, entre outras funcionalidades. Tenha aquele ânimo antes mesmo de treinar.</p>
        </div>
        <div class="sobre_video">
            <video src="../estilizacao/images/video_acad.mp4" autoplay muted loop></video>
        </div>
    </section>
</main>

<?php include "../includes/rodape.php"; ?>