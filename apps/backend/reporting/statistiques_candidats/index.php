<?php
  session_start();
if(isset($_SESSION['compte_v'])) {  header("Location: ../../compte/");  } 
if (!isset($_SESSION["abb_admin"]) || $_SESSION["abb_admin"] == "") {    header("Location: ../../login/"); } 
    header("location: ./candidats_inscrits/"); 
	
?>	
 