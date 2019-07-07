<?php
namespace Modules\Funcionario\Entities;
use Illuminate\Database\Eloquent\Model;

class Ponto extends Model{
    
    protected $table = 'ponto';

    protected $fillable = ['created_at', 'automatico', 'entrada'];

    public $timestamps = false;

    public function funcionario(){
        return $this->belongsTo('Modules\Funcionario\Entities\Funcionario', 'funcionario_id');
    }
    
}