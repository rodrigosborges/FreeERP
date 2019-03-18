<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model{

    protected $table = 'endereco';

    protected $fillable = ['rua', 'numero', 'bairro'];

    public $timestamps = false;

    public function aluno(){
        return $this->belongsTo('App\Aluno');
    }
}   