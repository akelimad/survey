 			<div class='texte'><br><br/><h1> STATISTIQUES CANDIDATS </h1>                   <div  class="subscription" style="margin: 10px 0pt;"><h1>  CANDIDATS </h1></div> <table width="100%"><tr>                            <td width="25%"><b>Indicateur :</b></td>                            <td width="85%">							<select onChange="window.location.href=this.value">                                <option value="<?= get_current_url() ?>"></option>                <option value="<?= site_url('backend/reporting/statistiques_candidats/candidats_inscrits/'); ?>">Nombre des candidats inscrits</option>                <option value="<?= site_url('backend/reporting/statistiques_candidats/comptes_mettre_en_veille/'); ?>" >                                Nombre des comptes mettre en veille </option>                                <option value="<?= site_url('backend/reporting/statistiques_candidats/comptes_desactives/'); ?>" >Nombre des comptes supprimées  </option>                <option value="<?= site_url('backend/reporting/statistiques_candidats/repartition_candidats/'); ?>" >Répartition des candidats</option>                <option value="<?= site_url('backend/reporting/statistiques_candidats/cv_theque/'); ?>" selected>Nombre des CVs dans la CV-Thèque</option>                <option value="<?= site_url('backend/reporting/statistiques_candidats/cv_importees/'); ?>" >Nombre des CVs importées</option>              </select>							                              </td>                        </tr></table><br/><div class="ligneBleu"></div> 				  <div class="b1" style="width:690px;">  	<?php       include ( "./statistiques_candidats_4.php"); ?>	 	   </div>	   		<br />     </div>				 