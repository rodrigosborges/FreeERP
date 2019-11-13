<?php

namespace Modules\Assistencia\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServicoAssistenciaModel extends Model
{
  use SoftDeletes;
  protected $table = 'servico_assistencia';
  protected $fillable = ['id','nome','valor'];

  public static function busca($busca) //metodo de busca por nome
  {
    return static::where('nome', 'LIKE', '%'.$busca.'%')->paginate(10);
  }
}
