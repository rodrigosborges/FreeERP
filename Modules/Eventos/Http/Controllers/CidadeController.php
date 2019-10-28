<?php

namespace Modules\Eventos\Http\Controllers;

use Modules\Eventos\Entities\Cidade;

class CidadeController
{
    public function getCidades($idEstado)
    {
        $cidades = Cidade::where('estado_id', $idEstado)->get(['id', 'nomeCidade'])->toArray();
        return $cidades;
    }
}
