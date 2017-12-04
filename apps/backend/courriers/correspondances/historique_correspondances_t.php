<?php



session_start();

if(isset($_SESSION['compte_v'])) {  header("Location: ../../compte/");  } 

if (!isset($_SESSION["abb_admin"]) || $_SESSION["abb_admin"] == "") {

    header("Location: ../../login/");

}  

 

require_once dirname(__FILE__) . "/../../../../config/config.php";

 

    $sql = mysql_query("select * from offre ");



    

function switchdate($var) 

{ 

$tab = explode("/",$var); 

$datechangee = $tab[2]."-".$tab[1]."-".$tab[0]; 

return $datechangee ; 

} 









        $popup_div="";

        if(isset($_POST['email_tt'])){

        

        $result_unique =  array_keys(array_flip($_POST['select'])); 

        

        

                                            

    $cama='' ;

    $txt_area="";

            for ($i = 0; $i < count($result_unique); $i++){     if($i!=0) $cama=', ' ;      

            $txt_area.=$cama.$result_unique[$i];            

            } 

            

    $sql_delete = mysql_query("DELETE from corespondances WHERE id IN (".$txt_area.") ");

    

        

        $popup_div='    <script type="text/javascript">  alert("Suppression avec succès!"); </script> ';

        

        }

        

        

 $_SESSION['link_bak_a']=5;

 $_SESSION['link_bak_b']=56; 

    

  $nom_page_site ="HISTORIQUES DES CORRESPONDANCES"  ;

 

  

$ariane=" Courriers > Historiques des corespondances "; 

?>