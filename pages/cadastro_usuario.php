<?php include "../includes/cabecalho.php"; ?>
<?php include "../includes/navbar.php"; 
//adição do form// obs: bug na pagina// para corrigir basta apagar a tag form
?>

<main style="background: linear-gradient(120deg, #0d0e13 , #0a296b, #326485  , #648ca4, #b1c7f1);">
  
  <form action="../intermediarios/inserirUsuario.php" method="post"> 

    <h2 style="text-align: center; color:white; margin-bottom : 20px; font-family: Euclid Circular A;">CRIAR CADASTRO</h2>

      <div class="md-textbox">
        <input oninput="handleChange(event)" id="input" type="text" name="nome">
      <span class="material-symbols-outlined">account_circle</span>
      <label for="input">Nome</label>
    </div>
    
    <div class="md-textbox">
      <input oninput="handleChange(event)" id="input" type="text" name="nome_usuario">
      <span class="material-symbols-outlined">account_circle</span>
      <label for="input">Nickname</label>
    </div>

    <div class="md-textbox">
      <input oninput="handleChange(event)" id="input" type="text" name="email">
      <span class="material-symbols-outlined">account_circle</span>
      <label for="input">E-mail</label>
    </div>

    <div class="md-textbox">
      <input oninput="handleChange(event)" id="input" type="password" name="senha">
      <span class="material-symbols-outlined">account_circle</span>
      <label for="input">Senha</label>
    </div>

    <button type="submit">CADASTRAR</button>
  </form>
  </main>

<script type="text/javascript" src="main.js"></script>

