<?php

namespace Modules\Assistencia\Entities;

use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
  protected $table = 'servico';
  protected $fillable = ['id','nome','valor'];

  public static function busca($busca)
  {
    return static::where('nome', 'LIKE', '%'.$busca.'%')->get();
  }
}
