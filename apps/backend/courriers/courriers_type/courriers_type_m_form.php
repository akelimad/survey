<table  width="100%" id="addrole" >

                        <input type="hidden" name="id"  value="<?php if(isset($_POST['id'])){echo $_POST['id'];}?> "  />

                        <tr>

                            <td  width="20%">

                                <b> Type d'email :</b> <font style="color:red;">*</font>

                            </td>

                            <td  width="60%"> 

                               <input type="text" name="type_cand"  value="<?php if(isset($_POST['type_cand'])){echo $_POST['type_cand'];}?> "  style="width: 400px;" maxlength="100"  <?php if(isset($_POST['ds'])){echo $_POST['ds'];}?> title="type_cand" required/>     

                                     

                            </td>

                        </tr> 

                        <tr>

                            <td><br/></td><td><br/></td>

                        </tr>

                        <tr>

                            <td  width="20%">

                                <b> Email expéditeur:</b> <font style="color:red;">*</font>

                            </td>

                            <td  width="60%">  

                                 <input type="email" name="expediteur"  

                                 value="<?php if(isset($_POST['expediteur'])){echo $_POST['expediteur'];} else echo $info_contact; ?> "  style="width: 400px;" maxlength="100"  <?php if(isset($_POST['ds'])){echo $_POST['ds'];}?> title="expediteur" required/>  

                                 <!--

                                    <select name="expediteur"  style="width: 404px;" <?php if(isset($_POST['ds'])){echo $_POST['ds'];}?> title="Email expéditeur" required/> 



                                      <option value=""></option>

                                      <?php         $req_02 = mysql_query( "SELECT * FROM root_roles ");             

                                      while ( $r02 = mysql_fetch_array( $req_02 ) ) {          

											if($r02['login']=='root') {$r02 = mysql_fetch_array( $req_02 ) ;}

                                      $r_id = $r02['id_tmail'];                 $r_desc = $r02['email'];            $v='';      

                                      if(isset($_POST['expediteur']) and $_POST['expediteur']==$r_desc) {$v='selected="selected"';}   else  {$v=''; }

                                        echo '<option value="'.$r_desc.'" '.$v.'>'.$r_desc.'</option>';   }     ?>



                                    </select>-->

                            </td>

                        </tr>

                        <tr>

                            <td><br/></td><td><br/></td>

                        </tr>

                        <tr>

                            <td  width="20%">

                                <b> Objet:</b> <font style="color:red;">*</font>

                            </td>

                            <td  width="60%"> 

                                <input type="text" name="objet"  value="<?php if(isset($_POST['objet'])){echo $_POST['objet'];}?> "  style="width: 400px;" maxlength="100"  <?php if(isset($_POST['ds'])){echo $_POST['ds'];}?> title="Objet" required/><br/>

                            </td>

                        </tr>

                        <tr>

                            <td><br/></td><td><br/></td>

                        </tr>

                        <tr>

                            <td  width="20%" valign="top">

                                <b >        Message:</b> <font style="color:red;"></font>

                                

                            </td>

                            <td  width="60%"> 

								<!--

                                <div>

                                <select id="selectHint" name="users" onchange="showUser(this.value)" style=" width: 250px;<?php if(isset($_POST['ds'])){ echo"background-color: #EBEBE4;"; } ?> " <?php if(isset($_POST['ds'])){echo $_POST['ds'];}?>>

                                    <option value="">Insère une variable dans le message : </option>

                                    <option value="{{nom_candidat}}">Nom candidat</option>

                                    <option value="{{email_candidat}}">Email de candidat</option>

                                    <option value="{{mot_passe}}">Mot de passe</option>

                                    <option value="{{nom_partenaire}}">Nom partenaire</option>

                                    <option value="{{titre_offre}}">Titre de l’offre</option>

                                    <option value="{{lien_offre}}">Lien Offre</option>

                                    <option value="{{date_postulation}}">date postulation</option>

                                    <option value="{{statu_candidature}}">Statu de candidature</option>

                                    <option value="{{date_statu}}">Date statu</option> 

                                    <option value="{{lieu_statu}}">Lieu statu</option>

                                    <option value="{{lien_confirmation}}">Lien de confirmation</option>

                                    <option value="{{message}}">Message</option>

                                </select>

                                </div><br/>

								-->

                                <textarea name="msg" id="editor1" style="width: 402px;height: 200px;" <?php if(isset($_POST['ds'])){echo $_POST['ds'];}?>><?php if(isset($_POST['msg'])){

                                                $var = array("\'");

                                                $replace   = array("'");

                                                $new_mss = str_replace($var, $replace, $_POST['msg']);

                                            echo $new_mss;

                                }?> </textarea>

                            <?php if(isset($_POST['ds']) AND  $_POST['ds']=="disabled" ){   

                                    echo "<script type='text/javascript'> 

                                    CKEDITOR.replace( 'editor1',

                                {

                                contentsCss : 'body{background-color:#EBEBE4 ;}'

                                });

                                </script>"; 

                                                                

                                } else { 

                                echo "<script type='text/javascript'> 

                                CKEDITOR.replace( 'editor1',

                                {

                                contentsCss : 'body{background-color:#FFFFFF ;}'

                                });

                                

                                function showUser(str) {

                                  if (str=='') {

                                    //document.getElementById('editor1').value+='';

                                        CKEDITOR.instances['editor1'].insertText('');

                                    return;

                                  } 

                                   if (str!='') {

                                      //document.getElementById('editor1').value+=document.getElementById('selectHint').value;

                                      //selecElement.selectedIndex = 0;

                                      var add_c=document.getElementById('selectHint').value; // '253+';//

                                        CKEDITOR.instances['editor1'].insertText(add_c);

                                      document.getElementById('selectHint').selectedIndex = 0;

                                    return;

                                  }

                                }



                                </script>";

                                 } ?> 

                            </td>

                        </tr>

                        <tr>

                            <td><br/></td><td><br/></td>

                        </tr>

                        <tr>

                            <td  width="20%">

                            <?php if(!isset($_POST['ds'])){ ?>

                                <input type="hidden" name="MAX_FILE_SIZE" value="100000000" />

                                <b>   Transfère un fichier :</b>  

                            <?php  } ?>

                            </td>

                            <td  width="60%"> 

                            <?php if(!isset($_POST['ds'])){ ?>

                                <input type="file" name="monfichier" />

                            <?php  } ?>

                            </td>

                        </tr>

                            <?php if( isset($_POST['id']) and $_POST['id']!='' ){ ?>

                          

                        <tr>

                            <td><br/></td><td><br/></td>

                        </tr>  

                        <tr>

                            <td> <b> Supprimer pièce joint : </b> </td><td><input type="checkbox" name="pj" value="pj"> </td>

                        </tr>

                            <?php  } ?>

                        <tr>

                            <td><br/></td><td><br/></td>

                        </tr>

                        

                        <tr>

                            <td  width="20%">                       

                            </td>

                            <td  width="60%"> 

                            

                                <input type="submit" class="espace_candidat" name="<?php if(isset($_POST['id'])){echo "Modifier";} else { echo $action; } ?>" value="<?php if(isset($_POST['id'])){echo "Modifier";} else { echo $action; } ?>" />

                                

                                <input name="" class="espace_candidat" type="reset" style="width:90px"/>

                                

                                   

                            </td>

                        </tr>

                        <tr>

                            <td colspan="2">

                                <div class="ligneBleu"></div>

                            </td>

                        </tr>

                        <tr>

                             <td colspan="2">



                            <p style="color:#CC0000"> P.S: les champs marqués par (*) sont obligatoires<br/>

                            



                            </p></td>

                

                        </tr>

                        </table>