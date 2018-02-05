

<table width="100%" border="0" cellspacing="0" id="dossier" class="tablesorter" style="background: none;">



<thead>

        <tr>

            <th width="3%"><center><b> N° </b></center></th>

            <th width="40%"><center><b> Nom dossier</b></center></th>

            <th width="20%"><center><b> Date création</b></center></th>

            <th  width="30%" ><center><b>Nombre du CV par dossier</b></h2></center></th>

            <th width="15%"><center><b>Actions</b></center></th>

        </tr>

</thead>

<tbody>



                        <?php

  $count = mysql_num_rows($select);

if($count<1){

    echo  ' <tr><td colspan="5"><center>Aucunes données trouvez</center></td></tr>';}

else{                     

                        $trcolor='';

                        $oddeven=1;$inum=0;



                            while( $reponse = mysql_fetch_array($select)) {

                                $inum++;

                                $is=$inum+$limitstart;

                            if($oddeven==1)

                            {

                            $oddeven=2;

                            $trcolor='';

                            }

                            else

                            {

                            $oddeven=1;

                            $trcolor='bgcolor="#DDDDDD"';

                            }

                            

                                ?>          



<tr <?php echo $trcolor; ?> onmouseover="this.className='marked'" onmouseout="this.className=''" >

                                    

<td align="center" style="border:1px solid #FFFFFF;">

<span class="badge"><?php echo $is; ?></span>

</td>





<td align="center" style="border:1px solid #FFFFFF;">

<?php

$select_dossier_candidats = mysql_query("SELECT * from dossier_candidat

 where  id_dossier = '".$reponse['id_dossier']."' ");

$dossier_existe = mysql_num_rows($select_dossier_candidats);

if ($dossier_existe)

{

?>

<a href="./candidats/?in_d=<?php echo $reponse['id_dossier']; ?>" title="La liste des candidats">

<b><?php echo $reponse['nom_dossier']; ?></b>

</a>

<?php }else{ ?>

<?php echo $reponse['nom_dossier']; ?>

<?php } ?>

</td>



<td align="center" style="border:1px solid #FFFFFF;">

<?php echo date("d.m.Y H:s",strtotime($reponse['datestamp'])); ?>

</td>

                                        

<td align="center" style="border:1px solid #FFFFFF;">

<?php                                                                  //id_dossier



if ($dossier_existe)

{

    echo '<a href="./candidats/?in_d='.$reponse['id_dossier'].'" 

title="La liste des candidats"> 

<i class="fa fa-file fa-fw " style="color:#47A948;"></i> '.$dossier_existe .'</a>';

}

else

{

    echo '<i class="fa fa-file fa-fw " ></i> '.$dossier_existe ;

}   



?>

</td>

<td style="border:1px solid #FFFFFF;" align="center">

<a href="./?action=modifier&id=<?php echo $reponse['id_dossier'] ?>&nom_dossier=<?php echo $reponse['nom_dossier'] ?>" >

<i class="fa fa-pencil-square-o fa-fw fa-lg"></i>

</a>

<a href="javascript:void(0)" onclick="if(confirm('Êtes-vous sûre de vouloir supprimer ce dossier?'))location.href='?action=delete&id=<?php echo $reponse['id_dossier'] ?>'">

<i class="fa fa-trash-o fa-fw fa-lg" style="color:#DB1212;"></i>

 </a>

</td>

</tr>



 <?php

}

}

?>   

</tbody>

</table>

                <div <?php  if($nbPages>1) echo 'style="float:left"'; ?>>

        <form id="frm" method='post' >

          <select onchange="this.form.submit()" name="t_p_g"  style="width: 50px; margin-right: 20px;" >

            <option value="10"  <?php if(isset($_SESSION["i_t_p_g"]) and $_SESSION["i_t_p_g"]=='10')  echo "selected"; ?> >10 </option>

            <option value="20"  <?php if(isset($_SESSION["i_t_p_g"]) and $_SESSION["i_t_p_g"]=='20')  echo "selected"; ?> >20 </option>

            <option value="30"  <?php if(isset($_SESSION["i_t_p_g"]) and $_SESSION["i_t_p_g"]=='30')  echo "selected"; ?> >30 </option>

            <option value="40"  <?php if(isset($_SESSION["i_t_p_g"]) and $_SESSION["i_t_p_g"]=='40')  echo "selected"; ?> >40 </option>

            <option value="50"  <?php if(isset($_SESSION["i_t_p_g"]) and $_SESSION["i_t_p_g"]=='50')  echo "selected"; ?> >50 </option>

            <option value="100" <?php if(isset($_SESSION["i_t_p_g"]) and $_SESSION["i_t_p_g"]=='100') echo "selected"; ?> >100</option>

			<option value="99999" <?php if(isset($_SESSION["i_t_p_g"]) and $_SESSION["i_t_p_g"]=='99999') echo "selected"; ?> >Tous</option>	

           </select>

        </form>

</div> 

     <div class="pagination">

         <?php        





$la_page = '?' ;

            require_once (dirname ( __FILE__ ) . $incurl2.'/class.pagination2.php');

            

Pagination::affiche($la_page, 'idPage', $nbPages, $pageCourante, 2);

            

            ?>

    </div>