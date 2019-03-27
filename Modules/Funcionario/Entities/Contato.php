<?php
namespace Modules\Funcionario\Entities;
use Illuminate\Database\Eloquent\Model;

class Contato extends Model{

    protected $table = 'contato';

    protected $fillable = ['email'];

    public $timestamps = false;

    public function telefones(){
        return $this->hasMany('App\Telefone');
    }
}   