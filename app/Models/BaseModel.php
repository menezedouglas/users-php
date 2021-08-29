<?php

namespace App\Models;

use CoffeeCode\DataLayer\DataLayer;

//use App\Common\DB;
//use PDOStatement;

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
     * The fields for selection
     *
     * @var string
     */
    protected string $select = '*';

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

    /**
     * Constructor Method
     */
    public function __construct()
    {
        parent::__construct(
            $this->table,
            $this->fillable,
            $this->primaryKey,
            $this->timestamp
        );
    }

    /**
     * Drop a specific resource
     */
    public function drop()
    {
        $this->deleted_at = date('Y-m-d H:i:s');
        $this->save();
    }

}