<?php

namespace Modules\Assistencia\Entities;

use Illuminate\Database\Eloquent\Model;

class ClienteAssistenciaModel extends Model
{
  protected $table = 'cliente_assistencia';
  protected $fillable = ['id','nome','cpf','email','data_nascimento','sexo','celnumero','telefonenumero'];

  public static function busca($busca)
  {
    return static::where('nome', 'LIKE', '%'.$busca.'%')->get();
  }
}
