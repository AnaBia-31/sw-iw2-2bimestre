<?php

function tabela(){
include "conecta.php";

$stmt = $conn->query("SELECT * FROM db_loja");

$resposta = "<table border = 1>";

while($user = $stmt->fetchObject()) {
    $resposta .= "<tr> 
    <td>$user->cor </td> 
    <td> $user->tamanho </td> 
    </tr>";
}
 $resposta.="</table>";
echo $resposta;

}
tabela();
?>