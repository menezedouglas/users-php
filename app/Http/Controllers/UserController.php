<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;

use Exception;

use App\Common\DB;
use App\Common\Response;

use App\Models\{
    Address,
    City,
    State,
    User,
    UserAddress
};

use App\Http\Requests\User\{
    StoreRequest,
    UpdateRequest
};

class UserController extends BaseController
{

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
        parent::__construct();
        $this->model = new User();
    }

    /**
     * List all users
     */
    public function index()
    {
        try {

            $users = $this->model->find(
                "deleted_at is null"
            )->fetch(true);

            if(!$users) $users = [];

            $response = [];

            foreach ($users as $user)
            {
                $response[] = $user->data();
            }

            return $this->response->json($response);

        } catch (Exception $error) {

            return $this->response->json([
                'error' => 'Não foi possível listar os usuários!'
            ], 500);

        }
    }

    /**
     * Return a specific user
     *
     * @param int $id
     * @return false|string
     */
    public function show(int $id)
    {
        try {

            $user = $this->model->find(
                'id = :id and deleted_at is null',
                "id=".$id
            )->fetch();

            if(!$user)
                return $this->response->json([
                    'error' => 'O usuário não foi encontrado!'
                ], 404);

            $userAddress = (new UserAddress())->find(
                "user_id = :user_id",
                "user_id=".$user->id
            )->fetch();

            $addresses = (new Address())->findById($userAddress->address_id);
            $city = (new City())->findById($addresses->city_id);
            $state = (new State())->findById($addresses->state_id);

            $userAddresses = [
                'street' => $addresses->street,
                'location' => $addresses->location,
                'number' => $userAddress->number,
                'complement' => $userAddress->complement,
                'postal_code' => $addresses->postal_code,
                'city' => $city->name,
                'state' => $state->name,
                'uf' => $state->code,
            ];

            $response = array_merge((array) $user->data(), ['addresses' => (array) $userAddresses]);

            return $this->response->json(
                $response,
                200
            );

        } catch (\Exception $error) {

            return $this->response->json([
                'error' => 'Não foi possível mostrar o usuário!'
            ], 500);

        }
    }

    /**
     * Create a new user
     *
     * @return false|string
     */
    public function store()
    {

        try {

            $request = new StoreRequest();

            $inputs = $request->all();

            if(count(array_keys(array_keys($inputs), 'errors')) > 0)
                return $this->response->json($request->getErrors(), 422);

            $user = new User();
            $city = new City();
            $state = new State();
            $address = new Address();
            $userAddress = new UserAddress();

            $user->name = $inputs['name'];
            $user->email = $inputs['email'];
            $user->age = $inputs['age'];

            $city->name = $inputs['city'];

            $state->name = $inputs['state'];
            $state->code = $inputs['uf'];

            $user->save();
            $city->save();
            $state->save();

            if($user->fail())
            {
                if(intval($user->fail()->getCode()) === 23000)
                {
                    $user = $this->model->find(
                        "email = :email",
                        "email=".$user->email
                    )->fetch();

                    $user->deleted_at = null;
                    $user->save();
                }
            }

            if($city->fail()) {
                $city = (new City())->find(
                    "name = :name",
                    "name=".$inputs['city']
                )->fetch();

                $city->deleted_at = null;
                $city->save();
            }

            if($state->fail()) {
                $state = (new State())->find(
                    "name = :name AND code = :code",
                    "name=".$inputs['state']."&code=".$inputs['uf']
                )->fetch();

                $state->deleted_at = null;
                $state->save();
            }

            $address->street = $inputs['street'];
            $address->location = $inputs['location'];
            $address->state_id = (int) $state->id;
            $address->city_id = (int) $city->id;
            $address->postal_code = $inputs['postal_code'];

            $address->save();

            if($address->fail()) {
                $address = (new Address())->find(
                    "postal_code = :postal_code",
                    "postal_code=".$inputs['postal_code']
                )->fetch();

                $address->deleted_at = null;
                $address->save();
            }

            $userAddress->user_id = (int) $user->id;
            $userAddress->address_id = (int) $address->id;
            $userAddress->number = $inputs['number'];
            $inputs['complement'] ?
                $userAddress->complement = $inputs['complement'] :
                $userAddress->complement =  'S/D';

            $userAddress->save();

            if($userAddress->fail())
            {
                if(intval($userAddress->fail()->getCode()) === 23000)
                {
                    $userAddresses = (new UserAddress())->find(
                        "user_id = :user_id",
                        "user_id=".$user->id
                    )->fetch(true);

                    foreach ($userAddresses as $address)
                    {
                        $address->deleted_at = null;
                        $address->save();
                    }
                }
            }

            return $this->response->json([
                'message' => 'Usuário cadastrado'
            ]);

        } catch (\Exception $error) {

            return $this->response->json([
                'error' => 'Nâo foi possível cadastrar o usuario!'
            ], 500);

        }
    }

    /**
     * Create a new user
     *
     * @return false|string
     */
    public function update(int $id)
    {

        try {

            $request = new UpdateRequest();

            $inputs = $request->all();

            if(count(array_keys(array_keys($inputs), 'errors')) > 0)
                return $this->response->json($request->getErrors(), 422);

            $user = (new User())->findById($id);

            $city = (new City())->find(
                "name = :name",
                "name=".$inputs['city']
            )->fetch();

            $state = (new State())->find(
                "name = :name AND code = :code",
                "name=".$inputs['state']."&code=".$inputs['uf']
            )->fetch();

            $address = (new Address())->find(
                "postal_code = :postal_code",
                "postal_code=".$inputs['postal_code']
            )->fetch();

            $userAddress = (new UserAddress())->find(
                "user_id = :user_id AND address_id = :address_id",
                "user_id=".$user->id."&address_id=".$address->id
            )->fetch();

            $user->name = $inputs['name'];
            $user->email = $inputs['email'];
            $user->age = $inputs['age'];

            $city->name = $inputs['city'];

            $state->name = $inputs['state'];
            $state->code = $inputs['uf'];

            $user->save();
            $city->save();
            $state->save();

            $address->street = $inputs['street'];
            $address->location = $inputs['location'];
            $address->state_id = (int) $state->id;
            $address->city_id = (int) $city->id;
            $address->postal_code = $inputs['postal_code'];

            $address->save();

            $userAddress->user_id = (int) $user->id;
            $userAddress->address_id = (int) $address->id;
            $userAddress->number = $inputs['number'];
            $inputs['complement'] ?
                $userAddress->complement = $inputs['complement'] :
                $userAddress->complement =  'S/D';

            $userAddress->save();

            return $this->response->json([
                'message' => 'Cadastro atualizado!'
            ]);

        } catch (\Exception $error) {

            return $this->response->json([
                'error' => 'Nâo foi possível atualizar o cadastro do usuario!'
            ], 500);

        }
    }

    /**
     * Delete a specific user
     *
     * @param int $id
     * @return false|string
     */
    public function delete(int $id)
    {
        try {

            $user = (new User())->findById($id);

            if(!$user)
                return $this->response->json([
                    'error' => 'O usuário não foi encontrado!'
                ], 404);

            $userAddress = (new UserAddress())->find(
                "user_id = :user_id",
                "user_id=".$user->id
            )->fetch(true);

            foreach ($userAddress as $address)
            {
                $address->drop();
            }

            $user->drop();

            return $this->response->json([
                'message' => 'Cadastro excluído!'
            ]);

        } catch (\Exception $error) {

            return $this->response->json([
                'error' => 'Nâo foi possível excluir o cadastro do usuario!'
            ], 500);

        }
    }

}