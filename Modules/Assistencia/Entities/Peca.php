<?php

namespace Modules\Assistencia\Entities;

use Illuminate\Database\Eloquent\Model;

class peca extends Model
{
  protected $table = 'peca';
  protected $fillable = ['id','nome','valor'];
}
