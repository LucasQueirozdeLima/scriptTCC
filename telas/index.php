<?php include "../esqueleto/cabecalho.php"; ?>


<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a id="navbar_logo" href="index.php">FitRealTime</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a id="nav-link" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a id="nav-link" href="sobre.php">Sobre</a>
        </li>
        <li class="nav-item">
          <a id="nav-link" href="perfil.php">Perfil</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<main>
    <form class="form_academias" action="buscar_academias.php" method="GET">
        <h2 id="nav_acad">Localizar Academias</h2>
        <div class="input-group w-75">
            <span class="input-group-text" id="search-icon">
                <i class="bi bi-search"></i> <!-- Ícone de lupa -->
            </span>
            <input type="text" class="form-control" name="query" id="searchInput" placeholder="Ex.: São Paulo ou Academia XYZ" aria-label="Search" aria-describedby="search-icon" required>
        </div>
        <button type="submit" class="btn btn-primary">Pesquisar</button>
    </form>
</main>  

  
<?php include "../esqueleto/rodape.php"; ?>

