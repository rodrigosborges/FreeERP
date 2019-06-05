<?php

namespace Modules\Assistencia\Entities;

use Illuminate\Database\Eloquent\Model;

class ItemServico extends Model
{
  protected $table = 'item_servico_assistencia';
  protected $fillable = ['id','idConserto','idMaoObra'];
}
