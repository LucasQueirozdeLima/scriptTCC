

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sidebar 2</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="./styleUser.css" />
  </head>
  <body>
    <button type="button" class="burger" onclick="toggleSidebar()">
      <img class="burger-avatar" src="../../../estilizacao/images/svg/avatar.png"/>
      <span class="burger-icon"></span>
    </button>
    <div class="overlay"></div>
    <aside class="sidebar">
      <img class="sidebar-avatar" height="100" width="100" src="../../../estilizacao/images/user-avatar.png" />
      <div class="sidebar-username">Vinicius</div>
      <div class="sidebar-role">Frontend Developer</div>
      <nav class="sidebar-menu">
        <button type="button">
          <img src="../../../estilizacao/images/svg/icon-home.svg" />
          <span>Home</span>
        </button>
        <button type="button">
          <img src="../../../estilizacao/images/svg/icon-settings.svg" />
          <span>Settings</span>
        </button>
        <button type="button">
          <img src="../../../estilizacao/images/svg/icon-accounts.svg" />
          <span>Profile</span>
        </button>
      </nav>
      <nav class="sidebar-menu bottom">
        <button type="button">
          <img src="../../../estilizacao/images/svg/icon-lock.svg" />
          <span>Sign Out</span>
        </button>
      </nav>
    </aside>
    <a href="../../index.php"><img src="../../../estilizacao/images/logo_nav.png" class="user-logo"></a>


    <script type="text/javascript">
      const toggleSidebar = () => document.body.classList.toggle("open");
    </script>
  </body>
</html>
