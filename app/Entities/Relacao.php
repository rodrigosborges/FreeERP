<?php
namespace app\Entities;
use Illuminate\Database\Eloquent\Model;

class Relacao extends Model{

    protected $table = 'relacao';

    protected $fillable = ['tabela_origem', 'origem_id', 'tabela_destino', 'destino_id', 'modelo'];

    public $timestamps = false;

    public function dados(){
        return $this->belongsTo("App\Entities\\$this->modelo", 'destino_id');
    }

}