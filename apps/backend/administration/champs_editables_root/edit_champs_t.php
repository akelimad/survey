<?php

session_start(); 



if (isset($_SESSION["abb_admin"]) && $_SESSION["abb_admin"] != "root") {

    header("Location: ../../");

}

if (!isset($_SESSION["abb_admin"]) || $_SESSION["abb_admin"] == "") {

    header("Location: ../../login/");

}  

 

    require_once dirname(__FILE__) . "/../../../../config/config.php";

 



		

 $_SESSION['link_bak_a']=6;

 $_SESSION['link_bak_b']=64;

 	



	

$ariane=" Admin > Champs éditables ";	

    ?>



	