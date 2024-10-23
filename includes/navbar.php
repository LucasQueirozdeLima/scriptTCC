<nav> 
    <a href="./index.php"><img src="../estilizacao/images/logo_nav.png" alt="Logo" class="navbar-logo" /></a>
    <button class="navbar-burguer" onclick="toggleMenu()"></button>
</nav>

<div class="navbar-menu">
    <button class="close-menu" onclick="toggleMenu()">✖</button> <!-- Botão de fechar -->
    <a href="index.php" style="animation-delay: 0.1s" onclick="toggleMenu()">Home</a>
    <a href="login.php" style="animation-delay: 0.2s" onclick="toggleMenu()">Login</a>
    <a href="sobre.php" style="animation-delay: 0.3s" onclick="toggleMenu()">Sobre</a>
    <a href="contato.php" style="animation-delay: 0.5s" onclick="toggleMenu()">Contato</a>
</div>

<script>
    const toggleMenu = () => {
        document.body.classList.toggle('open');
    };
</script>
