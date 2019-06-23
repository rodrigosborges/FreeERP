<?php
namespace Modules\Funcionario\Entities;
use Illuminate\Database\Eloquent\Model;

class Parentesco extends Model{
   
    protected $table = 'parentesco';

    protected $fillable = ['nome'];

    public $timestamps = false;
}