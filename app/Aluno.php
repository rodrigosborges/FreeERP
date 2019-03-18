<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aluno extends Model{
    use SoftDeletes;

    protected $table = 'aluno';

    protected $fillable = ['nome', 'prontuario'];

    public function aulas(){
        return $this->belongsToMany('App\Aula', 'aluno_has_aula');
    }

    public function endereco(){
        return $this->hasOne('App\Endereco');
    }
}   