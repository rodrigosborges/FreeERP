<?php

namespace Modules\Assistencia\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClienteAssistenciaModel extends Model
{
  use SoftDeletes;
  protected $table = 'cliente_assistencia';
  protected $fillable = ['id','nome','cpf','email','data_nascimento','sexo','celnumero','telefonenumero'];

  public static function busca($busca)
  
  {
    return static::where('nome', 'LIKE', '%'.$busca.'%')->get();
  }
}
