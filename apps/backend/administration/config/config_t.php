<?php

  

session_start();

/*

if (isset($_SESSION["abb_admin"]) && $_SESSION["abb_admin"] != "root") {

    header("Location: ../../");

}

*/

if (!isset($_SESSION["abb_admin"]) || $_SESSION["abb_admin"] == "") {

    header("Location: ../../login/");

}  

 

    require_once dirname(__FILE__) . "/../../../../config/config.php";

    



    $sql = "SELECT * from prm_config ";

	$select = mysql_query($sql);

	$reponse = mysql_fetch_assoc($select);

			

 $_SESSION['link_bak_a']=6;

 $_SESSION['link_bak_b']=70;

 $_SESSION['page_courant ']=$_SERVER['REQUEST_URI'];

 

$ariane=" Admin > config  ";	

    ?>

 

