<?php
namespace Modules\Funcionario\Entities;
use Illuminate\Database\Eloquent\Model;

class Log extends Model{
    
    protected $table = 'log';

    protected $fillable = ['mensagem', 'created_at'];

    public $timestamps = false;

}