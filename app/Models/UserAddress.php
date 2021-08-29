<?php

namespace App\Models;

class UserAddress extends BaseModel
{
    /**
     * The table name
     *
     * @var string
     */
    protected string $table = 'user_addresses';

    /**
     * The table primary key
     *
     * @var string
     */
    protected string $primaryKey = 'id';

    /**
     * Datetime validation
     *
     * @var bool
     */
    protected bool $timestamp = true;

    /**
     * The table required fields
     *
     * @var string[]
     */
    protected array $fillable = [
        'user_id',
        'address_id',
        'number',
        'complement'
    ];

}