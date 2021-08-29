<?php

namespace App\Common;

use Exception;
use PDO;

use App\Common\Environment;

class DB extends PDO
{

    /**
     * Constructor Method
     *
     * @throws Exception
     */
    public function __construct()
    {
        try {
            $host = getenv('DB_HOST');
            $name = getenv('DB_NAME');
            $user = getenv('DB_USER');
            $password = getenv('DB_PASSWORD');

            parent::__construct("mysql:host=$host;dbname=$name", $user, $password);

            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->setAttribute( PDO::ATTR_EMULATE_PREPARES, false);
            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");

        } catch (\PDOException $error) {
            throw new Exception($error->getMessage(), 500);
        }
    }

}