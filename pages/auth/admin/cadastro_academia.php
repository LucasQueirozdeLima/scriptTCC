<?php
session_start();

if (isset($_SESSION["verificador"])) {
    include "cabecalho_admin.php";
    include "sidebar_admin.php";
?>

<div class="main-content">
<div class="form-container">
    <h2>Cadastro de Academia</h2>
    <form action="processar_cadastro.php" method="POST">
        <div class="form-group">
            <label for="razao_social">Razão Social:</label>
            <input type="text" id="razao_social" name="razao_social" required>
        </div>
        <div class="form-group">
            <label for="cnpj">CNPJ:</label> 
            <input type="text" id="cnpj" name="cnpj" required>
        </div>
        <div class="form-row">
            <div class="form-group half-width"> 
                <label for="rua">Rua:</label>
                <input type="text" id="rua" name="rua" required>
            </div>
            <div class="form-group half-width"> 
                <label for="numero">Número:</label>
                <input type="text" id="numero" name="numero" required>
            </div>
        </div>
        <div class="form-row"> 
            <div class="form-group half-width"> 
                <label for="bairro">Bairro:</label>
                <input type="text" id="bairro" name="bairro" required>
            </div>
            <div class="form-group half-width"> 
                <label for="cidade">Cidade:</label>
                <input type="text" id="cidade" name="cidade" required>
            </div>
        </div>
        <div class="form-row"> 
            <div class="form-group half-width"> 
                <label for="cep">CEP:</label>
                <input type="text" id="cep" name="cep" required>
            </div>
            <div class="form-group half-width"> 
                <label for="status_academia">Status da Academia:</label>
                <select id="status_academia" name="status_academia" required>
                    <option value="Ativa">Ativa</option>
                    <option value="Inativa">Inativa</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" required></textarea>
        </div>
        <div class="form-group">
            <label for="capacidade">Capacidade Máxima:</label>
            <input type="number" id="capacidade" name="capacidade" required>
        </div>
        <button type="submit">Cadastrar Academia</button>
    </form>
</div>

</div>

<?php
} else {
    header("Location: ../../index.php?error=auth");
}

include "rodape.php";
?>
