<?php

	if(isset($_GET['action']) && isset($_GET['id']))
	{
		$action = $_GET['action'];
		$id = $_GET['id'];

		require_once('../config/config.php');
		mysql_connect($serveur,$user,$passwd);
		mysql_select_db($bdd);	
		
		$select_repertoire = mysql_query("SELECT * from entrepreneuriat where id_entrepreneuriat = '$id'");
		$repertoire = mysql_fetch_array($select_repertoire);
		$civilite = $repertoire['civilite'];
		$prenom = $repertoire['prenom_entrepreneur'];
		$nom = $repertoire['nom_entrepreneur'];
		$pays = utf8_encode(stripslashes($repertoire['pays']));
		$rs = utf8_encode($repertoire['raison_social']);
		$email = $repertoire['email_entrepreneur'];
		$secteur = utf8_encode(stripslashes($repertoire['secteur']));
		$description = utf8_encode(stripslashes($repertoire['description']));
		if($action == "update")
		{
				switch ($civilite){
				case 'Mr': $select1 = 'selected';$select2 = '';$select3 = '';break;
				case 'Mme': $select1 = '';$select2 = 'selected';$select3 = '';break;
				case 'Mlle': $select1 = '';$select2 = '';$select3 = 'selected';break;
				}
				$div = '<div id="fils"><div id="fade"></div><div class="popup_block" style="width: 400px; z-index: 999; top: 30%; left: 40%;"><div class="titleBar"><div class="title">R&eacute;pertorier votre expertise</div><a href="javascript:fermer()"><div class="close" style="cursor: pointer;">close</div></a></div><div id="content" class="content"><form action="entrepreneuriat.php" method="post" onSubmit="return valid_insertion()"><input name="id" type="hidden" value="'.$id.'" /><table border="0" cellspacing="0" cellpadding="2"><tr><th scope="row"><div align="left">Civilit&eacute;: </div></th><td><select name="civil" id="civil"><option value="Mr" '.$select1.'>Mr</option><option value="Mme" '.$select2.'>Mme</option><option value="Mlle" '.$select3.'>Mlle</option></select></td></tr><tr><th scope="row"><div align="left">Nom: </div></th><td><input name="nom" id="nom" type="text" value="'.$nom.'" style="width:235px"/></td></tr><tr><th scope="row"><div align="left">Pr&eacute;nom: </div></th><td><input name="prenom" id="prenom" type="text" value="'.$prenom.'" style="width:235px"/></td></tr><tr><th scope="row"><div align="left">Pays: </div></th><td><input name="pays" id="pays" type="text" value="'.$pays.'" style="width:235px"/></td></tr><tr><th scope="row"><div align="left">Email: </div></th><td><input name="email" id="email" type="text" value="'.$email.'" style="width:235px"/></td></tr><tr><th scope="row"><div align="left">Raison sociale: </div></th><td><input name="rs" id="rs" type="text" value="'.$rs.'" style="width:235px"/></td></tr><tr><th scope="row"><div align="left">Secteur d\'activit&eacute;: </div></th><td><select name="secteur" id="secteur">';
				$select_secteur = mysql_query("select * from prm_sectors");
				while($sect = mysql_fetch_array($select_secteur))
				{
					if($sect['FR'] == $secteur)
						$selected = 'selected';
					else
						$selected = '';
					$div.='<option value="'.utf8_encode($sect['FR']).'" '.$selected.'>'.utf8_encode($sect['FR']).'</option>';
				}
				$div.='</select></td></tr><tr><th scope="row"><div align="left">Description de votre expertise: </div></th><td><textarea name="description" id="description" cols="27" rows="5">'.$description.'</textarea></td><td></td></tr><tr><th scope="row" colspan="2"><input name="send" value="Modifier" type="submit" /></th><td></td></tr></table></form></div></div></div>';
			echo $div;
		}
	}
?>
