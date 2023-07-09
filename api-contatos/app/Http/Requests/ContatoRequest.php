<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ContatoRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {

        $valueValidation = 'required|sometimes|string';
        dd($this->tipo_id);

        if ($this->tipo_id == 3) {
            $valueValidation .= '|email';
        }

        return [
            'valor' => $valueValidation,
            'tipo_id' => 'required|sometimes|integer|exists:tipo,id',
            'pessoa_id' => 'required|sometimes|integer|exists:pessoas,id',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Ocorreram erros de validação',
            'data'      => $validator->errors()
        ]));
    }
}
