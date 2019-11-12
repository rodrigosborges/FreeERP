<?php

use Modules\AvaliacaoDesempenho\Entities\Processo;
use Modules\AvaliacaoDesempenho\Entities\Avaliacao;
use Modules\AvaliacaoDesempenho\Entities\Avaliador;
use Modules\AvaliacaoDesempenho\Entities\Avaliado;
use Modules\AvaliacaoDesempenho\Entities\Questao;
use Modules\AvaliacaoDesempenho\Entities\Categoria;
use Modules\AvaliacaoDesempenho\Entities\ResultadoGestor;
use Modules\AvaliacaoDesempenho\Entities\ResultadoFuncionario;

function relatorioIndividual($tipo_avaliacao, $resultado_id) {

    if ($tipo_avaliacao == 1) {
        $resultado = ResultadoFuncionario::findOrFail($resultado_id);
    } else {
        $resultado = ResultadoGestor::findOrFail($resultado_id);
    }

    $avaliacao = $resultado->avaliacao;

    $respostas = (array)json_decode($resultado->respostas);

    $pontuacao = 0;
    $pontuacaoCategoria = [];

    $questoesId = [];
    $categoriaId = [];

    foreach ($respostas as $key => $value) {
        $questoesId[] = $key;
        $pontuacao += $value;

        $aux = Questao::findOrFail($key);
        $categoria = $aux->categoria->id;

        if (!isset($pontuacaoCategoria[$categoria])) {
            $pontuacaoCategoria[$categoria] = $respostas[$aux->id];
        } else {
            $pontuacaoCategoria[$categoria] += $respostas[$aux->id];
        }
    }

    foreach ($pontuacaoCategoria as $key => $value) {
        $categoriaId[] = $key;
    }

    $questoes = Questao::whereIn('id', $questoesId)->get();
    $categorias = Categoria::whereIn('id', $categoriaId)->get();

    $data = [
        'respostas' => $respostas,
        'pontuacao' => $pontuacao,
        'pontuacaoCategoria' => $pontuacaoCategoria,
        'questoesId' => $questoesId,
        'categoriaId' => $categoriaId,
        'questoes' => $questoes,
        'categorias' => $categorias,
        'avaliacao' => $avaliacao,
        'resultado' => $resultado
    ];

    return $data;
}