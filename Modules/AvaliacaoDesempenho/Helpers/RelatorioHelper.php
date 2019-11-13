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
        $categoriaId[] = $categoria;
        if (!isset($pontuacaoCategoria[$categoria])) {
            $pontuacaoCategoria[$categoria] = $respostas[$aux->id];
        } else {
            $pontuacaoCategoria[$categoria] += $respostas[$aux->id];
        }
    }
    
    $ocorrenciaCategorias = array_count_values($categoriaId);
    
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
        'ocorrenciaCategorias' => $ocorrenciaCategorias,
        'avaliacao' => $avaliacao,
        'resultado' => $resultado
    ];

    return $data;
}

function relatorioGestor($avaliacao_id) {
    $avaliacao = Avaliacao::findOrFail($avaliacao_id);

    $avaliadores = $avaliacao->avaliadores;

    $avaliado = $avaliacao->avaliados[0];

    $resultados = ResultadoGestor::where('avaliacao_id', $avaliacao->id)->get();

    $teste = [];

    foreach ($resultados as $i => $resultado) {

        $respostas = (array)json_decode($resultado->respostas);
        
        $pontuacaoTotal = 0;
        $pontuacaoCategoria = [];

        foreach ($respostas as $j => $resposta) {
            $pontuacaoTotal += $resposta;

            $aux = Questao::findOrFail($j);

            $categoria = $aux->categoria->id;

            if (!isset($pontuacaoCategoria[$categoria])) {
                $pontuacaoCategoria[$categoria] = $respostas[$aux->id];
            } else {
                $pontuacaoCategoria[$categoria] += $respostas[$aux->id];
            }
        }

        $teste[$i] = [
            'pontuacaoTotal' => $pontuacaoTotal,
            'pontuacaoCategoria' => $pontuacaoCategoria
        ];

    }

    $pontuacaoGeral = 0;
    $pontuacaoGeralCategoria = [];
    $mediaGeralCategoria = [];
    $categoriaId = [];

    foreach ($teste as $key => $bla) {
        $pontuacaoGeral += $bla['pontuacaoTotal'];

        foreach ($bla['pontuacaoCategoria'] as $k => $categoria) {
            if (!isset($pontuacaoGeralCategoria[$k])) {
                $pontuacaoGeralCategoria[$k] = $categoria;
            } else {
                $pontuacaoGeralCategoria[$k] += $categoria;
            }
            $mediaGeralCategoria[$k] = $pontuacaoGeralCategoria[$k]/count($avaliacao->avaliadores);
        }
    }

    $mediaGeral = $pontuacaoGeral/count($avaliacao->avaliadores);

    foreach ($avaliacao->questoes as $key => $questao) {
        $categoriaId[] = $questao->categoria->id;
    }

    $categorias = Categoria::whereIn('id', $categoriaId)->get();

    $ocorrenciaCategorias = array_count_values($categoriaId);

    $data = [
        'pontuacaoGeral' => $pontuacaoGeral,
        'pontuacaoGeralCategoria' => $pontuacaoGeralCategoria,
        'ocorrenciaCategorias' => $ocorrenciaCategorias,
        'mediaGeral' => $mediaGeral,
        'mediaGeralCategoria' => $mediaGeralCategoria,
        'categorias' => $categorias,
        'avaliacao' => $avaliacao,
        'resultados' => $resultados
    ];

    return $data;
}