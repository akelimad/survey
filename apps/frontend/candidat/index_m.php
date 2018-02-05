 

	<div class='texte' >

	  <div >

<?php
// echo $_SESSION['fb___email'] ;
/********************************erreur authentif initial pos/////////////*/



if($compte_desactive)

{

echo "ok";

?>







    <div id="repertoire">

                <div id="fils">

                  <div id="fade"></div>

                  <div class="popup_block"  style="width: 400px; z-index: 999; top: 30%; left: 32%;" >

               <form name= "F1" action="" method="post" id="formpopup">        

			   <div class="titleBar">

                      <div class="title">Réactivation de votre compte</div>

               

	<input class="close" style="cursor: pointer;height: 16px;" name="fermer" value="fermer" type="submit" />

					  </div>

                    <div id="content" class="content">

                   

				

                        <table border="0" cellspacing="0" cellpadding="2">

                          <tr>

                          <td>

                          <p>Votre compte candidat a été mis en veille. Souhaitez vous le réactiver?</p>

                          </td>

                          </tr>

       <tr>

             

        <td><input name="oui" value="Oui" class="espace_candidat" type="submit" />&nbsp;&nbsp; 
        <input name="non" class="espace_candidat" value="Non, je veux créer un nouveau" type="submit" />



                          

</td>

                          </tr>



                        </table>



                     



                    </div>

 </form>

                  </div>



                </div>



              </div>

			  

			  <?php }



			  

if(isset($compte_desactive_fb))

{

	if($compte_desactive_fb)

{

?>







    <div id="repertoire">

                <div id="fils">

                  <div id="fade"></div>

                  <div class="popup_block"  style="width: 400px; z-index: 999; top: 30%; left: 32%;" >

               <form name= "F1" action="" method="post" id="formpopup">         

			   <div class="titleBar">

                      <div class="title">Réactivation de votre compte</div>

                   	<input class="close" style="cursor: pointer;height: 16px;" name="fermer" value="fermer" type="submit" /></div>

                    <div id="content" class="content">

                

				

                        <table border="0" cellspacing="0" cellpadding="2">

                          <tr>

                          <td>

                          <p>Vous avez déjà un compte désactivé sur le site. souhaiter vous l'activer?</p>

                        </td>

                          </tr>

       <tr>

            

        <td><input class="espace_candidat" name="oui_fb" value="Oui" type="submit" /><input class="espace_candidat" name="non_fb" value="Non, je veux créer un nouveau compte" type="submit" />

</td>

                          



                          </tr>



                        </table>



                   



                    </div>

   </form>

                  </div>



                </div>



              </div>

			  

			  <?php }



			}?>











<div style="margin: 0px 0pt;text-align:left;" >

                   <h1>ESPACE RESERVE AUX CANDIDATS</h1> 

					<br/>

									  <?php

				  if(isset($displayerror) && $displayerror)

{

	//echo "<span style=\"text-indent:20px;\" ><h2>Erreur d'authentification</h2></span>";
$messages=array();
$msgs ="<div class='alert alert-error'>
<ul><li style='color:#FF0000'>Votre Email et/ou votre mot de passe est incorrect !</li></ul>
</div>";
array_push($messages,$msgs);

if(isset($messages) and !empty($messages))  {
        foreach($messages as $messages) 
        ?><?php    
          {     echo $messages;    } 
           ?><?php
      } 
      

}



?>

                  </div>



  <table style="width: 600px;height:129px;padding-left:0px;"   border="0"   >

    <tr>

    <td style="height:90px;"  valign="top"  >

<form name="form1" method="post" action="">

  <table style="width:300px;" border="0"   >

    <tr>

    <td colspan="2" >Déjà inscrit ? Connectez-vous</td>
	</tr>
    <tr><td><br/></td><td><br/></td></tr>
    <tr>

      <td style="width:108px;text-align:left" >Identifiant (email) </td>

      <td style="width:144px;text-align:left" ><input type="text" name="login" style="width: 200px;"/> </td>

    </tr>

    <tr>

      <td style="text-align:left">Mot de passe </td>

      <td style="text-align:left"><input type="password" name="pass" style="width: 200px;"/>      </td>

    </tr>


	</table>
<table width="352" border="0">

    <tr>

      <td>&nbsp;</td>

      <td><label> </label>
      <br/>
          <center>

            <input type="submit" name="Submit" class="espace_candidat" value="IDENTIFIER" />
            <input type="reset" name="Submit2" class="espace_candidat" value="REINITIALISER" />
           </center>

       </td>

    </tr>
	   <tr>

    <td colspan="2" style="text-align:right" >

<br/>

    <br/>

    </td>

    

    </tr>


	 <tr>
		<td colspan="2">
		 <table>
		 	 <tr >
				<td><div style="    margin: -5px 0 0 0;"><span class="csscaree csspuce"></div>	 </td> <td>   Vous n'avez pas encore de compte? cliquez <a href="<?php echo $urlcandidat; ?>/inscription/">ici</a>  </td> 				
			 </tr>
			 <tr><td></td><td></td></tr>
			 <tr >
				<td><div style="    margin: -5px 0 0 0;"><span class="csscaree csspuce"></div> </td> <td>    Vous avez oublié votre mot de passe? cliquez <a href="<?php echo $urlcandidat; ?>/mot_de_passe_perdu/">ici</a> </td> 		 
			 </tr>
		 </table>
		</td>
     </tr>

      </table>

</form>



</td>

    

    <td style="width:60px;">&nbsp;</td>

    <td style="width:303px">

	

	

	

	

	

	

	

	

	

	

	

	

	

		<div id="alternate-account">



	

                                                        <h1>

                                                            Ou&#8230;</h1>

                                                        <div>

                                                            <input name="action" value="verify" type="hidden" />

                                                            <input id="ProfilePicture" name="ProfilePicture" value="" type="hidden" />

                                                           

                                                             <fieldset>

															 

															 <ul>

															 <li>

                                                                   <?php
 		   

include_once "./fb/facebook.php";

 

$facebook = new Facebook(array(

	'appId'		=> $app_id, 
	'secret'	=> $app_secret,

	));

 

$user = $facebook->getUser();



if($user){

//==================== Single query method ======================================

	try{ 
		// Proceed knowing you have a logged in user who's authenticated.

		$user_profile = $facebook->api('/me');

	}catch(FacebookApiException $e){

		error_log($e);

		$user = NULL;

	}

//==================== Single query method ends =================================

}

 
if($user){

$next        =   $urlcandidat.'/logout_facebook.php';
 
//$next    = str_replace("/index.php","",$next);
//$next    = str_replace("/inscription.php","",$next);
 
	// Get logout URL

	$logoutUrl = $facebook->getLogoutUrl(array(

		'next'	=> $next, // URL to which to redirect the user after logging out

		));
 
	//echo '<a href="'.$logoutUrl.'">logout</a>';

}else{
 
$redirect    =   $urlcandidat.'/connexion_facebook.php';

//$redirect    =    str_replace("/index.php","",$redirect);
//$redirect    =    str_replace("./inscription.php","",$redirect);

//$cancel_url  =    'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'?facebook_cancel=1';

	// Get login URL

	$loginUrl = $facebook->getLoginUrl(array( 
											'display' => "popup", 
											'scope'	=> 'email', 
											'redirect_uri'	=>$redirect, 
											));

		echo '<a    onclick="var left = (screen.width/2)-(500/2);var top = (screen.height/2)-(200/2); window.open(\''.$loginUrl.'\',\'facebook\',\'width=500, height=200,top=\'+top+\',left=\'+left+\'\');window.close();"  href="index.php" style="border-bottom: none;"><img src="'.$site.'assets/images/facebook-connexion.png" height="21" width="169" alt="connexion avec facebook"  width="150"  /></a>';

}

?>

</li>

<li>
<!--
	<script type="in/Login">

	</script>


	<div id="demo" style="width: 173px;">
		<div >		
			<div id="picture" class="picture"></div>
			<div id="profiles" ></div>
		</div>
	</div>
-->
</li>



</ul>

</fieldset>                                                      

                                                         

                                                        </div>

                                                       

                                                    

													</div>

	

	

	

	

	

	

	

	

	

	

	

	

	

      <div style="text-align:left;">

        <ul style="padding-left:9px">

          <li>Réception des offres par e-mail<br />

          </li>

          <li>Votre CV consulté par l'entreprise<br />

          </li>

          <li>Suivi de vos candidatures</li>

        </ul>

      </div></td>

  </tr>

 <tr> 



<td colspan="3" >

 

   <?php

if(isset($_POST['envoi']))

{ 

	$email = isset($_POST['email'])? trim($_POST['email']) : "";

	$valid = "/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9_-]+\.[a-zA-Z0-9_-]+$/";

	$error = 0;

	if(empty($email))

	{

		$error = 1;

	}

	elseif(!preg_match($valid,$email))

		$error = 2;

	else

	{

	 	$sql = mysql_query("SELECT * FROM candidats WHERE email = '$email'");

		$exist = mysql_num_rows($sql);

		if(!$exist)

		{

			$error = 3;

		}

	}

	if($error)

	{

	  echo '<h1>Mot de passe oubli&eacute;</h1><h3>Informations incomplètes ou erroné </h3>';

	  echo '<ul>';

		if($error == 1 )

			echo "<li style='color:#FF0000'>Veuillez entrer votre adresse email!</li>";

		if($error == 2)

			echo "<li style='color:#FF0000'>L'email saisie n'est pas bien formaté</li>";

		if($error == 3)

			echo "<li style='color:#FF0000'>L'adresse e-mail saisie ne correspond à aucune adresse dans notre base de données! Si vous souhaitez vous inscrire, appuyez sur ce <a href ='inscription.php'>lien</a></li>";

	echo '</ul>';

?>

<div class="subscription" style="margin: 0px 0pt -6px;"><h1>Identification</h1></div>

<?php			

	}

	

}



?>

</td>

  </tr>

 

</table>



      </div>

    </div>

</div></div><!-- fin content gauche -->




 