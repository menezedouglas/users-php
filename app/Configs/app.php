<?php

/**
 * Data Layer config set
 *
 * @var array
 */
define("DATA_LAYER_CONFIG", [
    "driver" => getenv('DB_DRIVER'),
    "host" => getenv('DB_HOST'),
    "port" => getenv('DB_PORT'),
    "dbname" => getenv('DB_NAME'),
    "username" => getenv('DB_USER'),
    "passwd" => getenv('DB_PORT'),
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);