<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class SimulationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422)
        );
    }
    public function rules()
    {
        return [
            'valor' => 'required|numeric|min:0.01',
            'instituicoes' => 'nullable|array',
            'instituicoes.*' => 'string|in:PAN,OLE,BMG',
            'convenios' => 'nullable|array',
            'convenios.*' => 'string|in:INSS,FEDERAL,SIAPE',
            'parcela' => 'nullable|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'valor.required' => 'O campo valor é obrigatório.',
            'valor.numeric' => 'O campo valor deve ser um número.',
            'valor.min' => 'O valor deve ser maior que 0.',

            'instituicoes.array' => 'O campo instituições deve ser um array.',
            'instituicoes.*.string' => 'Cada institução deve ser uma string.',
            'instituicoes.*.in' => 'Instituição inválida, deve ser PAN, OLE ou BMG.',

            'convenios.array' => 'O campo convenios deve ser um array.',
            'convenios.*.string' => 'Cada convenio deve ser uma string.',
            'convenios.*.in' => 'Convenio invalida, deve ser INSS, FEDERAL ou SIAPE.',

            'parcela.integer' => 'O campo parcela deve ser um número inteiro.',
            'parcela.min' => 'O valor de parcela deve ser maior que 0.',
        ];
    }
}
