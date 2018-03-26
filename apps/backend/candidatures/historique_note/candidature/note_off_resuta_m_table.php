
   
     <div class="subscription" style="margin: 10px 0pt;">  
                                    <div style=" float: left; margin: -2px 0px 0px 10px;">
                                     <a href="javascript:void(0)" title="Imprimer" onclick="PrintElem('#imprime');return false;" style=" border-bottom: none; ">
                                            <img src="<?php echo $imgurl ?>/icons/print.png" title="Imprimer"/> 
                                    </a>
                                    </div> 
                                    <div style=" float: right; margin: -5px 10px 0px 0px;">
                                     <a href="<?php echo $_SESSION['page_courant_n']; ?>" style=" border-bottom: none; ">
                                            <img src="<?php echo $imgurl ?>/arrow_ltr.png" title="Retour"/><strong style="color:#fff">Retour</strong>
                                    </a>
                                    </div> 
                            </div>
               <div id="imprime"> 
             <table><tr><td colspan="2" ><h1> Offre : <b> <?php echo $reponse['Name']; ?> </b></h1> </tr> <tr class="odd"> 
             <td></td></tr></table>  

 <div id="divTableDataHolder"> 
 <table width="100%" border="0" cellspacing="0" id="note_candidature" class="tablesorter" style="background: none;">  

  <thead>
   <tr>
   <td widtd="5%" style="border: 1px solid #ccc;text-align: left;background:<?php echo $color_bg;?>"><b style="color:#fff">N°</b></td>
   <td widtd="15%" style="border: 1px solid #ccc;text-align: left;background:<?php echo $color_bg;?>"><b style="color:#fff">Nom & Prénom</b></td>
   <td widtd="10%" style="border: 1px solid #ccc;text-align: left;background:<?php echo $color_bg;?>"><b style="color:#fff">Ref</b></td>
   <td widtd="10%" style="border: 1px solid #ccc;text-align: left;background:<?php echo $color_bg;?>"><b style="color:#fff">Ecole</b></td>
   <td widtd="5%" style="border: 1px solid #ccc;text-align: left;background:<?php echo $color_bg;?>"><b style="color:#fff">Niveau</b></td>
   <td widtd="3%" style="border: 1px solid #ccc;text-align: left;background:<?php echo $color_bg;?>"><b style="color:#fff">Note</b></td>
   <td widtd="25%" style="border: 1px solid #ccc;text-align: left;background:<?php echo $color_bg;?>"><b style="color:#fff">Spécialité</b></td>
   <td widtd="3%" style="border: 1px solid #ccc;text-align: left;background:<?php echo $color_bg;?>"><b style="color:#fff">Note</b></td>
   <td widtd="5%" style="border: 1px solid #ccc;text-align: left;background:<?php echo $color_bg;?>"><b style="color:#fff">A.0</b></td>
   <td widtd="3%" style="border: 1px solid #ccc;text-align: left;background:<?php echo $color_bg;?>"><b style="color:#fff">Note</b></td>
   <td widtd="5%" style="border: 1px solid #ccc;text-align: left;background:<?php echo $color_bg;?>"><b style="color:#fff">Exp</b></td>
   <td widtd="3%" style="border: 1px solid #ccc;text-align: left;background:<?php echo $color_bg;?>"><b style="color:#fff">Note</b></td>
   <td widtd="5%" style="border: 1px solid #ccc;text-align: left;background:<?php echo $color_bg;?>"><b style="color:#fff">Stage</b></td>
   <td widtd="3%" style="border: 1px solid #ccc;text-align: left;background:<?php echo $color_bg;?>"><b style="color:#fff">Age</b></td>
   <td widtd="3%" style="border: 1px solid #ccc;text-align: left;background:<?php echo $color_bg;?>"><b style="color:#fff">Total</b></td>
  </tr>
  </thead>
  <tbody>
  <?php


  $cc = mysql_num_rows($rst_pagination);
  //echo $cc;
  if($cc)
  { 
  //$ii = 1;$i=0;
  $i=0;
  $alter_class=1;
  mysql_data_seek($rst_pagination,0);
  while($return = mysql_fetch_array($rst_pagination))
     {
         //$ii == 1 ? $ii++ : $ii--;
            $i++;
            $is=$i+$limitstart;
		 //////////////////////////
		$id_candidat=$return['candidats_id'];
		$id_candidature=$return['id_candidature'];
		
	
/* traitment candidats*/	

		$query_c="SELECT * from candidats where candidats_id  = '".$id_candidat."' limit 0,1 "; 
  			// echo '<br>'. $query_c; 
 		$req_c  =  mysql_query($query_c);	
		$return_c = mysql_fetch_array($req_c);

  $ageDate = $return_c['date_n']; 
  $ageDate = explode("/", $ageDate); 
  $age_cl = (date("md", date("U", mktime(0, 0, 0, $ageDate[0], $ageDate[1], $ageDate[2]))) > date("md") ? ((date("Y") - $ageDate[2]) - 1) : (date("Y") - $ageDate[2])); 
  

/* traitment notation*/
		$query_n="SELECT * from notation_1 where id_candidature  = '".$id_candidature."' limit 0,1 "; 
  			// echo '<br>'. $query_n; 
 		$req_n  =  mysql_query($query_n);	
		$return_n = mysql_fetch_array($req_n);
		
/* traitment formation*/
		$query_f="SELECT * from formations where id_formation  = (SELECT MIN(id_formation) FROM formations where candidats_id = '".$id_candidat."' ) limit 0,1 ";
 			// echo '<br>'. $query_f; 
 		$req_f  =  mysql_query($query_f);	
		$return_f = mysql_fetch_array($req_f);
  $dipDate = $return_f['date_fin']; 
  $dipDate = explode("/", $dipDate); 
 

		$query_nv="SELECT * from prm_niv_formation where id_nfor  = '".$return_f['nivformation']."' limit 0,1 "; 
  			// echo '<br>'. $query_nv; 
 		$req_nv  =  mysql_query($query_nv);	
		$return_nv = mysql_fetch_array($req_nv);
		
		$query_e="SELECT * from prm_ecoles where id_ecole  = '".$return_f['id_ecol']."' limit 0,1 "; 
  			// echo '<br>'. $query_e; 
 		$req_e  =  mysql_query($query_e);	
		$return_e = mysql_fetch_array($req_e);
    if ($return_f['id_ecol']!='290') { $type=$return_e['nom_ecole'];} else {$type=$return_f['ecole'];}

		$query_f="SELECT * from prm_filieres where id_fili  = '".$return_f['diplome']."' limit 0,1 "; 
  			// echo '<br>'. $query_f; 
 		$req_f  =  mysql_query($query_f);	
		$return_f = mysql_fetch_array($req_f);
		
		
/* traitment experiences*/
$note_experience=0;
$sum_day_exp=0;$EXP_t='';
    $select_experience_pro = mysql_query("SELECT * from experience_pro where id_tpost  <> '4' and candidats_id = '".$id_candidat."' ");
	/*
    while($experience_pro = mysql_fetch_array($select_experience_pro)) { 
		  $date_d = $experience_pro['date_debut']; 
		   $date_d = (empty($experience_pro['date_debut'])) ? date("d/m/Y") : $experience_pro['date_debut'] ; 
		  $date_d = explode("/", $date_d); 
		  
		  $date_f = (empty($experience_pro['date_fin'])) ? date("d/m/Y") : $experience_pro['date_fin'] ;    
		  $date_f = explode("/", $date_f); 
		  
   $dStart = new DateTime($date_d[2].'-'.$date_d[1].'-'.$date_d[0]);
   $dEnd  = new DateTime($date_f[2].'-'.$date_f[1].'-'.$date_f[0]);
   $dDiff = $dStart->diff($dEnd); 
   $sum_day_exp += $dDiff->days; 
   
   $EXP_t=(empty($experience_pro['date_fin'])) ? 0 : 1 ; 
		}	 
		//*/
	$day_yr=$sum_day_exp/365;  
	$note_experience= round($day_yr*8, 0) ; 
	if($note_experience>40) 	$note_experience=40;
		
		
		 //////////////////////////		
 
 
$query_nt="SELECT * from notation_1  WHERE notation_1.id_candidature = ".$id_candidature."   ";
     
 

$selects_nt = mysql_query($query_nt);

$tpc_nt = mysql_num_rows($selects_nt); 

 
		
		 $NOTE_Ec=0;
		 $NOTE_F=0;
		 $NOTE_A=0;
		 $NOTE_Ex=0; 
		 $NOTE_S=0;
			
		if($tpc_nt>0) {

		$return_nt = mysql_fetch_array($selects_nt); 
			
		 $NOTE_Ec=$return_nt['note_ecole'];
		 $NOTE_F=$return_nt['note_filiere'];
		 $NOTE_A=$return_nt['note_diplome'];
		 $NOTE_Ex=$return_nt['note_experience']; 
		 $NOTE_S=$return_nt['note_stages'];
		 
		}  
		

		 //////////////////////////	



		 
		 
         //$i++;
		 
		 //$N=intval($limitstart)*10;
		 //$N=$i+$limitstart;
		 $NOM='<a class="info" href="'.$urladmin.'/cv/?candid='.$id_candidat.'"  > '.
       '<b>' . $return_c['prenom'].'&nbsp;'.$return_c['nom'].'  </b></a>';

		 $REF='EMAILS';
		 $ECOLE=$return_e['nom_ecole'];
		 $NIVEAU=$return_nv['formation'];
		 $SPECIALITE=$return_f['filiere'];
		 $A_O=(empty($dipDate[2])) ? $dipDate[1] : $dipDate[2];
		 $EXP=($EXP_t!=1) ? $return_n['obs'] : round($day_yr,2) ; 
		 $EXP=(empty($EXP)) ? 0 : $EXP ;  
		 $AGE=$age_cl; 
		 $NOTE_T=$NOTE_Ec+$NOTE_F+$NOTE_A+$NOTE_Ex+$NOTE_S; 
		 
		 
		 
  ?>  
  <tr>
    <td style="border: 1px solid #ccc;text-align: left;"><center><?php echo $is; ?></center></td>
    <td style="border: 1px solid #ccc;text-align: left;"><center><?php echo $NOM; ?></center></td>
    <td style="border: 1px solid #ccc;text-align: left;"><center><?php echo $REF; ?></center></td>
    <td style="border: 1px solid #ccc;text-align: left;"><center><?php echo $type; ?></center></td>
    <td style="border: 1px solid #ccc;text-align: left;"><center><?php echo $NIVEAU; ?></center></td>
    <td style="border: 1px solid #ccc;text-align: left;"><center><?php echo $NOTE_Ec; ?></center></td>
    <td style="border: 1px solid #ccc;text-align: left;"><center><?php echo $SPECIALITE; ?></center></td>
    <td style="border: 1px solid #ccc;text-align: left;"><center><?php echo $NOTE_F; ?></center></td>
    <td style="border: 1px solid #ccc;text-align: left;"><center><?php echo $A_O; ?></center></td>
    <td style="border: 1px solid #ccc;text-align: left;"><center><?php echo $NOTE_A; ?></center></td>
    <td style="border: 1px solid #ccc;text-align: left;"><center><?php echo  number_format($EXP, 2, '.', '')?></center></td>
    <td style="border: 1px solid #ccc;text-align: left;"><center><?php echo $NOTE_Ex; ?></center></td>
    <td style="border: 1px solid #ccc;text-align: left;"><center><?php echo $NOTE_S; ?></center></td>
    <td style="border: 1px solid #ccc;text-align: left;"><center><?php echo $AGE; ?></center></td>
    <td style="border: 1px solid #ccc;text-align: left;"><center><?php echo $NOTE_T; ?></center></td>
    
  </tr>
     <?php 
     }
           
        ?>
    </tbody>
     </table>
     </div>
     </div>

     <p> 
 
     </p>
  
     <?php
    }
    else
       echo '<tr class="sectiontableentry1"><td></td><td colspan="14" align="center">Aucune candidature</td></tr></tbody></table>'; 

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
					 
					/* 
					$lapage = 'pages/'  ;
					require_once (dirname ( __FILE__ ) . $incurl2.'/class.pagination.php');
					 
					Pagination::affiche ( $lapage, 'idPage', $nbPages, $pageCourante, 2,$urladmin.'/accueil' );
			
					//*/
					?>
      </div>
              
    </div>
 

 
