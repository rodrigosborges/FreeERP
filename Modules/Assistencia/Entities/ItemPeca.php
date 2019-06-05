<?php

namespace Modules\Assistencia\Entities;

use Illuminate\Database\Eloquent\Model;

class ItemPeca extends Model
{
    protected $table = 'item_peca_assistencia';
    protected $fillable = ['id','idConserto','idPeca'];
}
