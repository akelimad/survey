  <div class='texte' style="padding-top:5px">

  <?php

/* Mise a jour de status offre */

	  $today = date("Y-m-d"); 

     $request0 = mysql_query("select * from offre  where offre.date_expiration < '$today'  ");

       $req_offr='-';

            while ( $retour0 = mysql_fetch_array ( $request0 ) )  { 

					$req_offr="UPDATE offre SET status='Archivée'  where id_offre= ".$retour0['id_offre']." ";

					mysql_query($req_offr);	

				//echo $req_offr.'<br>';

				}

?>

                            <div align="center">

                                <table width="393" border="0">

                                    <tr>

                                                    <td>

                                                        <?php 

if(isset($messages) and !empty($messages))  {

        foreach($messages as $messages) 

        ?><?php    

          {     echo $messages;    } 

           ?><?php

      } 

      

                                                        //echo $msg_alert ;?>

                                                    </td> 

                                                    </tr>

                                    <tr>

                                        <td><div class="subscription" style="margin: 0px 0pt;">

                                                <center><h1>Accés entreprise</h1></center>

                                            </div></td>

                                    </tr>

                                    <tr>

                                        <td bgcolor="#FFFFFF"><form nom="form1" method="post" action="<?php echo $urladmin ?>/login/">

                                                <table width="100%" border="0">

                                                    

                                                    <tr>

                                                        <td width="117">

                                                       

                                                         <i class="fa fa-envelope-o " ></i>   

                                                        

                                                        Email d'utilisateur </td>

                                                        <td width="148"><label>                  

                                                                <div align="center">

                                                                    <input type="text" id="login"  name="login" 

                                                                    title="veuillez entrez l'email d'utilisateur" required/>

                                                                </div></label>    </td>

                                                        <td rowspan="3">

                                                        <center>

                                                        <i class="fa fa-users fa-5x" style="color:<?php echo $color_bg; ?>"></i>

                                                        </center>

                                                        </td>

                                                    </tr>

                                                    <tr>

                                                        <td><i class="fa fa-key " ></i>  

                                                        Mot de passe </td>

                                                        <td><label>

                                                                <div align="center">



                                                                    <input type="password" id="pass"  name="pass" 

                                                                    title="veuillez entrez le mot de passe" required/>

                                                                </div>

                                                            </label></td>

                                                    </tr>

                                                    

                                                </table>

                                                <table width="352" border="0">

                                                    <tr>

                                                        <td>&nbsp;</td>

                                                        <td style="100%">

                                                            <label>

                                                                <div align="center">

                                                                    <input type="submit" class="espace_candidat" name="Submit" value="IDENTIFIER"   />

                                                                    <input type="reset" class="espace_candidat" name="Submit2" value="REINITIALISER" />

                                                                </div>

                                                            </label>

                                                        </td>

                                                    </tr>

                                                </table>

                                                </form></td>

                                    </tr>

                                </table>



                            </div>

                        </div>

