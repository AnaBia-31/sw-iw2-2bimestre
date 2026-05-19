<?php
include 'conecta.php';
include 'Consulta3.php';

$id = $_POST['id'];
$sql = "DELETE FROM db_loja WHERE ID = ' ".$id.' " ';
if($pdo->query($sql)){
    consultar();
} else {
    echo "Erro ao excluir";
}
?>