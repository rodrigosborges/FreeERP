<?php

namespace Modules\Usuario\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Usuario\Entities\{Usuario};

class UsuarioPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function create(Usuario $usuario){
        return $usuario->papel->nome === "Administrador";
    }

    
}
