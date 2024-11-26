<?php
session_start();


if (isset($_SESSION["verificador"])) {
    include "cabecalho_user.php";
    include "sidebar.php";

    require_once "../../../config/Dao.php";
    $dao = new Dao();
   
    $dica = null;
    $objetivo = null;

    if (isset($_POST['objetivo'])) {
        $objetivo = $_POST['objetivo']; 
        $dica = $dao->recuperarDicas($objetivo);
    }

    ?>

    <div class="boxbox">
        <div class="box">
            <h2 class="titulo-bem-vindo">Seja Bem-vindo, <?php echo $_SESSION['verificador']; ?>!</h2>

            <p class="texto-instrucoes">Escolha o seu objetivo para receber dicas de alimentação:</p>

            <form method="POST" action="home_user.php">
                <button type="submit" name="objetivo" value="Emagrecer" class="btn objetivo-btn emagrecer-btn">Massa Magra</button>
                <br><br>
                <button type="submit" name="objetivo" value="Engordar" class="btn objetivo-btn engordar-btn">Massa Gorda</button>
            </form>

            <?php if ($dica && $objetivo): ?>
                <h3 class="titulo-dica">Dica de Alimentação para o seu Objetivo: <?php echo $objetivo; ?></h3>
                <p class="dica"><?php echo $dica; ?></p>
            <?php elseif ($objetivo): ?>
                <p class="sem-dica">Desculpe, não temos dicas para o seu objetivo no momento.</p>
            <?php endif; ?>
        
        </div>
    </div>

    <?php
    include "rodapeUser.php";
} else {
    header("Location: ../../index.php?error=auth");
}
?>
