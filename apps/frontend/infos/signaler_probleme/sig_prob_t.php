<?php

  



 

    require_once dirname(__FILE__) . "/../../../../config/fo_conn.php";

 

 



//  - d -   

function generateCode(){

    $unique =   FALSE;

    $length =   7;

    $chrDb  =   array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','0','1','2','3','4','5','6','7','8','9');

    //while (!$unique){

          $str = '';

          for ($count = 0; $count < $length; $count++){

              $chr = $chrDb[rand(0,count($chrDb)-1)];

              if (rand(0,1) == 0){

                 $chr = strtolower($chr);

              }

              if (3 == $count){

                 $str .= '-';

              }

              $str .= $chr;

          }

    //    $unique=true;

    //}

    return $str;

}

$code_ticket = generateCode();

          $req_theme = mysql_query("SELECT * FROM root_signale_probleme");

          while ($data_s = mysql_fetch_array($req_theme)) {

            if($data_s['ticket'] == $code_ticket){

                $code_ticket = generateCode();

                }

          }

          

//  - fin code ticket -  







$messages=array(); 

		

  

if (isset($_GET['cpcha']) and $_GET['cpcha']==0 ){

  array_push($messages, "<ul><li style='color:#FF0000'>Le CAPTCHA est invalide</li></ul>");

  }









  

    $nom_page_site = "SIGNALER UN PROBLEME " ;

	

    $ariane=" <a href='$site'> Accueil </a> > Signaler un probléme";



?>