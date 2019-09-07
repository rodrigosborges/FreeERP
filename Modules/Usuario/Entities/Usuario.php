<?php

namespace Modules\Usuario\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable{

    use Notifiable;
    
    use SoftDeletes;

    protected $table = 'usuario';
    protected $fillable = ['apelido', 'avatar', 'email', 'papel_id', 'password'];


    public function papel(){
        return $this->hasOne('Modules\Usuario\Entities\Papel');
    }
}
