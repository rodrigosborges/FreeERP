<?php
namespace Modules\Funcionario\Entities;
use Illuminate\Database\Eloquent\Model;

class Telefone extends Model{

    protected $table = 'telefone';

    protected $fillable = ['numero'];

    public $timestamps = false;
}