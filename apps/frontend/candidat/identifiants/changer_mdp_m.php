<div class='texte'>

<h1>MES IDENTIFIANTS</h1>

<div class="subscription" style="margin: 10px 0pt;">

<h1>Vous souhaitez changer votre mot de passe?</h1>

</div>   

<?php

           //$succes = false;

           $messages=array();

           $messages_succ=array();

 if (isset($_POST['mdp']) && isset($_POST['mdp1'])&& !empty($_POST['mdp']) && !empty($_POST['mdp1']) && !empty($_POST['mdp2']) ) // Si les variables existent

    {

        $id_candidat = $_SESSION['abb_id_candidat'];

    $message = "";

    $pass = md5($_POST['mdp']);

    $pass1= md5($_POST['mdp1']);

    $pass1new= md5($_POST['mdp2']);

    $requet = mysql_query("select * from candidats WHERE `candidats_id` = '".$id_candidat."'"); 

    $reponse = mysql_fetch_array($requet);  

    

    if($pass1 == $pass1new)

    {

    if($pass!=$reponse['mdp'])

     array_push($messages,"<li style='color:#FF0000'>Le mot de passe actuel que vous avez entré, n\'est pas correct !</li>");



     else

     {

     if(!empty($pass1))

     {   

     $con = mysql_query("UPDATE candidats SET mdp ='".safe($pass1)."'  WHERE `candidats_id` = ".safe($id_candidat)." ");

          //$succes = true;

      array_push($messages_succ,"<li style='color:#468847'>Votre mot de passe a bien été modifié</li>");

         }

         else

      array_push($messages,"<li style='color:#FF0000'>le nouveau mot de passe que vous avez entré est vide</li >");



     }

     echo $message;

     }

     else 

            array_push($messages,"<li style='color:#FF0000'>Les mots de passe ne correspondent pas. Voulez-vous réessayer ?</li>");



}



?>

      

<ul>

<?php foreach ($messages as $message): ?>

    <div class="alert alert-error">

    <?php echo $message; ?>

    </div>

<?php endforeach; ?>



<?php foreach ($messages_succ as $messages_succ): ?>

    <div class="alert alert-success">

    <?php echo $messages_succ; ?>

    <meta http-equiv="refresh" content="10;URL=../compte/index.php">

    </div>

<?php endforeach; ?>

</ul>

       

     <form action="index.php" id="form_inscription"  method="post"  >

       <table style="width:587px;" border="0" >



   

    <tr>

      <td style="width:280px;" align="left">Votre mot de passe actuel </td>

      <td style="width:396px;" align="left"><input type="password" name="mdp" title="Votre mot de passe actuel " maxlength="50"  required /> </td>

    </tr>

    

    <tr>

      <td align="left">Nouveau mot de passe </td>

      <td align="left"><input type="password" id="mdp1" name="mdp1" oninput="form.mdp2.pattern = escapeRegExp(this.value)" 

      title="Nouveau mot de passe " maxlength="50"   required/>      </td>

      </tr>

      <tr>

      <td align="left">Confirmer le nouveau mot de passe </td>

      <td align="left"><input type="password" id="mdp2" name="mdp2" title="Confirmer le nouveau mot de passe" maxlength="50"  required />      </td>

    </tr>

    <tr>

        <td align="left"><br> </td>

      <td align="left"> <br></td>

    </tr>



</table> 

      <div class="ligneBleu"></div>

 <table style="width:587px;" border="0" >

 <tr>

        <td width="40%"> </td>

      <td width="60%">



            <input class="espace_candidat" type="submit" name="Submit" value="Valider" />

            <input class="espace_candidat" type="reset" name="nom" value=" Annuler " />

           

      </td>

</tr>

</table>

</form>



<?php



?>

    </div>

    <script>

    function escapeRegExp(str) {

      return str.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");

    }

</script>