<?php

namespace Modules\Eventos\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalvaAtividade extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => 'required',
            'tipo' => 'required',
            'descricao' => 'nullable',
            'data' => 'required|date',
            'horario' => 'required',
            'duracao' => 'required',
            'local' => 'required',
            'vagas' => 'required|integer',
            'fotoPalestrante' => 'nullable|image|dimensions:ratio=0/0',
            'nome' => 'required|min:2',
            'bio' => 'nullable',
        ];
    }
    
    public function messages() 
    {   
        return [     
            'required' => 'O campo :attribute é obrigatório',
            'fotoPalestrante.dimensions' => 'A imagem deve ser quadrada!'
        ]; 
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}