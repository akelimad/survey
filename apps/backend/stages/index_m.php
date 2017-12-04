  <div class='texte' style="padding-top:5px">

                            <div align="center">

                                <table width="393" border="0">

                                    <tr>

                                                    <td>

                                                        <?php echo $msg_alert ;?>

                                                    </td> 

                                                    </tr>

                                    <tr>

                                        <td><div class="subscription" style="margin: 0px 0pt;">

                                                <center><h1>Accés entreprise</h1></center>

                                            </div></td>

                                    </tr>

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

                                        <td bgcolor="#FFFFFF">

                                        <form nom="form1" method="post" 

                                        action="<?php echo $urladmin ?>/stages/">

                                                <table width="352" border="0">

                                                    

                                                    <tr>

                                                        <td width="117">Email d'utilisateur </td>

                                                        <td width="148"><label>                  

                                                                <div align="center">

                                                                    <input type="text" id="login"  name="login" 

                                                                    title="veuillez entrez l'email d'utilisateur" required/>

                                                                </div></label>    </td>

                                                        <td width="65" rowspan="3"><img src="<?php echo $imgurl ?>/icons/password.jpg" width="64" height="65" /></td>

                                                    </tr>

                                                    <tr>

                                                        <td>Mot de passe </td>

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