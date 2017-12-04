<div class='texte'>



        <?php











?>

<br/>

<h1>MOT DE PASSE OUBLIE</h1>

<?php foreach ($messages as $message): ?>

  <div class="alert alert-error">

  		<?php echo $message; ?>

  </div>

<?php endforeach; ?>

<?php foreach ($message_succ as $message_succ): ?>

  <div class="alert alert-success">

      <?php echo $message_succ; ?>

      <meta http-equiv="refresh" content="3;URL=index.php">

  </div>



<?php endforeach; ?>





        <form method="post" id="form_standard" action="<?php echo($_SERVER['REQUEST_URI']); ?>">



          <table width="100%" border="0">



            <tr>

            

              <td> <div class="subscription" style="margin: 10px 0pt;">



              <h1>Vous avez oublié votre mot de passe?</h1>



       </div>   </td>



            </tr>



            <tr>



              <td>Si vous avez oublié votre mot de passe, veuillez entrer ci-dessous l'adresse e-mail que vous avez saisie lors de votre inscription. Ainsi un nouveau mot de passe vous sera envoyer à l'adresse indiquée.</td>



            </tr>



            <tr>



              <td>&nbsp;</td>



            </tr>



            <tr>



              <td><label>E-mail : </label>



                <span style="color:red;">*</span>&nbsp;&nbsp;



                <input name="email" type="email" style="width:300px"  placeholder="me@example.com" 

                title="Veuillez entrez un email valide" maxlength="50" required/><br /><br />



                <input class="espace_candidat" type="submit" name="envoi" value="Envoyer" /></td>



            </tr>



          </table>



        </form>



        <?php 







?>



      </div>