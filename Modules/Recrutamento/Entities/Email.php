<?php

namespace Modules\Recrutamento\Entities;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use SoftDeletes;
    protected $table = 'email_mensagem';
    public $timestamps = true;
    protected $fillable = array('id','email');
}
