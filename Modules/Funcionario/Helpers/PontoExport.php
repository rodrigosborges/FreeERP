<?php

namespace Modules\Funcionario\Helpers;
use App\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Modules\Funcionario\Entities\{Funcionario,Ponto};
use DB;

class PontoExport implements FromView
{
    use Exportable;

    public function __construct($data){
        $this->data = $data;
    }

    public function view(): View
    {
        return view('funcionario::frequencia.xls', [
            'data' => $this->data
        ]);
    }
}