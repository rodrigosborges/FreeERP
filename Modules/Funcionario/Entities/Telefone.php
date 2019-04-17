<?php
namespace Modules\Funcionario\Entities;
use Illuminate\Database\Eloquent\Model;

class Telefone extends Model{

    protected $table = 'telefone';

    protected $fillable = ['numero'];

    public $timestamps = false;

    public function setNumeroAttribute($val){
        $val = str_replace('(', '', $val);
        $val = str_replace(')', '', $val);
        $val = str_replace('-', '', $val);
        $val = str_replace(' ', '', $val);
        $this->attributes['numero'] = $val;
    }

    public function getNumeroAttribute($val){
        $val = str_replace('(', '', $val);
        $val = str_replace(')', '', $val);
        $val = str_replace('-', '', $val);
        $val = str_replace(' ', '', $val);
        return $val;
    }
}