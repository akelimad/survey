


<?php
if (isset($_SESSION['abb_id_candidat']) and !empty($_SESSION['abb_id_candidat'])) {
if($retenu_page=strpos($_SERVER['REQUEST_URI'],'/compte/'))
{$active1 ="style='color:".$color_bg_menu."' ";}
if($retenu_page=strpos($_SERVER['REQUEST_URI'],'/identifiants/'))
{$active2 ="style='color:".$color_bg_menu."' ";}
if($retenu_page=strpos($_SERVER['REQUEST_URI'],'/cv/'))
{$active3 ="style='color:".$color_bg_menu."' ";}
if($retenu_page=strpos($_SERVER['REQUEST_URI'],'/informations/'))
{$active4 ="style='color:".$color_bg_menu."' ";}
if($retenu_page=strpos($_SERVER['REQUEST_URI'],'/formations/'))
{$active5 ="style='color:".$color_bg_menu."' ";}
if($retenu_page=strpos($_SERVER['REQUEST_URI'],'/experiences/'))
{$active6 ="style='color:".$color_bg_menu."' ";}
if($retenu_page=strpos($_SERVER['REQUEST_URI'],'/langues_pj/'))
{$active7 ="style='color:".$color_bg_menu."' ";}
if($retenu_page=strpos($_SERVER['REQUEST_URI'],'/mettre_en_veille_compte/'))
{$active8 ="style='color:".$color_bg_menu."' ";}
if($retenu_page=strpos($_SERVER['REQUEST_URI'],'/supprimer_compte/'))
{$active9 ="style='color:".$color_bg_menu."' ";}


?>
<div id="espacecandidat">
	<div id="bloc_espace_haut">&nbsp;</div>
	<div id="bloc_espace_fond">
	<div id="ctl00_espace_nonlogue" class="espace_nonlogue">
	<h2 class="titreh1">
	<span class="masquer">Connexion</span>
	  Espace candidat
	</h2>
	<div id="ctl00_connexion_fldst" class="connexion" >
	<fieldset>
	<legend>
	Connexion à l'espace candidat
	</legend>
	<table class="marginbottom5">
		<tbody>
		<tr>
		<td>	
		<label for="ctl00_connexion_tbxIdentifiant">Bienvenue :</label><b>
		<?php if(isset($_SESSION['abb_nom'])) echo $_SESSION['abb_nom']; ?></b> <br>
		<label for="ctl00_connexion_tbxIdentifiant"><i class="fa fa-sign-in fa-lg" style="color:<?php echo $color_bg;?>;"></i> 
		Vous êtes connecté à votre espace</label><br>
		</td>
		</tr>
		</tbody>
	</table> 
	<table id="ctl00_connexion_tableConnexionBox">
		<tbody>
		<tr>
		<td class="paddingleft10" colspan="4">
		<ul class="nav">
		<li  style="list-style:none;padding:5px 0px;">
		<i class="fa fa-cog fa-lg" style="color:<?php echo $color_bg;?>;"></i> 
		 <a <?php if(isset($active1)){echo $active1; } ?>
		 href="<?php echo $urlcandidat;  ?>/compte/"  >Mon compte</a></li>
		
		<li  style="list-style:none;padding:5px 0px">
		<i class="fa fa-cog fa-lg" style="color:<?php echo $color_bg;?>;"></i>
		<a <?php if(isset($active2)){echo $active2; }?>
		href="<?php echo $urlcandidat ; ?>/identifiants/" > Mes identifiants </a></li>
		
		<li  style="list-style:none;padding:5px 0px">
<i class="fa fa-cog fa-lg" style="color:<?php echo $color_bg;?>;"></i> 
		 <a <?php if(isset($active3)){echo $active3;} ?>
		 href="<?php  echo $urlcandidat;  ?>/cv/">Mon CV</a></li>
		<li  style="list-style:none;padding:0px 0px 0px 20px"><i class="fa fa-cog fa-lg" style="color:<?php echo $color_bg;?>;"></i> 
		<a <?php if(isset($active4)){echo $active4;} ?>
		href="<?php  echo $urlcandidat;  ?>/cv/informations/">Informations personnelles</a></li>
		<li  style="list-style:none;padding:3px 0px 0px 20px"><i class="fa fa-cog fa-lg" style="color:<?php echo $color_bg;?>;"></i> 
		</span> <a <?php if(isset($active5)){echo $active5;} ?>
		href="<?php  echo $urlcandidat;  ?>/cv/formations/">Formations</a></li>
		<li  style="list-style:none;padding:3px 0px 0px 20px"><i class="fa fa-cog fa-lg" style="color:<?php echo $color_bg;?>;"></i> 
		<a <?php if(isset($active6)){echo $active6;} ?>
		href="<?php  echo $urlcandidat;  ?>/cv/experiences/">Expériences </a></li>
		<li  style="list-style:none;padding:3px 0px 5px 20px"><i class="fa fa-cog fa-lg" style="color:<?php echo $color_bg;?>;"></i> 
		<a <?php if(isset($active7)){echo $active7;} ?>
		href="<?php  echo $urlcandidat;  ?>/cv/langues_pj/">Langues et pièces jointes</a></li>
		<li  style="list-style:none;padding:5px 0px"><i class="fa fa-cog fa-lg" style="color:<?php echo $color_bg;?>;"></i> 
		</span> <a <?php if(isset($active8)){echo $active8;} ?>
		href="<?php  echo $urlcandidat;  ?>/mettre_en_veille_compte/"  > Mettre en veille mon compte </a></li>
		<li  style="list-style:none;padding:5px 0px"><i class="fa fa-cog fa-lg" style="color:<?php echo $color_bg;?>;"></i> 
		 <a <?php if(isset($active9)){echo $active9;} ?>
		 href="<?php  echo $urlcandidat;  ?>/supprimer_compte/"  > Supprimer mon compte </a></li>
		</ul>
		</td>
		</tr>
		<tr>
		<td class="paddingleft10" colspan="2">
		</td>
		<td class="paddingleft10" width="20">
		<form id="connexion" method="post" action="<?php echo $site ?>index.php?action=logout">
		<br><input name="envoi" value="Déconnecter" id="ctl00_connexion_btnConnexion" class="espace_candidat" type="submit">
		</form>
		</td>
		</tr>
		</tbody>
	</table>		
	</fieldset>
	</div>					
	</div>
	</div>
	<div id="bloc_espace_bas">&nbsp;</div>
</div>		
<?php
} else {
?> 
<div id="colG">
<div id="espacecandidat">
<div id="bloc_espace_haut">&nbsp;</div>
<div id="bloc_espace_fond">
<div id="ctl00_espace_nonlogue" class="espace_nonlogue">
<h2 class="titreh1">
<a href="<?php  echo $urlcandidat;  ?>/compte/"  >
 Espace candidat </a> <br>
</h2>
<h3 id="ctl00_connexion_h3Title"> <i class="fa fa-sign-in fa-lg" style="color:<?php echo $color_bg;?>;"></i>
J'ai déjà un espace candidat </h3>
<form  method="post" id="form_candidat" action="<?php echo($_SERVER['REQUEST_URI']); ?>">								
	<div id="ctl00_connexion_fldst" class="connexion" >
		<fieldset>
			<legend>
				Connexion à l'espace candidat 
			</legend>
		
		<table class="marginbottom5">
			<tbody><tr>
				<td>
					<label for="login">Email </label><br></td>
					<td><input width="100%" name="login" id="login" type="email" 
					placeholder="Votre e-mail ici"  maxlength="50"  required/>
				</td>
				</tr><tr>
				<td>
					<label for="pass">Mot de passe</label><br></td><td>
					<input width="100%" name="pass" id="pass" type="password" 
					placeholder="Votre mot de passe" maxlength="20" required/>
				</td>
			</tr>
		</tbody></table>
		<table id="ctl00_connexion_tableConnexionBox">
				<tbody><tr>
				
					<td >
					<a style="font-weight:bold;" href="<?php echo $urlcandidat ; ?>/mot_de_passe_perdu/">Mot de passe perdu</a>
				</td>
					<td > 
					<input name="envoi" class="espace_candidat" value="S'identifier" id="ctl00_connexion_btnConnexion"  type="submit" style="width: 80px;">
				</td>
				</tr>
			</tbody></table>		
		
		</fieldset>
	</div>
</form>
<div id="ctl00_connexion_creation">
	<hr>
	<div style="float:left;width:80%;">
		<h3><i class="fa fa-sign-in fa-lg" style="color:<?php echo $color_bg;?>;"></i>
		Créer mon espace candidat
	</h3>
	<p>
		Vous n'avez pas encore votre propre espace candidat. Créez-le en cliquant ici.
	</p>
	</div>
	<div style="float:right;width:20%;">
	<a id="ctl00_connexion_lnkCreerCompte" href="<?php echo $urlcandidat ?>/inscription/">
	<i class="fa fa-user-plus fa-4x" style="color:<?php echo $color_bg; ?>"></i></a>
	</div>
</div>
</div>
</div>
<div id="bloc_espace_bas">&nbsp;</div>
</div>
</div> 
<?php
 }
?> 
							
	
									
                                             
							