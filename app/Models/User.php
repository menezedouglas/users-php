<?php

namespace App\Models;

class User extends BaseModel
{
    /**
     * The table name
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The table primary key
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Datetime validation
     *
     * @var bool
     */
    protected $timestamp = true;

    /**
     *
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'age',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}