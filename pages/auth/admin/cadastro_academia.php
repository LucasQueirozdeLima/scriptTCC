<?php include "cabecalho_admin.php"; ?>
<?php include "sidebar_admin.php"; ?>

<div class="main-content">
    <h2>Cadastro de Academia</h2>
    <form action="processar_cadastro.php" method="POST">
        <div class="form-group">
            <label for="nome">Nome da Academia:</label>
            <input type="text" id="nome" name="nome" required>
        </div>
        <div class="form-group">
            <label for="endereco">Endereço:</label>
            <input type="text" id="endereco" name="endereco" required>
        </div>
        <div class="form-group">
            <label for="capacidade">Capacidade Máxima:</label>
            <input type="number" id="capacidade" name="capacidade" required>
        </div>
        <button type="submit">Cadastrar Academia</button>
    </form>
</div>

<?php include "rodape.php"; ?>
