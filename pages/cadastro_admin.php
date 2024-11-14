<?php include "../includes/cabecalho.php"; ?>
<?php include "../includes/navbar.php"; ?>

<main style="background: linear-gradient(120deg, #0d0e13 , #0a296b, #326485  , #648ca4, #b1c7f1);">

<form action="../intermediarios/inserirAdmin.php" method="post" > 

<h2 style="text-align: center; color:white; margin-bottom : 20px; font-family: Euclid Circular A;">CRIAR CADASTRO ADMINISTRADOR</h2>

    <div class="md-textbox">
      <input oninput="handleChange(event)" id="input" type="text" name="nome" placeholder="Digite seu nome" required minlength="3" maxlength="15"/>
      <span class="material-symbols-outlined">account_circle</span>
      <label for="input">Nome</label>
    </div>
    
    <div class="md-textbox">
      <input oninput="handleChange(event)" id="input" type="text" name="nome_usuario" placeholder="Digite seu nome de usuário" required minlength="2" maxlength="15"/>
      <span class="material-symbols-outlined">account_circle</span>
      <label for="input">Apelido</label>
    </div>

    <div class="md-textbox">
      <input oninput="handleChange(event)" id="input" type="email" name="email" placeholder="Digite seu e-mail" required  maxlength="80"/>
      <span class="material-symbols-outlined">account_circle</span>
      <label for="input">E-mail</label>
    </div>
    
    <div class="md-textbox">
      <input oninput="handleChange(event)" id="documento" type="text" name="documento" placeholder="Digite seu documento" required/>
      <span class="material-symbols-outlined">account_circle</span>
      <label for="documento">Documento</label>
    </div>
    
    <div class="md-textbox">
      <input oninput="handleChange(event)" id="input" type="text" name="cargo" placeholder="Digite seu cargo" required minlength="2" maxlength="30"/>
      <span class="material-symbols-outlined">account_circle</span>
      <label for="input">Cargo</label>
    </div>

    <div class="md-textbox">
      <input oninput="handleChange(event)" id="input" type="password" name="senha" placeholder="Digite sua senha" required minlength="3" maxlength="20"/>
      <span class="material-symbols-outlined">account_circle</span>
      <label for="input">Senha</label>
    </div>

    <button type="submit">CADASTRAR</button> 
    <a href="./login_cadastro.php">VOLTAR</a>
</form>

</main>

<script type="text/javascript" src="../estilizacao/js/main.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Máscara de CPF
        Inputmask("999.999.999-99").mask(document.getElementById("documento"));

        // Caso queira adicionar máscara de RG, você pode usar algo assim:
        // Inputmask("99.999.999-9").mask(document.getElementById("documento"));

        // Exemplo de máscara para CEP
        // Inputmask("99999-999").mask(document.querySelector("#cep"));
    });
</script>
