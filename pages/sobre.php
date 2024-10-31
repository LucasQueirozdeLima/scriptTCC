<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nós</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet"/>




    <link rel="stylesheet" href="../estilizacao/css/styles.css">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        header {
            background: url('../estilizacao/images/Academia_fundo2.0.jpg') no-repeat center center;
            background-size: cover;
            background-attachment: fixed;
            padding: 20px 0;
            height: 500px;
        }
        header img {
            display: block;
            margin: 100px auto;
            height: 200px;
        }
        
        .content {
            text-align: center;
            padding: 50px 20px;
            background-color: #333;
        }
        .content h2 {
            color: #c8c8c8;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .content p {
            color: #c8c8c8;
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .team {
            background-color: #d9d9d9; 
            padding: 50px 20px;
            text-align: center; 
        }
        .team h2 {
            color: #333333; 
            font-size: 24px;
            margin-bottom: 20px;
        }
        .team-members {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            align-items: center; 
        }
        .team-member {
            text-align: center;
        }
        .team-member img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
        .team-member p {
            color: #333;
            font-size: 16px;
            margin-top: 10px;
        }
        .team-member a {
            text-decoration: none;
            color: #333;
            font-size: 16px;
        }
        .team-member a img {
            width: 60px;
            height: 60px;
        }
        footer {
            background-color: #d9d9d9; /* Cinza claro para o rodapé */
            text-align: center;
            padding: 20px 0;
            position: relative;
            bottom: 0;
            width: 100%;
        }
        footer p {
            color: #333; /* Cor do texto do rodapé */
            margin: 0;
        }
    </style>
</head>
<body>
<?php include "../includes/navbar.php"; ?>
    <header>

    </header>

    <div class="content">
        <h2>SOBRE NÓS</h2>
        <p>
        Nosso web service foi criado com o objetivo de melhorar a experiência dos usuários de academias, ajudando-os a evitar a superlotação, um problema cada vez mais comum nos centros de treino. Sabemos que um ambiente lotado não só compromete a qualidade do treino, mas também pode desmotivar quem busca saúde e bem-estar. 
        </p>
    </div>
    <div class="team">
        <h2>Equipe:</h2>
        <div class="team-members">      
            <div class="team-member">
                <img alt="a" height="100" src="../estilizacao/images/devs/a.jpeg" width="100"/>
                <p>Deborah Oliveira</p>
                <a href="https://github.com/deborahbezerrolv"><img class="logoGit" src="../estilizacao/images/GitHub-logo.png" alt="Logo github"></a>
            </div>
            <div class="team-member">
                <img alt="b" height="100" src="../estilizacao/images/devs/c.jpeg" width="100"/>
                <p>Lucas Queiroz de Lima </p>
                <a href="https://github.com/LucasQueirozdeLima"><img class="logoGit" src="../estilizacao/images/GitHub-logo.png" alt="Logo github"></a>
            </div>
            <div class="team-member">
                <img alt="a" height="100" src="../estilizacao/images/devs/d.jpeg" width="100"/>
                <p>Gabriel Silva </p>
                <a href="https://github.com/kimkimdev"><img class="logoGit" src="../estilizacao/images/GitHub-logo.png" alt="Logo github"></a>
            </div>
            <div class="team-member">
                <img alt="a" height="100" src="../estilizacao/images/devs/b.jpeg" width="100"/>
                <p>Vinicius da Silva Generoso</p>
                <a href="https://github.com/vinicimxt"><img class="logoGit" src="../estilizacao/images/GitHub-logo.png" alt="Logo github"></a>
            </div>
            <div class="team-member">
                <img alt="a" height="100" src="../estilizacao/images/devs/e.jpeg" width="100"/>
                <p>Thiago de Araujo Souza</p>
                <a href="https://github.com/ThiagoAraujoSouza"><img class="logoGit" src="../estilizacao/images/GitHub-logo.png" alt="Logo github"></a>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
