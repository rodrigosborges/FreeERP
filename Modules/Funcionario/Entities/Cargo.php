<?php
namespace Modules\Funcionario\Entities;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cargo extends Model{
    use SoftDeletes;
    
    protected $table = 'cargo';

    protected $fillable = ['nome', 'horas_semanais', 'salario'];

    public $timestamps = false;

    public function funcionarios(){
        return $this->belongsToMany('Modules\Funcionario\Entities\Funcionario', 'historico_cargo');
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