<?php

namespace App\Models;

class Address extends BaseModel
{
    /**
     * The table name
     *
     * @var string
     */
    protected string $table = 'addresses';

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
        'street',
        'location',
        'state_id',
        'city_id',
        'postal_code'
    ];

}