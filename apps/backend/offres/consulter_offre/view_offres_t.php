<?php

 

session_start();

 

if(isset($_SESSION['compte_v'])) {  header("Location: ../../compte/");  } 

if (!isset($_SESSION["abb_admin"]) || $_SESSION["abb_admin"] == "") {

    header("Location: ../../login/"); 

} 

    

 



require_once dirname(__FILE__) . "/../../../../config/config.php";

        mysql_connect($serveur,$user,$passwd);

        mysql_select_db($bdd);

             

        

        $sql_roles = mysql_query("SELECT * FROM  root_roles where login = '".$_SESSION['abb_admin']."' ");

        $rep_roles = mysql_fetch_assoc($sql_roles);

 

 



     

    if(isset($_GET['offre']) ) {
      $id_offre = $_GET['offre'];
    } else if(isset($_POST['id']) ) {
      $id_offre = $_POST['id'];
    } 

           $sql = mysql_query("select * from offre where id_offre = '$id_offre' ");



            $offre_exist = mysql_num_rows($sql);

            if($offre_exist){   

                $offre = mysql_fetch_array($sql);

            }

/*/////////////////////////////////////////////////////////////////////////////*/

$offres=strpos($_SESSION['page_courant '],'offres');

$candidatures=strpos($_SESSION['page_courant '],'candidatures');

/*/////////////////////////////////////////////////////////////////////////////*/





 $off = $offre['Name']; 

 

 

  $nom_page_site =strtoupper($off)  ;

  

      

 $ariane=" Offres > <a href='offres.php' >Liste des offres</a> > $off";    

?>