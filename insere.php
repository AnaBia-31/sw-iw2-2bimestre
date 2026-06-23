<?php

header('Content-Type: application/json; charset=utf-8');

include_once 'conecta.php';

$cor = $_POST["cor"];
$tamanho = $_POST["tamanho"];

try {

    $sql = "INSERT INTO db_loja (cor, tamanho)
            VALUES (?, ?)";

    $stmt = $conn->prepare($sql);

    if ($stmt->execute([$cor, $tamanho])) {

        echo json_encode([
            "status" => "success",
            "message" => "Camiseta cadastrada"
        ]);

    } else {

        echo json_encode([
            "status" => "error",
            "message" => "Erro ao cadastrar"
        ]);

    }

} catch(PDOException $e) {

    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);

}