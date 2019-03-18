<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model{

    protected $table = 'professor';

    protected $fillable = ['nome'];

    public $timestamps = false;

    public function aulas(){
        return $this->hasMany('App\Aula');
    }
}   