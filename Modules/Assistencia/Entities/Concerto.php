<?php

namespace Modules\Assistencia\Entities;

use Illuminate\Database\Eloquent\Model;


class concerto extends Model
{
    protected $table = 'concerto';

    protected $fillable = ['id','modelo_aparelho','marca_aparelho','serial_aparelho','imei_aparelho','defeito','obs','cliente_id','peca_id','servico_id'];

    public static function busca($busca)
    {
      return static::where('id', 'LIKE', '%'.$busca.'%')->get();
    }

    public static function max(){

      return static::where('id')->max('id');
    }

    public function cliente(){
        return $this->belongsTo('Modules\Assistencia\Entities\Cliente');
    }
    public function peca(){
        return $this->belongsTo('Modules\Assistencia\Entities\Peca');
    }
    public function servico(){
        return $this->hasMany('Modules\Assistencia\Entities\Servico');
    }


}
