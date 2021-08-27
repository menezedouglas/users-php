<?php

namespace App\Http\Controllers;

use App\Common\Response;

class UserController
{

    public function test()
    {
        try {
            (new Response())->json(['foo' => 'bar']);
        } catch (\Exception $error) {
            var_dump($error);
        }
    }

}