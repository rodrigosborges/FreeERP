<?php
namespace app\Entities;
use Illuminate\Database\Eloquent\Model;

class Telefone extends Model{

    protected $table = 'telefone';

    protected $fillable = ['numero', 'tipo_id'];

    public $timestamps = false;
    
}   