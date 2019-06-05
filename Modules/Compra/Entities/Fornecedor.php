<?php

namespace Modules\Compra\Entities;

use App\Entities\{Relacao};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Fornecedor extends Model
{
    Use SoftDeletes;
    protected $table = 'fornecedor';
    public $timestamps = true;
    protected $fillable = array('id','nome');


    //Relação com a tabela Orcamento
    public function orcamentos(){
        return $this->hasMany('Modules\Compra\Entities\Orcamento');
    }

    //Relação com tabela endereço

    public function enderecoRelacao(){
        return $this->hasOne('App\Entities\Relacao', 'origem_id')
            ->where('tabela_origem','fornecedor')
            ->where('tabela_destino','endereco');
    }
    public function endereco(){
        return $this->enderecoRelacao->dados();
    }

    
    //Relação com tabela Telefone
    public function telefoneRelacao(){
        return $this->hasOne('App\Entities\Relacao', 'origem_id')
            ->where('tabela_origem','fornecedor')
            ->where('tabela_destino','telefone');
    }
    public function telefone(){
        return $this->telefoneRelacao->dados();
    }

    //Relação com tabela Email
    public function emailRelacao(){
        return $this->hasOne('App\Entities\Relacao', 'origem_id')
            ->where('tabela_origem','fornecedor')
            ->where('tabela_destino','email');
    }
    public function email(){
        return $this->emailRelacao->dados();
    }




}
