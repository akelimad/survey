<?php
// Defines
define('DB_SERVER', 'localhost');
define('DB_NAME', 'project_etalent_1.5.0');
define('DB_USER', 'root');
define('DB_PASS', '98k1TYZe49KeyWJT');

// Store vars for old versions
$bdd = DB_NAME;
$serveur = DB_SERVER;
$user = DB_USER;
$passwd = DB_PASS;

// Connect to database
mysql_connect(DB_SERVER, DB_USER, DB_PASS);
mysql_select_db(DB_NAME);
mysql_query("set names utf8");