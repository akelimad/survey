 
   
<div class="subscription" style="margin: 10px 0pt;">  
  <div style=" float: right; margin: -5px 10px 0px 0px;">
  <a href="javascript:void(0)" title="Imprimer" onclick="PrintElem('#imprime');return false;" style=" border-bottom: none; ">
  <img src="<?php echo $imgurl ?>/icons/print.png" title="Imprimer"/> 
  </a>
  <a href="javascript:void(0)" onclick="window.history.go(-1); return false;" style=" border-bottom: none; ">
<img src="<?php echo $imgurl ?>/arrow_ltr.png" title="Retour"/><strong style="color:#fff">Retour</strong>
</a>
  </div>
  <div style=" float: left; margin: -2px 0px 0px 10px;padding-left: 20px;">
    <a href="" >
    <h2 style="color:#fff;">
    Total des candidatures : <span class="badge"><?php echo $tpc; ?></span></h2>
    </a>
  </div> 
</div>

<div id="imprime"> 
<div id="divTableDataHolder"> 

<table width="100%" border="0" cellspacing="0" id="note_candidature" class="tablesorter" style="background: none;">  
<thead>
  <tr>
    <td widtd="2%" style="border: 1px solid #ccc;text-align: left;
    background:<?php echo $color_bg;?>">
    <center><b style="color:#fff">N°</b></center>
    </td>
    <td widtd="25%" style="border: 1px solid #ccc;text-align: left;background:<?php echo $color_bg;?>">
    <center><b style="color:#fff">NOM & PRENOM</b></center>
    </td>
    <td widtd="15%" style="border: 1px solid #ccc;text-align: left;background:<?php echo $color_bg;?>">
    <center><b style="color:#fff">TYPE ACTION</b></center>
    </td>
    <td widtd="15%" style="border: 1px solid #ccc;text-align: left;background:<?php echo $color_bg;?>">
    <center><b style="color:#fff">DATE ACTION</b></center>
    </td>
    <td widtd="15%" style="border: 1px solid #ccc;text-align: left;background:<?php echo $color_bg;?>">
    <center><b style="color:#fff">CHARG&#201; DE RECRUTEMENT</b></center>
    </td>
    <td widtd="15%" style="border: 1px solid #ccc;text-align: left;background:<?php echo $color_bg;?>">
    <center><b style="color:#fff">SYNTHESE D'ENTRETIEN</b></center>
    </td>
    <td widtd="15%" style="border: 1px solid #ccc;text-align: left;background:<?php echo $color_bg;?>">
    <center><b style="color:#fff">OFFRE</b></center>
    </td>
  </tr>
</thead>
<tbody>
  <?php
  $cc = mysql_num_rows($rst_pagination);
  /*echo $cc;
  */
  if($cc)
  { $iss=0;

  while($return = mysql_fetch_array($rst_pagination))
  {
    $iss++;
    $is=$iss+$limitstart; 
    $nom=$return['nom'];$prenom=$return['prenom'];
    $status=$return['status'] ;
    $commentaire=$return['commentaire'];
    $date_modification=$return['date_modification'];
    $Name=$return['Name'];$utilisateur=$return['utilisateur'];
  ?>  
  <tr>
    <td style="border: 1px solid #ccc;text-align: left;"><center>
    <?php echo $is; ?></center></td>
    <td style="border: 1px solid #ccc;text-align: left;"><center>
    <?php echo $nom.' '.$prenom; ?></center></td>
    <td style="border: 1px solid #ccc;text-align: left;"><center>
    <?php echo $status; ?></center></td>
    <td style="border: 1px solid #ccc;text-align: left;"><center>
    <?php echo $date_modification; ?></center></td>
    <td style="border: 1px solid #ccc;text-align: left;"><center>
    <?php echo $utilisateur; ?></center></td>
    <td style="border: 1px solid #ccc;text-align: left;"><center>
    <?php echo utf8_decode($commentaire); ?></center></td>
    <td style="border: 1px solid #ccc;text-align: left;"><center>
    <?php echo $Name; ?></center></td>  
  </tr>
  <?php } ?>
</tbody>
</table>
</div>
</div>

     <p> 
 
     </p>
  
     <?php
    }
    else
       echo '<tr><td colspan="6" align="center">Aucune candidature</td></tr></tbody></table></div></div>'; 

?>
    <div class="pagination">
       
      <?php   if( $cc>10  or $nbPages>1 ) { ?>
      <div style="  float: left;" >
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
      <?php   } ?>
           
      <div id=""> 
					<?php       
					$lapage = '?offre='.$id_offre;
					
					require_once (dirname ( __FILE__ ) . $incurl3.'/class.pagination2.php');
					Pagination::affiche ( $lapage, 'idPage', $nbPages, $pageCourante, 2 ); 

					?>
      </div>
              
    </div>
 

 
