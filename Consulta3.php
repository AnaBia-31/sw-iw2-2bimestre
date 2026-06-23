<?php

include_once "conecta.php";

if (isset($_POST['id'])) {

    try {

        $id = $_POST['id'];

        $sql = "SELECT * FROM db_loja WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);

        $dados = $stmt->fetch(PDO::FETCH_ASSOC);

        echo json_encode([
            "status" => "ok",
            "codigo" => $dados['id'],
            "cor" => $dados['cor'],
            "tamanho" => $dados['tamanho']
        ]);

    } catch (PDOException $e) {

        echo json_encode([
            "status" => "erro",
            "message" => $e->getMessage()
        ]);

    }

    exit;
}

function tabela()
{
    include "conecta.php";

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
                        class='btn btn-warning btn-sm editar'
                        data-id='{$user->id}'>
                        Editar
                    </button>

                    <button
                        class='btn btn-danger btn-sm excluir'
                        data-id='{$user->id}' data-bs-toggle='modal' data-bs-target='#modalExcluir'>
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

        echo "Erro na consulta: " . $e->getMessage();

    }
}

?>