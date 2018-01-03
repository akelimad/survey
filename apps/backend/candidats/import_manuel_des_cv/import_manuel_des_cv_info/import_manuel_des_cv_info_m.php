

    <!DOCTYPE html PUBLIC>



    <html xmlns="http://www.w3.org/1999/xhtml">



        <head>

  <?php 

 include ( dirname(__FILE__) . $tempurl3 . "/header_tmp_admin.php"); ?>



 

<link href="<?php echo $jsurl; ?>/jquery/jquery-ui.css" rel="stylesheet">



<script type="text/javascript" src="<?php echo $jsurl; ?>/jquery/jquery-1.11.2.min.js"></script> 

<script type="text/javascript" src="<?php echo $jsurl; ?>/jquery/jquery-ui.js"></script>  





<script type="text/javascript" src="<?php echo $jsurl ?>/ckeditor/ckeditor.js"></script>





                <script type="text/javascript">



                    $(document).ready(function(){



                        $('input[type="radio"]').click(function(){



                            if($(this).attr("value")=="stage"){



                                $(".box").hide();                               $(".stage").show();



                            }



                            if($(this).attr("value")=="spontane"){



                                $(".box").hide();                               //$(".spontane").show();



                            }



                            if($(this).attr("value")=="annonce"){



                                $(".box").hide();                               $(".annonce").show();



                            }



                            if($(this).attr("value")=="ressource"){



                                $(".box").hide();                               $(".ressource").show();



                            }



                        });



                    });



                </script>



            







            <script type="text/javascript">



                //pour ouvrir un popup



                function OuvrirPopup(page,nom,largeur,hauteur) 



                {



                    var winl = (screen.width - largeur) / 2;



                    var wint = (screen.height - hauteur) / 2;



                    winprops = 'height='+hauteur+',width='+largeur+',top='+wint+',left='+winl+',menubar=no,scrollbars=yes'



                    win = window.open(page, nom, winprops)



                }



            </script>



             



<!--    -->     



        <script type="text/javascript">



        $(document).ready(function(){



    



    $("#etablissement").change(function() {



    



     if( $(this).val()=="290"){    $("#div_etablissement").show();  $("#div_etablissement1").show()    }



     else{    $("#nom_etablissement").val('');  $("#div_etablissement").hide(); $("#div_etablissement1").hide()    }



 



    });



    $("#etablissement").change();



    });



        </script>

 



   <script type="text/javascript">



        $(function() {







            var $tabs = $('#tabs').tabs();



    



            $(".ui-tabs-panel").each(function(i){



    



              var totalSize = $(".ui-tabs-panel").size() - 1;



    



              if (i != totalSize) {



                  next = i + 2;



                 // $(this).append("<center><a href='#' class='next-tab mover' rel='" + next + "' style='border-bottom: none ;padding-bottom: 0px;'><h6><i>J’ai rempli mon formulaire</i></h6><h3><b>Je passe à l’étape 2 &#187;</b></h3></a></center>");



              }



      /*



              if (i != 0) {



                  prev = i;



                  $(this).append("<a href='#' class='prev-tab mover' rel='" + prev + "'>&#171; Prev Page</a>");



              }



        */



            });



    



            $('.next-tab, .prev-tab').click(function() { 



                   $tabs.tabs('select', $(this).attr("rel"));



                   return false;



               });



       







        });



    </script>



    





<script type="text/javascript" src="<?php echo $jsurl ?>/ckeditor/ckeditor.js"></script>







</head>

<body>







<div>



<?php

if(isset($messages) and !empty($messages)){ ?>

<div class="alert alert-error"><ul>

<?php foreach($messages as $m){echo $m;} ?>

</ul></div>

<?php   }   ?>









<div style="float:left; width: 47%; height: 800px; background-color: #b0c4de;">


<?php
$google_doc = "https://docs.google.com/viewer?url=". urlencode(site_url('apps/upload/backend/cv_import_uploads/')) . $_FILES["file"]["name"] ."&embedded=true";
?>
<iframe src="<?= $google_doc; ?>" width="100%" height="100%" style="border: none;"></iframe>



</div>



<div style=" float: right; width: 525px; ">



<!--



##################################      tabs    d   ####################################



-->







<div id="page-wrap">







   <form action="<?php echo($_SERVER['REQUEST_URI']); ?>" method="post" enctype="multipart/form-data">  <!-- action="" method="post"> -->      



    <div id="tabs" >



        



    <ul>



       <li><a href="#fragment-1">Etape 1</a></li>



       <li><a href="#fragment-2">Etape 2</a></li>



                



    </ul>



    



    <div id="fragment-1" class="ui-tabs-panel">



  







            



  <div>



  <?php



  $req = mysql_query("select email from candidats where email='$pass[1]'");

				if(!isset($messages) or empty($messages))  

                                    if($rep = mysql_fetch_assoc($req))



                                            {



                                                echo '<font style="color:red;">Cette E-mail '.$rep['email'].' est déjà enregistré  </font><br><br> ' ;



                                            }   



  ?>



  </div>



          



          <table>



          <tr><td style="width: 180px;">E-mail du candidat :</td><td><input type="text" readonly  value="<?php echo $pass[1]; // id="email0" name="email1"  ?>" ></td></tr>



            <tr><td>



            <input   type="hidden" name="mdp1" value="<?php echo $gen_pass; ?>"/> <br></td><td>



            <input   type="hidden" name="mdp2" value="<?php echo $gen_pass; ?>"/><br></td></tr>



            <tr><td rowspan="4" style="width: 180px;" >Type de candidature :    </td>



                                    <td><input type="radio" name="type_candidatur" value="stage" <?php if($type_candidatur=="stage") echo 'checked="checked"'; ?> > Candidature pour stage</td></tr>



                                    <tr><td><input type="radio" name="type_candidatur" value="spontane" <?php if($type_candidatur=="spontane") echo 'checked="checked"'; ?> > Candidature spontanée</td></tr>



                                    <tr><td><input type="radio" name="type_candidatur" value="annonce" <?php if($type_candidatur=="annonce") echo 'checked="checked"'; ?> > Reponse à une offre</td></tr>   



                                    <tr><td><input type="radio" name="type_candidatur" value="ressource" <?php if($type_candidatur=="ressource") echo 'checked="checked"'; ?> > CV reçu</td></tr>



                <tr><td><br></td><td><br></td></tr>



                <tr><td style="width: 180px;" > 



                        <div class="stage box" style="<?php echo ($type_candidatur=="stage") ? 'display:block' : 'display:none' ; ?>">Choisir une offre  pour stage:</div> 



                        <div class="spontane box" style="<?php echo ($type_candidatur=="spontane") ? 'display:block' : 'display:none' ; ?>">Choisir une offre  spontanée:</div> 



                        <div class="annonce box" style="<?php echo ($type_candidatur=="annonce") ? 'display:block' : 'display:none' ; ?>">Choisir une offre :</div> 



                        <div class="ressource box" style="<?php echo ($type_candidatur=="ressource") ? 'display:block' : 'display:none' ; ?>">Origine de candidature:</div> 



                    </td>



                    <td>



                    <div class="stage box" style="<?php echo ($type_candidatur=="stage") ? 'display:block' : 'display:none' ; ?>">



                        <select name="type_p1"    style="font-size:11px;width: 214px;" >



                                              <option value=""></option>



                                          <?php



                                            //*



                                            $select_s = mysql_query("select * from offre  where  status = 'En cours' AND id_tpost='4' ORDER BY date_insertion Desc");



                                            



                                            while($t_s = mysql_fetch_array($select_s))



                                            {



                                            $id=$t_s['id_offre'];



                                            $vr1=$t_s['reference'];



                                            $vr2=$t_s['Name'];



                                            if(isset($type_p1) and $type_p1==$id){                  



                                                  echo '<option value="'.$id.'" selected="selected">' . $vr1 . '|' . $vr2 . '</option>';



                                                  }     else    {       



                                                echo '<option value="' . $id . '"  >' . $vr1 . '|' . $vr2 . '</option>';                



                                                  }



                                                



                                            }



                                            //*/



                                            ?>



                    </select>



                    </div>



                    <div class="spontane box" style="<?php echo ($type_candidatur=="spontane") ? 'display:none' : 'display:none' ; ?>">



                    <select name="type_p2"   style="font-size:11px;width: 214px;" >



                                          <option selected="selected" value=""></option>



                                          <?php



                                            /*



                                            $select_t_p = mysql_query("SELECT * FROM prm_type_partenaire");



                                            while($t_p = mysql_fetch_array($select_t_p))



                                            {



                                                echo "<optgroup label='".$t_p['type_partenaire']."'>";



                                                echo " SELECT * FROM partenaire where type_partenaire='".$t_p['type_partenaire']."' ";



                                            $select_p=mysql_query("SELECT * FROM partenaire where type_partenaire='".$t_p['type_partenaire']."' ");



                                            while ($p = mysql_fetch_array($select_p)) {



                                                echo "<option value='" . $p['nom'] . "' " . $selected . ">" . $p['nom'] . "</option>";



                                            }



                                            echo " </optgroup>";



                                            }



                                            //*/



                                            ?>



                    </select>



                    </div>



                    <div class="annonce box" style="<?php echo ($type_candidatur=="annonce") ? 'display:block' : 'display:none' ; ?>">



                    <select name="type_p3"   style="font-size:11px;width: 214px;" >



                                          <option selected="selected" value=""></option>



                                          <?php



                                            //*



                                            $select_s = mysql_query("select * from offre  where  status = 'En cours' AND id_tpost<>'4' ORDER BY date_insertion Desc");



                                            while($t_s = mysql_fetch_array($select_s))



                                            {



                                            $id=$t_s['id_offre'];



                                            $vr1=$t_s['reference'];



                                            $vr2=$t_s['Name'];



                                            if(isset($type_p3) and $type_p3==$id){                  



                                                  echo '<option value="'.$id.'" selected="selected">' . $vr1 . '|' . $vr2 . '</option>';



                                                  }     else    {       



                                                echo "<option value='" . $id . "'  >" . $vr1 . "|" . $vr2 . "</option>";            



                                                  }



                                                



                                            }



                                            //*/



                                            ?>



                    </select>



                    </div>



                    <div class="ressource box" style="<?php echo ($type_candidatur=="ressource") ? 'display:block' : 'display:none' ; ?>">



                    <select name="type_p4"   style="font-size:11px;width: 214px;" >



                                          <option selected="selected" value=""></option> 

                                          <option value="cabinet de recrutement">Cabinet de recrutement</option>

                                          <option value="centres de formation">Centres de formation</option>

                                          <option value="ecoles">Ecoles</option>

                                          <option value="direct">Direct</option>



                                          <?php

                                        /*

                                            $select_t_p = mysql_query("SELECT * FROM prm_type_partenaire");



                                            while($t_p = mysql_fetch_array($select_t_p))



                                            {



                                                echo "<optgroup label='".$t_p['type_partenaire']."'>";



                                                echo " SELECT * FROM partenaire where id_tparte='".$t_p['id_tparte']."' ";



                                            $select_p=mysql_query("SELECT * FROM partenaire where id_tparte='".$t_p['id_tparte']."' ");



                                            while ($p = mysql_fetch_array($select_p)) {



                                            $vr_id=$p['id'];



                                            $vr_n=$p['nom'];



                                            if(isset($type_p4) and $type_p4==$vr_id){                   



                                                  echo '<option value="'.$vr_id.'" selected="selected">' . $vr_n .  '</option>';



                                                  }     else    {       



                                                echo "<option value='" . $vr_id . "' >" . $vr_n . "</option>";  



                                                  }



                                            }



                                            echo " </optgroup>";



                                            }

                                        //*/

                                            ?>



                    </select>



                    </div>



                    <br/>



                    </td>



                </tr>



                <tr><td><br></td><td></td></tr>



                



          </table>



        <br><br> 



          



    </div>



  



    <div id="fragment-2" class="ui-tabs-panel ui-tabs-hide" style=" height: 730px; " >



    



        <!--  @dil debut tab 2  -->



        <div>



            <style type="text/css">



                .onglet_s



                {



                        display:inline-block;



                        margin-left:0px;



                        margin-right:0px;



                        padding:1px;



                        border:1px solid White ;



                        cursor:pointer;



                }



                .onglet_0



                {



                        background:#FFFFFF;



                        border-bottom:0px solid White ;



                }



                .onglet_1



                {



                        background:#FFF;



                        border-bottom:1px solid White ;



                        padding-bottom:2px;



                }



                .contenu_onglet



                {



                        background-color:#FFF;



                        border:1px solid White ;



                        margin-top:-1px;



                        padding:2px;



                        display:none;



                        width: 99%; height: 98%;



                }



                </style>



                



                



            <script type="text/javascript">



                //<!--



                        function change_onglet(name)



                        {



                                document.getElementById('onglet_'+anc_onglet).className = 'onglet_0 onglet_s';



                                document.getElementById('onglet_'+name).className = 'onglet_1 onglet_s';



                                document.getElementById('contenu_onglet_'+anc_onglet).style.display = 'none';



                                document.getElementById('contenu_onglet_'+name).style.display = 'block';



                                anc_onglet = name;



                        }



                //-->



                </script>



            



        



            <div class="systeme_onglets" style=" height: 550px; border-width:2px; ">



                <div class="onglets_s" style=" width: 490px; ">



                    <span class="onglet_0 onglet_s" id="onglet_id" onclick="javascript:change_onglet('id');"><b>ETAT CIVIL</b>  |</span>



                    <span class="onglet_0 onglet_s" id="onglet_pr" onclick="javascript:change_onglet('pr');"><b>PROFILE</b>   | </span>



                    <span class="onglet_0 onglet_s" id="onglet_fo" onclick="javascript:change_onglet('fo');"><b>FORMATION</b> |</span>



                    <span class="onglet_0 onglet_s" id="onglet_ex" onclick="javascript:change_onglet('ex');"><b>EXPERIENCE</b> |</span>



                    <span class="onglet_0 onglet_s" id="onglet_ic" onclick="javascript:change_onglet('ic');"><b>JOINDRE CV</b> </span>



                                <div class="ligneBleu"></div>

                </div>



                <div class="contenu_onglets" style=" height: 450px;" >



                



                    <div class="contenu_onglet" id="contenu_onglet_id" >



                        <div id="chart_visiteurs_uniques" style="width: 100%; height: 0;">      

 



                          



                        <h1>&Eacute;TAT CIVIL :</h1>



								<?php include ( "./import_cv/onglet_id.php");?>



                        </div>



                    </div>



                    



                    



                    <div class="contenu_onglet" id="contenu_onglet_pr" >



                        <div id="chart_pages_visitees" style="width: 100%; height: 0;"></div>



                         <h1>PROFIL  :</h1>



								<?php include ( "./import_cv/onglet_pr.php");?>



                    </div>



                    



                    



                    <div class="contenu_onglet" id="contenu_onglet_fo" >



                        <div id="chart_temps_moyen" style="width: 100%; height:0;"></div>



                         <h1>FORMATION :</h1>



								<?php include ( "./import_cv/onglet_fo.php");?>



                    </div>



                    <div class="contenu_onglet" id="contenu_onglet_ex" >



                        <div id="chart_temps_moyen" style="width: 100%; height:0;"></div>



                         <h1>EXPERIENCE  :</h1>



								<?php include ( "./import_cv/onglet_ex.php");?>



                    </div>



                    



                    <div class="contenu_onglet" id="contenu_onglet_ic"  >



                        <div id="chart_taux_de_rebond" style="width: 100%; height:0;"></div>



                         <h1>JOINDRE CV :</h1>



								<?php include ( "./import_cv/onglet_ic.php");?>



                        <table><tr><td  width="55%">



                        <input name="envoi" type="submit" value="Valider" class="espace_candidat" style="width: 170px;height: 50px; "/>



<!--<button name="envoi" type="submit" value="Valider" style=" height: 50px; width: 190px; ">Enregistrer et ouvrir le dossier candidat </button>-->



                        </td>



                        <td>



                        <input name="" type="reset" class="espace_candidat"  style="width: 170px; height: 50px;"/>



<!--<button name="envoi" type="submit" value="Valider" style=" height: 50px; width: 170px; ">Enregistrer et retourner &#225 la liste</button>-->



                        </td></tr></table>



                    </div>



                    



                </div>



                <script type="text/javascript">



                //<!--



                        var anc_onglet = 'id';



                        change_onglet(anc_onglet);



                //-->



        </script>



                <div class="onglets_s" style=" width: 490px;margin-top: 25px; ">



                



                </div>



        </div>







        </div>



        <!-- fin tab 2  -->



    </div>











  



    </div>







   </form>



  



</div>







</div>









</div>





</body>



</html>