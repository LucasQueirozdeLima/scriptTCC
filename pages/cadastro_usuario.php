<?php include "../includes/cabecalho.php"; ?>
<?php include "../includes/navbar.php"; ?>

<main class="main_cadastroUser">

    <h2 style="text-align: center; color:black; margin-bottom : 20px;">CRIAR CADASTRO</h2>


    <div class="md-textbox">
      <input oninput="handleChange(event)" id="input" type="text" />
      <span class="material-symbols-outlined">account_circle</span>
      <label htmlFor="input">Nome</label>
    </div>
    
    <div class="md-textbox">
      <input oninput="handleChange(event)" id="input" type="text" />
      <span class="material-symbols-outlined">account_circle</span>
      <label htmlFor="input">Nickname</label>
    </div>

    <div class="md-textbox">
      <input oninput="handleChange(event)" id="input" type="text" />
      <span class="material-symbols-outlined">account_circle</span>
      <label htmlFor="input">E-mail</label>
    </div>

    <div class="md-textbox">
      <input oninput="handleChange(event)" id="input" type="text" />
      <span class="material-symbols-outlined">account_circle</span>
      <label htmlFor="input">Senha</label>
    </div>
</main>

<script type="text/javascript" src="main.js"></script>

