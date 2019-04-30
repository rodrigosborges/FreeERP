<?php
namespace Modules\Funcionario\Entities;
use Illuminate\Database\Eloquent\Model;

class HistoricoCargos extends Model{
  
    protected $table = 'historico_cargos';

    protected $fillable = ['funcionario_id', 'cargo_id', 'data_entrada', 'data_saida'];

    public $timestamps = false;

    public function setDataEntradaAttribute($val){
        $this->attributes['data_entrada'] = implode('-', array_reverse(explode('/', $val))) ? : '';
    }

    public function setDataSaidaAttribute($val){
        $this->attributes['data_saida'] = implode('-', array_reverse(explode('/', $val))) ? : '';
    }
}