



        

<?php

if (isset($_GET['a'])) $_SESSION['rad']=''; 

if (isset($_POST['radio'])) $_SESSION['rad']=$_POST['radio'];

    $ck0="checked";     $ck1="";            $ck2="";            $ck3="";            $ck4="";

if (isset($_SESSION['rad'])) {

    if ($_SESSION['rad'] == 'off_tous') {

    $ck0="checked";     $ck1="";            $ck2="";            $ck3="";            $ck4="";            }

    if ($_SESSION['rad'] == 'off_cours') {

    $ck0="";            $ck1="checked";     $ck2="";            $ck3="";            $ck4="";            }

    if ($_SESSION['rad'] == 'off_archiv') {

    $ck0="";            $ck1="";            $ck2="checked";     $ck3="";            $ck4="";            }

    if ($_SESSION['rad'] == 'off_stages') {

    $ck0="";            $ck1="";            $ck2="";            $ck3="checked";     $ck4="";            }

    if ($_SESSION['rad'] == 'off_echeance') {

    $ck0="";            $ck1="";            $ck2="";            $ck3="";            $ck4="checked";     }

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

?>       



<form enctype="multipart/form-data" action="" method="post"> 

<table>

<tr>

<td>

<input name="radio" type="radio" value="off_tous" <?php echo $ck0; ?> onchange="submit(this.form)"/>Tous:&nbsp;(<?php

                                     $select_encours = mysql_query("select * from offre  ".$q_ref_fili."  ");

                                     $encours = mysql_num_rows($select_encours);

                                     echo $encours;?>)&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>

<td>

<input name="radio" type="radio" value="off_cours" <?php echo $ck1; ?> onchange="submit(this.form)"/>En cours:&nbsp;(<?php

                                     $select_encours = mysql_query("select * from offre where  status = 'En cours'  ".$q_ref_fili_and."   ");

                                     $encours = mysql_num_rows($select_encours);

                                     echo $encours;?>)&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>

<td>

<input name="radio" type="radio" value="off_archiv"  <?php echo $ck2; ?> onchange="submit(this.form)"/>Archivées:&nbsp;(<?php

                                     $select_archive = mysql_query("select * from offre where  status = 'Archivée'   ".$q_ref_fili_and."   ");

                                     $archive = mysql_num_rows($select_archive);

                                     echo $archive;?>)&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>



<td>

<input name="radio" type="radio" value="off_echeance" <?php echo $ck4; ?> onchange="submit(this.form)"/>Arrivant à échéance dans moins de 7 jours:&nbsp;(<?php

                                    $select_accept1 = mysql_query("select * from offre where (DATEDIFF(date_expiration,CURDATE())>0 And DATEDIFF(date_expiration,CURDATE())<7) ".$q_ref_fili_and."  ");

                                    $accept1 = mysql_num_rows($select_accept1);

                                    echo $accept1;?>)</td>  

</tr>

</table>

</form>





<!--  ajout du tri à la table des offers  -->

<table width="100%" border="0" cellspacing="0" id="partage_offres" class="tablesorter" style="background: none;">

    <thead>

          <tr>

              

              

             

            <th width="6%"  align="center"><b>Actions</b></th>

            <th width="12%"><center><b>Date de publication</b></center> </th>

        

            <th width="30%"><b>Titre</b></th>

            <th width="15%"><b>Filiale</b></th>

            <th width="5%"><b>Réf.</b></th>

            <th width="8%"><b>Etat</b></th>

            <th width="5%"><b>Vues</b></th>

          </tr>

    </thead>

   <tbody>  

   

          <?php 

		  

    if(!empty($_POST['checkbox']))

			include("./partage_off_m_email_1.php");

	

	

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

                    echo '<script type="text/javascript">alert("votre message a été modifié avec succès");</script>';

                    }

                    else

                    {   

                        mysql_query("INSERT INTO message_offre VALUES ('','".safe($id_offre)."','".safe($message)."')");

                    

                    echo '<script type="text/javascript">alert("votre message a été modifié avec succès");</script>';

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

                            echo '<h3>Offre archivée avec succés</h3>';

                    }

                    elseif($action_offre == 'desarchive')

                    {

                        mysql_query("Update offre Set status = 'En cours' where id_offre = '$id'");

                        $affected = mysql_affected_rows();

                        if ($affected > 0 )

                            echo '<h3>Offre désarchivée avec succés</h3>';

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

                            echo '<h3>Suppression avec succés</h3>';

                    

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







/* /////////////////////////////////////////////////////////////////





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

                $sql = mysql_query("select * from offre where  status = 'En cours'  ".$q_ref_fili_and."   ORDER BY date_insertion DESC

                    LIMIT " . $limitstart . ", " . $itemsParPage ."");

            elseif($action == "archive")

                $sql = mysql_query("select * from offre where  status = 'Archivée'  ".$q_ref_fili_and."   ORDER BY date_insertion DESC

                    LIMIT " . $limitstart . ", " . $itemsParPage ."");

            else

                $sql = mysql_query("select * from offre   ".$q_ref_fili."   ORDER BY date_insertion DESC

                    LIMIT " . $limitstart . ", " . $itemsParPage ."");

                

// debut btn radio



if (isset($_SESSION['rad']) || isset($_GET['r'])) {

    if ($_SESSION['rad'] == 'off_cours' || (isset($_GET['r']) and $_GET['r'] == 'c')) {

    $sql = mysql_query("select * from offre where  status = 'En cours'  ".$q_ref_fili_and."   ORDER BY date_insertion DESC

        LIMIT " . $limitstart . ", " . $itemsParPage ."");



    }

    if ($_SESSION['rad'] == 'off_archiv' || (isset($_GET['r']) and $_GET['r'] == 'a')){

    $sql = mysql_query("select * from offre where  status = 'Archivée'  ".$q_ref_fili_and."   ORDER BY date_insertion DESC

        LIMIT " . $limitstart . ", " . $itemsParPage ."");



    }

    if ($_SESSION['rad'] == 'off_stages' || (isset($_GET['r']) and $_GET['r'] == 's')){

    $sql = mysql_query("select * from offre where id_tpost ='4'   ".$q_ref_fili_and."    ORDER BY date_insertion DESC

        LIMIT " . $limitstart . ", " . $itemsParPage ."");



    }

    if ($_SESSION['rad'] == 'off_echeance' || (isset($_GET['r']) and $_GET['r'] == 'e')){

    $sql = mysql_query("select * from offre where  (DATEDIFF(date_expiration,CURDATE())>0  And DATEDIFF(date_expiration,CURDATE())<7)   ".$q_ref_fili_and."     ORDER BY date_insertion DESC LIMIT " . $limitstart . ", " . $itemsParPage ."");



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

                $sqll_000 = "select * from offre where  status = 'Archivée'   ".$q_ref_fili_and."   ORDER BY date_insertion DESC 

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

    $sqll_000 = "select * from offre where  status = 'Archivée' ".$q_ref_fili_and."   ORDER BY date_insertion DESC   ";



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

        

            <td valign="top" width="20px" width="16%" style="border:0px solid #FFFFFF;">

            <form action="<?php echo $urlad_offr;?>/consulter_offre/" method="post" name="formulaire<?php echo ++$jj; ?>">

                <input name="id" type="hidden" value="<?php echo $result['id_offre'];?>" />

                <input name="action_offre" type="hidden" value="view" />

                <input name="action" type="hidden" value="<?php echo $action;?>" />

                <a href="<?php echo $urlad_offr;?>/consulter_offre/?offre=<?php echo $result['id_offre'] ?>" onclick="formulaire<?php echo $jj; ?>.submit()" title="Voir l’offre "> 

                 <i class="fa fa-search fa-fw fa-lg"></i></a>&nbsp;  

             </form>

            </td>

            

            

                <td valign="top"  width="20px" style="border:1px solid #FFFFFF;">

                <form action="<?php echo  $_SERVER['REQUEST_URI'] ?>" method="post" name="formulaire<?php echo ++$jj; ?>">

                <input name="id" type="hidden" value="<?php echo $result['id_offre'];?>" />

                <input name="action_offre" type="hidden" value="partager" />

                <input name="action" type="hidden" value="<?php echo $action;?>" />

                <a href="javascript:void(0)" onclick="return showSharePopup(<?=$result['id_offre']; ?>)" title="Partager"><i class="fa fa-exchange fa-fw fa-lg"></i></a>

                <!-- <a href="javascript:void(0)" onclick="formulaire<?php //echo $jj; ?>.submit()" title="Partager">

                 <i class="fa fa-exchange fa-fw fa-lg"></i></a>&nbsp; -->

              </form>



            </td>

            

        </tr>

                  </table>

              </td> 

              

              

            <td valign="top" style="border:1px solid #FFFFFF;"><center>

            <?php echo date("d.m.Y",strtotime($result['date_insertion']));?></center> </td>

        

         

            <td valign="top" style="border:1px solid #FFFFFF;">

             

            

            <?php ///////////////////////////////////////////////// ?>

            <table><tr>

            <td width="25%"> 

                            

                            <a href="?offre=<?php echo $result['id_offre']; ?>" class="info" >



                                        <?php echo $result['Name'];?>



                               <i class="fa fa-external-link"></i> <span  style="width:400px;padding:6px;margin-top:-120px;margin-left:100px;">



             

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

                                        {echo '<br>Aucune donnée<br>';}

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

					

					require_once (dirname ( __FILE__ ) . $incurl2.'/class.pagination2.php');

					Pagination::affiche ( $lapage, 'idPage', $nbPages, $pageCourante, 2 ); 

					?>

			</div>

    </div>



