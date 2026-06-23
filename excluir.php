<?php

header('Content-Type: application/json; charset=utf-8');

include_once 'conecta.php';

$id = $_POST['id'];

try {

    $sql = "DELETE FROM db_loja WHERE id = ?";

    $stmt = $conn->prepare($sql);

    if ($stmt->execute([$id])) {

        echo json_encode([
            "status" => "success",
            "message" => "Camiseta excluída"
        ]);

    } else {

        echo json_encode([
            "status" => "error",
            "message" => "Erro ao excluir"
        ]);

    }

} catch (PDOException $e) {

    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);

}

exit();
?>