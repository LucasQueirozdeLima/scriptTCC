<?php include "../includes/cabecalho.php";
include "../includes/navbar.php";
require_once "../config/Dao.php"


?>



<main>

    <section class="busca-academias">
        <div class="form_academias">
            <h2>Localizar Academias</h2>
            <div class="input-group w-90">
                <div class="form-group">
                    <label for="searchInput">Digite ou selecione a Academia:</label>

                    <div class="input-wrapper">
                        <input type="text" id="searchInput" class="form-control" placeholder="Ex.:    Academia XYZ " aria-label="Search" aria-describedby="search-icon">
                        <i class="bi bi-search fs-3"></i>
                    </div>
                    <!-- Lista de sugestões -->
                    <div id="suggestions" class="suggestions-box"></div>
                </div>
            </div>
            <!-- Botão de busca -->
            <button id="searchButton" class="btn btn-primary">Buscar</button>
        </div>
    </section>



    <!-- Gráfico -->
    <section class="presenca-academia">
        <h2 class="h2-person">Pessoas Presentes na Unidade em Tempo Real</h2>
        <div class="chart-container">
            <canvas id="presencaChart"></canvas>
        </div>

        <button id="favoriteButton" class="btn btn-outline-danger">
  <i class="fas fa-heart"> FAVORITAR</i> <!-- Ícone de coração -->
</button>



        <!-- Informações abaixo do gráfico -->
        <div class="info-presenca">
            <div class="info-item">
                <p><strong>Pessoas Presentes:</strong>
                <p id="pessoasPresentes">0</p>
                </p>
            </div>
            <div class="info-item">
                <p> <strong>Número Máximo Suportado:</strong>
                <p id="maxPessoas"> 0 </p>
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
                            color: '#ffffff',
                            font: {
                                size: 18,

                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: '#ffffff',
                            font: {
                                size: 18
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
                        const data = doc.data();
                        
                        const pessoasPresentes = data.pessoaPresente;
                        const maxPessoas = data.maxPessoas;
                        const ocupacaoPercentual = (pessoasPresentes / maxPessoas) * 100;

                        // Define a cor com base na ocupação
                        let corGrafico;
                        if (ocupacaoPercentual < 50) {
                            corGrafico = 'rgba(0, 128, 0, 0.8)'; 
                        } else if (ocupacaoPercentual < 80) {
                            corGrafico = 'rgba(255, 255, 0, 0.8)'; 
                        } else {
                            corGrafico = 'rgba(255, 0, 0, 0.8)';
                        }

                        // Atualiza o gráfico com a nova cor e dados
                        presencaChart.data.labels[0] = data.nome;
                        presencaChart.data.datasets[0].data[0] = pessoasPresentes;
                        presencaChart.data.datasets[1].data[0] = maxPessoas;
                        presencaChart.data.datasets[0].backgroundColor = corGrafico;
                        presencaChart.update();

                        // Atualiza os valores de texto
                        document.getElementById('pessoasPresentes').innerText = pessoasPresentes;
                        document.getElementById('maxPessoas').innerText = maxPessoas;
                    }
                });
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
                option.value = academia.id; 
                option.textContent = academia.nome;
                selectElement.appendChild(option);
            });
        }

        // Função para exibir sugestões enquanto o usuário digita
        function searchAcademy(query) {
            // Se a pesquisa for vazia, não fazer nada
            if (!query.trim()) {
                document.getElementById('suggestions').style.display = 'none';
                return;
            }

            // Filtrar academias no Firestore que contenham o nome correspondente à pesquisa
            academiasRef.where("nome", ">=", query)
                .where("nome", "<=", query + '\uf8ff') 
                .get()
                .then(snapshot => {
                    const academias = snapshot.docs.map(doc => ({
                        id: doc.id,
                        nome: doc.data().nome,
                    }));
                    showSuggestions(academias); 
                })
                .catch(error => {
                    console.error("Erro ao buscar academias: ", error);
                });
        }

        // Função para exibir sugestões na interface
        function showSuggestions(academias) {
            const suggestionsBox = document.getElementById('suggestions');
            suggestionsBox.innerHTML = ''; 

            // Adiciona cada academia como uma opção na lista de sugestões
            academias.forEach(academia => {
                const suggestionItem = document.createElement('div');
                suggestionItem.textContent = academia.nome;
                suggestionItem.dataset.id = academia.id; 
                suggestionItem.addEventListener('click', () => {
                    document.getElementById('searchInput').value = academia.nome;
                    suggestionsBox.style.display = 'none';
                    updateGrafico(academia.id); 
                });
                suggestionsBox.appendChild(suggestionItem);
            });

            // Exibe o box de sugestões
            suggestionsBox.style.display = academias.length ? 'block' : 'none';
        }

        // Evento para capturar a digitação no input de pesquisa
        document.getElementById('searchInput').addEventListener('input', (event) => {
            const query = event.target.value;
            searchAcademy(query); // Filtra as academias conforme o texto digitado
        });

        // Fecha a lista de sugestões se o usuário clicar fora dela
        document.addEventListener('click', (event) => {
            const suggestionsBox = document.getElementById('suggestions');
            if (!event.target.closest('.form_academias')) {
                suggestionsBox.style.display = 'none';
            }
        });

        // Evento do botão de busca
        document.getElementById('searchButton').addEventListener('click', () => {
            const selectedAcademy = document.getElementById('searchInput').value.trim().toLowerCase(); 

            if (selectedAcademy) {
                // Busca a academia no Firestore pelo nome em minúsculas
                academiasRef.where("nomeLowercase", "==", selectedAcademy).get()
                    .then(snapshot => {
                        if (!snapshot.empty) {
                            const academia = snapshot.docs[0]; 
                            updateGrafico(academia.id); 
                        } else {
                            alert('Academia não encontrada. Verifique o nome e tente novamente.');
                        }
                    })
                    .catch(error => {
                        console.error("Erro ao buscar academia:", error);
                        alert('Erro ao buscar a academia. Tente novamente mais tarde.');
                    });
            } else {
                alert('Por favor, digite ou selecione uma academia.');
            }
        });


        // Exemplo de atualização para cada academia
        academiasRef.doc(academia).update({
            nomeLowercase: nome.toLowerCase()
        });


        function searchAcademy(query) {
            if (!query.trim()) {
                document.getElementById('suggestions').style.display = 'none';
                return;
            }

            academiasRef.where("nomeLowercase", ">=", query.toLowerCase())
                .where("nomeLowercase", "<=", query.toLowerCase() + '\uf8ff')
                .get()
                .then(snapshot => {
                    const academias = snapshot.docs.map(doc => ({
                        id: doc.id,
                        nome: doc.data().nome, // Exibe o nome normal para o usuário
                    }));
                    showSuggestions(academias);
                })
                .catch(error => {
                    console.error("Erro ao buscar academias: ", error);
                });
        }

    // Evento do botão de favoritar
    document.getElementById('favoriteButton').addEventListener('click', function() {
        const selectedAcademy = document.getElementById('searchInput').value.trim();

        if (selectedAcademy) {
            // Envia o nome da academia para o PHP usando AJAX
            fetch('favoritos.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'nomeAcademia=' + encodeURIComponent(selectedAcademy)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Academia favoritada com sucesso!');
                } else {
                    alert('Erro ao favoritar a academia.');
                }
            })
            .catch(error => console.error('Erro:', error));
        } else {
            alert('Por favor, selecione uma academia primeiro.');
        }
    });



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