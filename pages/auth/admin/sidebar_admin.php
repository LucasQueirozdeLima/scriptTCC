<div class="background-blur"></div>
<div class="btn">
<button type="button" class="burger" onclick="toggleSidebar()">
    <img class="burger-avatar" src="../../../estilizacao/images/logo_nav.png"/>
    <span class="burger-icon"></span>
</button>
</div>
<div class="overlay"></div>

<script type="text/javascript">
  const toggleSidebar = () => document.body.classList.toggle("open");
</script>

<aside class="sidebar">
    <a href="../../index.php"><img class="sidebar-avatar" height="100" width="100" src="../../../estilizacao/images/logo_nav.png"/></a>
    <div class="sidebar-username"><?php echo $_SESSION['verificador']; ?></div>
    <div class="sidebar-role">ADMIN</div>

    <!-- Menu da Sidebar -->
    <nav class="sidebar-menu">
        <a href="dashboard.php">
            <button type="button">
                <img src="../../../estilizacao/images/svg/dashboard-icon.svg" />
                <span>Dashboard</span>
            </button>
        </a>

        <a href="config_admin.php">
            <button type="button">
                <img src="../../../estilizacao/images/svg/icon-config.svg" />
                <span>Configurações</span>
            </button>
        </a>

        <a href="cadastro_academia.php" onclick="toggleSubMenu(event, 'academia-submenu')">
            <button type="button">
                <img src="../../../estilizacao/images/svg/halter_logo.svg" />
                <span>Academias</span>
                <i class="icon-chevron-down"></i>
            </button>
        </a>
        <!-- Submenu para Academias -->
        <div id="academia-submenu" class="submenu">
            <a href="cadastro_academia.php">Cadastrar Academia</a>
            <a href="listar_academias.php">Listar Academias</a>
        </div>

        <a href="perfil_admin.php">
            <button type="button">
                <img src="../../../estilizacao/images/svg/icon-perfil.svg" />
                <span>Perfil</span>
            </button>
        </a>


    <nav class="sidebar-menu bottom">
        <a href="logout.php">
            <button type="button">
                <img src="../../../estilizacao/images/svg/icon-sair.svg" />
                <span>Sair</span>
            </button>
        </a>
    </nav>
</aside>

<script>
  function toggleSubMenu(event, submenuId) {
    event.preventDefault();
    document.getElementById(submenuId).classList.toggle("open");
  }
</script>

