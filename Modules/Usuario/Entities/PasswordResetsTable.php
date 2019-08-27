<?php

namespace Modules\Usuario\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Criei essa classe seguindo a resposta escolhida em:
 * https://stackoverflow.com/questions/53257296/creating-users-table-in-laravel/53257395
*/

class PasswordResetsTable extends Model
{
    protected $fillable = ['email', 'token'];
}
