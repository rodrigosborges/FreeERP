<?php

namespace Modules\Assistencia\Entities;

use Illuminate\Database\Eloquent\Model;

class Peca extends Model
{
  protected $table = 'peca';
  protected $fillable = ['id','nome','valor'];

  public static function busca($busca)
  {
    return static::where('nome', 'LIKE', '%'.$busca.'%')->get();
  }
}
