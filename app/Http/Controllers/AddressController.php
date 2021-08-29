<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;

use App\Models\Address;
use App\Models\City;
use App\Models\State;

class AddressController extends BaseController
{

    /**
     * The user model
     *
     * @var Address
     */
    protected Address $model;

    /**
     * Constructor method
     */
    public function __construct()
    {
        parent::__construct();
        $this->model = new Address();
    }

    /**
     * List all addresses
     *
     * @return false|string
     */
    public function index()
    {
        try {
            $addresses = (new Address())->find()->fetch(true);

            $response = [];

            foreach ($addresses as $address)
            {
                $city = (new City())->findById($address->city_id);
                $state = (new State())->findById($address->state_id);

                $response[] = [
                    'id' => $address->id,
                    'street' => $address->street,
                    'location' => $address->location,
                    'postal_code' => $address->postal_code,
                    'city' => $city->name,
                    'state' => $state->name,
                    'uf' => $state->code,
                    'created_at' => $address->created_at,
                    'updated_at' => $address->updated_at,
                ];
            }

            return $this->response->json($response);
        } catch (\Exception $error) {
            return $this->response->json([
                'error' => 'Não foi possível listar os endereços!'
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
            $address = (new Address())->findById($id);

            $city = (new City())->findById($address->city_id);
            $state = (new State())->findById($address->state_id);

            $response = [
                'id' => $address->id,
                'street' => $address->street,
                'location' => $address->location,
                'postal_code' => $address->postal_code,
                'city' => $city->name,
                'state' => $state->name,
                'uf' => $state->code,
                'created_at' => $address->created_at,
                'updated_at' => $address->updated_at,
            ];

            return $this->response->json($response);
        } catch (\Exception $error) {
            return $this->response->json([
                'error' => 'Não foi possíve mostrar o endereço!'
            ], 500);
        }
    }

}