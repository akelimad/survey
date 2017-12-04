<?php
/**
 * Model
 *
 * @author M'hamed Chanchaf
 *
 * @package app.models
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