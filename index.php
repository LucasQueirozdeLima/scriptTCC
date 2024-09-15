<?php include "cabecalho.php"; ?>
<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pricing</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown link
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<main>
    <form class="form_academias" action="buscar_academias.php" method="GET">
        <h2>Localizar Academias</h2>
        <div class="input-group w-75">
            <span class="input-group-text" id="search-icon">
                <i class="bi bi-search"></i> <!-- Ícone de lupa -->
            </span>
            <input type="text" class="form-control" name="query" id="searchInput" placeholder="Ex.: São Paulo ou Academia XYZ" aria-label="Search" aria-describedby="search-icon" required>
        </div>
        <button type="submit" class="btn btn-primary">Pesquisar</button>
    </form>
    <!--
    <h2>Login</h2>z
    <form action="login_page.php" method="POST">
        <div>
            <label for="exampleInputEmail1">Email</label>
            <input type="email" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" required>
        </div>
        <div>
            <label for="exampleInputPassword1">Senha</label>
            <input type="password" name="senha" id="exampleInputPassword1" required>
        </div>
        <button type="submit">Entrar</button>
        <a href="cadastro_usuario.php">Cadastrar usuário</a>
        <a href="cadastro_admin.php">Cadastrar admin</a>
    </form>
    -->
</main>
<?php include "rodape.php"; ?>

