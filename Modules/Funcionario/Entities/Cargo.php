<?php
namespace Modules\Funcionario\Entities;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model{

    protected $table = 'cargo';

    protected $fillable = ['nome', 'horas_semanais', 'salario'];

    public $timestamps = false;
}