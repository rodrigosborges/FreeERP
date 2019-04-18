<?php

namespace Modules\OrdemServico\Entities;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Solicitante extends Model
{
    use SoftDeletes;

    protected $table = 'solicitante';

    protected $fillable = ['nome'];
}
