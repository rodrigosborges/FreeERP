<?php

namespace Modules\Assistencia\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConcertosRequest extends FormRequest
{

    public function rules()
    {
        return [
            'idCliente' => 'required'
        ];
    }


    public function authorize()
    {
        return true;
    }
}
