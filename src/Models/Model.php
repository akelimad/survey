<?php
/**
 * Model
 *
 * @author mchanchaf
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