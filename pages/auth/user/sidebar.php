
<button type="button" class="burger" onclick="toggleSidebar()">
      <img class="burger-avatar" src="../../../estilizacao/images/svg/icon-user.svg"/>
      <span class="burger-icon"></span>
    </button>
    <div class="overlay"></div>
    
    <script type="text/javascript">
      const toggleSidebar = () => document.body.classList.toggle("open");
    </script>


<aside class="sidebar">
  <img class="sidebar-avatar" height="100" width="100" src="../../../estilizacao/images/svg/icon-user.svg" />
  <div class="sidebar-username"><?php echo $_SESSION['verificador']; ?></div>
  <div class="sidebar-role">BEM-VINDO </div>

  <!-- Menu da Sidebar -->
  <nav class="sidebar-menu">
    <a href="home_user.php">
      <button type="button">
        <img src="../../../estilizacao/images/svg/home.svg" />
        <span>Home</span>
      </button>
    </a>
    
    <a href="config_user.php">
      <button type="button">
        <img src="../../../estilizacao/images/svg/engrenagem.svg" />
        <span>Configurações</span>
      </button>
    </a>

    <a href="buscar_academias.php">
      <button type="button">
        <img src="../../../estilizacao/images/svg/lupa.svg" />
        <span>Academias</span>
      </button>
    </a>
    
    <a href="favoritos.php">
      <button type="button">
        <img src="../../../estilizacao/images/svg/favoritos.svg" />
        <span>Favoritos</span>
      </button>
    </a>
  </nav>

  <!-- Logout -->
  <nav class="sidebar-menu bottom">
    <a href="logout.php">
      <button type="button">
        <img src="../../../estilizacao/images/svg/icon-sair.svg" />
        <span>Sair</span>
      </button>
    </a>
  </nav>
</aside>

<a href="../../index.php"><img src="../../../estilizacao/images/logo_nav.png" class="user-logo"></a>
