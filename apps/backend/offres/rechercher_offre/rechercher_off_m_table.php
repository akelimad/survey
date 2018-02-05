

<table width="100%" border="0" cellspacing="0" id="rechercher_offres" class="tablesorter" style="background: none;">

 <thead>

          <tr> 

             

            <th width="10%"  align="center"><b>Actions</b></th>

            <th width="14%"><center><b>Date de publication</b> </center></th>

        

            <th width="30%"><b>Titre</b></th>

            <th width="15%"><b>Filiale</b></th>

            <th width="7%"><b>Réf</b></th>

            <th width="8%"><b>Etat</b></th>

            <th width="4%"><center><b>Vues</b></center></th>

            <th width="8%"><center><b>Candidatures</b></center></th>

          </tr>

    </thead>

   <tbody>  

   

          <?php 

        if(isset($_POST['partager']))   

        {

        $objet = "Offre d'emploi de ".$nom_site;

        $headers = 'MIME-Version: 1.0' . "\r\n";

        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

        $headers .= 'From: '.$nom_site.' <'.$admin_email.'>' . "\r\n"; //on définit l'expéditeur

        

        $id_offre = isset($_POST['id_offre'])  ? $_POST['id_offre'] : "";





          foreach($_POST['checkbox'] as $checkbox){

    if(isset($checkbox)){

    

        //* --------------------------   insertion dans la table his_off_partag

        $id_p=$checkbox;

        $sql_partenaire = mysql_query("SELECT * FROM  partenaire where id_parte = '".$id_p."' ");

        $rep_partenaire = mysql_fetch_assoc($sql_partenaire);

               

            $partenaire = $rep_partenaire['nom'];

            $lien_offre='<a href="'.$site.'offres/index.php?id='.$id_offre.'">'.$site.'offres/index.php?id='.$id_offre.'</a>';

            $email = $rep_partenaire['email'];

            $message = $rep_partenaire['message'];

            // Génère : message

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

                            echo '<h3>Offre publiée avec succés</h3>';

                        include('../offres_alerts.php');

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

            

            if(isset($_POST['action']))

                $action = $_POST['action'];

            elseif(isset($_POST['action']))

                $action = $_POST['action'];

            else

                $action = '';

            if($action  == "encours")

                $sql = mysql_query("select * from offre where  status = 'En cours'  ".$q_ref_fili_and." ORDER BY date_insertion DESC");

            elseif($action == "archive")

                $sql = mysql_query("select * from offre where  status = 'Archivée'  ".$q_ref_fili_and." ORDER BY date_insertion DESC");

            else

                $sql = mysql_query("select * from offre  ".$q_ref_fili."  ORDER BY date_insertion DESC");

 



//  ###########################################################



                            





$requete = "";







if (!empty($_SESSION['offre'])) {

if (empty($requete))

        $requete .= "offre.reference = '" . $_SESSION['offre'] . "'";

else

        $requete .= "And offre.reference = '" . $_SESSION['offre'] . "'";

}



if (!empty($_SESSION['intPoste'])) {

if (empty($requete))

        $requete .= "offre.Name = '" . $_SESSION['intPoste'] . "'";

else

        $requete .= "And offre.Name = '" . $_SESSION['intPoste'] . "'";

}



if (!empty($_SESSION['poste'])) {

if (empty($requete))

        $requete .= "offre.id_tpost = '" . $_SESSION['poste'] . "'";

else

        $requete .= "And offre.id_tpost = '" . $_SESSION['poste'] . "'";

}



if (!empty($_SESSION['statut'])) {

if (empty($requete))

        $requete .= "offre.status = '" . $_SESSION['statut'] . "'";

else

        $requete .= "And offre.status = '" . $_SESSION['statut'] . "'";

}



if (!empty($_SESSION['lieu'])) {

if (empty($requete))

        $requete .= "offre.id_localisation = '" . $_SESSION['lieu'] . "'";

else

        $requete .= "And offre.id_localisation = '" . $_SESSION['lieu'] . "'";

}



if (!empty($_SESSION['motcle'])) {

if (empty($requete))

        $requete .= "lower(concat_ws(' ',offre.reference,offre.Name,offre.status,offre.id_tpost,offre.id_localisation )) like lower('%" . $_SESSION['motcle'] . "%')";

else

        $requete .= "And lower(concat_ws(' ',offre.reference,offre.Name,offre.status,offre.id_tpost,offre.id_localisation )) like lower('%" . $_SESSION['motcle'] . "%')";

}

/////////////

if(isset($_POST["t_p_g"]) and $_POST["t_p_g"]!='')  $_SESSION["i_t_p_g"]=$_POST["t_p_g"];

////

if( (isset($_SESSION['p_envoi'])) AND $_SESSION['p_envoi']!='' AND (!empty($requete)) ){

$sql25 = mysql_query("select * from offre where " . $requete . "   ".$q_ref_fili_and." ORDER BY date_insertion DESC");

}else{

$sql25 = mysql_query("select * from offre  ".$q_ref_fili." ORDER BY date_insertion DESC");

}

$rows = mysql_num_rows($sql25);

$nbItems = $rows;

$itemsParPage = (isset($_SESSION["i_t_p_g"]) and $_SESSION["i_t_p_g"]!='') ?  intval ($_SESSION["i_t_p_g"]) : 10 ;

/*$itemsParPage = 10;*/

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



$selectString = "select * from offre  ".$q_ref_fili." ORDER BY date_insertion DESC

LIMIT " . $limitstart . ", " . $itemsParPage ."";





if( (isset($_SESSION['p_envoi'])) AND $_SESSION['p_envoi']!='' AND (!empty($requete)) ){



$selectString = "select * from offre where " . $requete . "   ".$q_ref_fili_and." ORDER BY date_insertion DESC

LIMIT " . $limitstart . ", " . $itemsParPage ."";



}





//echo $selectString;



    $sql = mysql_query($selectString);

//  ###########################################################



            $rows = mysql_num_rows($sql);

            if($rows)

            {

                $ii=1;$j=0;$jj=0;

                while($result = mysql_fetch_array($sql))

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

            

            

            

            <td valign="top" width="20px" style="border:0px solid #FFFFFF;">

            <form action="<?php echo $urlad_offr;?>/modifier_offre/" method="post" name="formulaire<?php echo ++$jj; ?>">

                <input name="id" type="hidden" value="<?php echo $result['id_offre'];?>" />

                <input name="action_offre" type="hidden" value="edit" />

                <input name="action" type="hidden" value="<?php echo $action;?>" />

                <a href="javascript:void(0)" onclick="formulaire<?php echo $jj; ?>.submit()" title="Modifier">

                  <i class="fa fa-pencil-square-o fa-fw fa-lg"></i>

                  </a>&nbsp;

              </form>

            </td>

            

                <td valign="top" width="20px" style="border:0px solid #FFFFFF;">

                <form action="" method="post" name="formulaire<?php echo ++$jj; ?>">

                <input name="id" type="hidden" value="<?php echo $result['id_offre'];?>" />

                <input name="action_offre" type="hidden" value="supprimer" />

                <input name="action" type="hidden" value="<?php echo $action;?>" />

                <a href="javascript:void(0)" onclick="if(confirm('Êtes-vous sûre de vouloir Supprimer cette offre?')) formulaire<?php echo $jj; ?>.submit()" title="Supprimer">

                 <i class="fa fa-trash-o fa-fw fa-lg" style="color:#DB1212;"></i>

                 </a>&nbsp;

              </form>



            </td>

            

            <td valign="top"   width="20px" style="border:0px solid #FFFFFF;">

            <form action="" method="post" name="formulaire<?php echo ++$jj; ?>">

                <input name="id" type="hidden" value="<?php echo $result['id_offre'];?>" />

                <input name="action" type="hidden" value="<?php echo $action;?>" />

                <?php 

      if($result['status'] == 'En cours')

      {

      ?>

                <input name="action_offre" type="hidden" value="archive" />

                <a href="javascript:void(0)" onclick="if(confirm('Êtes-vous sûre de vouloir Archivée  cette offre?')) formulaire<?php echo $jj; ?>.submit()" title="ARCHIVER"> 

                <i class="fa fa-unlock fa-fw fa-lg" style="color:#419900;"></i></a>

                <?php 

      }

      elseif($result['status'] == 'Archivée')

      {

      ?>

                <input name="action_offre" type="hidden" value="desarchive" />

                <a href="javascript:void(0)" onclick="if(confirm('Êtes-vous sûre de vouloir publier cette offre?')) formulaire<?php echo $jj; ?>.submit()" title="PUBLIER"> 

                <i class="fa fa-lock fa-fw fa-lg" style="color:#DB1212;"></i></a>

                <?php 

      }

      ?>

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

            

                        <!--<a href="<?php $pos1 = strpos($url44, '?');  if($pos1) echo $url44.'&'; else echo $url44.'?'; ?>cc=<?php echo $return['id_candidature']; ?>" class="info" >-->

                            

                            <a href="<?php echo $urlad_offr;?>/consulter_offre/?offre=<?php echo $result['id_offre']; ?>" class="info" >



                                        <?php echo $result['Name'];?>



                                                   <i class="fa fa-external-link"></i> <span  style="width:400px;padding:6px;margin-top:-120px;margin-left:100px;">



             

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

                                        {echo '<br>Aucune donnée<br>';}

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

            echo  $count ;

          echo '</form>';

          }

          else

          echo '0';

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

<div <?php  if($nbPages>1) echo 'style="float:left"'; ?>>

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

  <div class="pagination">

         <?php        

            $lapage = '?';

            

            require_once (dirname ( __FILE__ ) . $incurl2.'/class.pagination2.php');

            

            Pagination::affiche ( $lapage, 'idPage', $nbPages, $pageCourante, 2 );

            

            ?>

    </div>