<?php

function tabela()
{

    include_once "conecta.php";

    try {

        $stmt = $conn->query("SELECT * FROM db_loja");

        $resposta = "
        <table class='table table-striped table-hover'>
            <thead class='table-dark'>
                <tr>
                    <th>ID</th>
                    <th>Cor</th>
                    <th>Tamanho</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>";

        while ($user = $stmt->fetchObject()) {

            $resposta .= "
            <tr>
                <td>{$user->id}</td>
                <td>{$user->cor}</td>
                <td>{$user->tamanho}</td>
                <td>
                    <button
                        class='btn btn-danger btn-sm excluir'
                        data-id='{$user->id}'>
                        Excluir
                    </button>
                </td>
            </tr>";
        }

        $resposta .= "
            </tbody>
        </table>";

        echo $resposta;

    } catch (PDOException $e) {

        echo 'Erro na consulta: ' . $e->getMessage();

    }
}

?>