<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Telefone extends Model{

    protected $table = 'telefone';

    protected $fillable = ['numero'];

    public $timestamps = false;
}