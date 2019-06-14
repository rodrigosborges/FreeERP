<?php

namespace Modules\Assistencia\Entities;

use Illuminate\Database\Eloquent\Model;


class ConsertoAssistenciaModel extends Model
{
    protected $table = 'conserto_assistencia';

    protected $fillable = ['id','numeroOrdem', 'valor','situacao','data_entrada','modelo_aparelho','marca_aparelho','serial_aparelho','imei_aparelho','defeito','obs','idCliente','idTecnico','idPeca[]','idMaoObra[]','ativo'];

    public static function busca($busca){
      return static::where('id', 'LIKE', '%'.$busca.'%')->get();
    }
    public function cliente(){
        return $this->belongsTo('Modules\Assistencia\Entities\ClienteAssistenciaModel', 'idCliente');
    }
    public function tecnico(){
        return $this->belongsTo('Modules\Assistencia\Entities\TecnicoAssistenciaModel', 'idTecnico');
    }
    public function peca(){
        return $this->belongsTo('Modules\Assistencia\Entities\PecaAssistenciaModel', 'idPeca');
    }
    public function servico(){
        return $this->hasMany('Modules\Assistencia\Entities\ServicoAssistenciaModel', 'idMaoObra');
    }

}
