<?php include "../esqueleto/cabecalho.php"; ?>

<?php include "../esqueleto/navbar.php"; ?>
<main>
    <h2>Cadastrar Usuário</h2>
    <form action="processa_cadastro.php" method="POST">
        <div>
            <label for="usuario">Usuário</label>
            <input type="text" name="usuario" required>
        </div>
        <div>
            <label for="senha">Senha</label>
            <input type="password" name="senha" required>
        </div>
        <div>
            <label for="telefone">Telefone</label>
            <input type="text" name="telefone" required>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label for="endereco">Endereço</label>
            <input type="text" name="endereco" required>
        </div>
        <button type="submit" class="btn_cd_user">Cadastrar</button>
    </form>
</main>
<?php include "../esqueleto/rodape.php"; ?>
