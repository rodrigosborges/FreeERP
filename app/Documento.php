<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model{

    protected $table = 'documento';

    protected $fillable = ['tipo', 'numero'];

    public $timestamps = false;
}   