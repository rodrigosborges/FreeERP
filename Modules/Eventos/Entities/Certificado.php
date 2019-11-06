<?php

namespace Modules\Eventos\Entities;

use Illuminate\Database\Eloquent\Model;

class Certificado extends Model
{
    protected $table = 'certificado';
    protected $fillable = ['certificado'];
    
    public function pessoa(){
        return $this->belongsTo(Pessoa::class);
    }
    
    public function evento(){
        return $this->belongsTo(Evento::class);
    }
}