<?php

namespace Modules\OrdemServico\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tecnico extends Model
{
    use SoftDeletes;
    protected $table = 'tecnico';
    public $timestamps = false;
    protected $fillable = ['nome','cpf','rg','email','comissao'];

    //Relação com tabela ordem_servico
    public function os(){
        return $this->belongsTo('App\OrdemServico\OrdemServico');
    }
}
