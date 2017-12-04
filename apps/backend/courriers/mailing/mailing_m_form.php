<?php



		$r_id = '';		$r_titre = '';		$r_email = '';		$r_pj = '';		$r_obj = '';		$r_msg = '';	

    if(isset($_POST['t_sujet']))



    {



            $t_sujet = isset($_POST['t_sujet'])  ? $_POST['t_sujet'] : "";

			$q = $t_sujet ;

//============================================================================================================================== 

		$option_tmail='';		$v='';	 $req_01 = mysql_query( "SELECT * FROM email_type where id_email=".$q." ");				

		 $r01 = mysql_fetch_array( $req_01 );				

		$r_id = $r01['id_email'];		$r_titre = $r01['titre'];		$r_email = $r01['email'];		$r_pj = $r01['p_joint'];		

		$r_obj = $r01['objet'];		$r_msg = $r01['message'];		

//==============================================================================================================================



       

    }



?>





<table width="100%">

                        <tr>

                                <td colspan="2"><div class="ligneBleu"></div></td>

                        </tr>







                            <tr>

                                <td colspan="2">

                                    <h2><b>Formulaire de l’email :</b></h2>

                                    <br>

                                </td>

                            </tr>

                            <tr>

                                <td align="right">

                                    <b>Choisir une maquette du mail  :<span style="color:red">*</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>

                                </td>

                                

                                <td> 

								

     

									<form  action="<?php echo $_SERVER['REQUEST_URI']; ?>"  method="POST">



                                        <select name="t_sujet" id="t_sujet"  style="width:250px" required onchange="this.form.submit()" />

                                        <option value=""></option> 

                                            <?php

                                            //$req_theme = mysql_query("SELECT * FROM  email_type WHERE id_email=1");

                                            $req_theme = mysql_query("SELECT * FROM  email_type ");

                                            while ($data = mysql_fetch_array($req_theme)) {

                                             $m_id = $data['id_email']; $obj = $data['titre']; 

                        ?>

<option value="<?php echo $m_id; ?>" <?php if (isset($_POST['t_sujet']) and $_POST['t_sujet'] == $m_id) echo ' selected="selected"'; ?>>

<?php echo $obj; ?></option>

<?php



                                            }

                                            ?> 

                                        </select> 

     

									</form>



                                </td>

                            </tr>

                            

     

     

<form  action="<?php echo $_SERVER['REQUEST_URI']; ?>"  method="POST"  enctype="multipart/form-data">

                            

                                    <input type="hidden" id="m_id" name="m_id" value="<?php echo $r_id; ?>" maxlength="80" style="width:246px"    />

                            <tr>

                                <td align="right">

                                    <b>Votre email  : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>

                                </td>

                                

                                <td>

                                    <input  type="text" name="m_email" id="m_email" value="<?php echo $r_email; ?>" maxlength="80" style="width:246px"   required/> 

                                </td>

                            </tr>

                            

                            <tr>

                                <td align="right">

                                    <b>Sujet  : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>

                                </td>

                                

                                <td>

                                    <input id="Sujet0" type="text" name="Sujet" value="<?php echo $r_obj; ?>" maxlength="80" style="width:246px"   required/>

                                </td>

                            </tr>

                            <tr <?php if(isset($_SESSION['destination']) and $_SESSION['destination'] !=-2) echo 'style="display:none"'; ?>>

                                <td align="right">

                                    <b>Selectionnez les emails  :<span style="color:red">*</span>

                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>

                                </td>

                                

                                <td>  

                                        <textarea style="width:244px; height: 50px; " name="m_emails" id="m_emails" ></textarea> 

                                </td>

                            </tr>

                            <tr>

                                <td align="right">

                                    <b>Votre message  : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b><br>

                                </td>

                                

                                <td>

                                        

                                        <textarea style="width:250px;" name="m_message" id="m_message" cols="30" rows="5" required><?php echo $r_msg; ?></textarea>

										 <script type="text/javascript">

										 CKEDITOR.replace( 'm_message') 

										 </script> 

										<br>

                                        <span style=" color: brown;   font-size: 10px;">Le message sera ajouté à la maquette choisie.</span> 

                                </td>

                            </tr>

                            

                            <tr>

                                <td align="right">

                                    <b>Pi&egrave;ce &agrave; joindre  : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b><br>

                                </td>

                                

                                <td>

                                        

                                       <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />

                                       <input type="file" name="piecejointe" id="piecejointe" /><br>

                                       <label for="piecejointe" style="margin-top:8px; margin-bottom:8px;color: chocolate;">Seuls les fichiers (.doc, .jpg, .gif, .png ou .pdf) sont accept&eacute;s</label>

                                </td>

                            </tr>

                            

                            <tr>

                                    <td colspan="2"><div class="ligneBleu"></div></td>

                            </tr>

                            <tr>

                                <td></td>

                                <td>

                                <input type="submit" class="espace_candidat" name="envoyer_emails" value="Envoyer"   >

                                </td>

                            </tr>

                        

                             

						    

</form>



                           

                            <tr>

                                    <td colspan="2"><div class="ligneBleu"></div></td>

                            </tr>

                        </table> 

						



