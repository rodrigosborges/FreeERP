<?php
namespace app\Entities;
use Illuminate\Database\Eloquent\Model;

class Exemplo extends Model{

    //caso seja 1 pra 1
    public function enderecoRelacao(){
        return $this->hasOne('App\Entities\Relacao', 'origem_id')
            ->where('tabela_origem','exemplo')
            ->where('tabela_destino','endereco');
    }

    public function endereco(){
        return $this->enderecoRelacao->dados();
    }

    //caso seja 1 pra n
    // public function enderecoRelacao(){
    //     return $this->hasMany('App\Entities\Relacao', 'origem_id')
    //         ->where('tabela_origem','exemplo')
    //         ->where('tabela_destino','endereco');
    // }

    // public function endereco(){
    //     $dados = [];
    //     foreach($this->enderecoRelacao as $relacao){
    //         $dados[] = $relacao->dados;
    //     }
    //     return $dados;
    // }

}