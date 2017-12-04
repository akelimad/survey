
<?php  

//session_start();

require(dirname(__FILE__).'/../../../../../config/config.php');

mysql_connect($serveur,$user,$passwd);

mysql_select_db($bdd);



if(isset($_POST['id_candidature']) &&  !empty($_POST['dossier']))
{
			$id_candidature = isset($_POST['id_candidature'])  ? $_POST['id_candidature'] : "";
 			$dossier      = isset($_POST['dossier'])  	? $_POST['dossier']    		 : "";
			
			$select  = mysql_query("SELECT * FROM dossier_candidat WHERE candidats_id = '$id_candidature' AND 
                id_dossier = '$dossier'  ");
			$count=0;
			while ($row = mysql_fetch_assoc($select)) {
				    $count=$count+1;
				}
				
				if ($count > 0)
						{
						echo '<p style=color:#CC0000>Candidate existe dans ce dossier</p> ';	
						}
				if ($count == 0) 
						{	
						mysql_query("INSERT INTO dossier_candidat VALUES ('".safe($dossier)."','".safe($id_candidature)."')"); 
						   echo '
				<div id="repertoire0">
                <div id="fils">
                 <div id="fade" style="background: rgba(0, 0, 0, 1);"></div>
                  <div class="popup_block"   style="width: 25%; z-index: 999; top: 30%; left: 40%;height:100px; overflow:auto" >
                    <div class="titleBar">
                      <!--<a href="javascript:fermer()">-->
					  <a href="javascript:hideDiv0()" >
                      <div class="close" style="cursor: pointer;">close</div>
                      </a> </div>
                    <div id="content" align="center" class="content" style=" height: 42px; "> <h3><p style=color:#09B34D>Votre action a &eacute;t&eacute; enregistr&eacute; avec succ&egrave;s !</p> </h3> </div></div></div> </div>  <meta http-equiv="refresh" content="1;'.$_SESSION['page_courant '].'" />  ';
						}	
			}
			
	else	
		echo '<p style=color:#CC0000>Le choix du dossier est obligatoire !</p> ';

	?>