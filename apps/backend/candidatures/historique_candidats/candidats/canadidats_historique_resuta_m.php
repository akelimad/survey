


     <br/><h1> HISTORIQUE DES CANDIDATURES </h1>

		  
 <div class="texte"> 
        		<div style=" float: right; padding: 2px 5px 0px 0px;">
					<a href="<?php echo $_SESSION['page_courant '];?>" style=" border-bottom: none; ">
					   <img src="<?php echo $imgurl;?>/arrow_ltr.png" title="Retour"><strong style="color:#fff">Retour</strong>
				    </a>	
				</div>

<?php
		$idcand = (isset($_GET["idcand"]))? $_GET["idcand"] : '';
		/*//*/
		$selectString = "select * from  candidats INNER JOIN candidature on candidats.candidats_id = candidature.candidats_id    WHERE candidats.candidats_id = '".$idcand."' LIMIT 0 , 1";   
        $select = mysql_query( $selectString); 
		
		//candidature . * , candidats . * , formations . * , offre.Name, offre.reference
		  $query = "SELECT *
					FROM candidats
					INNER JOIN candidature ON candidats.candidats_id = candidature.candidats_id
					INNER JOIN offre ON candidature.id_offre = offre.id_offre
					INNER JOIN formations ON candidature.candidats_id = formations.candidats_id
					WHERE candidature.candidats_id  =$idcand 
					group by candidature.id_candidature ";
		  //echo $query;
        $req  =  mysql_query($query);
		$return = mysql_fetch_array($select);
		$req00_theme = mysql_query( "SELECT * FROM candidats where candidats_id = '".$return['candidats_id']."'");
$data00 = mysql_fetch_array($req00_theme);
?>
<div class="subscription" style="margin: 10px 0pt;">
<h1>Historique des candidatures de [ <?php echo '' . $data00['prenom'].'&nbsp;'.$data00['nom'].'  </b> '; ?> ] </h1>
</div>
<?php
include("./canadidats_historique_resuta_m_table.php");
  
 ?>
 </div>
         
         