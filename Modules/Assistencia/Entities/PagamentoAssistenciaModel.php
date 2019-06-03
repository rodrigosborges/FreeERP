<?php

namespace Modules\Assistencia\Entities;

use Illuminate\Database\Eloquent\Model;

class PagamentoAssistenciaModel extends Model
{
    protected $table = 'pagamento_assistencia';
    protected $fillable = ['id','idConserto','desconto','valor', 'status']; //mudar adiantamento para tabela conserto

}
