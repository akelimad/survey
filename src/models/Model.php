<?php
/**
 * Model
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
 *
 * @package app.models
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Models; 


class Model
{

    public static $db;

    public function __construct()
    {
        self::$db = getDB();
    }

  
} // END Class