<?php
namespace Modules\Funcionario\Entities;
use Illuminate\Database\Eloquent\Model;

class Ponto extends Model{
    
    protected $table = 'ponto';

    protected $fillable = ['created_at', 'automatico', 'entrada'];

    public $timestamps = false;

    public function funcionario(){
        return $this->belongsTo('Modules\Funcionario\Entities\Funcionario', 'funcionario_id');
    }

    public function get_day(){
        return date('d', strtotime($this->attributes['created_at']));
    }
    
    public function get_time(){
        return date('H:i:s', strtotime($this->attributes['created_at']));
    }

    public function timeTo($next){
        $date1 = strtotime($this->attributes['created_at']);
        $date2 = strtotime($next->created_at);
        $diff = $date2 - $date1;
        $hours = $diff / ( 60 * 60 );
        $hours = $hours < 10 ? "0$hours" : $hours;
        $diff = $diff % (60*60);
        $minutes = $diff / ( 60 );
        $minutes = $minutes < 10 ? "0$minutes" : $minutes;
        $seconds = $diff % (60);
        $seconds = $seconds < 10 ? "0$seconds" : $seconds;
        return "$hours:$minutes:$seconds";
    }

    public function formated_date(){
        return date("d/m/Y H:i:s", strtotime($this->attributes["created_at"]));
    }
    
}