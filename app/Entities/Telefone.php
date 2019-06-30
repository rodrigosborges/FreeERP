<?php
namespace app\Entities;
use Illuminate\Database\Eloquent\Model;

class Telefone extends Model{

    protected $table = 'telefone';

    protected $fillable = ['numero', 'tipo_telefone_id'];

    public $timestamps = false;

    public function setNumeroAttribute($val) {
        $val = str_replace('-', '', $val);
        $val = str_replace('(', '', $val);
        $val = str_replace(')', '', $val);
        $val = str_replace(' ', '', $val);
        $this->attributes['numero'] = $val;
    }
    
    public function getNumeroAttribute($val) {
        return $val ? Self::formataTelefone($val) : $val;
    }

    function formataTelefone($number){
        $number="(".substr($number,0,2).") ".substr($number,2,-4)."-".substr($number,-4);
        return $number;
    }
    
}   