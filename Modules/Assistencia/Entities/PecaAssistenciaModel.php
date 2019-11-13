<?php

namespace Modules\Assistencia\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PecaAssistenciaModel extends Model
{
  use SoftDeletes;
  protected $table = 'peca_assistencia';
  protected $fillable = ['id','nome','valor_compra','valor_venda','quantidade'];

  public static function busca($busca) //metodo de busca dentro da coluna nome
  {
    return static::where('nome', 'LIKE', '%'.$busca.'%')->paginate(10);
  }
}
