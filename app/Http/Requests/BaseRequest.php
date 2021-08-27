<?php

namespace App\Http\Requests;

class BaseRequest
{

    /**
     * Set the method allowed for this request
     *
     * @var string
     */
    protected string $allowedMethod = '*';

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
        return $this->data;
    }

}