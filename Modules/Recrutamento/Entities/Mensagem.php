<?php

namespace Modules\Recrutamento\Entities;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Recrutamento\Entities\{Candidato};
use Illuminate\Database\Eloquent\Model;

class Mensagem extends Model
{
    use SoftDeletes;
    protected $table = 'mensagem';
    public $timestamps = true;
    protected $fillable = array('id','candidato_id','mensagem');

    public function candidato(){
        return $this->belongsTo('Modules\Recrutamento\Entities\Candidato','candidato_id');
    }

}
