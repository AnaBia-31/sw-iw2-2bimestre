<?php

header('Content-Type: application/json; charset=utf-8');

include 'conecta.php';

$id = $_POST['id'];
$cor = $_POST['cor'];
$tamanho = $_POST['tamanho'];

$sql = "UPDATE db_loja
        SET cor = ?, tamanho = ?
        WHERE id = ?";

$stmt = $conn->prepare($sql);

if ($stmt->execute([$cor, $tamanho, $id])) {

    echo json_encode([
        'status' => 'success',
        'message' => 'Camiseta editada com sucesso'
    ]);

} else {

    echo json_encode([
        'status' => 'error',
        'message' => 'Erro ao editar'
    ]);

}

exit();
?>