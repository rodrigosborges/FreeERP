<?php
use Illuminate\Database\Eloquent\SoftDeletes;
namespace Modules\Recrutamento\Entities;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use SoftDeletes;
    protected $table = 'categoria';
    public $timestamps = true;
    protected $fillable = array('id','nome');
}
