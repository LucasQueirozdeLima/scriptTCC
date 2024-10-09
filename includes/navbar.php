<nav> 
    <a href="./index.php"><img src="../assets/images/logo_nav.png" alt="Logo" class="navbar-logo" /></a>
    <button class="navbar-burguer" onclick="toggleMenu()"></button>
</nav>

<div class="navbar-menu">
    <button class="close-menu" onclick="toggleMenu()">✖</button> <!-- Botão de fechar -->
    <a href="./index.php" style="animation-delay: 0.1s" onclick="toggleMenu()">Home</a>
    <a href="#" style="animation-delay: 0.2s" onclick="toggleMenu()">About</a>
    <a href="#" style="animation-delay: 0.3s" onclick="toggleMenu()">Services</a>
    <a href="#" style="animation-delay: 0.4s" onclick="toggleMenu()">Products</a>
    <a href="./login.php" style="animation-delay: 0.5s" onclick="toggleMenu()">Login</a>
</div>

<script>
    const toggleMenu = () => {
        document.body.classList.toggle('open');
    };
</script>
