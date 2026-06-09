<?php

include_once 'conecta.php';

$id = $_POST['id'];

try {

    $sql = "DELETE FROM db_loja WHERE id = '$id'";

    $conn->exec($sql);

} catch (PDOException $e) {

    echo $e->getMessage();

}

?>