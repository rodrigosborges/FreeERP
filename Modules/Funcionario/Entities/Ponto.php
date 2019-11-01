<?php
namespace Modules\Funcionario\Entities;
use Illuminate\Database\Eloquent\Model;

class Ponto extends Model{
    
    protected $table = 'ponto';

    protected $fillable = ['entrada', 'saida', 'automatico'];

    public $timestamps = false;

    public function funcionario(){
        return $this->belongsTo('Modules\Funcionario\Entities\Funcionario', 'funcionario_id');
    }

    public function get_day(){
        return date('d', strtotime($this->attributes['entrada']));
    }
    
    public function get_time_entrada(){
        return date('H:i:s', strtotime($this->attributes['entrada']));
    }

    public function get_time_saida(){
        return $this->attributes['saida'] ? date('H:i:s', strtotime($this->attributes['saida'])) : "N/A";
    }

    public function time_worked(){
        if($this->attributes['saida'] == null)
            return "00:00:00";

        $date1 = strtotime($this->attributes['entrada']);
        $date2 = strtotime($this->attributes['saida']);
        $diff = $date2 - $date1;
        $hours = intVal($diff / ( 60 * 60 ));
        $hours = $hours < 10 ? "0$hours" : $hours;
        $diff = $diff % (60*60);
        $minutes = intVal($diff / ( 60 ));
        $minutes = $minutes < 10 ? "0$minutes" : $minutes;
        $seconds = $diff % (60);
        $seconds = $seconds < 10 ? "0$seconds" : $seconds;
        return "$hours:$minutes:$seconds";
    }

    public function formated_entrada(){
        return date("d/m/Y H:i:s", strtotime($this->attributes["entrada"]));
    }

    public function formated_saida(){
        return date("d/m/Y H:i:s", strtotime($this->attributes["saida"]));
    }
    
}