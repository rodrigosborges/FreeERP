<?php

namespace Modules\Eventos\Entities;

use Illuminate\Database\Eloquent\Model;

class Programacao extends Model
{
    protected $fillable = ['nome','tipo','descricao','data','horario','duracao','local','vagas']; //ATRIBUTOS QUE PODEM SER EDITADOS
    protected $guarded = ['id']; //ATRIBUTOS QUE NÃO PODEM SER EDITADOS
    protected $table = 'programacao'; //TABELA COM NOME DIVERGENTE DO DEFAULT
    public $timestamps = false; //NÃO VOU UTILIZAR TIMESTAMPS
    
    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }
    
    public function palestrante()
    {
        return $this->belongsTo(Palestrante::class);
    }
    
    public function participantes()
    {
        return $this->belongsToMany(Pessoa::class, 'evento_has_participante');
    }
}
