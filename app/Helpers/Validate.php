<?php

namespace App\Helpers;

class Validate
{

    /**
     * Validate E-mail
     *
     * @param $email
     * @return bool
     */
    public static function email($email): bool
    {
        return $email && !!filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Validate String
     *
     * @param $val
     * @return bool
     */
    public static function string($val): bool
    {
        return $val && is_string($val);
    }

    /**
     * Validate Numbers
     *
     * @param $val
     * @return bool
     */
    public static function numeric($val): bool
    {
        return $val && is_numeric($val);
    }

    /**
     * Validate a minimum length of a value
     *
     * @param $val
     * @param int $minLength
     * @return bool
     */
    public static function minLength($val, int $minLength): bool
    {
        return $val && strlen($val) >= $minLength;
    }

    /**
     * Validate a maximum length of a value
     *
     * @param $val
     * @param int $maxLength
     * @return bool
     */
    public static function maxLength($val, int $maxLength): bool
    {
        return $val && strlen($val) <= $maxLength;
    }

    /**
     * Validate a minimum value
     *
     * @param $val
     * @param int $min
     * @return bool
     */
    public static function min($val, int $min): bool
    {
        return $val && $val >= $min;
    }

    /**
     * Validate a maximum value
     *
     * @param $val
     * @param int $max
     * @return bool
     */
    public static function max($val, int $max): bool
    {
        return $val && $val <= $max;
    }

}