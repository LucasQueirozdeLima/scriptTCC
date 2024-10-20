<?php include "../includes/cabecalho.php"; ?>
<?php include "../includes/navbar.php"; ?>

<main style="background: linear-gradient(120deg, #0d0e13 , #0a296b, #326485  , #648ca4, #b1c7f1);">

    <h2 style="text-align: center; color:white; margin-bottom : 20px; font-family: Euclid Circular A;">CRIAR CADASTRO</h2>


    <div class="md-textbox">
      <input oninput="handleChange(event)" id="input" type="text" />
      <span class="material-symbols-outlined">account_circle</span>
      <label for="input">Nome</label>
    </div>
    
    <div class="md-textbox">
      <input oninput="handleChange(event)" id="input" type="text" />
      <span class="material-symbols-outlined">account_circle</span>
      <label for="input">Nickname</label>
    </div>

    <div class="md-textbox">
      <input oninput="handleChange(event)" id="input" type="text" />
      <span class="material-symbols-outlined">account_circle</span>
      <label for="input">E-mail</label>
    </div>

    <div class="md-textbox">
      <input oninput="handleChange(event)" id="input" type="password" />
      <span class="material-symbols-outlined">account_circle</span>
      <label for="input">Senha</label>
    </div>
</main>

<script type="text/javascript" src="main.js"></script>

