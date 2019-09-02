<?php

namespace Modules\Protocolos\Entities;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Interessado extends Model
{
    use SoftDeletes;

    public $timestamps = true;

    protected $table = 'interessado';

    protected $fillable = ['nome'];
}
