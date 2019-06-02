<?php

namespace Modules\Assistencia\Entities;

use Illuminate\Database\Eloquent\Model;

class item_peca extends Model
{
    protected $table = 'item_peca_assistencia';
    protected $fillable = ['id','idPeca','quantidade'];
}
