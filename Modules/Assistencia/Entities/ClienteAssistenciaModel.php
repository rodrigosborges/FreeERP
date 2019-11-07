<?php

namespace Modules\Assistencia\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClienteAssistenciaModel extends Model
{
  use SoftDeletes;
  protected $table = 'cliente_assistencia';
  protected $fillable = ['id','nome','cpf','email','data_nascimento','celnumero','telefonenumero', 'endereco_id'];

  public function endereco(){
    return $this->belongsTo('App\Entities\Endereco');
  }
  // public static function busca($busca){ //busca para localização de cliente por nome, cpf ou telefone
  //   return static::where('nome', 'LIKE', '%'.$busca.'%')
  //                 ->orWhere('cpf', 'LIKE', '%'.$busca.'%')
  //                 ->orWhere('telefonenumero', 'LIKE', '%'.$busca.'%');
  // }

  // public static function buscaTrash($busca){ //busca para localização de cliente por nome, cpf ou telefone
  //   return static::onlyTrashed()->where('nome', 'LIKE', '%'.$busca.'%')
  //                 ->orWhere('cpf', 'LIKE', '%'.$busca.'%')
  //                 ->orWhere('telefonenumero', 'LIKE', '%'.$busca.'%');
  // }
  
  public static function buscaCPF($busca){ //essa busca serve para a validação do cadastro

    return static::where('cpf', 'LIKE', '%'.$busca.'%')->paginate(10);
  }

}
