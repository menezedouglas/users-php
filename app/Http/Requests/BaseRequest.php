<?php

namespace App\Http\Requests;

use App\Common\DB;
use Exception;

use Pecee\Http\Input\InputHandler;
use Pecee\Http\Request;

use App\Common\Response;

use App\Helpers\Validate;


/**
 *
 */
class BaseRequest
{
    /**
     * Class to response
     *
     * @var Response
     */
    protected Response $response;

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
     * Errors emitted for validate inputs
     *
     * @var string[]
     */
    protected array $errors = [];

    /**
     * Messages for inputs with errors
     *
     * @var string[]
     */
    protected array $errorMessages = [];

    /**
     * Database connection
     *
     * @var DB
     */
    private DB $connection;

    /**
     * Constructor method
     */
    public function __construct()
    {
        $this->response = new Response();
        $this->setData((new InputHandler(new Request()))->all());
        $this->connection = new DB();
    }

    /**
     * Set multiple inputs into data
     *
     * @param array $data
     */
    private function setData(array $data)
    {
        foreach ($data as $key => $value) {
            $this->setIntoData($key, $value);
        }
    }

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
     * Get a specific input in data
     *
     * @param string $key
     * @return mixed
     */
    private function getDataByKey(string $key)
    {
        return $this->data[$key];
    }

    /**
     * Get all inputs in data
     *
     * @return array
     */
    private function getData()
    {
        return $this->data;
    }

    /**
     * Set errors
     *
     * @param array $errors
     */
    private function setErrors(array $errors)
    {
        $this->errors = $errors;
    }

    /**
     * Return all emitted errors
     *
     * @return string[]
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Get a specific valid input
     *
     * @param $key
     * @return mixed
     */
    public function input($key)
    {
        return $this->data[$key];
    }

    /**
     * Get all inputs if are valid
     *
     * @return array
     * @throws Exception
     */
    public function all(): array
    {
        if($this->validate()) {
            return ['errors' => $this->errors];
        } else {
            return $this->getData();
        }
    }

    /**
     * Validate all inputs
     *
     * @return bool
     * @throws Exception
     */
    private function validate(): bool
    {
        $errors = [];
        $data = $this->getData();

        $inputRules = $this->extractRules();

        foreach ($inputRules as $key => $rules) {
            foreach ($rules as $rule) {
                if(!is_array($rule)) {
                    switch ($rule) {
                        case 'required': {
                            if(!isset($data[$key]))
                            {
                                $errors[$key][] = $this->errorMessages[$key.'.'.$rule];
                            }
                            break;
                        }
                        case 'string': {
                            if(!Validate::string($data[$key]))
                            {
                                $errors[$key][] = $this->errorMessages[$key.'.'.$rule];
                            }
                            break;
                        }
                        case 'email': {
                            if(!Validate::email($data[$key]))
                            {
                                $errors[$key][] = $this->errorMessages[$key.'.'.$rule];
                            }
                            break;
                        }
                        case 'numeric': {
                            if(!Validate::numeric((string) $data[$key]))
                            {
                                $errors[$key][] = $this->errorMessages[$key.'.'.$rule];
                            }
                            break;
                        }
                    }
                }
                else {
                    switch ($rule['rule']) {
                        case 'min': {
                            if(!Validate::min($data[$key], (int) $rule['param']))
                            {
                                $errors[$key][] = $this->errorMessages[$key.'.'.$rule['rule']];
                            }
                            break;
                        }
                        case 'max': {
                            if(!Validate::max($data[$key], (int) $rule['param']))
                            {
                                $errors[$key][] = $this->errorMessages[$key.'.'.$rule['rule']];
                            }
                            break;
                        }
                    }
                }
            }
        }

        $this->setErrors($errors);

        return count($errors) > 0;

    }

    /**
     * Extract all rules for execute validation
     *
     * @return array
     */
    private function extractRules(): array
    {
        $rules = [];

        foreach ($this->rules as $input => $inputRules) {
            $explodedRules = explode('|', $inputRules);

            foreach ($explodedRules as $rule) {
                if (strpos($rule, ':')) {
                    $temp = explode(':', $rule);
                    $rules[$input][] = [
                        'rule' => $temp[0],
                        'param' => $temp[1]
                    ];
                } else {
                    $rules[$input][] = $rule;
                }
            }
        }

        return $rules;
    }

}