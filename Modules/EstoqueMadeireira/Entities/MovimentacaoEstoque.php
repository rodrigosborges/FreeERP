<?php
namespace Modules\EstoqueMadeireira\Entities;
use Illuminate\Database\Eloquent\Model;




class MovimentacaoEstoque extends Model
{
    
    protected $fillable = ['quantidade','observacao','estoque_id','preco_custo', 'created_at'];
    protected $table ='movimentacao_estoque';
   
   
   
   
    public function estoque(){
        return $this->belongsTo('Modules\EstoqueMadeireira\Entities\Estoque')->withTrashed();
    }
}