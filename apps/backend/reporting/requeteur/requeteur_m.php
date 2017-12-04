<div class='texte'><br/>

<?php

include('menu_requeteur.php');

?>



<h1>REQUETEUR</h1>

<p>Cette section vous permet la personnalisation des statistiques.</p>										

<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">

                 <?php include("./requeteur_m_filtre.php");?>

</form>        

<br> 

                         

<?php





            

            

        $query  =  (isset($_SESSION["query"])) ?  $_SESSION["query"] : '' ;  

                

                

            

            $query = $query."  ORDER BY  pertinence  DESC  ";

                

                

               //  echo '<h1> '.$query.'</h1>';

                

               

            

            if(isset($_POST['tridate']) and  $_POST['tridate']=="ASC" ){                

          //     echo '<h1> '.$query.'</h1><br/><br/><br/><br/><br/>';

                 

                $query = str_replace("ORDER BY STR_TO_DATE( replace( date_candidature, '/', '-' ) , '%d-%m-%Y' ) DESC", "ORDER BY STR_TO_DATE( replace( date_candidature, '/', '-' ) , '%d-%m-%Y' )  ASC ", $query);

            

      //         echo '<h1> '.$query.'</h1>';

                

                }  

              



            if($_SESSION["i_val_requet"]!="" ){      

                $requet =  " where  historique.status ='".$_SESSION["i_val_requet"]."' ";  

                

                } 

                //  DATEDIFF(date_expiration,CURDATE())>0 And DATEDIFF(date_expiration,CURDATE())<7")

                

                   if((isset( $_SESSION["i_dd"]) and   $_SESSION["i_dd"]!="" ) and (isset( $_SESSION["i_df"]) and   $_SESSION["i_df"]!="" )){   

                   

                $requet .=  " And  historique.date_modification >'". $_SESSION["i_dd"]."' 

                And  historique.date_modification <'". $_SESSION["i_df"]."' ";  

                

                } 

                

            if(isset( $_SESSION["i_co"]) and   $_SESSION["i_co"]!="" ){      

                $requet .=  " And  candidature.id_offre  ='". $_SESSION["i_co"]."' "; 

                

                } 

            if(!isset($requet )  ){      

                $requet =  " "; 

                

                } 

                

$query = "SELECT DISTINCT o.Name, o . *  , historique.status

,historique.*,candidature.candidats_id

FROM offre o

inner join candidature on o.id_offre = candidature.id_offre

inner join historique on candidature.id_candidature = historique.id_candidature  

".$requet."  ".$q_offre_fili_and."

			 ";





        

        

function couperChaine($chaine, $nbrMotMax , $nbrMotCarct=null ) {

    $chaineNouvelle = "";

    $i = 0;

    $t_chaineNouvelle = explode(" ", $chaine);

    foreach ($t_chaineNouvelle as $cle => $mot) {

        if ($cle < $nbrMotMax) {

            $chaineNouvelle .= $mot . " ";

        }

        $i++;

    }

    

    if ($i <= $nbrMotMax){  

        $chaine=substr($chaine,0,$nbrMotCarct).'...';

        return $chaine;

        }

    else{

        

        $chaineNouvelle=substr($chaineNouvelle,0,$nbrMotCarct).'...';

        return $chaineNouvelle;

        }

}

function time_ago($date, $granularity = 2)

{

    $date = strtotime($date);

    $difference = time() - $date;

    $periods = array(

        'decade' => 315360000,

        'année'   => 31536000,

        'mois'  => 2628000,

        'semaine'   => 604800, 

        'jour'    => 86400,

        'heure'   => 3600,

        'minute' => 60,

        'seconde' => 1);

    

    $retval = '';

    if ($difference < 1)

    {

        $retval = "moins de 1 second";

    }

    else

    {

        foreach ($periods as $key => $value)

        {

            if ($difference >= $value)

            {

                $time = floor($difference/$value);

                $difference %= $value;

                $retval .= ($retval ? ' ' : '').$time.' ';

                $retval .= (($time > 1 && $key !=mois) ? $key.'s' : $key);

                $granularity--;

            }

            if ($granularity == '0')

            {

                break;

            }

        }

    }

    return $retval;      

}

        

$tag_s = array("&lt;p&gt;", "&lt;/p&gt;");

?>                           

                             

                             

                             

                             

                             

<?php include("./requeteur_m_table.php");?>

  



                    </div>



                </div>

