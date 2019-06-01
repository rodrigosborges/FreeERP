<?php

namespace Modules\Assistencia\Entities;

use Illuminate\Database\Eloquent\Model;


class ConsertoAssistenciaModel extends Model
{
    protected $table = 'conserto_assistencia';

    protected $fillable = ['id','numero', 'valor','situacao','data_entrada','modelo_aparelho','marca_aparelho','serial_aparelho','imei_aparelho','defeito','obs','idCliente','idTecnico','idPeca[]','idMaoObra[]'];

    public static function busca($busca)
    {
      return static::where('id', 'LIKE', '%'.$busca.'%')->get();
    }

    public static function max(){

      return static::where('id')->max('id');
    }

    public function cliente(){
        return $this->belongsTo('Modules\Assistencia\Entities\ClienteAssistenciaModel', 'idCliente');
    }
    public function peca(){
        return $this->belongsTo('Modules\Assistencia\Entities\PecaAssistenciaModel', 'idPeca');
    }
    public function servico(){
        return $this->hasMany('Modules\Assistencia\Entities\ServicoAssistenciaModel', 'idMaoObra');
    }
    public function tecnico(){
        return $this->hasMany('Modules\Assistencia\Entities\TecnicoAssistenciaModel', 'idTecnico');
    }

}
