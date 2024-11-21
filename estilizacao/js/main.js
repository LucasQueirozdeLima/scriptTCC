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
};

// Adiciona o evento `input` aos campos
[nome, nomeUsuario, email, senha].forEach((campo) => {
  campo.addEventListener("input", handleChange);
});


