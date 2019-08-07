<?php
namespace app\Entities;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model{

    protected $table = 'documento';

    protected $fillable = ['numero','comprovante','tipo_documento_id'];

    public $timestamps = false;

    public function tipo_documento(){
        return $this->belongsTo('App\Entities\TipoDocumento','tipo_documento_id');
    }
    
}   