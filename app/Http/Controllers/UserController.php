<?php

namespace App\Http\Controllers;

use App\Common\Response;

use App\Models\User;

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

            $this->response->json($users);

        } catch (\Exception $error) {

            $this->response->json([
                'error' => 'Não foi possível listar os usuários!'
            ], 500);

        }
    }

    /**
     * @param StoreRequest $request
     */
    public function store(StoreRequest $request)
    {
        print_r($request->all());
    }

}