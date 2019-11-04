<?php

namespace Modules\Eventos\Entities;

use Illuminate\Database\Eloquent\Model;

class Palestrante extends Model
{
    protected $fillable = ['nome','bio','foto']; //ATRIBUTOS QUE PODEM SER EDITADOS
    protected $guarded = ['id']; //ATRIBUTOS QUE NÃO PODEM SER EDITADOS
    protected $table = 'palestrante'; //TABELA COM NOME DIVERGENTE DO DEFAULT
    public $timestamps = false; //NÃO VOU UTILIZAR TIMESTAMPS
    
    public function programacao()
    {
        return $this->hasOne(Programacao::class);
    }
}
