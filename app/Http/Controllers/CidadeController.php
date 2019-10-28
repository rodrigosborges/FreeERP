<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use App\Entities\Cidade;

class CidadeController extends Controller
{
    public function getCidades($idEstado)
    {
        $cidades = Cidade::where('estado_id', $idEstado)->get(['id', 'nome'])->toArray();
        return $cidades;
    }
}
