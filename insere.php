<?php

include ("conecta.php");

$cor = $_POST['campo1'];
$tamanho = $_POST['campo2'];

if ($conn->query("INSERT INTO `db_loja`(`cor`,`tamanho`) VALUES ('$cor', '$tamanho')")) {
    echo "Concluído";
} else {
    echo "Erro ao concluir ";
}

?>