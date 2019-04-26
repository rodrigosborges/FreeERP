<?php

namespace Modules\ControleUsuario\Entities;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use\Illuminate\Database\Eloquent\SoftDeletes;

class Usuario extends Authenticatable
{
    use Notifiable;
    protected $table='usuario';
    protected $fillable = ['foto', 'name', 'email', 'password'];


    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function atuacoes()
    {
        return $this-> hasMany('Modules\controleUsuario\Entities\Atuacao');
    }


    
}

