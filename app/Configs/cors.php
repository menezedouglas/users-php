<?php

const CORS = [
    'Access-Control-Allow-Origin' => [
        'http://localhost'
    ],

    'Access-Control-Allow-Headers' => [
        'X-Requested-With',
        'Content-Type',
        'Origin',
        'Cache-Control',
        'Pragma',
        'Authorization',
        'Accept',
        'Accept-Encoding'
    ],

    'Cache-Control' => [
        'no-cache',
        'must-revalidate'
    ],

    'Content-Type' => [
        'application/json;charset=utf-8'
    ]
];