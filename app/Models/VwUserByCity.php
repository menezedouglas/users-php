<?php

namespace App\Models;

class VwUserByCity extends BaseModel
{
    /**
     * The table name
     *
     * @var string
     */
    protected string $table = 'vw_users_by_cities';

    /**
     * The table required fields
     *
     * @var string[]
     */
    protected array $fillable = [
        'city',
        'users'
    ];

}