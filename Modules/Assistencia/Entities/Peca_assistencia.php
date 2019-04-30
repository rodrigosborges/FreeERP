<?php

namespace Modules\Assistencia\Entities;

use Illuminate\Database\Eloquent\Model;

class PecaAssistenciaModel extends Model
{
  protected $table = 'peca_assistencia';
  protected $fillable = ['id','nome','valor_compra','valor_venda'];

  public static function busca($busca)
  {
    return static::where('nome', 'LIKE', '%'.$busca.'%')->get();
  }
}
