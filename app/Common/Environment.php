<?php

namespace App\Common;

class Environment
{

    /**
     * Load environment file
     *
     * @param string $dir
     * @return false|void
     */
    public static function load(string $dir)
    {
        if(!file_exists($dir . '/.env'))
            return false;

        $lines = file($dir . '/.env');

        foreach ($lines as $line)
        {
            if(!!trim($line))
                putenv(trim($line));
        }

    }

}