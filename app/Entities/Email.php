<?php
namespace app\Entities;
use Illuminate\Database\Eloquent\Model;

class Email extends Model{

    protected $table = 'email';

    protected $fillable = ['email'];

    public $timestamps = false;
    
}   