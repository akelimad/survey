



        

<?php

if (isset($_GET['a'])) $_SESSION['rad2']=''; 

if (isset($_POST['radio'])) $_SESSION['rad2']=$_POST['radio'];



    $ck0="checked";     $ck1="";            $ck2="";            $ck3="";            $ck4="";

if (isset($_SESSION['rad2'])) {

    if ($_SESSION['rad2'] == 'off_tous')     {    $ck0="checked";     $ck1="";            $ck2="";            $ck3="";            $ck4="";            }

    if ($_SESSION['rad2'] == 'off_cours')    {    $ck0="";            $ck1="checked";     $ck2="";            $ck3="";            $ck4="";            }

    if ($_SESSION['rad2'] == 'off_archiv')   {    $ck0="";            $ck1="";            $ck2="checked";     $ck3="";            $ck4="";            }

    if ($_SESSION['rad2'] == 'off_stages')   {    $ck0="";            $ck1="";            $ck2="";            $ck3="checked";     $ck4="";            }

    if ($_SESSION['rad2'] == 'off_echeance') {    $ck0="";            $ck1="";            $ck2="";            $ck3="";            $ck4="checked";     }

}

if (isset($_GET['r'])) {

    if ($_GET['r'] == 'c') {    $ck1="checked";     $ck2="";        $ck3="";        $ck4="";        }

    if ($_GET['r'] == 'a') {    $ck1="";        $ck2="checked";     $ck3="";        $ck4="";        }

    if ($_GET['r'] == 's') {    $ck1="";        $ck2="";        $ck3="checked";     $ck4="";        }

    if ($_GET['r'] == 'e') {    $ck1="";        $ck2="";        $ck3="";        $ck4="checked";     }

}

?>  

<form enctype="multipart/form-data" action="" method="post">   



<table>

<tr>

<td>

<input name="radio" type="radio" value="off_tous" <?php echo $ck0; ?> onchange="submit(this.form)"/>Tous:&nbsp;(<?php

                                     $select_encours = mysql_query("select * from offre   ".$q_ref_fili." ");

                                     

                                     $encours = mysql_num_rows($select_encours);

                                     echo $encours;?>)&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>

<td>

<input name="radio" type="radio" value="off_cours" <?php echo $ck1; ?> onchange="submit(this.form)"/>En cours:&nbsp;(<?php

                                     $select_encours = mysql_query("select * from offre where  status = 'En cours'   ".$q_ref_fili_and." ");

                                     $encours = mysql_num_rows($select_encours);

                                     echo $encours;?>)&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>

<td>

<input name="radio" type="radio" value="off_archiv"  <?php echo $ck2; ?> onchange="submit(this.form)"/>Archiv�es:&nbsp;(<?php

                                     $select_archive = mysql_query("select * from offre where  status = 'Archiv�e'   ".$q_ref_fili_and."  ");

                                     $archive = mysql_num_rows($select_archive);

                                     echo $archive;?>)&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>

 

<td>

<input name="radio" type="radio" value="off_echeance" <?php echo $ck4; ?> onchange="submit(this.form)"/>Arrivant � �ch�ance dans moins de 7 jours:&nbsp;(<?php

                                    $select_accept1 = mysql_query("select * from offre where (DATEDIFF(date_expiration,CURDATE())>0 And DATEDIFF(date_expiration,CURDATE())<7)  ".$q_ref_fili_and." ");

                                    $accept1 = mysql_num_rows($select_accept1);

                                    echo $accept1;?>)</td>  

</tr>

</table>

</form>





<!--  ajout du tri � la table des offers  -->

        <table width="100%" border="0" cellspacing="0" id="matching_offres" class="tablesorter" style="background: none;">

    <thead>

          <tr>

           

             

            <th width="6%"  align="center"><b>Actions<b></th>

            <th width="14%"><center><b>Date de publication<b> </center></th>

        

            <th width="30%"><b>Titre<b></th>

            <th width="10%"><b>Filiale</b></th>

            <th width="7%"><b>R�f<b></th>

            <th width="8%"><b>Etat<b></th>

            <th width="4%"><center><b>Vues<b></center></th>

            <th width="8%"><center><b>Candidatures<b></center></th>

			<!---->

            <th width="4%"><center><b>Matching</b></center></th>

			

          </tr>

    </thead>

   <tbody>  

   

          <?php 

        if(isset($_POST['partager']))   

        {

        $objet = "Offre d'emploi de ".$nom_site;

        $headers = 'MIME-Version: 1.0' . "\r\n";

        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

        $headers .= 'From: '.$nom_site.' <'.$admin_email.'>' . "\r\n"; //on d�finit l'exp�diteur

        

        $id_offre = isset($_POST['id_offre'])  ? $_POST['id_offre'] : "";





          foreach($_POST['checkbox'] as $checkbox){

    if(isset($checkbox)){

    

        //* --------------------------   insertion dans la table his_off_partag

        $id_p=$checkbox;

        $sql_partenaire = mysql_query("SELECT * FROM  partenaire where id_parte  = '".$id_p."' ");

        $rep_partenaire = mysql_fetch_assoc($sql_partenaire);

               

            $partenaire = $rep_partenaire['nom'];

            $lien_offre='<a href="'.$site.'offres/index.php?id='.$id_offre.'">'.$site.'offres/index.php?id='.$id_offre.'</a>';

            $email = $rep_partenaire['email'];

            $message = $rep_partenaire['message'];

            // G�n�re : message

                $var = array("{{nom}}", "{{lien}}");

                $replace   = array($partenaire, $lien_offre);

                $new_msg = str_replace($var, $replace, $message);

            

         // INSERT INTO his_off_partag      

                        $date_his_p = date("Y-m-d H:i:s");            

                        

                        mysql_query("INSERT INTO his_off_partag VALUES ('','$id_offre','$id_p','$date_his_p')");    

                        

        // -------------------------    */ 

        

        mail($email, $objet, $new_msg, $headers);

    }

      else { echo 'cochez au moins une case!';  }

    }} 

    if(isset($_POST['envoimessage']))

                    {

            $id_offre = isset($_POST['id_offre'])  ? $_POST['id_offre'] : "";

             $message = isset($_POST['message'])  ? $_POST['message'] : "";

		//$message = htmlentities ($message );

		$message = addslashes ($message );

            $select = mysql_query("select * from message_offre where id_offre = '$id_offre'");

            $reponse = mysql_fetch_array($select);

            $a = mysql_num_rows($select);

        

            if($a)

            {

            mysql_query("UPDATE message_offre SET message = '". safe($message)."'  where id_offre = '$id_offre'");

                $maj = mysql_affected_rows();

                    if($maj > 0)

                    echo '<script type="text/javascript">alert("votre message a �t� modifi� avec succ�s");</script>';

                    }

                    else

                    {   

                        mysql_query("INSERT INTO message_offre VALUES ('','".safe($id_offre)."','".safe($message)."')");

                    

                    echo '<script type="text/javascript">alert("votre message a �t� modifi� avec succ�s");</script>';

            }

                        }

        

            if (isset($_POST['action_offre']))

            {

                $action_offre = $_POST['action_offre'];

                if(isset($_POST['id']))

                {

                    $id = $_POST['id'];

                    if ($action_offre == 'archive')

                    {

                        mysql_query("Update offre Set status = 'Archivée' where id_offre = '$id'");

                        $affected = mysql_affected_rows();

                        if ($affected > 0 )

                            echo '<h3>Offre archiv�e avec succ�s</h3>';

                    }

                    elseif($action_offre == 'desarchive')

                    {

                        mysql_query("Update offre Set status = 'En cours' where id_offre = '$id'");

                        $affected = mysql_affected_rows();

                        if ($affected > 0 )

                            echo '<h3>Offre d�sarchiv�e avec succ�s</h3>';

                    }

                    }

            } 

            if (isset($_POST['action_offre']))

            {

                $action_offre = $_POST['action_offre'];

                if($action_offre == 'supprimer')

                { 

                        mysql_query("DELETE FROM his_off_rol where id_offre = '$id'");

                        mysql_query("DELETE FROM offre where id_offre = '$id'");

                        mysql_query("DELETE FROM campagne_offres where id_offre = '$id'");

                        $affected = mysql_affected_rows();

                            echo '<h3>Suppression avec succ�s</h3>';

                    

                }

            }



//

$ss = 0;

if (isset($_GET['a'])) $_SESSION['rad1']='';

if (isset($_POST['radio'])) $_SESSION['rad1']=$_POST['radio'];

    $ck0="checked";     $ck1="";            $ck2="";            $ck3="";            $ck4="";

if (isset($_SESSION['rad1'])) {

if ($_SESSION['rad1'] == 'off_tous') {

    $ss = $_SESSION['tous'];

}

 if ($_SESSION['rad1'] == 'off_cours') {

$ss = $_SESSION['encours'];

 }

 if ($_SESSION['rad1'] == 'off_archiv') {

$ss = $_SESSION['archive'];

 }

 if ($_SESSION['rad1'] == 'off_stages') {

$ss = $_SESSION['tous'];

 }

if ($_SESSION['rad1'] == 'off_echeance') {

$ss = $_SESSION['accept1'];

}

}

if (isset($_GET['r'])) {

    if ($_GET['r'] == 'c') {

    $ck1="checked";     $ck2="";        $ck3="";        $ck4="";        }

    if ($_GET['r'] == 'a') {

    $ck1="";        $ck2="checked";     $ck3="";        $ck4="";        }

    if ($_GET['r'] == 's') {

    $ck1="";        $ck2="";        $ck3="checked";     $ck4="";        }

    if ($_GET['r'] == 'e') {

    $ck1="";        $ck2="";        $ck3="";        $ck4="checked";     }

}









/* /////////////////////////////////////////////////////////





$nbItems = $ss;













if(isset($_POST["t_p_g"]) and $_POST["t_p_g"]!='')  $_SESSION["i_t_p_g"]=$_POST["t_p_g"];

$itemsParPage = (isset($_SESSION["i_t_p_g"]) and $_SESSION["i_t_p_g"]!='') ?  intval ($_SESSION["i_t_p_g"]) : 10 ;



$nbPages = ceil ( $nbItems / $itemsParPage );

if (! isset ( $_GET ['idPage'] ))

$pageCourante = 1;        

elseif (is_numeric ( $_GET ['idPage'] ) && $_GET ['idPage'] <= $nbPages)

$pageCourante = $_GET ['idPage'];

else

$pageCourante = 1;

// Calcul de la clause LIMIT

$limitstart = $pageCourante * $itemsParPage - $itemsParPage;

//             

            if(isset($_GET['action']))

                $action = $_GET['action'];

            elseif(isset($_POST['action']))

                $action = $_POST['action'];

            else

                $action = '';

            if($action  == "encours")

                $sql = mysql_query("select * from offre where  status = 'En cours'   ".$q_ref_fili_and." ORDER BY date_insertion DESC

                    LIMIT " . $limitstart . ", " . $itemsParPage ."");

            elseif($action == "archive")

                $sql = mysql_query("select * from offre where  status = 'Archiv�e'  ".$q_ref_fili_and."  ORDER BY date_insertion DESC

                    LIMIT " . $limitstart . ", " . $itemsParPage ."");

            else

                $sql = mysql_query("select * from offre   ".$q_ref_fili."  ORDER BY date_insertion DESC

                    LIMIT " . $limitstart . ", " . $itemsParPage ."");

                

	// debut btn radio



	if (isset($_SESSION['rad2']) || isset($_GET['r'])) {

		if ($_SESSION['rad2'] == 'off_cours' || (isset($_GET['r']) and $_GET['r'] == 'c')) {

		$sql = mysql_query("select * from offre where  status = 'En cours'  ".$q_ref_fili_and."  ORDER BY date_insertion DESC

            LIMIT " . $limitstart . ", " . $itemsParPage ."");



		}

		if ($_SESSION['rad2'] == 'off_archiv' || (isset($_GET['r']) and $_GET['r'] == 'a')) {

		$sql = mysql_query("select * from offre where  status = 'Archiv�e'  ".$q_ref_fili_and."  ORDER BY date_insertion DESC

            LIMIT " . $limitstart . ", " . $itemsParPage ."");



		}

		if ($_SESSION['rad2'] == 'off_stages' || (isset($_GET['r']) and $_GET['r'] == 's')) {

		$sql = mysql_query("select * from offre where id_tpost ='4'  ".$q_ref_fili_and."    ORDER BY date_insertion DESC

            LIMIT " . $limitstart . ", " . $itemsParPage ."");



		}

		if ($_SESSION['rad2'] == 'off_echeance' || (isset($_GET['r']) and $_GET['r'] == 'e')) {

		$sql = mysql_query("select * from offre where  (DATEDIFF(date_expiration,CURDATE())>0  And DATEDIFF(date_expiration,CURDATE())<7)  ".$q_ref_fili_and."    ORDER BY date_insertion DESC LIMIT " . $limitstart . ", " . $itemsParPage ."");



		}

	} 

	

	// fin btn radio   



		

            $rows = mysql_num_rows($sql);

            if($rows)

            {

                $ii=1;$j=0;$jj=0;

                while($result = mysql_fetch_array($sql))

                {

       

	   

	   

        

		//////////////////////////////////////////////////////////////////////////////////////*/

		

		



$nbItems = $ss;











/*

if(isset($_POST["t_p_g"]) and $_POST["t_p_g"]!='')  $_SESSION["i_t_p_g"]=$_POST["t_p_g"];



$itemsParPage = (isset($_SESSION["i_t_p_g"]) and $_SESSION["i_t_p_g"]!='') ?  intval ($_SESSION["i_t_p_g"]) : 10 ;



$nbPages = ceil ( $nbItems / $itemsParPage );

if (! isset ( $_GET ['idPage'] ))

$pageCourante = 1;        

elseif (is_numeric ( $_GET ['idPage'] ) && $_GET ['idPage'] <= $nbPages)

$pageCourante = $_GET ['idPage'];

else

$pageCourante = 1;

// Calcul de la clause LIMIT

$limitstart = $pageCourante * $itemsParPage - $itemsParPage;

//                

  //*/

  

  if(isset($_GET['action']))

                $action = $_GET['action'];

            elseif(isset($_POST['action']))

                $action = $_POST['action'];

            else

                $action = '';

            if($action  == "encours")

                $sqll_000 = "select * from offre where  status = 'En cours'   ".$q_ref_fili_and."   ORDER BY date_insertion DESC 

                      " ;

            elseif($action == "archive")

                $sqll_000 = "select * from offre where  status = 'Archiv�e'   ".$q_ref_fili_and."   ORDER BY date_insertion DESC 

                      ";

            else

                $sqll_000 = "select * from offre  ".$q_ref_fili."   ORDER BY date_insertion DESC 

                      ";

 





   

        

// debut btn radio



if (isset($_SESSION['rad1']) || isset($_GET['r'])) {

    if ((isset($_SESSION['rad1']) and $_SESSION['rad1'] == 'off_cours') || (isset($_GET['r']) and $_GET['r'] == 'c')) {

    $sqll_000 = "select * from offre where  status = 'En cours'   ".$q_ref_fili_and."  ORDER BY date_insertion DESC   ";



    }

    if ((isset($_SESSION['rad1']) and $_SESSION['rad1'] == 'off_archiv') || (isset($_GET['r']) and $_GET['r'] == 'a')){

    $sqll_000 = "select * from offre where  status = 'Archiv�e' ".$q_ref_fili_and."   ORDER BY date_insertion DESC   ";



    }

    if ((isset($_SESSION['rad1']) and $_SESSION['rad1'] == 'off_stages') || (isset($_GET['r']) and $_GET['r'] == 's')) {

    $sqll_000 = "select * from offre where id_tpost ='4'  ".$q_ref_fili_and."   ORDER BY date_insertion DESC  ";



    }

    if ((isset($_SESSION['rad1']) and $_SESSION['rad1'] == 'off_echeance') || (isset($_GET['r']) and $_GET['r'] == 'e')){

    $sqll_000 = "select * from offre where  (DATEDIFF(date_expiration,CURDATE())>0  And DATEDIFF(date_expiration,CURDATE())<7 )   ".$q_ref_fili_and."   ORDER BY date_insertion DESC   ";



    }

}



//echo $sqll_000;



$sql = mysql_query($sqll_000);

// fin btn radio 

$rows = mysql_num_rows($sql);

//echo $nbItems;



/////////////   debut pagination

if(isset($_POST["t_p_g"]) and $_POST["t_p_g"]!='')  $_SESSION["i_t_p_g"]=$_POST["t_p_g"];



$select = mysql_query($sqll_000);



$tpc = mysql_num_rows($select);                     

$nbItems = $tpc;

$itemsParPage = (isset($_SESSION["i_t_p_g"]) and $_SESSION["i_t_p_g"]!='') ?  intval ($_SESSION["i_t_p_g"]) : 10 ;

$nbPages = ceil ( $nbItems / $itemsParPage );

if (! isset ( $_GET ['idPage'] ))

$pageCourante = 1;        

elseif (is_numeric ( $_GET ['idPage'] ) && $_GET ['idPage'] <= $nbPages)

$pageCourante = $_GET ['idPage'];

else

$pageCourante = 1;

// Calcul de la clause LIMIT

$limitstart = $pageCourante * $itemsParPage - $itemsParPage;

 //



$sql_pagination=$sqll_000."  LIMIT " . $limitstart . ", " . $itemsParPage ."";

// echo $sql_pagination;

$rst_pagination = mysql_query($sql_pagination);

 



/////////////   fin pagination



$count00 = mysql_num_rows($rst_pagination);    



            if($rows)

            {

                $ii=1;$j=0;$jj=0;

                while($result = mysql_fetch_array($rst_pagination))

                {

        ?>

		

		

          <tr   class="sectiontableentry<?php echo $ii; $ii == 1 ? $ii++ : $ii--; ?>" >

        

              

              

            

              <td valign="top" style="border:1px solid #FFFFFF;" >

                  <table width="100%" border="0" cellspacing="0" >

        <tr>

        <?php

		$id_offre_M = $result['id_offre'];

            $select_M = mysql_query("select * from offre where id_offre = '$id_offre_M'  ".$q_ref_fili_and." ");

            $reponse_M = mysql_fetch_array($select_M);

			/*

            $candition_off =" ( candidats.id_sect=".$reponse_M['id_sect']." and  candidats.id_fonc=".$reponse_M['id_fonc']." and  candidats.id_nfor=".$reponse_M['id_nfor']." )   OR ( candidats.id_sect=".$reponse_M['id_sect']." and  candidats.id_fonc=".$reponse_M['id_fonc']." ) OR (candidats.id_fonc=".$reponse_M['id_fonc']." and  candidats.id_nfor=".$reponse_M['id_nfor'].") OR ( candidats.id_sect=".$reponse_M['id_sect']." and  candidats.id_nfor=".$reponse_M['id_nfor']." ) ";

			

			inner join candidature on candidats.candidats_id = candidature.candidats_id 

			 group by candidats.candidats_id  ORDER BY  STR_TO_DATE( replace( candidature.date_candidature, '/', '-' ) , '%d-%m-%Y' ) DESC 

			//*/

			/*

            $candition_off ="  ( ( candidats.id_expe=".$reponse_M['id_expe']." ) 

                OR ( candidats.id_nfor=".$reponse_M['id_nfor']." ) 

                OR  (   candidats.id_fonc=".$reponse_M['id_fonc']."   ) )";

			

            $query_M="select candidats.candidats_id from candidats   where candidats.candidats_id NOT IN ( SELECT candidats_id FROM candidature WHERE candidats_id IS NOT NULL) and ( ".$candition_off."  ) limit 0,1 ";

		*/

        $ref_pertinence = mysql_query("SELECT min_p_a FROM prm_pertinence WHERE ref_p = 'm' limit 0,1");

        $prm_p_candidat = mysql_fetch_array($ref_pertinence);

					/*

        $query_M="  SELECT candidats.candidats_id 

					FROM candidats ,pertinence_oc 

					WHERE  candidats.candidats_id=pertinence_oc.candidats_id 

							and  pertinence_oc.id_offre=".$id_offre_M." 

							and pertinence_oc.total_p>".$prm_p_candidat['min_p_a']."

							and pertinence_oc.ref_p LIKE  'm'

					ORDER BY LPAD(pertinence_oc.total_p, 20, '0') DESC ";

					*/

        $query_M=" SELECT c.candidats_id FROM candidats c ,offre o WHERE o.id_expe=c.id_expe and o.id_fonc=c.id_fonc and o.id_nfor=c.id_nfor and o.id_localisation=(SELECT id_vill FROM prm_villes 

					WHERE ville=c.ville limit 0,1) and o.id_offre=".$id_offre_M." and c.candidats_id not in (SELECT candidats_id FROM candidature WHERE id_offre=".$id_offre_M." ) ";

			 //echo '<br>'.$query_M;

			

			$req  =  mysql_query($query_M);

			$cc_matching = mysql_num_rows($req);

			$info_entr = ($cc_matching>0) ? 'color:#090' : 'color:#FF0016' ;

			

		?>

        <tr>

        

        

            <td valign="top" width="20px" width="16%" style="border:0px solid #FFFFFF;">

            <form action="<?php echo $urlad_offr;?>/consulter_offre/" method="post" name="formulaire<?php echo ++$jj; ?>">

                <input name="id" type="hidden" value="<?php echo $result['id_offre'];?>" />

                <input name="action_offre" type="hidden" value="view" />

                <input name="action" type="hidden" value="<?php echo $action;?>" />

                <a href="<?php echo $urlad_offr;?>/consulter_offre/?offre=<?php echo $result['id_offre'] ?>" onclick="formulaire<?php echo $jj; ?>.submit()" title="Voir l�offre "> 

                <i class="fa fa-search fa-fw fa-lg"></i></a>&nbsp;  

             </form>

            </td>

            

        

            <td valign="top" width="20px" width="16%" style="border:1px ;">

            <form action="<?php echo $urlad_offr;?>/matching_offre/offre_matching_statique_candidats/" method="post" name="formulaire<?php echo ++$jj; ?>">

                <input name="id" type="hidden" value="<?php echo $result['id_offre'];?>" />

                <input name="action_offre" type="hidden" value="view" />

                <input name="action" type="hidden" value="<?php echo $action;?>" />

                <a href="<?php echo $urlad_offr;?>/matching_offre/offre_matching_statique_candidats/?offre=<?php echo $result['id_offre'] ?>" onclick="formulaire<?php echo $jj; ?>.submit()" 

                title="Matching || La liste des candidatures"> 

                <i class="fa fa-user fa-fw fa-lg" style="<?php echo $info_entr;?> "></i></a>&nbsp;  

             </form>

            </td>

            

            

           



        </tr>

                  </table>

              </td>

              

            

              

              

              

              

            <td valign="top" style="border:1px solid #FFFFFF;">

            <?php echo "<center>".date("d.m.Y",strtotime($result['date_insertion']))."</center>";?> </td>

        

        

        

        

            <td valign="top" style="border:1px solid #FFFFFF;">

            

            

            

            <?php ///////////////////////////////////////////////// ?>

            <table><tr>

            <td width="25%"> 

                            

                            <a href="<?php echo $urlad_offr;?>/consulter_offre/?offre=<?php echo $result['id_offre']; ?>" class="info" >



                                        <?php echo $result['Name'];?>



                                                    <i class="fa fa-external-link"></i>  <span  style="width:400px;padding:6px;margin-top:-120px;margin-left:100px;">



            

 

                <strong>Historique des publications </strong> :

                                        <?php 

                                        $historique = mysql_query("SELECT * from his_off_rol where id_offre = '".$result['id_offre']."' ORDER BY date_action DESC");

                                        $cpt = mysql_num_rows($historique);

                                        if($cpt)

                                        {

                                        echo '<div> <table width="100%" >';

                                        echo '<tr style=" background-color: #ededed; "><td width="30%">Date</td><td width="30%">Etat</td><td width="40%">Utilisateur</td></tr>';



                                        while($data = mysql_fetch_array($historique))

                                        {

                                            $sql_role1 = mysql_query("SELECT * FROM  root_roles where id_role = '".$data['id_role']."' ");

                                            $rep_role1 = mysql_fetch_assoc($sql_role1);

                                          $date = $data['date_action'];

                                          $etat = $data['action'];

                                          $user = $rep_role1['nom'];    

                                        ?>

                                                          <tr style="background-color: #F4F5CC;"><td><?php echo date('d-m-Y H:i',strtotime($date)); ?></td><td><?php echo $etat; ?></td><td><?php echo $user; ?></td></tr>

                                                          <?php 

                                        }

                                        echo '</table></div> <br/>';

                                        }

                                        else

                                        {echo '<br>Aucune donn�e<br>';}

                                        ?>

                                        

                                                          



                      <strong>Historique des partages </strong> :

                                        <?php 

                                        $historique2 = mysql_query("SELECT * from his_off_partag where id_offre = '".$result['id_offre']."' ORDER BY date_envoi DESC");

                                        $cpt2 = mysql_num_rows($historique2);

                                        if($cpt2)

                                        {

                                        echo '<div> <table width="100%" >';

                                        echo '<tr><td width="30%">Date</td><td width="30%">Type</td><td width="40%">Nom</td></tr>';



                                        while($data2 = mysql_fetch_array($historique2))

                                        {

                                            $sql_p1 = mysql_query("SELECT * FROM  partenaire where id_parte = '".$data2['id_parte']."' ");

                                            $rep_p1 = mysql_fetch_assoc($sql_p1);

                                          $date = $data2['date_envoi'];

                                          $Type = $rep_p1['id_tparte'];

                                          $Nom = $rep_p1['nom'];    

                                        ?>

                                                          <tr><td><?php echo date('d-m-Y H:i',strtotime($date)); ?></td><td><?php echo $Type; ?></td><td><?php echo $Nom; ?></td></tr>

                                                          <?php 

                                        }

                                        echo '</table></div> <br/>';

                                        }

                                        else

                                        {echo '<br>Aucune donn�e<br>';}

                                        ?>

                                        



                            </a></td>

              

            <?php ///////////////////////////////////////////////// ?>

            </tr></table>

            </td>

            

            

            

            

            <td valign="top" style="border:1px solid #FFFFFF;">

            <?php 

$sql_test= "select * from per_filiale where  ref_filiale = '".$result['ref_filiale']."' ";

$requete_test= mysql_query($sql_test);

$result_test = mysql_fetch_array($requete_test);

$nom_filiale = $result_test['nom_filiale'];

            echo $nom_filiale; ?></td>

            <td valign="top" style="border:1px solid #FFFFFF;"><?php echo $result['reference']; ?></td>

            <td valign="top" style="border:1px solid #FFFFFF;"><?php 

          if($result['status'] == 'En cours') 

            echo '<font style="color:#009900 ;" >'.$result['status'].'</font>';

          else

            echo '<font style="color:#FF0000 ;">'.$result['status'].'</font>';

          ?>

            </td>

            <td align="center" valign="top" style="border:1px solid #FFFFFF;"><?php if(empty($result['vue'])) echo 0; else echo $result['vue'];?></td>

            <td align="center" valign="top" style="border:1px solid #FFFFFF;"><?php 

          $select_candidature = mysql_query("SELECT * from candidature

          inner join candidats on candidats.candidats_id = candidature.candidats_id  

      inner join notation_1 on notation_1.id_candidature = candidature.id_candidature 

            where candidature.id_offre = '".$result['id_offre']."'");

$select_candidature1 = $select_candidature;

          $count = mysql_num_rows($select_candidature);

          if($count)

          {

          echo '<form action="'.$_SERVER['REQUEST_URI'].'" method="post" name="form'.$j.'">'; 

            echo  "<b style='color:#911B1B'>".$count."</b>" ;

          echo '</form>';

          }

          else

          echo '0';

          ?>

            </td>

			<!---->

            <td>

                <?php

					echo "<center><b style='color:#204514'>".$cc_matching."</b></center>";

                ?>

            </td>

			

          </tr>

          <?php

            $j++;

                          

                }

            }

            else

            {

        ?>

          <tr>

            <td colspan="11" align="center" class="sectiontableentry2" style="border:1px solid #FFFFFF;"> Aucune offre disponible</td>

          </tr>

          <?php

            }

            ?>

</tbody>

        </table> 

        

        <?php 

        if(isset($action_offre) and $action_offre == 'relancer')

                    {

                                $id_offre = isset($_POST['id'])  ? $_POST['id'] : "";

            $select = mysql_query("select * from offre where id_offre = '$id_offre'  ".$q_ref_fili_and." ");

            $reponse = mysql_fetch_array($select);

        ?>

        

         

    <div class="subscription" style="margin: 10px 0pt;">

                  <h1>Personnalisation du message envoy� aux candidats postulant</h1>

                </div>    <form method="post" action="<?php echo($_SERVER['REQUEST_URI']); ?>">

         <table>

            <tr>

              <td width="25%">Intitulé de l'offre <font style="color:#FF0000 ;">*</font></td>

              <td width="75%"><?php echo '<input type="text" name="intitule" style="width:534px" value="'.$reponse['Name'].'" readonly="readonly"/>'; ?>

                <input name="id_offre" type="hidden" value="<?php echo $id_offre; ?>" />

              </td>

            </tr>

            <tr>

              <td width="25%">Date de publication </td>

              <td width="75%"><span style="color:#000000;font-weight:normal"><?php echo $reponse['date_insertion']; ?></span></td>

            </tr>

         

         <tr>

             <td valign="top">Message personnalis� <font style="color:#FF0000 ;">*</font></td>

             

        <?php 

            $select1 = mysql_query("select * from message_offre where id_offre = '$id_offre'");

$reponse1 = mysql_fetch_array($select1);

            $a = mysql_num_rows($select1);

if($a)

$details=$reponse1['message'];

else

        $details="Bonjour,<br/>

Nous vous remercions d'avoir postuler � l'offre : ".$reponse['Name'].".<br/>

Sans r�ponse de notre part dans un d�lai de 30 jours, vous pourrez consid�rer que votre candidature n'a pas �t� retenue pour le poste demand�.

Cordialement." ;

?>

              <td><textarea name="message" id="editor1"><?php echo stripslashes($details); ?></textarea>

                <script type="text/javascript">

                CKEDITOR.replace( 'editor1',

                {

                enterMode : CKEDITOR.ENTER_DIV,

                entities: false,

                entities_additional : '',

                toolbar : 'Basic',

                resize_enabled : false

                });

            </script>

              </td>

        </tr>

        <tr>

        <td>

        </td>

        <td>

        <input name="envoimessage" type="submit" value="Valider" style="width:100px" />

                  <input name="reset" type="reset" style="width:100px"/>

               </td>

        </tr>

        </table>

        <?php

            }  ?>

			

			</form>

			

	



    <div class="pagination">

			 

			<?php 	if( $count00>10  or $nbPages>1 ) { ?>

			<div style="  float: left;" >

				<form id="frm" method='post' >

					<select onchange="this.form.submit()" name="t_p_g"  style="width: 50px; margin-right: 20px;" >

						<option value="10"  <?php if(isset($_SESSION["i_t_p_g"]) and $_SESSION["i_t_p_g"]=='10')  echo "selected"; ?> >10 </option>

						<option value="20"  <?php if(isset($_SESSION["i_t_p_g"]) and $_SESSION["i_t_p_g"]=='20')  echo "selected"; ?> >20 </option>

						<option value="30"  <?php if(isset($_SESSION["i_t_p_g"]) and $_SESSION["i_t_p_g"]=='30')  echo "selected"; ?> >30 </option>

						<option value="40"  <?php if(isset($_SESSION["i_t_p_g"]) and $_SESSION["i_t_p_g"]=='40')  echo "selected"; ?> >40 </option>

						<option value="50"  <?php if(isset($_SESSION["i_t_p_g"]) and $_SESSION["i_t_p_g"]=='50')  echo "selected"; ?> >50 </option>

						<option value="100" <?php if(isset($_SESSION["i_t_p_g"]) and $_SESSION["i_t_p_g"]=='100') echo "selected"; ?> >100</option>

			<option value="99999" <?php if(isset($_SESSION["i_t_p_g"]) and $_SESSION["i_t_p_g"]=='99999') echo "selected"; ?> >Tous</option>	

					 </select>

				</form>

			</div>

			<?php 	} ?>

           

			<div id="">

					<?php        

					$lapage = '?';

					

					require_once (dirname ( __FILE__ ) . $incurl3.'/class.pagination2.php');

					Pagination::affiche ( $lapage, 'idPage', $nbPages, $pageCourante, 2 ); 

					?>

			</div>

    </div>



		



