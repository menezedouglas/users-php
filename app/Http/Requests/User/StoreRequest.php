<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{

    /**
     * @var bool
     */
    protected bool $permitted = true;

    /**
     * @var array|string[]
     */
    protected array $rules = [
        'name' => 'required|string',
        'email' => 'required|email',
        'age' => 'required|numeric|min:18'
    ];

    /**
     * @var array|string[]
     */
    protected array $errorMessages = [
        'name.required' => 'O nome é obrigatório!',
        'name.string' => 'Este nome não é válido!',
        'email.required' => 'O e-mail é obrigatório!',
        'email.email' => 'Este e-mail é inválido!',
        'age.required' => 'A idade é obrigatória!',
        'age.numeric' => 'Esta idade é inválida!',
        'age.min' => 'É preciso ter no mínimo 18 anos!'
    ];

}