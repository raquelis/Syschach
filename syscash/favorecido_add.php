<?php
require_once("valida_acesso.php");
?>
<?php
if (filter_input(INPUT_SERVER, "REQUEST_METHOD") === "POST") {
    try {
        $erros = [];
        $id = filter_input(INPUT_POST, "id_favorecido", FILTER_VALIDATE_INT);
        $usuario_id = isset($_SESSION["usuario_id"]) ?  $_SESSION["usuario_id"] : 0;
        $pagina = filter_input(INPUT_POST, "pagina_favorecido", FILTER_VALIDATE_INT);
        $texto_busca = filter_input(INPUT_POST, "texto_busca_favorecido", FILTER_SANITIZE_STRING);

        if (!isset($pagina)) {
            $pagina = 1;
        }
    } catch (Exception $e) {
        $erros[] = $e->getMessage();
        $_SESSION["erros"] = $erros;
    }
}
?>
<br>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4 d-flex justify-content-start">
                    <h4>Adicionar Favorecido</h4>
                </div>
                <div class="col-md-4 d-flex justify-content-center">
                </div>
                <div class="col-md-4 d-flex justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" title="Home" id="home_index_favorecido"><i class="fas fa-home"></i>
                                    <span>Home</span></a></li>
                            <li class="breadcrumb-item"><a href="#" title="Favorecido" id="favorecido_index"><i class="fas fa-tag"></i> <span>Favorecido</span></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Adicionar</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <hr>
            <?php
            if (isset($_SESSION["erros"])) {
                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>";
                echo "<button type='button' class='btn-close btn-sm' data-bs-dismiss='alert'
                aria-label='Close'></button>";
                foreach ($_SESSION["erros"] as $chave => $valor) {
                    echo $valor . "<br>";
                }
                echo "</div>";
            }
            unset($_SESSION["erros"]);
            ?>
            <div class="alert alert-info alert-dismissible fade show" style="display: none;" id="div_mensagem_registro_favorecido">
                <button type="button" class="btn-close btn-sm" aria-label="Close" id="div_mensagem_registro_botao_favorecido"></button>
                <p id="div_mensagem_registro_texto_favorecido"></p>
            </div>
            <hr>
            <div class="col-md-12">
                <form enctype="multipart/form-data" method="post" accept-charset="utf-8" id="favorecido_dados" role="form" action="">
                    <ul class="nav nav-tabs" id="tab_favorecido" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="dadostab_favorecido" data-bs-toggle="tab" data-bs-target="#dados_favorecido" type="button" role="tab" aria-controls="dados_favorecido" aria-selected="true">Dados</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="tabdados_favorecido">
                        <div class="tab-pane fade show active" id="dados_favorecido" role="tabpanel" aria-labelledby="dados_favorecido">
                            <div class="col-md-6">
                                <label for="nome" class="form-label">Descrição</label>
                                <input type="text" class="form-control" id="nome_favorecido" name="nome_favorecido" maxlength="50" autofocus>
                            </div>
                            <input type="hidden" id="id_favorecido" value="<?php echo isset($id) ? $id : '' ?>" />
                            <input type="hidden" id="usuario_id_favorecido" name="usuario_id_favorecido" value="<?php echo isset($usuario_id) ? $usuario_id : '' ?>" />
                        </div>
                    </div>
                    <br>
                    <div>
                        <button type="button" class="btn btn-primary" id="botao_salvar_favorecido">Salvar</button>
                        <button type="reset" class="btn btn-secondary" id="botao_limpar_favorecido">Limpar</button>
                    </div>
                </form>
            </div>
            <div>
                <input type="hidden" id="pagina_favorecido" name="pagina_favorecido" value="<?php echo isset($pagina) ? $pagina : '' ?>" />
                <input type="hidden" id="texto_busca_favorecido" name="texto_busca_favorecido" value="<?php echo isset($texto_busca) ? $texto_busca : '' ?>" />
            </div>
        </div>
    </div>
</div>

<!--modal de salvar-->
<div class="modal fade" id="modal_salvar_favorecido" tabindex="-1" aria-labelledby="logoutlabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutlabel_favorecido">Pergunta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Deseja salvar o registro?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="modal_salvar_sim_favorecido">Sim</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
            </div>
        </div>
    </div>
</div>

<script>
     //devido ao load precisa carregar o arquivo js dessa forma
    var url = "./js/sistema/favorecido.js";
    $.getScript(url);
</script>