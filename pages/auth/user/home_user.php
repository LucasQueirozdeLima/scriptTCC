<?php
session_start();

// Verifica se o usuário está autenticado
if (isset($_SESSION["verificador"])) {
    include "cabecalho_user.php";
    include "sidebar.php";

    // Inclui o DAO para manipulação do banco de dados
    require_once "../../../config/Dao.php";
    $dao = new Dao();

    // Verifica se o formulário foi enviado via POST
    $dica = null;
    $objetivo = null;

    if (isset($_POST['objetivo'])) {
        $objetivo = $_POST['objetivo']; // Obtém o objetivo escolhido
        $dica = $dao->recuperarDicas($objetivo); // Recupera a dica com base no objetivo
    }

    ?>

    <div class="boxbox">
        <div class="box">
            <h2 style="color: black;">Seja Bem-vindo, <?php echo $_SESSION['verificador']; ?>!</h2>

            <div class="content-home">
                <p>Escolha o seu objetivo para receber dicas de alimentação:</p>

                <!-- Formulário com os botões de escolha, agora usando POST -->
                <form method="POST" action="home_user.php">
                    <button type="submit" name="objetivo" value="Emagrecer" class="btn emagrecer-btn">Emagrecer</button>
                    <button type="submit" name="objetivo" value="Engordar" class="btn engordar-btn">Engordar</button>
                </form>

                <?php if ($dica && $objetivo): ?>
                    <h3>Dica de Alimentação para o seu Objetivo: <?php echo $objetivo; ?></h3>
                    <p><?php echo $dica; ?></p>
                <?php elseif ($objetivo): ?>
                    <p>Desculpe, não temos dicas para o seu objetivo no momento.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php
    include "rodapeUser.php";
} else {
    header("Location: ../../index.php?error=auth");
}
?>
