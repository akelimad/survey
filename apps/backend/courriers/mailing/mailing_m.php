<div class='texte'>



      <br/><h1>E-MAILING</h1>



        



<?php   

/*

    if(isset($_POST['select']))



    {



        $affected = 0;



        

        if(isset($_POST['email_tt'])){

        $result_unique =  array_keys(array_flip($_POST['select'])); 

        



        $popup_div='

                         <style>    

                        /*********Popup************* /

                        .popup_block{overflow:auto;position:fixed;_position:absolute; /* hack for internet explorer 6* / background-color:#fff;-moz-border-radius-topleft:10px;-moz-border-radius-topright:10px;top:200px;left:200px;z-index:999;}

                        .popup_block .titleBar{margin:0;height:25px; -moz-border-radius-topleft:10px;-moz-border-radius-topright:10px;}

                        .popup_block .footerBar{margin-right:20px;margin-left:20px;margin-bottom:4px;}

                        .popup_block .title{height:25px;float:left;font-size:12px;font-weight:700;margin-left:20px;margin-top:1px;  line-height:23px;text-transform:uppercase;color:#FFF;font-family:Verdana,Arial,Helvetica,sans-serif;}

                        .popup_block .close{height:13px;width:13px;margin-right:7px;margin-top:5px;line-height:30px;float:right;font-size:0;background-image:url(../images/close-b.jpg);background-repeat:no-repeat;text-indent:-10000px;overflow:hidden;}

                        .popup_block .content{margin:10px 10px 20px 10px;overflow:auto;font-family:Verdana,Arial,Helvetica,sans-serif;  font-size:12px; height: 508px;}

                        #fade {background: #000;position: fixed;_position:absolute; /* hack for internet explorer 6* /width: 100%;height: 100%; /* filter:alpha(opacity=80);opacity: .80;-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)"; * / /*--Transparence sous IE 8--* / left: 0;top: 0;z-index: 10;}

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

                    <select name="m_sujet" id="sujet"  style="width:250px" > <option value=""></option> '.$option_tmail.' </select>                                 

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

        

        

        if(isset($_POST['archive'])){



            for ($i = 0; $i < count($_POST["select"]); $i++){   



                mysql_query("Update candidature SET status = 'Archivée' where id_candidature = '".$_POST["select"][$i]."'");



                $select = mysql_query("select id_candidat from candidature where id_candidature = '".$_POST["select"][$i]."'");

                $rows = mysql_fetch_array($select);

                $id_candidat = $rows['id_candidat'];

                

                $select2 = mysql_query("SELECT id_cv FROM cv WHERE  actif=1 AND     principal=1 AND  candidats_id = '".$id_candidat."'");

                $rows2 = mysql_fetch_array($select2);

                $id  = $rows2['id_cv'];



                $insert = mysql_query("INSERT INTO archive_cvs values ('','$id_candidat', '$id')");



                $affected += mysql_affected_rows();



            }



            if($affected >= 0)



                echo $affected.' Candidature(s) archivée(s).';



        }



        if(isset($_POST['delete'])){



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



                mysql_query("INSERT INTO historique VALUES ('$id_candidature','Non retenu','$date_modification','')");



                $affected += mysql_affected_rows();



                }               



            }



            if($affected > 0)



                echo $affected.' Candidature(s) non retenue(s).';



            elseif($deleted > 0)



                echo $deleted.' Candidature(s) supprimée(s).';



        }



    }

    

	//*/

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//*



$l= rand(4, 8);

function generateRandomString($length) {

        $r = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);

        return $r; 

}

$n_f=generateRandomString($l);



if(isset($_POST['envoyer_emails'])){

include("mailing_m_email_1.php");





    

}

//*/



/*

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



            mysql_query("INSERT INTO historique VALUES ('$id_candidature','$status','$date_modification','$commentaire')");



            if ($affected >= 0)



                echo '<h3>Commentaire ajouté avec succès</h3>';         



    }

//*/

    ?>





            

           <?php

           

               $query_nbr=$_SESSION["query"];

              $nombre_candidature=  mysql_query($query_nbr);



               $nombre_candidature01=mysql_num_rows($nombre_candidature);

               

               

           ?>

       

            

      <div class="subscription" style="margin: 10px 0pt; width:715px; ">

          <h1> Selectionner les destinataires aux quelles vous voulez envoyer l'email </h1> 

      </div>

    <table> <tr class="odd"> <td><b>  Nombre des candidats sélectionnés pour l’envoi d’email : </b></td><td></td> <td><?php echo $nombre_candidature01; ?></td></tr></table>             

              

        

            

            

            

            

            

            

            

            

   <?php          

            

   //**************************************** filtrage candiddature ***********************/         

       ?> 

         

            

            

            

   <?php   

   /*

   if(!isset($_POST['envoi_fitrage']) && !isset($_POST['t_sujet']))

         $_SESSION['destination'] = isset($_POST['motcle']) ?  $_POST['motcle'] : "";

		 //*/

   if(isset($_POST['motcle'] ))

         $_SESSION['destination'] = isset($_POST['motcle']) ?  $_POST['motcle'] : "";

		 

	   if(isset($destination ))	 

        echo $destination;

   ?>          

        <div style="width:715px">         

                

                        <table width="100%">

                            <tr>

                                    <td colspan="2"><div class="ligneBleu"></div></td>

                            </tr> 

                        

                            <tr>

                                <td colspan="2">

                                    <h2><strong>Choix de destinataires :</strong></h2>

                                    <br>

                                </td>

                            </tr>

                            <tr>

                                <td align="right" style="width: 275px;">

                                    <b>Destinataires   :<span style="color:red">*</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>

                                </td>

                                

                                <td>  

									<form action="<?php echo $_SERVER['REQUEST_URI'];  ?>" method="post" name="myform" onsubmit="return valider()">   

										<select name="motcle" id="mySelect"  onchange="javascript: form.submit();">

											<option value="" <?php if(isset($_SESSION['destination']) and $_SESSION['destination']=="") echo 'selected="selected"' ;?> >Tous les candidats</option>

											<option value="-1" <?php if(isset($_SESSION['destination']) and $_SESSION['destination']=="-1") echo 'selected="selected"' ;?>>Candidats ciblés</option>

											<option value="-2" <?php if(isset($_SESSION['destination']) and $_SESSION['destination']=="-2") echo 'selected="selected"' ;?>>Autres</option>

										</select>

									</form>

                                </td>

                            </tr> 



                        </table> 

        </div>

            <?php

 

 

        

         

            if( ($candidature!="encours") || (($candidature=="encours")   and (isset($_POST['stat'])) and ($stat=="tel" || $stat=="transmis" || $stat=="rencontre"  || $stat=="entretien"  || $stat="recontact" || $stat=="retenus" )))  {   ?>

            

   <form action="<?php echo $_SERVER['REQUEST_URI'];  ?>"  method="POST" >



    



    

       <input type="hidden" name="candidature"  value="<?php echo $candidature;      ?>"    />

          <input type="hidden" name="stat"  value="<?php  echo $stat1;  ?>"    />

    









    <table  width="87%" <?php if(isset($_SESSION['destination']) and $_SESSION['destination'] !=-1) echo 'style="display:none"'; ?>>

	

	

	<tr><td colspan="3"><br><br><div class="ligneBleu"></div></td></tr>

	

	<tr>

    

	<td  width="25%">   

    

    <table width="100%" border="0" >

        <tr>



          <td colspan="2">



                  <label>Secteur d’activité</label><br />

                     <select name="secteur" >



          <option value="" selected="selected" ></option>

                        <?php

                        $req_theme = mysql_query("SELECT * FROM prm_sectors");

                        while ($data = mysql_fetch_array($req_theme)) {

                        $Sector_id = $data['id_sect'];

                        $Sector = $data['FR'];

                        ?>

<option value="<?php echo $Sector_id; ?>" <?php if (isset($_POST['secteur']) and $_POST['secteur'] == $Sector_id) echo ' selected="selected"'; ?>>

<?php echo $Sector; ?></option>

<?php

                        }

                        ?>

                        



          </select>  



        </td>



       



       



        </tr>



        



        



        <tr>



               <td>



          <label>Années d'expérience</label><br />



          <select name="exp">



          <option value=""></option>

                                                            <?php

                                                            $req_exp = mysql_query("SELECT * FROM prm_experience");

                                                            while ($exp = mysql_fetch_array($req_exp)) {

                                                            $exp_id = $exp['id_expe'];

                                                            $exp_desc = $exp['intitule'];

                        ?>

<option value="<?php echo $exp_id; ?>" <?php if (isset($_POST['exp']) and $_POST['exp'] == $exp_id) echo ' selected="selected"'; ?>>

<?php echo $exp_desc; ?></option>

<?php

                                                            }

                                                            ?>



          </select>          </td>



        



        </tr>



        



        <tr>



                  <td>



          <label>Niveau d'étude</label><br />



          <select name="formation">



            <option value="" selected="selected"></option>

     <?php

        $req_nf = mysql_query( "SELECT * FROM prm_niv_formation");

            while ( $nf = mysql_fetch_array( $req_nf ) ) {

                $nf_id = $nf['id_nfor'];

                $nf_desc = $nf['formation'];

                        ?>

<option value="<?php echo $nf_id; ?>" <?php if (isset($_POST['formation']) and $_POST['formation'] == $nf_id) echo ' selected="selected"'; ?>>

<?php echo $nf_desc; ?></option>

<?php

            }

    ?> 

          </select>          </td>



        



        </tr>



    



        </table>



        



        </td>



        



        



        



        <td  width="25%">



        <table width="100%" border="0">

        

       

       

        <tr>



           <td><label>Fraicheur du CV</label><br />



<select name="fraicheur" id="fraicheur">



  <option value=""></option>



  <option value="30" <?php if(isset($_POST['fraicheur']) and $_POST['fraicheur']=="30") echo ' selected="selected"' ; ?>>1 mois</option>



  <option value="90" <?php if(isset($_POST['fraicheur']) and $_POST['fraicheur']=="90") echo ' selected="selected"' ; ?>>3 mois</option>



  <option value="180" <?php if(isset($_POST['fraicheur']) and $_POST['fraicheur']=="180") echo ' selected="selected"' ; ?>>6 mois</option>



  <option value="360" <?php if(isset($_POST['fraicheur']) and $_POST['fraicheur']=="360") echo ' selected="selected"' ; ?>>12 mois</option>



</select></td>



        </tr>



        <tr>



               <td>



        



       </td>



        </tr>



        <tr>



                <td colspan="3">



        <label>Ecole ou établissement</label><br />



       <select name="etablissement" >



          <option value=""></option>

                      <?php 

                      $select_ecole = mysql_query("SELECT * FROM prm_ecoles");

                      while($ecole = mysql_fetch_array($select_ecole))

                      {

                        ?>

<option value="<?php echo $ecole['id_ecole']; ?>" <?php if (isset($_POST['etablissement']) and $_POST['etablissement'] == $ecole['id_ecole']) echo ' selected="selected"'; ?>>

<?php echo $ecole['nom_ecole']; ?></option>

<?php

                      }        

                      ?> 



          </select>     </td>



        </tr>



        <tr>



              <td>



          <label>Situation actuelle</label><br />



          <select name="situation">



            <option value=""></option>

                        <?php 

                      $select_sa = mysql_query("SELECT * FROM prm_situation");

                      while($sa = mysql_fetch_array($select_sa))

                      {

                        ?>

<option value="<?php echo $sa['id_situ']; ?>" <?php if (isset($_POST['situation']) and $_POST['situation'] == $sa['id_situ']) echo ' selected="selected"'; ?>>

<?php echo $sa['situation']; ?></option>

<?php

                      }        

                      ?>  

          </select>           </td>



          <td></td>



        </tr>



        </table>



        </td>



    



    



    



            <td  width="30%">



        <table width="100%" border="0">



         

        

        <tr>

        <td>

        <label>Ville</label><br />

<select name="villes" >

<option value="" selected="selected"></option>

      <?php 

      $select_tv = mysql_query("SELECT * FROM prm_villes");

      while($tv = mysql_fetch_array($select_tv))

      {

                                ?>

<option value="<?php echo $tv['ville']; ?>" <?php if (isset($_POST['villes']) 

and $_POST['villes'] ==$tv['ville']) echo ' selected="selected"'; ?>>

<?php echo $tv['ville']; ?></option>

<?php   

      }      

      ?> 

</select>



        </td>

        </tr>

        

        <tr>



                 <td>



          <label>Type de formation</label><br />



               <select name="type_formation" >

<option value="" selected="selected"></option>

      <?php 

      $select_tf = mysql_query("SELECT * FROM prm_type_formation");

      while($tf = mysql_fetch_array($select_tf))

      {

                                ?>

<option value="<?php echo $tf['id_tfor']; ?>" <?php if (isset($_POST['type_formation']) and $_POST['type_formation'] ==$tf['id_tfor']) echo ' selected="selected"'; ?>>

<?php echo $tf['formation']; ?></option>

<?php   

      }      

      ?> 

</select>         </td>



          <td>          </td>



        </tr>



        <tr>



                         <td>



          <label>Pays de résidence</label><br />



         <select name="pays">



          <option value=""></option>



         <?php



            $req_pays = mysql_query( "SELECT * FROM prm_pays");



                while ( $pays = mysql_fetch_array( $req_pays ) ) {



                    $pays_id = $pays['id_pays'];



                    $pays_desc = $pays['pays'];



                         ?>

<option value="<?php echo $pays_id; ?>" <?php if (isset($_POST['pays']) and $_POST['pays'] == $pays_id) echo ' selected="selected"'; ?>>

<?php echo $pays_desc; ?></option>

<?php



                }



        ?>



          </select>      

                                         </td>



        </tr> 

    



        </table>



        </td>



		</tr>

    

      </table>



      



                

<br/>

<table <?php if(isset($_SESSION['destination']) and $_SESSION['destination'] !=-1) echo 'style="display:none"'; ?>>

<tr>

<td><input type="submit" class="espace_candidat" name="envoi_fitrage"  value=" Filtrer " /></td>  <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>  

<td><input type="submit" class="espace_candidat" name="actualiser" OnClick="javascript:window.location.reload()" value=" Actualiser ">  </td>

</tr>

</table>

        



        



    <br/>



      </form>

      

   <?php

   

            }

   

   ?>

   

   <?php

   





     



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



        

            

            

            

            

            

            

            

            





   

     <div style="width:715px">

	 

	 

	 

<?php  include("./mailing_m_form.php"); ?>            





</div>

                 

     

     

    </div><!-- fin div text -->

 