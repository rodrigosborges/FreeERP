<?php

namespace Modules\Cliente\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;
    
    protected $table = "cliente";    
    protected $fillable = ['nome','nome_fantasia', 'tipo_cliente_id','documento_id', 'endereco_id', 'email_id'];
    

    public function tipo(){
        return $this->belongsTo('Modules\Cliente\Entities\TipoCliente');
    }
    public function telefonesAll(){
        $numeros = '';
        foreach($this->telefones as $key => $telefone){
            $numeros .= ($key == 0 ? '' : ', ').$telefone['numero'];
        }
        return $numeros;
    }
    public function getDocumento(){
        $numero = $this->documento->numero;
        if($this->tipo_cliente_id == 1){
            $numero = substr($numero, 0, 3).'.'.substr($numero, 3, 3).'.'.substr($numero, 6, 3).'-'.substr($numero, 9, 2);
        } else {
            $numero = substr($numero,0,2).'.'.substr($numero,2,3).'.'.substr($numero,5,3).'/'.substr($numero,8,4).'-'.substr($numero,-2);
        }
        return $numero;
    }
    public function telefones(){
        return $this->belongsToMany('App\Entities\Telefone', 'cliente_has_telefone', 'cliente_id', 'telefone_id');
    }

    public function documento(){
        return $this->belongsTo('App\Entities\Documento');
    }

    public function email(){
        return $this->belongsTo('App\Entities\Email');
    }

    public function endereco(){
        return $this->belongsTo('App\Entities\Endereco');
    }

    public function pedidos(){
        return $this->hasMany('Modules\Cliente\Entities\Pedido');
    }

    

}
