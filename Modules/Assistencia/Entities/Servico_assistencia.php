<?php

namespace Modules\Assistencia\Entities;

use Illuminate\Database\Eloquent\Model;

class ServicoAssistenciaModel extends Model
{
  protected $table = 'servico_assistencia';
  protected $fillable = ['id','nome','valor'];

  public static function busca($busca)
  {
    return static::where('nome', 'LIKE', '%'.$busca.'%')->get();
  }
}
