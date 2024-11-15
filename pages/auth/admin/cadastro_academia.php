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
                <input type="text" id="razao_social" name="razao_social" required minlength="3" maxlength="50"/>
            </div>
            <div class="form-group">
                <label for="cnpj">CNPJ:</label> 
                <input type="text" id="cnpj" name="cnpj" />
            </div>
            <div class="form-row">
                <div class="form-group half-width"> 
                    <label for="rua">Rua:</label>
                    <input type="text" id="rua" name="rua" required minlength="3" maxlength="100"/>
                </div>
                <div class="form-group half-width"> 
                    <label for="numero">Número:</label>
                    <input type="text" id="numero" name="numero" required minlength="1" maxlength="4"/>
                </div>
            </div>
            <div class="form-row"> 
                <div class="form-group half-width"> 
                    <label for="bairro">Bairro:</label>
                    <input type="text" id="bairro" name="bairro" required minlength="3" maxlength="50"/>
                </div>
                <div class="form-group half-width"> 
                    <label for="cidade">Cidade:</label>
                    <input type="text" id="cidade" name="cidade" required minlength="2" maxlength="30"/>
                </div>
            </div>
            <div class="form-row"> 
                <div class="form-group half-width"> 
                    <label for="cep">CEP:</label>
                    <input type="text" id="cep" name="cep" />
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
                <textarea id="descricao" name="descricao" required minlength="5" maxlength="500"></textarea>
            </div>
            <div class="form-group">
                <label for="capacidade">Capacidade Máxima:</label>
                <input type="number" id="capacidade" name="capacidade" required minlength="1" maxlength="4"/>
            </div>
            <button type="submit">Cadastrar Academia</button>
        </form>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (typeof Inputmask !== "undefined") {
            
            Inputmask("99.999.999/9999-99").mask(document.getElementById("cnpj"));
            
            Inputmask("99999-999").mask(document.getElementById("cep"));
        } else {
            console.error("Inputmask não está carregado.");
        }
    });
</script>

<?php
} else {
    header("Location: ../../index.php?error=auth");
}
include "rodape.php";
?>


