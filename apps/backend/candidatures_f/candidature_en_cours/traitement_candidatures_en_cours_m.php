    <div class='texte'>

      <br/>

      <h1>TRAITEMENT DES CANDIDATURES EN COURS </h1>

<?php

 

echo '<table> <tr class="odd">

                  <td><b>Nombre des candidatures en cours : </b></td>';

                  if ($tpc)

          {echo '<td><span class="badge badge-success">'.$tpc.'</span></td>';}

          else{echo '<td><span class="badge badge-error">0</span></td>';}

          echo '</tr></table>';

	

?>

<?php   

    if(isset($_POST['select']))

    { 



        $affected = 0;

 

        if(isset($_POST['email_tt'])){

        $result_unique =  array_keys(array_flip($_POST['select']));     



        $popup_div='

                         <style>    

                        /*********Popup*************/

                        .popup_block{overflow:auto;position:fixed;_position:absolute; /* hack for internet explorer 6*/ background-color:#fff;-moz-border-radius-topleft:10px;-moz-border-radius-topright:10px;top:200px;left:200px;z-index:999;}

                        .popup_block .titleBar{margin:0;height:25px; -moz-border-radius-topleft:10px;-moz-border-radius-topright:10px;}

                        .popup_block .footerBar{margin-right:20px;margin-left:20px;margin-bottom:4px;}

                        .popup_block .title{height:25px;float:left;font-size:12px;font-weight:700;margin-left:20px;margin-top:1px;  line-height:23px;text-transform:uppercase;color:#FFF;font-family:Verdana,Arial,Helvetica,sans-serif;}

                        .popup_block .close{height:13px;width:13px;margin-right:7px;margin-top:5px;line-height:30px;float:right;font-size:0;background-image:url(../images/close-b.jpg);background-repeat:no-repeat;text-indent:-10000px;overflow:hidden;}

                        .popup_block .content{margin:10px 10px 20px 10px;overflow:auto;font-family:Verdana,Arial,Helvetica,sans-serif;  font-size:12px; height: 508px;}

                        #fade {background: #000;position: fixed;_position:absolute; /* hack for internet explorer 6*/width: 100%;height: 100%; /* filter:alpha(opacity=80);opacity: .80;-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)"; */ /*--Transparence sous IE 8--*/left: 0;top: 0;z-index: 10;}

                        #hideshow {position: absolute;width: 100%;height: 100%;top: 0;left: 0;}

                        .popup_block .close {height: 13px;width: 13px;margin-right: 7px;margin-top: 5px;line-height: 30px;float: right;font-size: 0;background-image:url(../../assets/images/close-b.jpg);background-repeat: no-repeat;text-indent: -10000px;overflow: hidden;}

                         </style>   

                            

                                        <div id="repertoire0">

                                        <div id="fils">

                                         <div id="fade"></div>

                                          <div class="popup_block"   style="width: 25%; z-index: 999; top: 30%; left: 40%; overflow:auto" >                                         

                                            <div class="titleBar">

                                                <div class="title">Envoi des emails</div>

                                                <a href="'.$_SERVER['REQUEST_URI'].'" id="fermer"><div class="close" style="cursor: pointer;">close</div></a>

                                            </div>

            <form  action="'.$_SERVER['REQUEST_URI'].'"  method="POST"  enctype="multipart/form-data">

            <div style="padding: 0 0 10px 20px"> <table><tr><td align="center" valign="bottom"><div id="display"></div></td></tr><tr><td align="left" valign="bottom">Votre email <font style="color:red">*</font><br/></td></tr><tr><td align="left" valign="bottom">

                <select  name="m_email" id="email1"  style="width:250px" > <option value=""></option> '.$role_mail.' </select>      

            <!--<input type="text" name="m_email" id="email1" value="" style="width:250px"/>-->

            </td></tr><tr><td><br></td></tr><tr><td align="left" valign="bottom">Email(s) de(s) destinataire(s)<font style="color:red">*</font><br/></td></tr>

            <tr><td align="left" valign="bottom">';

                                            

    

            for ($i = 0; $i < count($result_unique); $i++){ 

                            $select = mysql_query("select email from candidats where candidats_id = '".$result_unique[$i]."'");

                            $rows = mysql_fetch_array($select);

                            $email_c = $rows['email'];

            

            $txt_area.=''.$email_c.', ';

             



            } 

            

                                        

            $popup_div.='<textarea style="width:250px; height: 50px; " name="m_emails" id="message" >'.$txt_area.'</textarea> </td></tr><tr><td><br></td></tr><tr><td align="left" valign="bottom">Sujet<font style="color:red">*</font><br/></td></tr><tr><td align="left" valign="bottom">                        

                    <select name="m_sujet" id="sujet"  style="width:250px" > 

                    <option value=""></option>

                     '.$option_tmail.' </select>                                 

            <!--<input type="text" name="m_sujet" id="sujet" value="" style="width:250px" />-->

            </td></tr> <tr><td align="left" valign="bottom"><br>Votre message<br><span style=" color: brown;   font-size: 10px;">Le message sera ajoute au mail choisi par le sujet</span>

            <textarea style="width:250px;" name="m_message" id="message" cols="30" rows="5" ></textarea></td></tr> <tr><td align="left" valign="bottom">

            <fieldset>

           <p><legend>Pi&egrave;ce &agrave; joindre</legend> <label for="piecejointe" style="margin-top:8px; margin-bottom:8px;color: chocolate;">Seuls les fichiers (.doc, .jpg, .gif, .png ou .pdf) sont accept&eacute;s</label></p><p>

           <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />

           <input type="file" name="piecejointe" id="piecejointe">

          </p></fieldset></td></tr></table><div style="margin-left:5px;">

            <input type="submit" name="envoyer_emails" value="Envoyer"   ></div> </div> </form>';

                $popup_div.='</div></div> </div>'; 

     

        

        echo $popup_div;

        }

      

        if(isset($_POST['archive']))

        {

            for ($i = 0; $i < count($_POST["select"]); $i++)

            {   

                mysql_query("Update candidature SET status = 'Archivée' where id_candidature = '".$_POST["select"][$i]."'");

                $select = mysql_query("select id_candidat from candidature where id_candidature = '".$_POST["select"][$i]."'");

                $rows = mysql_fetch_array($select);

                $id_candidat = $rows['id_candidat'];

                $insert = mysql_query("INSERT INTO archive_cvs values ('".safe($id)."','".safe($id_candidat)."')");

                $affected += mysql_affected_rows();

            }

            if($affected >= 0)

                echo $affected.' Candidature(s) archivée(s).';

        }

        if(isset($_POST['delete']))     

        {

            $deleted = 0; $affected = 0;

            for ($i = 0; $i < count($_POST["select"]); $i++)

            {   

                $id_candidature = $_POST["select"][$i];

                $date_modification = date("Y-m-d H:i");

                $my_sql = mysql_query("SELECT status from candidature where id_candidature = '$id_candidature'");

                $test = mysql_fetch_array($my_sql);

                if($test['status'] == 'Cloturé')

                {

                mysql_query("DELETE from candidature where id_candidature = '$id_candidature'");

                $deleted += mysql_affected_rows();

                mysql_query("DELETE from historique where id_candidature = '$id_candidature'");             

                }

                else

                { 

                mysql_query("Update candidature SET status = 'Cloturé' where id_candidature = '$id_candidature'");

                mysql_query("INSERT INTO historique VALUES ('".safe($id_candidature)."','Non retenu','".safe($date_modification)."','')");

                $affected += mysql_affected_rows();

                }               

            }

            if($affected > 0)

                echo $affected.' Candidature(s) non retenue(s).';

            elseif($deleted > 0)

                echo $deleted.' Candidature(s) supprimée(s).';

        }

    }

    if(isset($_POST['envoi']))

    {

            $id_candidature = isset($_POST['id_candidature'])  ? $_POST['id_candidature'] : "";

            $select  = mysql_query("select * from candidature where id_candidature = '$id_candidature'");

            $reponse = mysql_fetch_array($select);

            $commentaire = isset($_POST['commentaire']) ? trim($_POST['commentaire']): "";

            $status      = isset($_POST['status'])      ? $_POST['status']           : "";

            $date_modification = gmdate("Y-m-d H:i:s");

            if($status !='Non retenu')

                mysql_query("UPDATE candidature SET status = 'En cours' where id_candidature = '$id_candidature'");

            else

                mysql_query("UPDATE candidature SET status = 'Cloturé' where id_candidature = '$id_candidature'");

            $affected = mysql_affected_rows();

            mysql_query("INSERT INTO historique VALUES ('".safe($id_candidature)."','".safe($status)."','".safe($date_modification)."','".safe($commentaire)."')");

            if ($affected >= 0)

                echo '<h3>Commentaire ajouté avec succès</h3>';         

    }

    ?>

    

    

 

            

            

     <div class="subscription" style="margin: 10px 0pt;">

          <h1>Options de filtrage des candidatures en cours</h1> 

     </div>

            

            

            

            

            

            

            

            

   <?php          

            

   //**************************************** filtrage candiddature ***********************/         

       ?> 

         

            

            

            

            

               

          

            <?php

            

         

            if( ($candidature!="encours") || (($candidature=="encours")   and (isset($_GET['stat'])) and ($stat=="tel" || $stat=="entretien"  || $stat="physique"   || $stat="test"  )))  {  

            ?>

            

  <?php       include ( "./traitement_candidatures_en_cours_m_filtre.php");

      



   

            }

   

   ?>

   

        

            

            

            

            

            

            

            

            

   <?php

    if(isset($_SESSION["query"]))

    {

            

            

            

            

            

            

            

            

            

            

            

            

            

            

            

            

        $query  =  $_SESSION["query"];  

                

                

            //$query = $query."  ORDER BY STR_TO_DATE( replace( date_candidature, '/', '-' ) , '%d-%m-%Y' ) DESC  LIMIT ".$limitstart.",".$itemsParPage." ";

                $query = $query."  ORDER BY  pertinence  DESC  ";

                

                

               //  echo '<h1> '.$query.'</h1>'; LIMIT ".$limitstart.",".$itemsParPage."

                

               

                if(isset($_GET['tridate']) and  $_GET['tridate']=="ASC" )

            {

                

          //     echo '<h1> '.$query.'</h1><br/><br/><br/><br/><br/>';

                

            

                $query = str_replace("ORDER BY STR_TO_DATE( replace( date_candidature, '/', '-' ) , '%d-%m-%Y' ) DESC", "ORDER BY STR_TO_DATE( replace( date_candidature, '/', '-' ) , '%d-%m-%Y' )  ASC ", $query);

           

                   

                

                

                

      //         echo '<h1> '.$query.'</h1>';

                

                }

                

                

                

                

                

                    if(isset($_GET['tri_titreposte']) and ( $_GET['tri_titreposte']=="ASC"  or  $_GET['tri_titreposte']=="DESC" )  )

            {

                        $tri_titre=$_GET['tri_titreposte'];

                        

                    $query = str_replace("ORDER BY STR_TO_DATE( replace( date_candidature, '/', '-' ) , '%d-%m-%Y' ) DESC", "ORDER BY offre.Name ".$tri_titre." ", $query);

                    $query = str_replace("ORDER BY STR_TO_DATE( replace( date_candidature, '/', '-' ) , '%d-%m-%Y' )  ASC ", "ORDER BY  offre.Name ".$tri_titre." ", $query);

                        

                        

                        

                    }

              

             

 // echo '<h1>'.$query.'</h1>';  

  

        $req  =  mysql_query($query);

                

             

   

    $j=0;

    

  while($rep = mysql_fetch_array($req))

     {

      

        $j++;

  ?>

  <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="form<?php echo $j;?>">

    <input name="id_candidature" type="hidden" value="<?php echo $rep['id_candidature']; ?>" />

    <input name="candidature" type="hidden" value="<?php echo $candidature; ?>" />

    <input name="stat" type="hidden" value="<?php echo $stat; ?>" />

  </form>

  <?php

    }

    ?>

   

   

      

            





  <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="global" >  

      <b> * Le point en couleur montre la pertinence de la candidature (<span style="color:#79796A"><a style="color:#00B300">Vert</a>: pertinence bonne, <a style="color:#CC5500;">Orange</a>: pertinence moyenne,  <a style="color:#CC0000">Rouge</a>: pertinence faible   </b><b>).</b>

<?php 

    include("./traitement_candidatures_en_cours_m_table.php");

    }else

    {

        

    ?>

<table border="0" class="tablesorter" style="width:70%">

<thead>

<tr>

<th>&Eacute;tat des candidatures</th>

<th>Total de candidatures</th>

</tr>

</thead>

<tbody>

  <tr class="odd">

    <td><b>Entretien téléphonique :</b></td>

    <td><?php 

    if($count_tel)

        echo '<a href="'.$_SERVER['REQUEST_URI'].'?candidature=encours&stat=tel">'.$count_tel.'</a>';

    else

        echo $count_tel; 

    ?></td>

   <tr class="even">

    <td><b>Convocation entretien :</b></td>

    <td><?php 

    if($count_convocation)

        echo '<a href="'.$_SERVER['REQUEST_URI'].'?candidature=encours&stat=entretien">'.$count_convocation.'</a>';

    else

        echo $count_convocation; 

    ?></td>

    </tr>

    <tr class="odd">

    <td><b>Entretien physique :</b></td>

    <td><?php 

    if($count_physique) 

        echo '<a href="'.$_SERVER['REQUEST_URI'].'?candidature=encours&stat=physique">'.$count_physique.'</a>'; 

    else

        echo $count_physique;

    ?></td>

  </tr>

    <tr class="even">

    <td><b>Test :</b></td>

    <td><?php 

    if($count_test) 

        echo '<a href="'.$_SERVER['REQUEST_URI'].'?candidature=encours&stat=test">'.$count_test.'</a>'; 

    else

        echo $count_test;

    ?></td>

  </tr>

 

  </tbody>

</table>

        <br/>

    <?php

    }

            if(!isset($_POST['envoi']) && isset($_POST['id_candidature']))

            {

                $id_candidature = $_POST['id_candidature'];

                $select = mysql_query("select * from historique where id_candidature = '$id_candidature'");

                $reponse = mysql_fetch_array($select);

    

        

        $select_candidat = mysql_query("SELECT nom,prenom from candidats inner join candidature on candidats.candidats_id = candidature.candidats_id WHERE candidature.id_candidature = '$id_candidature'");

        $nomcomplet = mysql_fetch_array($select_candidat);

    ?>

      <?php

        }

     ?>

    </div>

</div></div><!-- fin content gauche -->