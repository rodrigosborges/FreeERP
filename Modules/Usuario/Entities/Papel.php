<?php

namespace Modules\Usuario\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Papel extends Model
{
    
    use SoftDeletes;

    protected $table = 'papel';
    protected $fillable = ['nome', 'permissoes'];


    public function temAcesso(array $permissoes){
        foreach($permissoes as $permissao){
            if($this->temPermissao()) return true;
        }
        return false;
    }

    protected function temPermissao(string $permissao){
        $permissoes = json_decode($this->permissoes, true);
        return $permissoes[$permissao] ?? false;
    }

}
