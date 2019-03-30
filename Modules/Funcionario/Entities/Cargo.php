<?php
namespace Modules\Funcionario\Entities;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model{

    protected $table = 'cargo';

    protected $fillable = ['nome', 'horas_semanais', 'salario'];

    public $timestamps = false;

    public function funcionarios(){
        return $this->hasMany('Modules\Funcionario\Entities\Funcionario');
    }
    
    public function setSalarioAttribute($val){
        $procurar = array('.', ',');
        $trocar = array('', '.');
        $this->attributes['salario'] = str_replace($procurar, $trocar, $val);
    }

    public function getSalarioAttribute($val){
        return number_format($val,2,",",".");
    }
}