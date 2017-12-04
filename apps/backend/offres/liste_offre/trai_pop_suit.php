
<?php  

//session_start();

require(dirname(__FILE__).'/../../../../config/config.php');

mysql_connect($serveur,$user,$passwd);

mysql_select_db($bdd);



if(isset($_POST['id_offre']) &&  !empty($_POST['compagne']))
{
			$id_offre = isset($_POST['id_offre'])  ? $_POST['id_offre'] : "";
 			$compagne      = isset($_POST['compagne'])  	? $_POST['compagne']    		 : "";
			
			$select  = mysql_query("SELECT * FROM campagne_offres WHERE id_offre = '$id_offre' AND id_compagne = '$compagne'  ");
			$count=0;
			while ($row = mysql_fetch_assoc($select)) {
				    $count=$count+1;
				}
				
				if ($count > 0)
						{
						echo '<div class="alert alert-success">
                        <p style=color:#CC0000>L\'offre et d&eacute;j&agrave; affecte a cette campagne de recrutement.</p>
                        </div> ';	
						}
				if ($count == 0) 
						{	
						$ins_req = "INSERT INTO campagne_offres VALUES ('$compagne','$id_offre')";
						mysql_query($ins_req);
						
						   echo '
				<div id="repertoire0">
                <div id="fils">
                 <div id="fade" style="background: #000; " ></div>
                  <div class="popup_block"   style="width: 25%; z-index: 999; top: 30%; left: 40%;height:100px; overflow:auto" >
                    <!--<div class="titleBar">
                      <a href="javascript:fermer()">
					  <a href="javascript:hideDiv0()" >
                      <div class="close" style="cursor: pointer;">close</div>
                      </a> </div>-->
                    <div id="content" align="center" class="content" style=" height: 42px; "> <h3><p style=color:#09B34D>Votre action a &eacute;t&eacute; enregistr&eacute; avec succ&egrave;s !</p> </h3> </div></div></div> </div> <meta http-equiv="refresh" content="1;'.$_SESSION['page_courant '].'" /> ';//.$ins_req;
						}	
			}
			
	else	
		echo '<div class="alert alert-error">
    <p style=color:#CC0000>Le choix de la campagne de recrutement est obligatoire !</p></div> ';

	?>