<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{

    /**
     * Rules for validation
     *
     * @var array|string[]
     */
    protected array $rules = [
        'name' => 'required|string',
        'email' => 'required|email',
        'age' => 'required|numeric|min:18',
        'street' => 'required|string',
        'location' => 'required|string',
        'number' => 'required|numeric',
        'postal_code' => 'required|string',
        'city' => 'required|string',
        'state' => 'required|string',
        'uf' => 'required|string',
    ];

    /**
     * Errors messages for validation
     *
     * @var array|string[]
     */
    protected array $errorMessages = [
        'name.required' => 'O nome é obrigatório!',
        'name.string' => 'Este nome não é válido!',
        'email.required' => 'O e-mail é obrigatório!',
        'email.email' => 'Este e-mail é inválido!',
        'age.required' => 'A idade é obrigatória!',
        'age.numeric' => 'Esta idade é inválida!',
        'age.min' => 'É preciso ter no mínimo 18 anos!',
        'street.required' => 'O logradouro é obrigatório!',
        'street.string' => 'Este logradouro não é válido!',
        'location.required' => 'O bairro é obrigatório!',
        'location.string' => 'Este bairro não é válido!',
        'number.required' => 'O número da residência é obrigatório!',
        'number.numeric' => 'Este número de residência é inválido!',
        'postal_code.required' => 'O código postal é obrigatório!',
        'postal_code.string' => 'Este código postal não é válido!',
        'city.required' => 'A cidade é obrigatória!',
        'city.string' => 'Esta cidade não é válida!',
        'state.required' => 'O estado é obrigatório!',
        'state.string' => 'Este estado não é válido!',
        'uf.required' => 'A UF é obrigatória!',
        'uf.string' => 'Esta UF não é válida!',
    ];

}