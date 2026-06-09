<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastro de Camisetas</title>

    <!-- Bootstrap porque ninguém merece fazer CSS do zero -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- JQuery porque AJAX sozinho dá medo -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

</head>

<!-- Fundo lilás porque sim -->
<body style="background-color:#f8f5ff;">

    <!-- Container principal -->
    <div class="container mt-5">

        <!-- Card bonitinho do sistema -->
        <div class="card shadow">

            <!-- Cabeçalho -->
            <div class="card-header text-white" style="background-color:#6f42c1;">

                <h3 class="mb-0"> Cadastro de Camisetas </h3>

            </div>

            <div class="card-body">

                <!-- Botão que abre o modal -->
                <button class="btn text-white mb-3" style="background-color:#6f42c1;" data-bs-toggle="modal"
                    data-bs-target="#modalCamiseta">

                    Nova Camiseta

                </button>

                <!-- Onde aparecem as mensagens tipo "deu certo!" -->
                <div id="mensagem"></div>

                <!-- Onde a tabela vai surgir magicamente -->
                <div id="resultado"></div>

            </div>

        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalCamiseta" tabindex="-1">

        <div class="modal-dialog">

            <div class="modal-content">

                <!-- Cabeçalho do modal -->
                <div class="modal-header">

                    <h5 class="modal-title">
                        Cadastrar Camiseta
                    </h5>

                    <!-- Botão de fechar -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <!-- Formulário -->
                    <form id="formulario">

                        <!-- Escolha da cor -->
                        <div class="mb-3">

                            <label class="form-label">
                                Cor
                            </label>

                            <select name="campo1" class="form-select" required>

                                <option value="">Selecione</option>
                                <option>Azul</option>
                                <option>Amarelo</option>
                                <option>Branco</option>
                                <option>Preto</option>
                                <option>Rosa</option>
                                <option>Roxo</option>

                            </select>

                        </div>

                        <!-- Escolha do tamanho -->
                        <div class="mb-3">

                            <label class="form-label">
                                Tamanho
                            </label>

                            <select name="campo2" class="form-select" required>

                                <option value="">Selecione</option>
                                <option>PP</option>
                                <option>P</option>
                                <option>M</option>
                                <option>G</option>
                                <option>GG</option>
                                <option>XG</option>

                            </select>

                        </div>

                        <!-- Botão que manda tudo pro banco -->
                        <button type="submit" class="btn text-white" style="background-color:#6f42c1;">

                            Salvar

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

    <script>

        // Função que carrega a tabela, traduzindo: "vai lá no PHP e traz os dados"
        function carregarTabela() {

            $.ajax({

                url: "mostrar.php",

                success: function (retorno) {

                    // Coloca a tabela dentro da div resultado
                    $("#resultado").html(retorno);

                }

            });

        }

        // Quando a página terminar de carregar...
        $(document).ready(function () {

            // Já mostra a tabela
            carregarTabela();

            // Quando o formulário for enviado
            $("#formulario").submit(function (e) {

                // Impede a página de recarregar
                e.preventDefault();

                $.ajax({

                    // Arquivo que salva os dados
                    url: "insere.php",

                    type: "POST",

                    // Envia os dados do formulário
                    data: $(this).serialize(),

                    success: function (retorno) {

                        // Atualiza a tabela
                        $("#resultado").html(retorno);

                        // Mensagem de sucesso porque autoestima do usuário importa
                        $("#mensagem").html(`
                            <div class="alert alert-success alert-dismissible fade show">
                                ✅ Camiseta cadastrada com sucesso!
                            </div>
                        `);

                        // Faz a mensagem desaparecer depois de 3 segundos
                        setTimeout(function () {
                            $("#mensagem").html("");
                        }, 3000);

                        // Limpa o formulário
                        $("#formulario")[0].reset();

                        // Fecha o modal porque já salvou mesmo
                        let modal = bootstrap.Modal.getInstance(
                            document.getElementById('modalCamiseta')
                        );

                        modal.hide();

                    }

                });

            });

            // Quando clicar em excluir...
            $(document).on("click", ".excluir", function () {

                // Pega o id do registro
                let id = $(this).data("id");

                $.ajax({

                    // Arquivo responsável por apagar a camiseta
                    url: "excluir.php",

                    type: "POST",

                    data: {
                        id: id
                    },

                    success: function (retorno) {

                        // Atualiza a tabela
                        $("#resultado").html(retorno);

                        // Mensagem de despedida da camiseta
                        $("#mensagem").html(`
                            <div class="alert alert-warning alert-dismissible fade show">
                                🗑️ Camiseta removida com sucesso!
                            </div>
                        `);

                        // A mensagem também some
                        setTimeout(function () {
                            $("#mensagem").html("");
                        }, 3000);

                    }

                });

            });

        });

    </script>

    <!-- JavaScript do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>