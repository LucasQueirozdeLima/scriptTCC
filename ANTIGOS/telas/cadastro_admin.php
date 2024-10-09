<?php include "../esqueleto/cabecalho.php"; ?>

<?php include "../esqueleto/navbar.php"; ?>

<main>
    <h2>Cadastrar Admin</h2>
    <form action="proacessa_cadastro_admin.php" method="POST">
        <div>
            <label for="usuario">Admin</label>
            <input type="text" name="usuario" required>
        </div>
        <div>
            <label for="senha">Senha</label>
            <input type="password" name="senha" required>
        </div>
        <button type="submit" class="btn_cd_user">Cadastrar Admin</button>
    </form>
</main>
<?php include "../esqueleto/rodape.php"; ?>
