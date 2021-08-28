<?php

namespace App\Http\Requests;

use App\Helpers\Validate;
use Exception;

class BaseRequest
{

    /**
     * Set the method allowed for this request
     *
     * @var bool
     */
    protected bool $permitted = false;

    /**
     * Valid inputs in request
     *
     * @var array
     */
    private array $data = [];

    /**
     * Rules for validate inputs
     *
     * @var string[]
     */
    protected array $rules = [];

    /**
     * Messages for inputs with errors
     *
     * @var string[]
     */
    protected array $errorMessages = [];

    /**
     * Add input into valid data
     *
     * @param $key
     * @param $value
     */
    private function setIntoData($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * Get a specific valid input
     *
     * @param $key
     * @return mixed
     */
    public function input($key): mixed
    {
        return $this->data[$key];
    }

    /**
     * Get all the valid inputs
     *
     * @return array
     */
    public function all(): array
    {
        $this->validate();

        return $this->data;
    }

    /**
     * @throws Exception
     */
    private function validate(): void
    {
        try {
            print_r(Validate::email('menezedouglas@outlook.com.br'));
        } catch (Exception $error) {
            throw new Exception('Unprocessable Entity', 422);
        }
    }

}