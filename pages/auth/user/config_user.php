
<?php include "cabecalho_user.php"; ?>

<?php include "sidebar.php"; ?>

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
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
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

 <?php include "rodapeUser.php"; ?>