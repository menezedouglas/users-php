<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;

use App\Models\{
    State,
    VwUserByState
};

class StateController extends BaseController
{

    /**
     * The user model
     *
     * @var State
     */
    protected State $model;

    /**
     * Constructor method
     */
    public function __construct()
    {
        parent::__construct();
        $this->model = new State();
    }

    /**
     * List all addresses
     *
     * @return false|string
     */
    public function index()
    {
        try {

            $states = $this->model->find()->fetch(true);

            if (!$states)
                $this->response->json([
                    'error' => 'Nenhum estado foi encontrado!'
                ], 404);

            $response = [];

            foreach ($states as $state) {
                $response[] = $state->data();
            }

            return $this->response->json($response);
        } catch (\Exception $error) {
            return $this->response->json([
                'error' => 'Não foi possível listar os estados!'
            ], 500);
        }
    }

    /**
     * List a specific address
     *
     * @return false|string
     */
    public function show(int $id)
    {
        try {

            $state = $this->model->findById($id);

            if (!$state)
                return $this->response->json([
                    'error' => 'O estado não foi encontrado!'
                ], 404);

            return $this->response->json(
                (array)$state->data()
            );

        } catch (\Exception $error) {
            return $this->response->json([
                'error' => 'Não foi possíve mostrar o estado!'
            ], 500);
        }
    }

    /**
     * Return total of users by state
     *
     * @return false|string
     */
    public function usersByState()
    {
        try {

            $data = (new VwUserByState())->find()->fetch(true);

            $response = [];

            foreach ($data as $item) {
                $response[] = $item->data();
            }

            return $this->response->json($response);

        } catch (\Exception $error) {
            return $this->response->json([
                'error' => 'Não foi possíve mostrar o total de usuários por estado!'
            ], 500);
        }
    }


}