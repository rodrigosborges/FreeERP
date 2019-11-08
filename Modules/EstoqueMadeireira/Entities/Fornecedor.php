<?php

namespace Modules\EstoqueMadeireira\Entities;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Fornecedor extends Model
{
    use softDeletes;

    protected $table = 'fornecedor';
    protected $fillable = ['nome', 'endereco','telefone', 'email', 'nome', 'cnpj'];


}
