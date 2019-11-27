<?php
namespace app\Entities;
use Illuminate\Database\Eloquent\Model;

class Email extends Model{

    protected $table = 'email';

    protected $fillable = ['email','id'];

    public $timestamps = false;
    
    public function funcionario(){
        return $this->hasOne('Modules/Entities/Funcionario');
    }
}   