<?php
include_once 'conecta.php';
include_once 'Consulta3.php';

$cor = $_POST["campo1"];
$tamanho = $_POST["campo2"];

try {
    $sql = "INSERT INTO db_loja (cor, tamanho) VALUES ('$cor', '$tamanho')";

    if ($conn->exec($sql)) {
        tabela();
    } else {
        echo "Erro ao concluir";
    }
} catch (PDOException $e) {
    echo "Erro no banco: " . $e->getMessage();
}
?>