<?php

namespace App\Http\Controllers;

use App\Common\Response;

use App\Models\User;

use Exception;
use Pecee\Http\Input\InputHandler;
use Pecee\Http\Request;
use Pecee\SimpleRouter\Router;
use App\Http\Requests\User\{StoreRequest};

class UserController
{

    /**
     * Class to response
     *
     * @var Response
     */
    protected Response $response;

    /**
     * The user model
     *
     * @var User
     */
    protected User $model;

    /**
     * Constructor method
     */
    public function __construct()
    {
        $this->response = new Response();
        $this->model = new User();
    }

    /**
     * List all users
     */
    public function index()
    {
        try {

            $users = $this->model->find()->fetch(true);

            if(!$users) $users = [];

            return $this->response->json($users);

        } catch (Exception $error) {

            return $this->response->json([
                'error' => 'Não foi possível listar os usuários!'
            ], 500);

        }
    }

    /**
     * @throws Exception
     */
    public function store()
    {


        $request = new StoreRequest();

        $inputs = $request->all();

        if(count(array_keys(array_keys($inputs), 'errors')) > 0)
            return $this->response->json($request->getErrors(), 422);

        return $this->response->json($inputs);


    }

}