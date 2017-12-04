<tr>







            <td colspan="3" class="subscription"><h1>Mes alertes 

            

            <span style="float:right;">



            <a style="color:#FFFFFF;text-decoration:none ;cursor: pointer;" onclick="createAlert(<?php     if(isset($_POST['requete'])) echo $_POST['requete']; else echo "'norequete'";        ?>);"  title="Création d'une alerte e-mail"  >

             <i class="fa fa-plus  fa-fw fa-lg" style="  color: #fff;"></i> créer une nouvelle alerte candidat </a> </span> 

             

            </h1></td>









          </tr>







          <tr>







            <td colspan="3">



            </td>



            </tr>







          <tr style="  background: #A6BFD3;">







            





            <th style="width:15%" ><center><b>Date</b></center></th>







            <th style="width:60%;"><b>Description de l'alerte</b></th>

            <th style="width:20%;" ><center><b>Actions</b></center></th>







          </tr>



          <tr>



          <td colspan="3" >



          <table id="table_alertes" width="100%"  >



          







          <?php   $select_alert = mysql_query("SELECT * from alert where candidats_id = '".safe($reponse['candidats_id'])."' order by id_alert desc ");             



          $count_alert = mysql_num_rows($select_alert);                  



          if ($count_alert) {            



          $ii = 1;                         



          $cc = 1;                



          while ($alerte = mysql_fetch_array($select_alert)) {        



          ?>







          <tr class="sectiontableentry<?php echo $ii = ($ii == 1) ? $ii++ : $ii--; ?>">



<?php

$var = array("/");

$replace   = array(".");

$date_rep = str_replace($var, $replace, $alerte['date']);

?>

 <td width="15%" ><center><b><?php echo $date_rep; ?></b></center></td>







            <td><?php echo $alerte['titre'] ?></td>

  <td width="20%" >



            

<div style="    float: left;    margin-right: 10px;">

              <form action="<?php echo $urloffre ?>/" method="post" name="recherche<?php echo $cc; ?>"> 

                <input name="id_alert" type="hidden" value="<?php echo $alerte['id_alert']; ?>" /> 

                <a href="<?php echo $urloffre ?>/?motcle=<?php echo $alerte['titre'] ?>" title="Executer la recherche" >

                <i class="fa fa-search fa-fw fa-lg"></i></a>

               </form>

</div>

             

<div style="    float: left;    margin-right: 10px;">

               <a href="#" onclick="editAlert(<?php echo $alerte['id_alert']; ?>,'<?php  $titre= str_replace("'","\'",$alerte['titre']); echo $titre;    ?>')"     title="Editer cette alerte" ><i class="fa fa-pencil fa-fw fa-lg"></i></a>

</div>



<div style="    float: left;    margin-right: 10px;">

              <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="formu<?php echo $cc; ?>">

        <input name="do" type="hidden" value="delete" /> 

                <input name="id_alert" type="hidden" value="<?php echo $alerte['id_alert']; ?>" /> 

                <a href="#" onclick="if(confirm('êtes vous sur de vouloir supprimer cette alerte?')) formu<?php echo $cc; ?>.submit();" title="Supprimer l'alerte" > <i class="fa fa-trash-o fa-fw fa-lg" style="color:#DB1212;"></i></a> 

              </form>

</div>



<div style="    float: left;    margin-right: 10px;">

              <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="form<?php echo $cc; ?>"> 

                <input name="id_alert" type="hidden" value="<?php echo $alerte['id_alert']; ?>" /> 

                <input name="do" type="hidden" value="activate" /> 

                <input type="checkbox" name="activation" onclick="form<?php echo $cc; ?>.submit()" title="Activer l'alerte" <?php if ($alerte['activate'] == 'true') echo 'checked'; ?> value="true"/> 

              </form>

</div>

              



              </td>







           







          </tr>







          <?php          



          $cc++;           



          }                 



          }                   



          else {             



          ?>



          







          <tr>







            <td colspan="3"> Vous n'avez aucune alerte. 

            <!--

            <a href="#" onclick="createAlert(<?php     if(isset($_POST['requete'])) echo $_POST['requete']; else echo "'norequete'";        ?>);" >Créer une alerte e-mail</a>

            -->

            </td>







          </tr>







          <?php            



          }                



          ?>

          </table>

          </td>



</tr>