<div class='texte'><br/><br/>

<h1>STATISTIQUE POUR CHAQUE OFFRE</h1>

<p>Cette section vous permet d'afficher les détails de chaque offre.</p>

  <?php   $select_nbr = mysql_query("Select count(*) As nbr  FROM offre

                                            inner join candidature on offre.id_offre = candidature.id_offre

                                            ".$q_ref_fili_and."

                                            ORDER BY  `offre`.`Name` ASC ");

$count_nbr = mysql_fetch_array($select_nbr);?>

<div style=" float: right; padding: 2px 5px 0px 0px;">

   <a href="../" style=" border-bottom: none; ">

      <img src="<?php echo $imgurl ?>/arrow_ltr.png" title="Retour"><strong style="color:#fff">Retour</strong>

   </a>    

</div>

<div class="subscription" style="width:100%; margin: 10px 0pt;">

   <h1>Statistique pour chaque offre</h1>

</div>

<?php if($count_nbr['nbr'] < 1 ){ ?>

    <h3 style="  color: red;"> Statistiques pour chaque offre : <?php echo $count_nbr['nbr']; ?></h3>

<?php }else { ?>  



<table width="100%">

    <tr>

                                <td align="right">

                                    <b>Choisissez une offre  :<span style="color:red">*</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>

                                </td>

                                

                                <td> 

                                <form action="" method="post">

                                

                                        <select name="co" id="co" style="width: 300px;" onchange="this.form.submit()" >

                                            <option value="" > </option>  

                                          <?php $req_theme = mysql_query( "SELECT DISTINCT offre.Name, offre . * 

                                            FROM offre

                                            inner join candidature on offre.id_offre = candidature.id_offre

                                            ".$q_ref_fili_and."

                                            ORDER BY  `offre`.`Name` ASC  ");   

                                                          while ( $data = mysql_fetch_array( $req_theme ) ) {       

                                                          $id_offre = $data['id_offre'];

                                                          $name = $data['Name'];



                        ?>

<option value="<?php echo $id_offre; ?>" <?php if (isset($_POST['co']) and $_POST['co'] == $id_offre) echo ' selected="selected"'; ?>>

<?php echo $name; ?></option>

<?php

               }?>  

                                        </select> 

                                        </form>

                                </td>

                            </tr>

                            <tr>

                                    <td colspan="2"><br><div class="ligneBleu"></div></td>

                            </tr>

</table> 

<br> 

 

     <center>                                          

<?php include("./offres_details_m_table.php");?>

</center>

                    </div>

<?php } ?>



