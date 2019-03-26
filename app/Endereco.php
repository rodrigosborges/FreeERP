<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model{

    protected $table = 'endereco';

    protected $fillable = ['logradouro', 'numero', 'bairro', 'cidade','uf','cep','complemento'];

    public $timestamps = false;

    public function funcionario(){
        return $this->belongsTo('App\Funcionario');
    }

    //limpar os dados futuramente
    public function setCepAttribute($val){
        $this->attributes['cep'] = $val;
    }
}   