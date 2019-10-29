<?php

namespace Modules\Protocolos\Entities;

use Illuminate\Database\Eloquent\Model;

class Apensado extends Model
{
    protected $table = 'protocolo_has_apensado';

    protected $fillable = ['protocolo_id', 'apensado_id'];
    
    
 
}
