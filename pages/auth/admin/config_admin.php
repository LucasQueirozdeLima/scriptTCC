<?php
session_start();
if (isset($_SESSION["verificador"])) {
    include "cabecalho_admin.php";
    include "sidebar_admin.php";
?>

    <div class="main-content">
        <div class="form-container">
            <h2>Alterar Dados</h2>
            <form action="processar_cadastro_usuario.php" method="POST">
                <div class="form-group">
                    <label for="nome">Nome Completo:</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="nome_usuario">Nome de Usuário:</label>
                    <input type="text" id="nome_usuario" name="nome_usuario" required>
                </div>
                <div class="form-group">
                    <label for="documento">Documento (CPF):</label>
                    <input type="text" id="documento" name="documento" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="cargo">Cargo:</label>
                    <input type="text" id="cargo" name="cargo" required>
                </div>
                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required>
                </div>
                <div class="form-group">
                    <label for="senha">Nova senha:</label>
                    <input type="password" id="senha" name="senha" required>
                </div>
                <button type="submit">Atualizar</button>
            </form>
        </div>
    </div>

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

<?php
} else {
    header("Location: ../../index.php?error=auth");
}

include "rodape.php";
?>