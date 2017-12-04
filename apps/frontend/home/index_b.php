

<?php

if($compte_desactive)

{

?>

<div id="repertoire">

  <div id="fils">

    <div id="fade"></div>

    <div class="popup_block"  style="width: 400px; z-index: 999; top: 30%; left: 32%;" >

      <form name= "F1" action="" method="post" id="formpopup">        

      <div class="titleBar">

        <div class="title">Réactivation de votre dossier</div>

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

            <td><input name="oui" value="Oui" type="submit" />&nbsp;&nbsp; <input name="non" value="Non, je veux créer un nouveau" type="submit" />

            </td>

          </tr>

        </table>

      </div>

      </form>

    </div>

  </div>

</div>

<?php }?>

