<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sidebars</title>
    <link rel="stylesheet" href="../admin/styleAdmin.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,700,1,0"
    />
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <script src="https://unpkg.com/akar-icons-fonts"></script>
  </head>
  <body>
    <aside class="sidebar">
      <header>
      <a href="../../index.php"><img src="../../../estilizacao/images/svg/logo_admin.svg" /></a><h2 style="color: white;">FitRealTime</h2> 
      </header>
      <ul>
        <li>
          <input type="radio" id="dashboard" name="sidebar" />
          <label for="dashboard">
            <i class="ai-dashboard"></i>
            <p>Dashboard</p>
          </label>
        </li>
        <li>
          <input type="radio" id="settings" name="sidebar" />
          <label for="settings">
            <i class="ai-gear"></i>
            <p>Configurações</p>
            <i class="ai-chevron-down-small"></i>
          </label>
          <div class="sub-menu">
            <ul>
              <li>
                <button type="button">Alterar Dados</button>
              </li>
              <li>
                <button type="button">###</button>
              </li>
            </ul>
          </div>
        </li>
        <li>
          <input type="radio" id="create" name="sidebar" />
          <label for="create">
            <i class="ai-folder-add"></i>
            <p>Academias</p>
            <i class="ai-chevron-down-small"></i>
          </label>
          <div class="sub-menu">
            <ul>
              <li>
                <button type="button">Cadastrar</button>
              </li>
              <li>
                <button type="button">Listar</button>
              </li>
              <li>
                <button type="button">###</button>
              </li>
              <li>
                <button type="button">###</button>
              </li>
            </ul>
          </div>
        </li>
        <li>
          <input type="radio" id="profile" name="sidebar" />
          <label for="profile">
            <i class="ai-person"></i>
            <p>Perfil</p>
            <i class="ai-chevron-down-small"></i>
          </label>
          <div class="sub-menu">
            <ul>
              <li>
                <button type="button">Dados Pessoais</button>
              </li>
              <li>
                <button type="button">###</button>
              </li>
            </ul>
          </div>
        </li>
        <li>
          <input type="radio" id="notifications" name="sidebar" />
          <label for="notifications">
            <i class="ai-bell"></i>
            <p>Notificação</p>
          </label>
        </li>
        
        <li>
          <input type="radio" id="account" name="sidebar" />
          <label for="account">
            <i class="ai-lock-on"></i>
            <p>Sair</p>
          </label>
        </li>
      </ul>
    </aside>
  </body>
</html>
