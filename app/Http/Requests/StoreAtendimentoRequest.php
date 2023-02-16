<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Cpf;

class StoreAtendimentoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nome' => ['required','max:128'],
            'areas' => ['required'],
            'data_hora' => ['date_format:d/m/Y', 'before_or_equal:today'],
            'telefone_principal' => ['nullable','min:13','max:14'],
            'cpf' => ['required'],
        ];
    }

    public function attributes()
    {
        return [
            'nome' => 'Nome completo',
            'areas' => 'Áreas de atendimento',
            'data_hora' => 'Data do atendimento',
            'telefone_principal' => 'Telefone',
            'cpf' => 'CPF'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute deve ser informado.',    
            'date_format' => ':attribute inválida.',        
            'before_or_equal' => ':attribute não pode ser maior que hoje.',
            'telefone_principal.min' => ':attribute inválido.',
            'telefone_principal.max' => ':attribute inválido.',
        ];
    }
}
