<?php
session_start();

if (!isset($_SESSION['id_admin'])) {
    die(json_encode(['success' => false, 'message' => 'Acesso não autorizado']));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../../../config/Dao.php';

    $data = json_decode(file_get_contents('php://input'), true);

    if (empty($data['id_academia'])) {
        die(json_encode(['success' => false, 'message' => 'ID da academia é obrigatório']));
    }

    $idAcademia = $data['id_academia'];

    try {
        $dao = new Dao();
        $idAdmin = $_SESSION['id_admin'];
        $response = $dao->removerAcademia($idAcademia, $idAdmin);
        echo json_encode($response);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Erro: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método não permitido']);
}
?>
