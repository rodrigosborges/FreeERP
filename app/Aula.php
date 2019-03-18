<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model{

    protected $table = 'aula';

    protected $fillable = ['nome', 'sigla', 'professor_id'];

    public $timestamps = false;

    public function alunos(){
        return $this->belongsToMany('App\Aluno', 'aluno_has_aula')->withTrashed();
    }

    public function professores(){
        return $this->belongsTo('App\Professor');
    }
}   