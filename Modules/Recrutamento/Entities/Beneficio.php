<?php

namespace Modules\Recrutamento\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Beneficio extends Model
{
    use SoftDeletes;
    protected $table = 'beneficio';
    public $timestamps = true;
    protected $fillable = array('id','nome');
}
