<?php
    require_once '../../../config/Dao.php'; 
    $dao = new Dao();
    
    $idAcademia = $_POST['selectedAcademyUid'];

    $dao->favoritarAcademia($idAcademia);
    // Redireciona de volta para a página de favoritos
    header("Location: favoritos.php");
    exit;
?>
