<?php

namespace Modules\Assistencia\Entities;

use Illuminate\Database\Eloquent\Model;

class PecaOS extends Model
{
    protected $table = 'peca_os_assistencia';
    protected $fillable = ['id','idConserto','idItemPeca'];
    
    public function itemPeca(){
        return $this->belongsTo('Modules\Assistencia\Entities\ItemPeca', 'idItemPeca');
    }
}
    