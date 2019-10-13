<?php
namespace app\Entities;
use Illuminate\Database\Eloquent\Model;

class EstadoCivil extends Model{

    protected $table = 'estado_civil';

    protected $fillable = ['nome'];

    public $timestamps = false;
    
}   