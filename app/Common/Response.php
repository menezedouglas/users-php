<?php

namespace App\Common;

class Response
{

    /**
     * Header response
     *
     * @var string[]
     */
    protected array $header;

    /**
     * The constructor method
     */
    public function __construct()
    {
        $this->header = CORS;
    }

    public function json(array $data, $code = 200)
    {
        $this->setHeaders();

        http_response_code($code);

        return json_encode($data);
    }

    /**
     * Set response headers defined in cors file
     */
    public function setHeaders()
    {
        foreach ($this->header as $key => $data)
        {

            $strData = '';

            foreach ($data as $index => $str)
            {
                $strData .= $str;

                if($index + 1 < count($data))
                    $strData .= ', ';
            }

            header($key.':'.$strData);

        }
    }

}