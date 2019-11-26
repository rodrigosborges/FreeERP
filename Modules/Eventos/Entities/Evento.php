<?php

namespace Modules\Eventos\Entities;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $fillable = ['nome','local','dataInicio','dataFim','descricao','imagem','empresa','email','telefone']; //ATRIBUTOS QUE PODEM SER EDITADOS
    protected $guarded = ['id']; //ATRIBUTOS QUE NÃO PODEM SER EDITADOS
    protected $table = 'evento'; //TABELA COM NOME DIVERGENTE DO DEFAULT
    public $timestamps = false; //NÃO VOU UTILIZAR TIMESTAMPS
    
    public function pessoas()
    {
        return $this->belongsToMany(Pessoa::class, 'evento_has_pessoa', 'evento_id', 'pessoa_id');
    }
    
    public function programacao()
    {
        return $this->hasMany(Programacao::class)->orderBy('data', 'asc', 'horario', 'asc');
    }
    
    public function permissoes(){
        return $this->hasMany(Permissao::class);
    }
    
    public function cidade(){
        return $this->belongsTo(Cidade::class);
    }
    
    //RETORNA TODOS OS PARTICIPANTES DE UM EVENTO
    public function participantes()
    {
        $programacao = $this->programacao()->get();
        foreach($programacao as $atividade){
            $participantes[] = $atividade->participantes;
        }
        return $participantes;
    }
    
    public function certificado(){
        return $this->hasOne(Certificado::class);
    }
    
    //RETORNA TRUE SE NÃO TIVER MAIS VAGAS DISPONÍVEIS
    public function vagas()
    {
        $programacao = $this->programacao()->get();
        $vagas = [];
        foreach($programacao as $atividade){
            $vagas[] = $atividade->vagas - count($atividade->participantes);
        }
        if(count(array_unique($vagas)) == 1 && array_unique($vagas)[0] == 0){
            return true;
        } else {
            return false;
        }
    }
}


