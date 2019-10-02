<?php

namespace Modules\Usuario\Entities;

use Modules\Usuario\Entities\Papel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable{

    use Notifiable;
    
    use SoftDeletes;

    protected $table = 'usuario';
    protected $fillable = ['apelido', 'avatar', 'email', 'password','papel_id'];

    public function papel(){
        return $this->belongsTo('Modules\Usuario\Entities\Papel');
    }

    public function temAcesso(array $permissoes){
        $papel = Papel::find($this->papel);
        if($papel->temAcesso($permissoes)){
            return true;
        }
        return false;
    }
}
