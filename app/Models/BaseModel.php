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
    protected string $table = '';

    /**
     * The primary key of table
     *
     * @var string
     */
    protected string $primaryKey = '';

    /**
     * The table required fields
     *
     * @var string[]
     */
    protected array $fillable = [];

    /**
     * Datetime validation
     *
     * @var bool
     */
    protected bool $timestamp = true;

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