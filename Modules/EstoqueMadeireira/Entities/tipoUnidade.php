<?php
namespace Modules\EstoqueMadeireira\Entities;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class tipoUnidade extends Model
{
    use SoftDeletes;
    protected $table = 'tipoUnidade';
    protected $fillable = ['nome'];

}