<?php
namespace app\Entities;
use Illuminate\Database\Eloquent\Model;

class TipoTelefone extends Model{

    protected $table = 'tipo_telefone';

    protected $fillable = ['nome'];

    public $timestamps = false;
    
}   