<?php

namespace Modules\Assistencia\Entities;

use Illuminate\Database\Eloquent\Model;

class item_servico extends Model
{
  protected $table = 'item_servico_assistencia';
  protected $fillable = ['id','idMaoObra','quantidade'];
}
