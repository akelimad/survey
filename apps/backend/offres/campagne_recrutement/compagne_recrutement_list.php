
<?php  

//session_start();

require(dirname(__FILE__).'/../../../config/config.php');

mysql_connect($serveur,$user,$passwd);

mysql_select_db($bdd);



if(isset($_POST['id_list']) &&  !empty($_POST['dossier']))
{
			//$id_candidature = isset($_POST['id_candidature'])  ? $_POST['id_candidature'] : "";
 			$dossier      = isset($_POST['dossier'])  	? $_POST['dossier']    		 : "";
 			$id_list      = isset($_POST['id_list'])  	? $_POST['id_list']    		 : "";
			$tab_id = explode(",", $id_list);
			
				$msg='';
				for ($i = 0; $i < count($tab_id); $i++){
				$count=0;
				$sql_s="SELECT * FROM campagne_offres WHERE candidats_id = '".$tab_id[$i]."' AND id_compagne = '$dossier'  ";
				echo $sql_s.'<br>';
			$select  = mysql_query($sql_s);
		
			while ($row = mysql_fetch_assoc($select)) {
				    $count=$count+1;
				}
				if ($count > 0)
						{
						$msg.='<p style=color:#CC0000>Candidate id '.$tab_id[$i].' existe dans ce dossier</p> ';	
						}
				if ($count == 0) 
						{	
						$sql_i="INSERT INTO campagne_offres VALUES ('$dossier','".$tab_id[$i]."')";
						mysql_query($sql_i);
						echo $sql_i.'<br>';
						$msg.='<p style=color:#09B34D>Candidate id '.$tab_id[$i].'  enregistr&eacute;e avec succ&egrave;s !</p> ';						   
						}
						
				}
				echo '
				<div id="repertoire0">
                <div id="fils">
                 <div id="fade" style="background: #000; " ></div>
                  <div class="popup_block"   style="width: 25%; z-index: 999; top: 30%; left: 40%;height:auto; overflow:auto" >
                    <!--<div class="titleBar">
                      <a href="javascript:fermer()">
					  <a href="javascript:hideDiv0()" >
                      <div class="close" style="cursor: pointer;">close</div>
                      </a> </div>-->
                    <div id="content" align="center" class="content" style=" height: auto; "> <h3>'.$msg.' </h3> </div></div></div> </div> 
					 <meta http-equiv="refresh" content="1;'.$_SESSION['page_courant '].'" /> ';	
					
			}
			
	else	
		echo '<p style=color:#CC0000>Le choix du dossier est obligatoire !</p> ';

	?>