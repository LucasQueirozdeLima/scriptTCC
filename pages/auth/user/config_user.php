<?php
session_start();

if (isset($_SESSION["verificador"])) {
    include "cabecalho_user.php";
    require_once '../../../config/Dao.php';
    include "sidebar.php";

    $verificadorID = $_SESSION['id_usuario'];

    $dao = new Dao();
    $usuario = $dao->recuperarDadosUsuario($verificadorID);
    $dados = $usuario->fetch();

    ?>

    <div class="boxbox">
        <div class="box">

            <div class="form-container">
                <h2>Alterar Dados</h2>
                <form action="../../../intermediarios/atualizarUsuario.php" method="POST">
                    <div class="form-group">
                        <label for="nome">Nome Completo:</label>
                        <input type="text" id="nome" name="nome" required minlength="2" maxlength="50"
                            value="<?php echo $dados['nome'] ?>" />
                    </div>
                    <div class="form-group">
                        <label for="nome_usuario">Nome de Usuário:</label>
                        <input type="text" id="nome_usuario" name="nome_usuario" required minlength="2" maxlength="20"
                            value="<?php echo $dados['nome_usuario'] ?>" />
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required minlength="2" maxlength="50"
                            value="<?php echo $dados['email'] ?>" />
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha:</label>
                        <input type="password" id="senha" name="senha" required minlength="2" maxlength="20"
                            value="<?php echo $dados['senha'] ?>" />
                    </div>
                    <div class="form-group">
                        <label for="senha">Nova senha:</label>
                        <input type="password" id="senha" name="senha" required minlength="2" maxlength="20"
                            value="<?php echo $dados['senha'] ?>" />
                    </div>
                    <button type="submit">Atualizar</button>
                </form>
            </div>


        </div>
    </div>

    <?php
} else {
    header("Location: ../../index.php?error=auth");
}

include "rodapeUser.php";
?>