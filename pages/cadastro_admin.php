<?php include "../includes/cabecalho.php"; ?>
<?php include "../includes/navbar.php"; ?>

<main style="background: linear-gradient(120deg, #0d0e13 , #0a296b, #326485  , #648ca4, #b1c7f1);">

  <form action="../intermediarios/inserirAdmin.php" method="post" id="formAdmin">

    <h2 style="text-align: center; color:white; margin-bottom: 20px; font-family: Euclid Circular A;">CRIAR CADASTRO ADMINISTRADOR</h2>

    <div class="md-textbox">
      <input oninput="handleChange(event)" id="nome_admin" type="text" name="nome" placeholder="Digite seu nome" required minlength="1" maxlength="15" />
      <span class="material-symbols-outlined">account_circle</span>
      <label for="nome_admin">Nome</label>
    </div>

    <div class="md-textbox">
      <input oninput="handleChange(event)" id="nome_usuario_admin" type="text" name="nome_usuario" placeholder="Digite seu nome de usuário " required minlength="1" maxlength="15" />
      <span class="material-symbols-outlined">account_circle</span>
      <label for="nome_usuario_admin">Apelido</label>
    </div>

    <div class="md-textbox">
      <input oninput="handleChange(event)" id="email_admin" type="email" name="email" placeholder="Digite seu e-mail" required maxlength="80" />
      <span class="material-symbols-outlined">account_circle</span>
      <label for="email_admin">E-mail</label>
    </div>

    <div class="md-textbox">
      <input oninput="handleChange(event)" id="documento_admin" type="text" name="documento" placeholder="Digite seu CPF" required />
      <span class="material-symbols-outlined">account_circle</span>
      <label for="documento_admin">Documento</label>
    </div>

    <div class="md-textbox">
      <input oninput="handleChange(event)" id="cargo_admin" type="text" name="cargo" placeholder="Digite seu cargo " required minlength="2" maxlength="30" />
      <span class="material-symbols-outlined">account_circle</span>
      <label for="cargo_admin">Cargo</label>
    </div>

    <div class="md-textbox">
      <input oninput="handleChange(event)" id="senha_admin" type="password" name="senha" placeholder="Digite sua senha " required minlength="3" maxlength="20" />
      <span class="material-symbols-outlined">account_circle</span>
      <label for="senha_admin">Senha</label>
    </div>

    <button type="submit" id="submitBtn_admin" class="btn-disabled" disabled>CADASTRAR</button>
    <a href="./login_cadastro.php">VOLTAR</a>

  </form>

</main>

<script type="text/javascript" src="../estilizacao/js/main.js"></script>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    Inputmask("999.999.999-99").mask(document.getElementById("documento_admin"));
  });
  document.addEventListener("DOMContentLoaded", function () {
  
  const form = document.querySelector("form");


  const campos = form.querySelectorAll("input");

  const submitBtn = form.querySelector("button[type='submit']");

  
  const handleChange = () => {
    let isValid = true;
    
  
    campos.forEach((campo) => {
      if (campo.required && campo.value.trim().length === 0) {
        isValid = false;
      }
    });

   
    submitBtn.disabled = !isValid;
    if (!isValid) {
      submitBtn.classList.add("btn-disabled");
    } else {
      submitBtn.classList.remove("btn-disabled");
    }
  };

 
  campos.forEach((campo) => {
    campo.addEventListener("input", handleChange);
  });

  // Inicializa a verificação ao carregar a página
  handleChange();

});



</script>
