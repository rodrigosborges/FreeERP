<?php

namespace App\Http\Middleware;

use Closure;

class OnlyBefore19H{

    public function handle($request, Closure $next){
        if(date('H') >= 19){
            return redirect('/')->with('error', 'Você não pode acessar essa rota nesse horário');
        }
        return $next($request);
    }

}
