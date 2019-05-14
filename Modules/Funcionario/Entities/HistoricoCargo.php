<?php
namespace Modules\Funcionario\Entities;
use Illuminate\Database\Eloquent\Model;

class HistoricoCargo extends Model{
  
    protected $table = 'historico_cargo';

    protected $fillable = ['funcionario_id', 'cargo_id', 'data_entrada', 'data_saida'];

    public $timestamps = false;

    public function cargo() {
        return $this->belongsTo('Modules\Funcionario\Entities\Cargo');
    }

    public function getDataEntradaAttribute($val){
        return implode('/', array_reverse(explode('-', $val))) ? : '';
    }

    public function getDataSaidaAttribute($val){
        return implode('-', array_reverse(explode('-', $val))) ? : '';
    }

    public function setDataEntradaAttribute($val){
        $this->attributes['data_entrada'] = implode('-', array_reverse(explode('/', $val))) ? : '';
    }

    public function setDataSaidaAttribute($val){
        $this->attributes['data_saida'] = implode('-', array_reverse(explode('/', $val))) ? : '';
    }
}