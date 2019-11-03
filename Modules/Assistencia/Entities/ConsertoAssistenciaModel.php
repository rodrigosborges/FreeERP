<?php

namespace Modules\Assistencia\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ConsertoAssistenciaModel extends Model
{
    use SoftDeletes;
    protected $table = 'conserto_assistencia';

    protected $fillable = ['id','numeroOrdem', 'valor','sinal','situacao','data_entrada','modelo_aparelho','marca_aparelho','serial_aparelho','imei_aparelho','defeito','obs','idCliente','idTecnico','idPeca[]','idMaoObra[]'];

    public static function busca($busca){
      return static::where('id', 'LIKE', '%'.$busca.'%')
                    /*->orWhere() //pesquisa por cliente
                    ->orWhere() //por modelo do aparelho
                    ->orWhere() //por 
                    ->orWhere()*/->paginate(10);
    }
    public function cliente(){
        return $this->belongsTo('Modules\Assistencia\Entities\ClienteAssistenciaModel', 'idCliente')->withTrashed();
    }
    public function tecnico(){
        return $this->belongsTo('Modules\Assistencia\Entities\TecnicoAssistenciaModel', 'idTecnico')->withTrashed();
    }
    public function peca(){
        return $this->belongsTo('Modules\Assistencia\Entities\PecaAssistenciaModel', 'idPeca')->withTrashed();
    }
    public function servico(){
        return $this->hasMany('Modules\Assistencia\Entities\ServicoAssistenciaModel', 'idMaoObra')->withTrashed();
    }

}
