<?php

function validaDado($registro)
{
    $erros = [];

    if (!filter_var($registro->nome_favorecido, FILTER_SANITIZE_STRING)) {
        $erros["nome_favorecido"] =  "Descrição: Campo vazio e ou informação inválida!";
    }

    if (count($erros) > 0) {
        $_SESSION["erros"] = $erros;
        throw new Exception("Erro nas informações!");
    }
}
