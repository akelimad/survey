<?php

 

//echo "  <br> <p>a_1</p>";





		   $percent=$i_prog = 0;

		  

		

			$candidats_note = mysql_query("SELECT * FROM candidature  WHERE id_offre = '".$id_off_m."'");

			

			$num_rows = mysql_num_rows($candidats_note);

			

			



/**

 *  1/2

 *********************************************************************************************************************************************

 *  debut

 */

		 

		class ProgressBar {

				var $percentDone = 0;

				var $pbid;

				var $pbarid;

				var $tbarid;

				var $textid;

				var $decimals = 1; 

		 

		 

				function __construct($percentDone = 0) {

						$this->pbid = 'pb';

						$this->pbarid = 'progress-bar';

						$this->tbarid = 'transparent-bar';

						$this->textid = 'pb_text';

						$this->percentDone = $percentDone;

				}

		  

		 

				function setProgressBarProgress($percentDone, $text = '') {

						$this->percentDone = $percentDone;

						$text = $text ? $text : number_format($this->percentDone, $this->decimals, '.', '').'%';

						print('

						<script type="text/javascript">

						if (document.getElementById("'.$this->pbarid.'")) {

								document.getElementById("'.$this->pbarid.'").style.width = "'.$percentDone.'%";');

						if ($percentDone == 100) {

							  //  print('document.getElementById("'.$this->pbid.'").style.display = "none";');

						} else {

								print('document.getElementById("'.$this->tbarid.'").style.width = "'.(100-$percentDone).'%";');

						}

						if ($text) {

								print('document.getElementById("'.$this->textid.'").innerHTML = "'.htmlspecialchars($text).'";');

						}

						print('}</script>'."\n");

						$this->flush();

				}

		 

				function flush() {

						print str_pad('', intval(ini_get('output_buffering')))."\n";

						//ob_end_flush();

						flush();

				}

		 

		}



		echo ' <br />';

		 

		$p = new ProgressBar();

		$p->setProgressBarProgress(0);





/**

 *  1/2

 *********************************************************************************************************************************************

 *  fin

 */ 

 

//echo "  <br> <p>a_2</p>";

						

						

                 while ($candidats_n = mysql_fetch_array($candidats_note)) {

						 

										

//echo "  <br> <p>a_2___1</p>";	

						

						 $id_candidature=$candidats_n['id_candidature'];

						 $id_candidat=$candidats_n['candidats_id'];

						 $id_offre = $id_off_m;

						 /* */

						 $notation = mysql_query("SELECT * from formations where id_formation  = (SELECT MIN(id_formation) FROM formations where candidats_id = '".$id_candidat."') LIMIT 0 , 1");

						 $array_n = mysql_fetch_array($notation);

						 

						 			

//echo "  <br> <p>a_2___2</p>";	

						

						 

						/* traitement ecole */

						$note_ecole = 0;

						$ecoless = mysql_query("SELECT *  FROM offre_necole  WHERE   id_offre = '".$id_offre."'");

						while($ecoless_n = mysql_fetch_array($ecoless)){

							if($array_n['id_ecol'] == $ecoless_n['id_ecole']) 

							$note_ecole = $ecoless_n['note'];

						}



			

//echo "  <br> <p>a_2___3</p>";	

						

						 

						/* traitment filiere*/

						$note_filiere = 0;

						$filiere = mysql_query("SELECT *  FROM offre_nfiliere  WHERE   id_offre = '".$id_offre."'");

						while($filiere_n = mysql_fetch_array($filiere)){

							if($array_n['diplome'] == $filiere_n['id_fili'] ) 

							$note_filiere = $filiere_n['note'];  

						}



			

//echo "  <br> <p>a_2___4</p>";	

						

						 



						/* traitment diplome*/

						$note_diplome=1; 

						  $date_f = $array_n['date_fin']; 

						  $date_f = explode("/", $date_f); 

						  if(!empty($date_f[2])) {

						  $date_f_cl = (date("md", date("U", mktime(0, 0, 0, $date_f[0], $date_f[1], $date_f[2]))) > date("md") ? ((date("Y") - $date_f[2]) - 1) : (date("Y") - $date_f[2]));

						  } else {

						  $date_f_cl = (date("m", date("U", mktime(0,  $date_f[0] ))) > date("m") ? ((date("Y") - $date_f[1]) - 1) : (date("Y") - $date_f[1]));

						  }

						if($date_f_cl<2) 		 $note_diplome=5; 

						if($date_f_cl<4 and $date_f_cl>1) 		 $note_diplome=3;



						/* traitment experience*/

						$note_experience=0;

						$sum_day_exp=0;

							$select_experience_pro = mysql_query("SELECT * from experience_pro where id_tpost  <> '4' and candidats_id = '".$id_candidat."' ");

							

										

//echo "  <br> <p>a_2___5</p>";	

						

						 

						 

							while($experience_pro = mysql_fetch_array($select_experience_pro)) {

								/*

								  $date_f = $experience_pro['date_fin']; 

								  $date_f = explode("/", $date_f); 

								  

								  $date_f_cl = (date("md", date("U", mktime(0, 0, 0, $date_f[0], $date_f[1], $date_f[2]))) > date("md") ? ((date("Y") - $date_f[2]) - 1) : (date("Y") - $date_f[2]));

						   

								 $note_experience=1;

								if($date_f_cl<4) 		 $note_experience=3;

								if($date_f_cl<2) 		 $note_experience=5;  

								*/

						//* 

						

								  $date_d =  (empty($experience_pro['date_debut'])) ? date("d/m/Y") : $experience_pro['date_debut'] ; 

								  

								  $date_d = explode("/", $date_d); 

								  

								  $date_f =  (empty($experience_pro['date_fin'])) ? date("d/m/Y") : $experience_pro['date_fin'] ;    

								  $date_f = explode("/", $date_f); 

								  

									  $dd2=$date_d[2];$dd1=$date_d[1];$dd0=$date_d[0];

									  $df2=$date_f[2];$df1=$date_f[1];$df0=$date_f[0];



								  if($date_d[0]>2000){

									  $dd2=$date_d[0];$dd1='01';$dd0='01';

								  }if($date_d[1]>2000){

									  $dd2=$date_d[1];$dd1=$date_d[0];$dd0='01';

								  }else{ 

									  $dd2=$date_d[2];$dd1=$date_d[1];$dd0=$date_d[0];

								  }

								  if($date_f[0]>2000){

									  $df2=$date_f[0];$df1='01';$df0='01';

								  }if($date_f[1]>2000){

									  $df2=$date_f[1];$df1=$date_f[0];$df0='01';

								  }else{ 

									  $df2=$date_f[2];$df1=$date_f[1];$df0=$date_f[0];

								  }

								  

									  		

//echo "  <br>dd ".$experience_pro['id_exp']."<p>".$experience_pro['date_debut']." : ".$dd2.'-'.$dd1.'-'.$dd0."</p>";	

//echo "  <br>df<p>".$experience_pro['date_fin']." : ".$df2.'-'.$df1.'-'.$df0."</p>";	



						   $dStart = new DateTime($dd2.'-'.$dd1.'-'.$dd0);

						   $dEnd   = new DateTime($df2.'-'.$df1.'-'.$df0);

						   $dDiff  = $dStart->diff($dEnd); 

						   $sum_day_exp += $dDiff->days;

						//*/

								

								}

			

//echo "  <br> <p>a_2___6</p>";	

						

						 

								$day_yr=$sum_day_exp/365; 

								$note_experience= round($day_yr*8, 0) ; 

								if($note_experience>40) 	$note_experience=40;

								

								



						/* traitment stages*/

						$note_stages=0;

						$select_experience_pro_s = mysql_query("SELECT * from experience_pro where id_tpost  = '4' and candidats_id = '".$id_candidat."' ");

						while($experience_pro_s = mysql_fetch_array($select_experience_pro_s)) {

							$note_stages=5;

						}	

			

//echo "  <br> <p>a_2___7</p>";	

						

						 

						/* traitment experience plus 3 ans ==> stages = 0 */

								if($note_experience>23) $note_stages=0;



						/* =========== insertion table notation =========== */	 

		

										/*	 (`id_note1`, `id_candidature`, `note_ecole`, `note_filiere`, `note_diplome`, `note_experience`, `note_stages`, `obs`)	

				$sql_note = "INSERT INTO  notation_1  VALUES ( '', '$id_cd', '$note_ecole', '$note_filiere', '$note_diplome', '$note_experience', '$note_stages', '')";	*/

				

				$sql_a = "SELECT * FROM `notation_1` WHERE  `id_candidature`='$id_candidature'  LIMIT 0 , 1";

				

				//echo '<br>a : '.$sql_a.'<br>';

				

				$tst_notation = mysql_query($sql_a);

				$a = mysql_num_rows($tst_notation);

							

//echo "  <br> <p>a_2___8</p>";	

						

						 

				//echo '<br>a : '.$a.'<br>id_offre : '.$id_offre.'<br>id_candidat : '.$id_candidat.'<br>id_candidature : '.$id_candidature.'<br>';

				

				if($a>0) {

				$sql_note = "UPDATE `notation_1` SET  `note_ecole`='".safe($note_ecole)."',`note_filiere`='".safe($note_filiere)."',`note_diplome`='".safe($note_diplome)."',`note_experience`='".safe($note_experience)."',`note_stages`='".safe($note_stages)."',`obs`='".safe($day_yr)."'  WHERE `id_candidature`='".safe($id_candidature)."'";

								

				

				} else {

				$sql_note = "INSERT INTO  notation_1  VALUES('','".safe($id_candidature)."','".safe($note_ecole)."','".safe($note_filiere)."','".safe($note_diplome)."','".safe($note_experience)."','".safe($note_stages)."','".safe($day_yr)."')";

				}

				

				//echo $sql_note;

				

		        mysql_query($sql_note);

							

//echo "  <br> <p>a_2___9</p>";	

						

						 

				/* =========== update table candidature =========== */	

						$sum_not = $note_ecole + $note_filiere + $note_diplome + $note_experience + $note_stages ; 

				mysql_query("UPDATE `candidature` SET  `notation`='".safe($sum_not)."'  WHERE `id_candidature`='".safe($id_candidature)."' ");





				

				     

			 

			$i_prog++;    

			$percent = intval(($i_prog/$num_rows) * 100);  

			  $p->setProgressBarProgress($percent);

				 //usleep(1000000*0.1);

				  

		  //if($percent > 50) break;

		  }

  

	   

//echo "  <br> <p>a_3</p>";



/**

 *  2/2

 *********************************************************************************************************************************************

 *  debut

 */

 

			$p->setProgressBarProgress(100);

			 

			echo '<div style="width: 815px;">';

			echo 'Progression de mise à jour : ';



			echo '<div id="pb" class="pb_container">

									<div id="pb_text" class="pb_text">100.0%</div>

									<div class="pb_bar">

											<div id="progress-bar" class="pb_before" style="width: 100%;"></div>

											<div id="transparent-bar" class="pb_after" style="width: 54%;"></div>

									</div>

									<br style="height: 1px; font-size: 1px;">

							</div> ';



			echo '</div>';





//echo "  <br> <p>a_4</p>";

/**

 *  2/2

 *********************************************************************************************************************************************

 *  fin

 */

 ?> 