 			<div class='texte'><br><br/><h1> STATISTIQUES CANDIDATS </h1>                   <div  class="subscription" style="margin: 10px 0pt;"><h1>  CANDIDATS </h1></div> <table width="100%"><tr>                            <td width="25%"><b>Indicateur :</b></td>                            <td width="85%">							<select onChange="window.location.href=this.value">								<option value="../candidats_inscrits/"   >Nombre des candidats inscrits</option>								<option value="../comptes_mettre_en_veille/" >                                Nombre des comptes mettre en veille </option>                                <option value="../comptes_desactives/" >Nombre des comptes supprimées </option>								<option value="../repartition_candidats/" >Répartition des candidats </option>								<option value="../cv_theque/">Nombre des CVs dans la CV-Thèque</option>								<option value="../cv_importees/" selected>Nombre des CVs importées</option>							</select>							                              </td>                        </tr></table><br/><div class="ligneBleu"></div> 		  <div class="b1" style="width:690px;">  	<?php       include ( "./statistiques_candidats_5.php"); ?>	 	   </div>	   		<br />     </div>				 