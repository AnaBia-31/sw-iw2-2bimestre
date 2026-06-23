<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Cadastro de Camisetas</title>
</head>

<body>
    <style>
        .body {
            background-color: pink
        }
    </style>
    <div class="container mt-5">
        <h1 class="mb-4">Registrar sua camiseta</h1>

        <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modalCadastro">
            Nova Camiseta
        </button>

        <div class="modal fade" id="modalCadastro" tabindex="-1" aria-labelledby="modalCadastroLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCadastroLabel">Cadastrar Nova Camiseta</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form id="formCamisa">
                            <div class="mb-3">
                                <label for="BoxColor" class="form-label">Cor da Camiseta</label>
                                <input type="text" class="form-control" placeholder="Coloque a cor da camisa"
                                    id="BoxColor">
                            </div>

                            <div class="mb-3">
                                <label for="BoxTamanho" class="form-label">Tamanho</label>
                                <select id="BoxTamanho" class="form-select">
                                    <option value="">Escolha um tamanho</option>
                                    <option value="PP">PP</option>
                                    <option value="P">P</option>
                                    <option value="M">M</option>
                                    <option value="G">G</option>
                                    <option value="GG">GG</option>
                                    <option value="XG">XG</option>
                                </select>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="button" id="Btn" class="btn btn-success">Registrar</button>
                    </div>

                </div>
            </div>
        </div>

        <!-- Modal de Editar -->

        <div class="modal fade" id="ModalEdit" tabindex="-1" aria-labelledby="ModalEditLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalEditLabel">Editar Camiseta</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form id="formEditarCamisa">
                            <input type="hidden" id="EditId">

                            <div class="mb-3">
                                <label for="EditColor" class="form-label">Cor da Camiseta</label>
                                <input type="text" class="form-control" id="EditColor">
                            </div>

                            <div class="mb-3">
                                <label for="EditTamanho" class="form-label">Tamanho</label>
                                <select id="EditTamanho" class="form-select">
                                    <option value="">Escolha um tamanho</option>
                                    <option value="PP">PP</option>
                                    <option value="P">P</option>
                                    <option value="M">M</option>
                                    <option value="G">G</option>
                                    <option value="GG">GG</option>
                                    <option value="XG">XG</option>
                                </select>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="button" id="BtnSalvarEdit" class="btn btn-primary">Salvar Alterações</button>
                    </div>

                </div>
            </div>
        </div>

        <!-- MODAL DE CONFIRMAR EXCLUSAO -->

        <div class="modal fade" id="modalExcluir" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Confirmar exclusão</h5>
                        <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal">
                        </button>
                    </div>

                    <div class="modal-body">
                        Deseja realmente excluir esta camisa?
                    </div>

                    <div class="modal-footer">
                        <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                            Cancelar
                        </button>

                        <button type="button"
                            class="btn btn-danger"
                            id="btnConfirmarExcluir">
                            Excluir
                        </button>
                    </div>

                </div>
            </div>
        </div>

        <div id="Resposta" class="mt-4">
            <?php
            include "Consulta3.php";
            tabela();
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {

            // Btn inserir
            $('#Btn').click(function(e) {
                e.preventDefault();

                var cor = $('#BoxColor').val();
                if (cor == '') {
                    alert('Preencha a cor da camiseta');
                    return;
                }
                var tamanho = $('#BoxTamanho').val();

                $.ajax({
                    url: "inserir.php",
                    type: "POST",
                    dataType: "json",
                    data: {
                        cor: cor,
                        tamanho: tamanho,
                    }
                }).done(function(resposta) {
                    console.log(resposta.status);
                    console.log(resposta.message);

                    $('#Resposta').load('Consulta3.php');

                    // Fecha o modal automaticamente após o cadastro com sucesso
                    bootstrap.Modal.getInstance(document.getElementById('modalCadastro')).hide();

                }).fail(function(jqXHR, textStatus) {
                    console.log("Request failed: " + textStatus);
                }).always(function() {
                    console.log("Completou");
                });
            });

            //Btn Pegar IdExcluir
            $(document).on("click", ".excluir", function() {
                $('#modalExcluir').data('id', $(this).data('id'));
            });

            //Btn Excluir
            $(document).on("click", "#btnConfirmarExcluir", function(e) {
                var id = $('#modalExcluir').data('id');

                console.log("ID enviado:", id);

                $.ajax({
                    url: "excluir.php",
                    type: "POST",
                    dataType: "json",
                    data: {
                        id: id
                    },
                }).done(function(resposta) {

                    console.log(resposta.status);
                    console.log(resposta.message);

                    window.location.reload();

                    bootstrap.Modal
                        .getInstance(document.getElementById('modalExcluir'))
                        .hide();

                }).fail(function(jqXHR, textStatus) {
                    console.log("Request failed: " + textStatus);

                }).always(function() {
                    console.log("completou");
                });
            });

            //Abrir o modal de Editar preenchido
            $(document).on("click", ".editar", function() {
                var id = $(this).data("id");

                $.ajax({
                    url: "Consulta3.php",
                    type: "POST",
                    dataType: "json",
                    data: {
                        id: id,
                    }
                }).done(function(resposta) {

                    console.log(resposta.status);
                    console.log(resposta.message);

                    $("#EditId").val(resposta.codigo);
                    $("#EditColor").val(resposta.cor);
                    $("#EditTamanho").val(resposta.tamanho);

                    new bootstrap.Modal(
                        document.getElementById('ModalEdit')
                    ).show();

                }).fail(function(jqXHR, textStatus) {

                    console.log("Status:", textStatus);
                    console.log("Resposta:", jqXHR.responseText);

                });

            });


            //Btn Salvar Edição
            $(document).on("click", "#BtnSalvarEdit", function(e) {
                e.preventDefault();

                var id = $('#EditId').val();
                var cor = $('#EditColor').val();
                var tamanho = $('#EditTamanho').val();

                if (cor == '') {
                    alert("Preencha a cor da camiseta");
                    return;
                }

                $.ajax({
                    url: "atualizar.php",
                    type: "POST",
                    dataType: "json",
                    data: {
                        id: id,
                        cor: cor,
                        tamanho: tamanho
                    }

                }).done(function(resposta) {
                    console.log(resposta.status);
                    console.log(resposta.message);

                    $('#Resposta').load('Consulta3.php');

                    bootstrap.Modal.getInstance(document.getElementById('ModalEdit')).hide();
                }).fail(function(jqXHR, textStatus) {
                    console.log("Erro ao atualizar: " + textStatus);
                });
            });
        });
    </script>
</body>

</html>