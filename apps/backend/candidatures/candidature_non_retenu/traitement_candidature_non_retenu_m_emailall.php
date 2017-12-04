<?php



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

?>