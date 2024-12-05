<?php include "../includes/cabecalho.php"; ?>
<?php include "../includes/navbar.php"; ?>

<main style="background: linear-gradient(120deg, #0d0e13 , #0a296b, #326485  , #648ca4, #b1c7f1);">
  <form action="../intermediarios/inserirUsuario.php" method="post">
    <h2 style="text-align: center; color:white; margin-bottom: 20px; font-family: Euclid Circular A;">CRIAR CADASTRO</h2>

    <div class="md-textbox">
      <input id="nome" type="text" name="nome" placeholder="Digite seu nome" required minlength="3" maxlength="15" />
      <span class="material-symbols-outlined">account_circle</span>
      <label for="nome">Nome</label>
    </div>

    <div class="md-textbox">
      <input id="nome_usuario" type="text" name="nome_usuario" placeholder="Digite seu nome de usuário " required minlength="2" maxlength="15" />
      <span class="material-symbols-outlined">account_circle</span>
      <label for="nome_usuario">Apelido</label>
    </div>

    <div class="md-textbox">
      <input id="email" type="email" name="email" placeholder="Digite seu e-mail" required maxlength="80" />
      <span class="material-symbols-outlined">account_circle</span>
      <label for="email">E-mail</label>
    </div>

    <div class="md-textbox">
      <input id="senha" type="password" name="senha" placeholder="Digite sua senha" required minlength="3" maxlength="20" />
      <span class="material-symbols-outlined">account_circle</span>
      <label for="senha">Senha</label>
    </div>

    <button type="submit" id="submitBtn" class="btn-disabled" disabled>CADASTRAR</button>

    <a href="./login_cadastro.php">VOLTAR</a>
  </form>
</main>

<script>

  // Seleciona todos os campos do formulário
const nome = document.querySelector("#nome");
const nomeUsuario = document.querySelector("#nome_usuario");
const email = document.querySelector("#email");
const senha = document.querySelector("#senha");
const submitBtn = document.querySelector("#submitBtn");

// Função para verificar os valores dos campos
const handleChange = () => {
  // Valida se todos os campos estão preenchidos corretamente
  const isValid =
    nome.value.trim().length >= 3 &&
    nomeUsuario.value.trim().length >= 2 &&
    email.value.trim().length > 0 &&
    senha.value.trim().length >= 3;

  // Habilita ou desabilita o botão
  submitBtn.disabled = !isValid;
  if (!isValid) {
    submitBtn.classList.add("btn-disabled");
  } else {
    submitBtn.classList.remove("btn-disabled");
  }
};

// Adiciona o evento `input` aos campos
[nome, nomeUsuario, email, senha].forEach((campo) => {
  campo.addEventListener("input", handleChange);
});



</script>
