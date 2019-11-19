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
    // public function visitante(Usuario $usuario){
    //     return $usuario->papel->nome === "Visitante" ;
    // }
    // public function administrador(Usuario $usuario){
    //     return $usuario->papel->nome === "Administrador" ;
    // }

    // public function operador(Usuario $usuario){
    //     return $usuario->papel->nome === "Operador";
    
    // }
    

    
}
