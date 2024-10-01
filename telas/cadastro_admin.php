<?php include "../esqueleto/cabecalho.php"; ?>

<?php include "../esqueleto/navbar.php"; ?>

<main>
    <h2>Cadastrar Admin</h2>
    <form action="processa_cadastro_admin.php" method="POST">
        <div>
            <label for="usuario">Admin</label>
            <input type="text" name="usuario" required>
        </div>
        <div>
            <label for="senha">Senha</label>
            <input type="password" name="senha" required>
        </div>
        <button type="submit">Cadastrar Admin</button>
    </form>
</main>
<?php include "../esqueleto/rodape.php"; ?>
