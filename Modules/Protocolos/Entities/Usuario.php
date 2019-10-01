<?php

namespace Modules\Protocolos\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use Notifiable;
    
    use SoftDeletes;

    protected $table = 'usuario';

    protected $fillable = ['nome','apelido', 'email', 'setor_id', 'password'];

    public function setor(){
        return $this->belongsTo('Modules\Protocolos\Entities\Setor');
    }
}

