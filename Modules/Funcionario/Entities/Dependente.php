<?php
namespace Modules\Funcionario\Entities;
use Illuminate\Database\Eloquent\Model;

class Dependente extends Model{
   
    protected $table = 'dependente';

    protected $fillable = ['nome', 'mora_junto', 'parentesco_id'];

    public $timestamps = false;

    public function parentesco(){
        return $this->belongsTo('Modules\Funcionario\Entities\Parentesco','parentesco_id');
    }
}