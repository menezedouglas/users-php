<?php

namespace App\Helpers;

class Validate
{

    /**
     * Validate E-mail
     *
     * @param string $email
     * @return bool
     */
    public static function email(string $email): bool
    {
        return !!filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Validate String
     *
     * @param $val
     * @return bool
     */
    public static function string($val): bool
    {
        return is_string($val);
    }

    /**
     * Validate Numbers
     *
     * @param $val
     * @return bool
     */
    public static function numeric($val): bool
    {
        return !is_nan($val);
    }

    /**
     * Validate a minimum length of a value
     *
     * @param string $val
     * @param int $minLength
     * @return bool
     */
    public static function minLength(string $val, int $minLength): bool
    {
        return strlen($val) >= $minLength;
    }

    /**
     * Validate a maximum length of a value
     *
     * @param string $val
     * @param int $maxLength
     * @return bool
     */
    public static function maxLength(string $val, int $maxLength): bool
    {
        return strlen($val) <= $maxLength;
    }

}