<?php
namespace Modules\EstoqueMadeireira\Entities;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class tipoUnidade extends Model
{
    use SoftDeletes;
    protected $table = 'tipoUnidade';
    protected $fillable = ['nome','quantidade_itens'];
   
   
   
   public function estoque()
    {
        return $this->belongsTo('Modules\Estoque\Entities\Estoque')->withTrashed();
    }

    
}