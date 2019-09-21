<?php

use Illuminate\Database\Eloquent\SoftDeletes;
namespace Modules\Recrutamento\Entities;
use Modules\Recrutamento\Entities\{Categoria};
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use SoftDeletes;
    protected $table = 'cargo';
    public $timestamps = true;
    protected $fillable = array('id','nome','categoria_id');

    public function categoria(){
        return $this->HasOne('Modules\Recrutamento\Entities\Categoria','categoria_id');
    }
}
