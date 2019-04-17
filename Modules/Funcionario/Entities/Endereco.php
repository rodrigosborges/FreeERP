<?php
namespace Modules\Funcionario\Entities;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model{

    protected $table = 'endereco';

    protected $fillable = ['logradouro', 'numero', 'bairro', 'cidade','uf','cep','complemento'];

    public $timestamps = false;

    public function funcionario(){
        return $this->belongsTo('Modules\Funcionario\Entities\Funcionario');
    }

    //limpar os dados futuramente
    public function setCepAttribute($val){
        $this->attributes['cep'] = str_replace('-', '', $val);
    }

    public function getCepAttribute($val){
        return str_replace('-', '', $val);
    }
    
}   