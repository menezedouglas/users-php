<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;

use App\Models\{
    City,
    VwUserByCity
};

class CityController extends BaseController
{

    /**
     * The user model
     *
     * @var City
     */
    protected City $model;

    /**
     * Constructor method
     */
    public function __construct()
    {
        parent::__construct();
        $this->model = new City();
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

            if(!$states)
                $this->response->json([
                    'error' => 'Nenhuma cidade foi encontrada!'
                ], 404);

            $response = [];

            foreach ($states as $state)
            {
                $response[] = $state->data();
            }

            return $this->response->json($response);
        } catch (\Exception $error) {
            return $this->response->json([
                'error' => 'Não foi possível listar as cidades!'
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

            if(!$state)
                return $this->response->json([
                    'error' => 'A cidade não foi encontrada!'
                ], 404);

            return $this->response->json(
                (array) $state->data()
            );

        } catch (\Exception $error) {
            return $this->response->json([
                'error' => 'Não foi possíve mostrar a cidade!'
            ], 500);
        }
    }

    /**
     * Return total of users by city
     *
     * @return false|string
     */
    public function usersByCity()
    {
        try {

            $data = (new VwUserByCity())->find()->fetch(true);

            $response = [];

            foreach ($data as $item) {
                $response[] = $item->data();
            }

            return $this->response->json($response);

        } catch (\Exception $error) {
            return $this->response->json([
                'error' => 'Não foi possíve mostrar o total de usuários por cidade!'
            ], 500);
        }
    }

}