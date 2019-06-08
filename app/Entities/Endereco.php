<?php
namespace app\Entities;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model{

    protected $table = 'endereco';

    protected $fillable = ['logradouro', 'numero', 'bairro', 'cidade_id','cep','complemento'];

    public $timestamps = false;

    public function cidade(){
        return $this->belongsTo('app\Entities\Cidade','cidade_id');
    }
    
}   