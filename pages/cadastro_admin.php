<?php include "../includes/cabecalho.php"; ?>
<?php include "../includes/navbar.php"; ?>

<main style="background: linear-gradient(120deg, #0d0e13 , #0a296b, #326485  , #648ca4, #b1c7f1);">

<form action="../intermediarios/inserirAdmin.php" method="post" > 

<h2 style="text-align: center; color:white; margin-bottom : 20px; font-family: Euclid Circular A;">CRIAR CADASTRO ADMINISTRADOR</h2>

    <div class="md-textbox">
      <input oninput="handleChange(event)" id="input" type="text" name="nome" placeholder="Digite seu nome"/>
      <span class="material-symbols-outlined">account_circle</span>
      <label for="input">Nome</label>
    </div>
    
    <div class="md-textbox">
      <input oninput="handleChange(event)" id="input" type="text" name="nome_usuario" placeholder="Digite seu nome de usuário"/>
      <span class="material-symbols-outlined">account_circle</span>
      <label for="input">Apelido</label>
    </div>

    <div class="md-textbox">
      <input oninput="handleChange(event)" id="input" type="text" name="email" placeholder="Digite seu e-mail"/>
      <span class="material-symbols-outlined">account_circle</span>
      <label for="input">E-mail</label>
    </div>
    
    <div class="md-textbox">
      <input oninput="handleChange(event)" id="input" type="text" name="documento" placeholder="Digite seu documento"/>
      <span class="material-symbols-outlined">account_circle</span>
      <label for="input">Documento</label>
    </div>
    
    <div class="md-textbox">
      <input oninput="handleChange(event)" id="input" type="text" name="cargo" placeholder="Digite seu cargo"/>
      <span class="material-symbols-outlined">account_circle</span>
      <label for="input">Cargo</label>
    </div>


    <div class="md-textbox">
      <input oninput="handleChange(event)" id="input" type="password" name="senha" placeholder="Digite sua senha"/>
      <span class="material-symbols-outlined">account_circle</span>
      <label for="input">Senha</label>
    </div>

    <button type="submit">CADASTRAR</button> 
    <a href="./login_cadastro.php">VOLTAR</a>
</form>

</main>

<script type="text/javascript" src="main.js"></script>