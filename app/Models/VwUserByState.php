<?php

namespace App\Models;

class VwUserByState extends BaseModel
{
    /**
     * The table name
     *
     * @var string
     */
    protected string $table = 'vw_users_by_states';

    /**
     * The table required fields
     *
     * @var string[]
     */
    protected array $fillable = [
        'state',
        'uf',
        'users'
    ];

}