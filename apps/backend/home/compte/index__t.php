<?php 



session_start();





if(!isset($_SESSION['compte_v'])) {  header("Location: ../");	 } 



    require_once dirname(__FILE__) . "/../../../../config/config.php";



//$_SESSION['query_ref_fili'] =" where ref_filiale = '0'  ";



//   echo "$ _SESSION['query_ref_fili'] = ".$_SESSION['query_ref_fili'] ;



//*						 

					 $query_f="select id_offre from offre ".$_SESSION['query_ref_fili']." ";

 // echo "<br>".$query_f; 

					 $result_filiale = mysql_query($query_f);

                            while( $reponse_filiale  = mysql_fetch_array($result_filiale)) {   

                            $id_offre_f .= " '".$reponse_filiale['id_offre']."' ,";

							   } 

							$id_offre_filiale=substr($id_offre_f, 0, -1);

								

							if(empty($id_offre_filiale)){	$id_offre_filiale=0; }	

							

							$_SESSION['query_offre_fili']=" where offre.id_offre in (".$id_offre_filiale.") ";

							$_SESSION['query_offre_fili_and']=" And  offre.id_offre in (".$id_offre_filiale.") ";

				

//*/	

   

   

function couperChaine($chaine, $nbrMotMax) {



    $chaineNouvelle = "";



    $i = 0;



    $t_chaineNouvelle = explode(" ", $chaine);



    foreach ($t_chaineNouvelle as $cle => $mot) {



        if ($cle < $nbrMotMax) {



            $chaineNouvelle .= $mot . " ";

        }



        $i++;

    }



    if ($i <= $nbrMotMax)

        return $chaine;



    else

        return $chaineNouvelle . " ...";

} 

     

	

?>

<?php

				$offres_0 = '';  $offre_id_0 = ''; 

				$candidatures_0 = '';   $candidatur_id = '';    $candidatures_id = ''; 

				

		$sql__0 = "SELECT * FROM roles_tmp where id_role = ". $_SESSION['id_role']."  LIMIT 0 , 1  ";

	   $result__0 = mysql_query($sql__0);

				$row__0 = mysql_fetch_assoc($result__0);

				

				$offres_0 = $row__0['offres'];  

				$candidatures_0 = $row__0['candidatures'];  



if($offres_0 == '1') {				

		$sql_0 = "SELECT * FROM role_offre where id_role = ". $_SESSION['id_role']."  LIMIT 0 , 1  ";

	//	echo $sql_0."<br>";

	   $result_0 = mysql_query($sql_0);

				$row_0 = mysql_fetch_assoc($result_0);

				$offre_id_0 = $row_0['id_offre'];  

				

				$_SESSION['offre_candidatures_0']=" And  candidature.id_offre = ".$offre_id_0." ";

}	



if($candidatures_0 == '1') {				

		$sql_1 = "SELECT * FROM role_candidature where id_role = ". $_SESSION['id_role']."    ";

	//	echo $sql_0."<br>";

	   $result_1 = mysql_query($sql_1); 

				

				  $count = mysql_num_rows($result_1);

				if($count<1){

					echo  ' <tr><td  ><div style="float:right;">Aucunes données trouvez</div></td><td></td><td></td></tr>';}

				else{                     

                        $trcolor='';

                        $oddeven=1;

                            while( $reponse = mysql_fetch_array($result_1)) {   

                            $candidatur_id .= " '".$reponse['id_candidature']."' ,";

							   } 

							$candidatures_id=substr($candidatur_id, 0, -1);

					} 

					

				$_SESSION['offre_candidatures_0']=" And  candidature.id_candidature in (".$candidatures_id.") ";

}



            



$offre_candidatures = (isset($_SESSION['offre_candidatures_0'])) ? $_SESSION['offre_candidatures_0'] : '' ;

				

?> 

<?php	

 

    $sql = mysql_query("select * from offre ");



 $_SESSION['link_bak_a']=0;

 $_SESSION['link_bak_b']=00;

		

 $_SESSION['page_courant_ac']=$_SERVER['REQUEST_URI']; 

 $_SESSION['page_courant ']=$_SERVER['REQUEST_URI'];

 

	 $ariane="Accueil  " ;	

?>