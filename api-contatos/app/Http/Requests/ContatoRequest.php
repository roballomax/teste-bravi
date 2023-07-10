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
        $validation = [
            'valor'     => ['required', 'string'],
            'tipo_id'   => ['required', 'integer', 'exists:tipo,id'],
            'pessoa_id' => ['required', 'integer', 'exists:pessoas,id'],
        ];

        switch($this->tipo_id) {
            case 1: $validation['valor'][] = "regex:/^(?:(?:\(?[1-9][0-9]\)?)?\s?)?(?:((?:9\d|[2-9])\d{3})-?(\d{4}))$/"; break;
            case 2: $validation['valor'][] = "regex:/^\([1-9]{2}\) [9]{0,1}[6-9]{1}[0-9]{3}\-[0-9]{4}$/"; break;
            case 3: $validation['valor'][] = "email"; break;
        }

        if ($this->isMethod('PUT')) {
            $validation['valor'][]      = 'sometimes';
            $validation['tipo_id'][]    = 'sometimes';
            $validation['pessoa_id'][]  = 'sometimes';
        }

        return $validation;
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message'   => 'Ocorreram erros de validação',
            'data'      => $validator->errors()
        ])->setStatusCode(400));
    }
}
