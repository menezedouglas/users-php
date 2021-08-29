<?php

namespace App\Http\Controllers;

use App\Common\Response;

class BaseController
{

    /**
     * Class to response
     *
     * @var Response
     */
    protected Response $response;

    /**
     * Constructor method
     */
    public function __construct()
    {
        $this->response = new Response();
    }
}