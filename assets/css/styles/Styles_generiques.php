<?php
   header('content-type: text/css');
   ob_start('ob_gzhandler');
   header('Cache-Control: max-age=31536000, must-revalidate');
   // etc. 
   
    require_once dirname(__FILE__) . "/../../../config/config.php";
	
	$bg=$color_bg_menu;
?>
.ac_results {
	padding: 0px;
	border: 1px solid black;
	background-color: white;
	overflow: hidden;
	z-index: 99999;
}

.ac_results ul {
	width: 100%;
	list-style-position: outside;
	list-style: none;
	padding: 0;
	margin: 0;
}

.ac_results li {
	margin: 0px;
	padding: 2px 5px;
	cursor: default;
	display: block;
	/* 
	if width will be 100% horizontal scrollbar will apear 
	when scroll mode will be used
	*/
	/*width: 100%;*/
	font: menu;
	font-size: 12px;
	/* 
	it is very important, if line-height not setted or setted 
	in relative units scroll will be broken in firefox
	*/
	line-height: 16px;
	overflow: hidden;
}

.ac_loading {
	 
}

.ac_odd {
	background-color: #eee;
}

.ac_over {
	background-color: #0A246A;
	color: white;
}

#accueil-presentation{margin-bottom:40px;text-align:justify;}
#accueil-offres{margin-bottom:40px; padding-left:200px;height:380px;}
.listing-offres .candidatures li{height:auto;padding:10px 0;border-top:1px dotted #cccccc;}
.listing-offres .candidatures li:hover{height:auto;padding:10px 0;border-top:1px dotted #cccccc;}
.listing-offres li{height:55px;padding:10px 0;border-top:1px dotted #cccccc;}
.listing-offres li.borderbas{border-bottom:1px dotted #cccccc;}
.listing-offres li:hover{height:55px;padding:10px 0;border-top:1px dotted #cccccc;background:#f7f7f7;}
a.lienfavori{padding:0px 5px;margin-top:4px;display:block;float:left;margin-top:4px;height:15px;border-bottom:0px}
.listing-offres li ul{display:block;float:left;margin-top:4px;}
.listing-offres li ul li{display:inline;border-right:1px solid #cccccc;height:15px;padding:0px 5px;background:none;border-top:0px;}
.listing-offres li ul li:hover, .listing-offres li ul li:focus{height:15px;padding:0px 5px;background:none;border-top:0px;}
a.liengrasnonsouligne{border-bottom:0px;padding-bottom:0px;font-weight:bold;}
a.liengrasnonsouligne:hover, a.liengrasnonsouligne:focus{border-bottom:1px dotted #333333;padding-bottom:1px;}
#accueil-metier{margin-bottom:40px;float:left;width:100%;}
#accueil-metier p{padding-bottom:10px;}
#accueil-metier a{border-bottom:0px;padding-bottom:0px;}
#accueil-metier a:hover, #accueil-metier a:focus{border-bottom:1px dotted #333333;padding-bottom:1px;}
#accueil-metier-seo{width:48%;float:left;}
#accueil-recherche-seo{width:48%;float:right;}
#accueil-metier-seo li,
#accueil-recherche-seo li{padding-bottom:4px;}
#criteres{border:1px dotted #cccccc;padding:10px;margin-bottom:10px;background:#f7f7f7;}
#resultatPagination{float:right;margin-bottom:10px;}
#resultatPagination ul li{display:inline;}
.resultat{float:left;}
.pagination{float:right;margin-right:5px}
.pagination span{display:inline;padding:0 5px;}
.pagination a{border:0px;}
#listing-facette-contener{float:left;width:650px;padding-bottom:40px;}
#listing-resultat{width:400px;float:left;}
#tri-facettes{border:1px dotted #cccccc;padding:10px;width:200px;float:right;}
li.facette-selection{position:relative;}
a.facette-delete{position:absolute;bottom:0px;right:0px;border:0px;padding-bottom:0px;}
a:hover.facette-delete img, a:focus.facette-delete img{border-bottom:0px;padding-bottom:0px;}
#tri-facettes li{padding:3px 0;}
#tri-facettes li a{border-bottom:1px dotted #ffffff;}
#tri-facettes li a:hover{border-bottom:1px dotted #333333;color:#333333;}
#tri-facettes li span.facette-titre{background:#f7f7f7;width:200px;display:block;padding:2px;font-weight:bold;font-size:1.1em;position:relative;margin:5px 0px;border:1px dotted #cccccc;}
#ref-date-ficheoffre p a{border-bottom:0px;}
.liensbas-ficheoffre{margin-top:20px;float:left;width:100%;}
a.bt_postuler{border-bottom:0px;}
ul#menu-ficheoffre{float:right;}
ul#menu-ficheoffre li{display:block;float:right;}
ul#menu-ficheoffre a{border:0px;}
.border-contenu{line-height:1.4em;border:1px dotted #cccccc;padding:20px 20px 15px 20px;margin-bottom:20px;float:left;width:610px;}
#text-mentions{text-align:justify;}
#text-mentions span{width:240px;display:block;float:left;font-weight:bold;text-align:left;}
.contenu-fixe{margin-bottom:50px;}
.contenu-fixe p{margin-bottom:10px;line-height:1.4em;}
.contenu-fixe a{padding-bottom:0px}
div.lstLiensRSS{clear:both;width:100%;float:left;}
.lstLiensRSS ul li{float:left;display:block;height:25px;padding:4px;}
.lstLiensRSS ul li.intituleflux{padding-top:10px;height:20px;}
div.sitewarning{color:#FF0000;background-color:#FFFFFF;border:solid 2px #FF0000;font-family:Arial, Helvetica, sans-serif;font-size:11px;font-style:normal;font-weight:bold;position:relative;text-align:right;padding:2px;z-index:19999;width:996px;margin:0 auto;display:none;}
div.innersitewarning{padding-bottom:10px;padding-left:20px;padding-right:20px;text-align:left;}
#global{margin:0 auto;width:995px;}
#contener{width:995px;position:relative;float:left;text-align:left;}
#header{margin-bottom:25px;}
ul#menu_aide_navigation{float:right;}
ul#menu_aide_navigation li{display:block;float:left;text-align:center;}
ul#menu_aide_navigation li a{height:20px;display:block;background:none;color:#000000;background:#FFFFFF;border-bottom:0px;padding-bottom:0px;}
ul#menu_aide_navigation li a:hover, ul#menu_aide_navigation li a:focus{border-bottom:0px;padding-bottom:0px;text-decoration:none;color:#000000;}
ul#menu_aide_navigation li.BT_accessibilite a{width:83px;}
ul#menu_aide_navigation li.BT_accessibilite a:hover, ul#menu_aide_navigation li.BT_accessibilite a:focus{ }
ul#menu_aide_navigation li.BT_accessibilite_active{width:83px;height:20px; color:#000000;}
ul#menu_aide_navigation li.BT_plan a{width:80px;}
ul#menu_aide_navigation li.BT_plan a:hover, ul#menu_aide_navigation li.BT_plan a:focus{ }
ul#menu_aide_navigation li.BT_plan_active{width:80px;height:20px;color:#000000;}
li#BT_contenu a{width:107px;}
li#BT_contenu a:hover, li#BT_contenu a:focus{ }
li#BT_moteur a{width:126px;}
li#BT_moteur a:hover, li#BT_moteur a:focus{ }
ul#menu_aide_navigation li.BT_contraste a{width:111px;}
ul#menu_aide_navigation li.BT_contraste a:hover, ul#menu_aide_navigation li.BT_contraste a:focus{ }
li#BT_allerbas a{width:96px;}
li#BT_allerbas a:hover, li#BT_allerbas a:focus{ }
#menulangue-panier{height:30px;padding:1px 6px;background:#f7f7f7;border-bottom:1px solid #cccccc;color:#666666;}
#menulangue{float:left;}
ul.menu-langue-site li{width:25px;height:30px;display:block;float:left;}
ul.menu-langue-site li a{padding-top:10px;height:20px;display:block;color:#FFFFFF;text-align:center;border-bottom:0px;padding-bottom:0px;}
ul.menu-langue-site li a:hover, ul.menu-langue-site li a:focus{ color:#333333;}
li.langue-active{padding-top:10px;height:20px;display:block; text-align:center;color:#666666;}
#panier{float:right;text-align:right;padding:8px 0px 0px 30px; font-size:1.2em;font-weight:bold;}
#panier a{color:#666666;}
#panier a:hover, #contenu a:focus{border-bottom:1px dotted #333333;padding-bottom:1px;color:#333333}
#wrapper{float:left;width:100%;}
#colG{width:295px;float:left;padding-left:6px;}
#menu-fo{float:left;width:295px;padding-top:20px;}
#menu-fo1{float:left;width:190px;padding-top:20px;}
ul#menu_site_carriere li.borderbas{border-bottom:1px dotted #cccccc;}
ul#menu_site_carriere li{border-top:1px dotted #cccccc;height:25px;font-family:Verdana, Arial, Helvetica, sans-serif}
ul#menu_site_carriere li a{text-transform:uppercase;border-bottom:0px;padding:5px 0 0 10px;height:20px;display:block;}
ul#menu_site_carriere li a:hover, ul#menu_site_carriere li a:focus{background:<?php echo $bg; ?>;color: #FFF;padding:5px 0 0 10px;}
ul#menu_site_carriere li.menufo-active{background:<?php echo $bg; ?>;text-transform:uppercase;color: #FFF;}
ul#menu_site_carriere li.menufo-active a{background:<?php echo $bg; ?>;text-transform:uppercase;color: #FFF;}
#espacecandidat{float:left;}
#bloc_espace_haut{width:292px;height:10px;background:url(../../images/menu_gauche/BG_espace_haut.png) no-repeat top left;float:left;}
#bloc_espace_fond{width:262px;padding:0 15px 5px 15px;background:url(../../images/menu_gauche/BG_espace_fond.jpg) repeat-y top left;float:left;}
#bloc_espace_bas{width:292px;height:15px;background:url(../../images/menu_gauche/BG_espace_bas.png) no-repeat top left;float:left;}
ul.message-erreur{width:255px;border:1px solid #ff0000;padding:5px 2px 5px 5px;margin:2px 0 7px 0;color:#ff0000;font-family:Verdana, Arial, Helvetica, sans-serif;font-size:0.9em;}
ul.message-erreur li{list-style-type:disc;list-style-position:inside;text-indent:5px}
ul.message-erreur p{margin-bottom:5px}
#espacecandidat hr{border-bottom:3px dotted #cccccc;padding-bottom:10px;margin-bottom:10px;}
div.espace_nonlogue table{width:265px}
/*#espacecandidat label{color:#FFFFFF;}*/
#espacecandidat input.checkbox,
#espacecandidat input[type=checkbox],
#espacecandidat span.checkbox{width:20px;border:0px;}
#espacecandidat input.bt_connexion,
#espacecandidat img.bt_connexion,
#contenu input.bt_connexion{width:22px;height:20px;border:0px;}
p.bonjour{color:#FFFFFF;margin-bottom:10px;}
ul#menu_espace_candidat li{height:22px;padding-left:15px;}
ul#menu_espace_candidat li a{border-bottom:0px;}
ul#menu_espace_candidat li a:hover, ul#menu_espace_candidat li a:focus{text-decoration:none;color:#333333;border-bottom:1px dotted #333333;padding-bottom:1px;}
#espacecandidat input.bt_deconnexion,
#espacecandidat a.bt_deconnexion{width:100px;height:20px;border:0px;text-align:center;float:right;padding-bottom:2px;}
.tags{margin-bottom:30px;text-align:justify;font-family:Verdana, Arial, Helvetica, sans-serif;}
ul#menu-nuage-tags li{display:inline;}
ul#menu-nuage-tags li a{border-bottom:0px;color:#CCCCCC;}
ul#menu-nuage-tags li a:hover{border-bottom:1px #666666 dotted;color:#666666;}
.pub{margin-bottom:20px;position:relative;float:left;}
#bt_diapo{position:absolute;top:1px;left:1px;background:#FFFFFF;padding:2px;border-bottom:1px solid #cccccc;border-right:1px solid #cccccc;z-index:1000;}
#bt_diapo IMG{cursor:pointer;cursor:hand;}
#bt_diapo DIV{display:inline;}
#img_diapo{width:292px;height:182px;overflow:hidden;overflow:hidden;}
#colD{width:650px;float:right;margin-bottom:70px}
#moteur{margin-bottom:10px;background:url(../../images/recherche_index/BG_moteur.png);width:630px;height:100px;padding:10px 15px 5px 15px;}
#moteur label{padding-right:3px;font-weight:bold;font-size:1.1em}
#moteur select{border:1px solid #cccccc;width:180px;}
#moteur td.quoi, td.ou, td.contrat, td.keyword{padding-bottom:15px;}
#moteur td.keyword{width:58%;text-align:left;}
#moteur td.keyword input{width:275px;}
#moteur td.quoi{width:38%;text-align:left;}
#moteur td.ou{width:39%;text-align:center;}
#moteur td.contrat{width:40%;text-align:right;}
#moteur td.offres{background:url(../../images/recherche_index/picto-offre.gif) no-repeat bottom left;padding-left:25px;}
#moteur td.r_avance{background:url(../../images/recherche_index/r_avance.png) no-repeat bottom left;padding-left:25px;}
#moteur td.flux{padding-left:20px;text-align:center;}
#moteur td.recherche{text-align:right}
#contenu .recherche{clear:both;}
#moteur input.bt_recherche{width:168px;height:26px;border:0px;}
#filariane{margin-bottom:20px;color:#FFFFFF;float:left;width:100%}
#filariane ul#menu_filariane li{display:block;float:left;padding-right:4px;}
#filariane ul#menu_filariane a{text-decoration:none;color:#FFFFFF;border-bottom:1px dotted #ffffff;padding-bottom:1px;}
#filariane ul#menu_filariane a:hover, ul#menu_filariane a:focus{color:#FFFFFF;border-bottom:1px dotted #FFFFFF;text-decoration:none;padding-bottom:1px;}
#filariane ul#menu_filariane li span.textsouligne-filariane{border-bottom:1px dotted #FFFFFF;}
#titrepages{float:left;clear:both;width:100%;}
#contenu{width:100%;float:left;}
.baseline-seo{color:#FFFFFF;margin-bottom:20px;}
#footer{height:50px;float:left;width:100%;}
ul.menu_footer li{display:inline;border-right:1px solid #cccccc;padding:0 5px;}
ul.menu_footer li.sansbordure{border:0px}
ul.menu_footer li a{text-decoration:none;color:#000000;border-bottom:0px;padding-bottom:1px;}
ul.menu_footer li a:hover, ul.menu_footer li a:focus{text-decoration:none;color:#666666;border-bottom:1px dotted #666666;padding-bottom:1px;}
span.copyright{color:#FFFFFF;}
#menufooter{}
a.retourhaut{float:right;display:block;height:15px;padding-right:20px;border-bottom:0px;color:#FFFFFF;}
a:hover.retourhaut span{color:#666666;border-bottom:1px dotted #666666;padding-bottom:1px;}
/*---------------------------------LOGO----*/
#logo {
	width:202px;
	height:151px;
	position: absolute;
	top:0px;
	left:15px;
	
	display: none;
}
#logo img {
	width:179px;
	height:139px;
	display:block;
	margin:0 auto;
}
/*------------------------------BANDEAU----*/
#bandeau {
	padding:5px 6px;
	border-top:1px solid #cccccc;
	border-bottom:1px solid #cccccc;
}
/*----------------------------MENU HEADER----*/
#menu-header {
	height:50px; 
	padding:0px 6px;
}
ul#menu_aide_navigation li a, ul#menu_aide_navigation li a:hover, ul#menu_aide_navigation li a:focus,
ul#menu_aide_navigation li.BT_accessibilite_active,ul#menu_aide_navigation li.BT_plan_active {
	padding-top:30px;
}
*{margin:0px;border-collapse:collapse;color:#000000;font-family:Helvetica;padding:1px 0 0 0;}
img{border:0px;}
ul li{list-style-type:none;}
a{text-decoration:none;color: #000000;font-family:Helvetica;/*border-bottom:1px dotted #cccccc;*/padding-bottom:1px;}
a:hover, a:focus{text-decoration:none;color:#000000;border-bottom:1px dotted #333333;padding-bottom:1px;}
a.lienimage, a:hover.lienimage, a:focus.lienimage{border-bottom:0px}
img.border{border:1px solid #cccccc;}
acronym, abbr{border:0px}
.sansbordure{border:0px}
a.sansbordure, a:hover.sansbordure, a:focus.sansbordure{border:0px}
.invisible{display:none}
.masquer{font-size:0px;position:absolute;left:-5000px;overflow:hidden;}
.sansmarge{margin:0px;}
.right{float:right;}
.left{float:left;}
.fieldset_sansborder{border:0px}
.listeline{display:inline}
.textsouligne{text-decoration:underline}
.italique{font-style:italic;}
.maincolor{color:#666666;}
.rouge{color:#ff0000;}
.grisclair{color:<?php echo $bg; ?>}
.gras{font-weight:bold;}
.text-right{text-align:right;}
.text-left{text-align:left;}
.text-justify{text-align:justify;}
.text-souligne{text-decoration:underline;}
.paddingright7{padding-right:7px;}
.paddingtop5{padding-top:5px;}
.paddingleft10{padding-left:10px;}
.marginright10{margin-right:10px;}
.margintop10{margin-top:10px;}
.margintop0{margin-top:0px;}
.marginbottom5{margin-bottom:5px;}
.paddingbottom20{padding-bottom:20px;}
.paddingleft10{padding-left:10px;}
.text-uppercase{text-transform:uppercase}
.text-capitalize{text-transform:capitalize}
.text-interligne{line-height:1.4em}
.font16{font-size:1.5em;}
h1{font-size:1.6em;font-weight:lighter;margin-bottom:7px;color:<?php echo $bg; ?>;font-family:Helvetica;}
h2.titreh1{font-size:1.6em;text-transform:uppercase;font-weight:lighter;margin:0px 0 7px 0px;border-bottom:0px
color:<?php echo $bg; ?>;font-family:Helvetica;}
h2, legend.legend-popup{font-size:1.5em;font-weight:lighter;margin:8px 0 5px 0px;padding-bottom:2px;color:<?php echo $bg; ?>;font-family:Helvetica;}
span.styleh2{font-size:1.5em;font-weight:lighter;margin:30px 0 5px 0px;padding-bottom:2px;border-bottom:1px solid #cccccc;width:100%;display:block;color:<?php echo $bg; ?>;font-family:Helvetica;}
h2 a, h2 a:hover, h2 a:focus{text-decoration:none;border-bottom:0px
color:<?php echo $bg; ?>;font-family:Helvetica;}
h2.soustitreflux{clear:both;float:left;width:100%}
#tri-facettes h2{font-size:1.1em;font-weight:bold;letter-spacing:0.05em;border-bottom:0px;text-transform:uppercase;margin:0px 0 5px 0px;color:<?php echo $bg; ?>;font-family:Helvetica;}
h3{font-size:1.1em;font-weight:bold;text-transform:none;margin:8px 0 15px 0;color:<?php echo $bg; ?>;font-family:Helvetica;}
h2.styleh3{font-size:1.1em;font-weight:bold;margin-bottom:3px;background:none;padding-left:0px;text-transform:none;margin:0px;border-bottom:0px
color:<?php echo $bg; ?>;font-family:Helvetica;}
.listing-offres h3{background:none;padding:0px;margin-top:0px
color:<?php echo $bg; ?>;font-family:Helvetica;}
hr{width:100%;height:3px;border:0;background:none;border-bottom:dotted 3px #ffffff;clear:both;display:block;}
.erreur{margin-bottom:10px;color:#ff0000;border:1px solid #ff0000;padding:5px;float:left;width:95%;text-align:left;}
.info{margin-bottom:10px;color:#2ca8c3;border:1px solid #2ca8c3;padding:5px;float:left;width:95%;text-align:left;}
.connexion fieldset{padding:0px;border:0px;margin:0px;}
.connexion legend{text-transform:none;font-size:1.2em;font-weight:lighter;font-family:Verdana, Arial, Helvetica, sans-serif;color:#666666;display:none;}
.formulaire a{border-bottom:0px;}
.formulaire a.dotted{border-bottom-width:1px;border-bottom-style:dotted;}
.formulaire td.paddingtop20{padding-top:20px;}
.formulaire fieldset.sansbordure{border:0px}
.formulaire fieldset{padding:10px;border:1px solid #cccccc;margin:10px 0 20px 0;}
.formulaire legend{text-transform:none;font-size:1.2em;font-weight:lighter;font-family:Verdana, Arial, Helvetica, sans-serif;color:#666666;}
legend.popup-titre{font-size:1.1em;font-weight:bold;margin-bottom:3px;padding-left:12px;text-transform:none;margin:10px 0 2px 0;}
.formulaire td{padding:2px;}
td.colG_form{width:190px;text-align:right;vertical-align:text-top;}
td.colD_form{width:450px;text-align:left;}
.formulaire input.input-mdp{width:200px;margin-right:10px;}
.formulaire div.formulaire-pj span.formulaire_pj_input_radiobutton input, .formulaire div.formulaire-pj input.formulaire_pj_input_radiobutton{width:20px;}
.formulaire div.formulaire-pj input.formulaire_pj_input_img{width:28px;height:28px;}
.formulaire input{width:335px;}
.formulaire div.formulaire-pj input{width:150px;}
.formulaire select{width:339px;}
.formulaire select.small{width:70px;}
.formulaire input.medium{width:227px;}
.formulaire input[type=radio]{width:20px}
.formulaire input[type=checkbox]{width:20px}
.formulaire input.btnOk{width:17px;height:17px}
.FormPJ{width:100px;text-align:right;display:inline-block;}
.btnEnregistrerPJ{float:right;}
ul.niv2 li{padding-left:60px;}
ul.niv3 li{padding-left:120px;}
hr.separateur{border-bottom:1px dotted #cccccc;}
.formulaire ul.niv1 input, .formulaire ul.niv2 input, .formulaire ul.niv3 input{width:20px}
.formulaire div.Mobility input{width:30px}
ul.ul_niv1{margin-left:50px}
input.input_plus_moins{float:left}
.colD_form img{border:1px solid red;display:inline;}
div#btenregistrercandidat{margin:40px 0;}
.mobilite ul{width:340px;}
.mobilite li table.mobilite-titre{margin:5px 0;}
.mobilite li table.mobilite-titre tr{background:#f7f7f7;font-weight:bold;border:1px solid #cccccc;}
.formulaire .mobilite li input{width:20px}
input.input_plus{border:none;cursor:pointer;cursor:hand;}
input.input_moins{ border:none;cursor:pointer;cursor:hand;}
ul.mobilite-titre-niv1{margin:5px 0 10px 25px;width:315px;}
ul.mobilite-titre-niv1 li{margin:2px 0}
.btnOk{ background-color:Transparent;border:none;cursor:pointer;border-width:0px;height:20px;width:22px;}
#wrapper .btnFermerPopUp{ background-color:Transparent;border:none;cursor:pointer;border-width:0px;height:17px;width:17px;}
#wrapper .btnPostuler{border-style:none;border-color:inherit; cursor:pointer;border-width:0px;height:26px;width:180px;}
.btnrecherche{background-image:url(../../images/recherche_index/T-recherche.png);background-color:Transparent;border:none;border-width:0px;height:26px;width:155px;text-align:left;padding-left:8px;padding-bottom:1px;cursor:pointer;margin:0 -155px 0 0;}
#wrapper .btnPetit{ background-color:Transparent;border:none;cursor:pointer;border-width:0px;height:20px;width:34px;padding-bottom:2px;}
.btnMoyen{background-image:url(../../images/menu_gauche/button_120.gif);background-color:Transparent;border:none;cursor:pointer;border-width:0px;height:20px;width:120px;padding-bottom:2px;}
#wrapper .btnGrand{ background-color:Transparent;border:none;cursor:pointer;border-width:0px;height:20px;width:180px;padding-bottom:2px;}
#wrapper .btnTresGrand{ background-color:Transparent;border:none;cursor:pointer;border-width:0px;height:20px;width:250px;padding-bottom:2px;}
#Connexion-pageconnexion input, #Creation-pageconnexion input{width:250px}
#Creation-pageconnexion span.checkbox input,
#Connexion-pageconnexion span.checkbox input{width:20px;border:0px;}
#ctl00_connexion_tbxIdentifiant, #ctl00_connexion_tbxPassword{width:145px;}