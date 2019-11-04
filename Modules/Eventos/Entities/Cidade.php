<?php
namespace Modules\Eventos\Entities;
use Illuminate\Database\Eloquent\Model;

class Cidade extends Model{

    protected $table = 'cidade';

    protected $fillable = ['nome'];

    public $timestamps = false;

    public function estado(){
        return $this->belongsTo(Estado::class);
    }
    
    public function evento(){
        return $this->hasOne(Evento::class);
    }
}   