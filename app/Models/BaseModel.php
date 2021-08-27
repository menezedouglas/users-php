<?php

namespace App\Models;

use CoffeeCode\DataLayer\DataLayer;

class BaseModel extends DataLayer
{

    /**
     * The table name
     *
     * @var string
     */
    protected $table = '';

    /**
     * The primary key of table
     *
     * @var string
     */
    protected $primaryKey = '';

    /**
     * The table required fields
     *
     * @var string[]
     */
    protected $fillable = [];

    /**
     * Datetime validation
     *
     * @var bool
     */
    protected $timestamp = true;

    public function __construct()
    {
        parent::__construct(
            $this->table,
            $this->fillable,
            $this->primaryKey,
            $this->timestamp
        );
    }

}