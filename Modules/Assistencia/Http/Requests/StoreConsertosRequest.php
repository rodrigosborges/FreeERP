<?php

namespace Modules\Assistencia\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConsertosRequest extends FormRequest{

    public function rules()
    {
        return [
            'numeroOrdem' => 'required',
            'situacao' => 'required|max:100',
            'data_entrada' => 'required',
            'modelo_aparelho' => 'required|max:50',
            'marca_aparelho' => 'required|max:50',
            'serial_aparelho' => 'required|max:50',
            'imei_aparelho' => 'required|max:50',
            'defeito' => 'required|max:50',
            'obs' => 'required|max:250',
            'idCliente' => 'required',
            'idTecnico' => 'required'
        ];
    }
    public function messages(){
        return [
          'numeroOrdem.required' => 'A ordem de serviço não está numerada, contacte o suporte do sistema.',
          'situacao.required' => 'Marque a atual situação da ordem de serviço.',
          'data_entrada.required' => 'A ordem não possui uma data de alteração, contacte o suporte do sistema.',
          'modelo_aparelho.required' => 'Por favor, insira o modelo do aparelho. (ex.: SM-G530 - Branco)',
          'marca_aparelho.required' => 'Por favor, insira a marca do aparelho. (ex.: Samsung, Apple, etc...)',
          'serial_aparelho.required' => 'Insira o código serial do aparelho, caso não possa verificar, marque como "Ilegivel".',
          'imei_aparelho.required' => 'insira o código IMEI do aparelho, caso não possa verificar, marque como "Ilegivel".',
          'defeito.required' => 'Qual o defeito/problema do aparelho?',
          'obs.required' => 'Insira observações extras sobre o serviço.',
          'idCliente.required' => 'Por favor, escolha o cliente desta ordem de serviço.',
          'idTecnico.required' => 'Por favor, selecione o tecnico responsavel.'

        ];
    }

    public function authorize()
    {
        return true;
    }
}
