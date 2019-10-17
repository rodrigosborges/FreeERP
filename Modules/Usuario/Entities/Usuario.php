<?php

namespace Modules\Usuario\Entities;

use Modules\Usuario\Entities\Modulo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable{

    use Notifiable;
    
    use SoftDeletes;

    protected $table = 'usuario';
    protected $fillable = ['apelido', 'avatar', 'email', 'password'];

    public function modulos(){
        return $this->belongsToMany('Modules\Usuario\Entities\Modulo', 'usuario_has_modulo')
                    ->withPivot('papel');
    }

}
