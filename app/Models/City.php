<?php

namespace App\Models;

class City extends BaseModel
{
    /**
     * The table name
     *
     * @var string
     */
    protected string $table = 'cities';

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
        'name',
    ];

}