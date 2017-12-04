<?php
   header('content-type: text/css');
   ob_start('ob_gzhandler');
   header('Cache-Control: max-age=31536000, must-revalidate'); 
   
    require_once dirname(__FILE__) . "/../../config/config.php";
	
	$bg0= $color_bg_body; 
	
	$bg1=$color_bg;
?> 
 body {
  background-color: #FFF;
   margin: 0; padding: 0;
   overflow:scroll;font-family: 'Fontastique', sans-serif;
   font-size: 12px;
background: url('./images/page-background.png') repeat 0 0 #ccc;
    } 
/* containe f2f3f6r */
#container { position:relative; margin:auto; width: 1035px;padding:0 10px;}
span.cache{display:none;}
/*menu haut horizental */
#menuref {position:relative;text-align:right; width:940px; height:12px; padding:14px 10px; color:#454545; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:9px; }
a.mni, a.mni:link, a.mni:visited {color:#454545; font-family:Verdana, Arial, Helvetica, sans-serif;  font-size:9pt; cursor:pointer; text-decoration:none; margin:0 5px; font-size:9px;}
a.mni:active, a.mni:hover {text-decoration:underline;}
a.mni img{margin-left:3px;}
/* entete */
#entete {position:relative; width:1035px; height:188px; background-repeat:no-repeat;}
#headerIndex {position:relative; width:960px; height:147px;   background-repeat:no-repeat;}
#logo {position:absolute; width:256px; height:118px; display:block; cursor:pointer; left:22px; top:17px;}
#logo_blogue {margin-bottom:19px;}
/* Zone de recherche */
#rsearch {position:absolute;left:729px;top:0;padding:18px 0 0;width:232px;height:48px;color:#fff;font-family:Verdana, Arial, Helvetica, sans-serif;font-size:10px;font-weight:700;line-height:18px;}
input.rsh {border:1px solid #a5acb2; background-color:#fff; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; cursor:text; height:16px; padding:3px 5px 0; width:180px;}
input.env{width:17px;height:18px;background-image:url(../images/recherche_index/button-search.png);background-repeat:no-repeat;cursor:pointer;border:0;margin-left:5px}
input.env2 {width:17px; height:18px;   background-repeat:no-repeat; cursor:pointer; border:0;}
/*Menu Vertical haut*/
#entete #menuEntete .selecetedEnteteD a{ }
#entete #menuEntete{position:absolute;top:71px;right:0;padding:0;margin:0;width:241px;}
#entete #menuEntete li{	width:241px;list-style:none;position:relative;margin:0;padding:0;height:24px;}
#entete #menuEntete li a {color:#fff;font-size:10px;text-decoration:none;font-weight:700;text-transform:uppercase; width:231px;	height:15px;display:block;margin:1px 0 0;padding:4px 0 3px 10px;}
#entete #menuEntete li span {color:#fff;font-size:10px;text-decoration:none;font-weight:700;text-transform:uppercase; width:231px;	height:15px;display:block;margin:1px 0 0;padding:4px 0 3px 10px;}
#entete #menuEntete li a:hover { }
#headerIndex #menuEntete .selecetedEnteteD a{}
#headerIndex #menuEntete{position:absolute;top:71px;right:0;padding:0;margin:0;width:241px;}
#headerIndex #menuEntete li{width:241px;list-style:none;position:relative;margin:0;padding:0;height:24px;}
#headerIndex #menuEntete li a {color:#fff;font-size:10px;text-decoration:none;font-weight:700;text-transform:uppercase; width:231px;	height:15px;display:block;margin:1px 0 0;padding:4px 0 3px 10px;}
#headerIndex #menuEntete li span {color:#fff;font-size:10px;text-decoration:none;font-weight:700;text-transform:uppercase; width:231px;	height:15px;display:block;margin:1px 0 0;padding:4px 0 3px 10px;}
#headerIndex #menuEntete li a:hover { }
/*Menu Horizental template*/
#entete #menuPrincipal{padding-left:25px;height:31px;margin:0;position:absolute;left:0;bottom:0;width:936px;}
#entete #menuPrincipal li{list-style:none;display:block;float:left;}
#entete #menuPrincipal li a { color:#fff;font-size:9px;line-height:3.4em;padding:0 10px;text-decoration:none;font-weight:700;text-transform: uppercase;display:block;}
#entete #menuPrincipal li a:hover {background-color:#f9b346;}
.selectedEntete {background-color:#f9b346;}
/* bas de page */
#bottom{float:left;width:100%;}
#bdp{position:relative;margin:auto;width:1045px;height:38px;top:0;left:0;background-color: <?php echo $bg1; ?>;margin-top:5px;margin-bottom:40px;}
#bdp_texte{width:1000px;height:46px;padding:12px 0 0 15px;font-family:Arial;font-size:9px;line-height:18px;}
a.bdp, a.bdp:link, a.bdp:visited{color: #FFFFFF;font-family:arial;font-size:10px;cursor:pointer;text-decoration:none;font-weight:bold;}
a.bdp:active, a.bdp:hover{text-decoration:underline;}
span.bdp{margin:0 5px;}
a{color:#454545;text-decoration:underline;}
a:hover{color:#765B52;}
.section-link{font-family:Verdana, Arial, Helvetica, sans-serif;font-size:13px;font-weight:700;margin:0;text-decoration:none;}
.section-link:hover{text-decoration:underline;color:#000;font-family:Verdana, Arial, Helvetica, sans-serif;}
img{border:0;}
li{font-family:Verdana, Arial, Helvetica, sans-serif;}
#gauche {float:left; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#000; }
#droite {float:left; margin: 0 0 0 80px; width:215px; min-height:0px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#000; }
/*gauche*/
#connx_titre {font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#E20026; font-weight:bold; width:208px; text-align:center;height:20px; }
#block_connx{position:relative; width:208px; padding:6px 0 0; background-color:#765B52; margin:0; -moz-border-radius-topleft:8px; -moz-border-radius-topright:8px;-webkit-border-top-left-radius: 8px;-webkit-border-top-right-radius: 8px;}
#connx { font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold;padding:0 0 0 5px;position: relative; left: 0; height: 133px; background-color:#FFF;border:1px solid #765B52}
#connx input{font-family:Verdana,Arial,Helvetica,sans-serif;font-size:11px}
#search_titre {font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#fff; font-weight:bold; width:165px; text-align:center; height:20px; }
#menu_titre {font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#fff; font-weight:bold; width:208px; text-align:center; height:20px; }
#block_search{/*position:relative;*/ width:650px;height:100px; padding:6px 0 0; background-color:#F7F7F7; margin-top:0px; -moz-border-radius-topleft:8px; -moz-border-radius-topright:8px;-webkit-border-top-left-radius: 8px;-webkit-border-top-right-radius: 8px; }
#block_menu{position:relative; width:208px;height:297px; padding:6px 0 0; background-color:#765B52; margin-top:5px; -moz-border-radius-topleft:8px; -moz-border-radius-topright:8px;-webkit-border-top-left-radius: 8px;-webkit-border-top-right-radius: 8px; }
#list_search{height:62px;;font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; text-align: left; padding:10px;background-color:#FFFFFF; border:1px solid #765B52}
#list_search select{width:145px;font-family:Verdana,Arial,Helvetica,sans-serif;font-size:11px}
#list_search input{font-family:Verdana,Arial,Helvetica,sans-serif;font-size:11px}
#list_search li {margin:0;padding:0; line-height:25px}
.btn-rechercher {font-weight: 700; color: white; font-size: 10px; text-transform: uppercase;background: #765B52;padding: 3px 10px 4px; vertical-align: middle;}
.btn-rechercher a:hover {color:white;}
/* droite */
#logo_titre {font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#fff; font-weight:bold; width:233px; text-align:center; height:20px; }
#blocklogo{position:relative; width:233px; padding:6px 0 0; background-color:#c31820;  margin:6px 0 0; -moz-border-radius-topleft:8px; -moz-border-radius-topright:8px;-webkit-border-top-left-radius: 8px;-webkit-border-top-right-radius: 8px;}
#espace_logo { font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; padding:0; background-color:#FFFFFF; border:1px solid #765B52}
#espace_pub { font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; height: 300px; padding:0; background-color:#FFFFFF; border:1px solid #765B52}
#blockblack{float:left;width:233px; padding:6px 0 0; background-color:#765B52;  margin:6px 0; -moz-border-radius-topleft:8px; -moz-border-radius-topright:8px;-webkit-border-top-left-radius: 8px;-webkit-border-top-right-radius: 8px;}
#blockblack2{float:left;width:660px; background-color:#F7F7F7;  -moz-border-radius-topleft:8px; -moz-border-radius-topright:8px;-webkit-border-top-left-radius: 8px;-webkit-border-top-right-radius: 8px;}
#bh_titre {border-radius:10px;font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#E20026; font-weight:bold; width:233px; text-align:center;  }
#annonces {position:relative;  padding:10px;overflow:auto;background-color:#FFFFFF;border:1px solid #ccc;}
/* effet texte */
select.rech{border:1px solid #a5acb2; background-color:#fff; color:#000; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:700;  height:22px; padding:4px 1px 2px;  cursor:pointer; margin:5px 0;}
h1 {font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:600; color:#CD6408; margin:8px 0;}
h2 {font-family: Arial; font-size:14px; color:#fff; font-weight:700; margin:0;}
h4{margin:0; font-size:11px;}
/* contenu milieu */
/*   taha reduire l'espace entre le menu gauche et la table des offres environement:employeur */
 #content_g_employeur_offre{float:left; width:170px;}
#content_g {float:left; padding-top:0px;}
#content_d {float:left ; margin-left:20px;  text-align:left;}
#content_d .paragraphe {text-align:left;font-family:Verdana, Arial, Helvetica, sans-serif;color:#000;	font-size:11px;margin:0 0 15px;padding-top:10px;}
#content_d h3{color:black;font-weight:700;font-size:12px;margin:20px 0 7px;padding:0}
#content_d ul, .resultatParcours ul{padding-left:15x; }
#content_d ul li ul{padding:0 0 0 25px;margin:0;list-style:disc;}
#content_d li{padding:2px 0;margin: 0 0 0 17px;}
#content_d p{margin-top:0;}
.texte {font-family:Verdana,Arial,Helvetica,sans-serif;font-size:11px;width: 820px}
.texte h2{color:#000; font-size:13px;color:#765B52;margin:0;}
.texte a{color:#454545;}
.texte a:hover{color:#765B52;}
.texte input{font-family:Verdana,Arial,Helvetica,sans-serif;font-size:11px}
.texte select{font-family:Verdana,Arial,Helvetica,sans-serif;font-size:11px}
#pub_titre {font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#E20026; font-weight:bold; width:472px; text-align:center; height:20px; }
#block_pub{position:relative; width:472px; padding:6px 0 0;  margin:0;-moz-border-radius-topleft:8px; -moz-border-radius-topright:8px;-webkit-border-top-left-radius: 8px;-webkit-border-top-right-radius: 8px; }
#zone_pub { font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; height: 160px; padding:0; background-color:#FFF;border:1px solid #765B52;}
#mg_titre {font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#E20026; font-weight:bold; width:472px; text-align:center;height:20px;}
#block_mg{position:relative; width:472px; padding:3px 0 0; background-color:#765B52; margin:0;-moz-border-radius-topleft:8px; -moz-border-radius-topright:8px;-webkit-border-top-left-radius: 8px;-webkit-border-top-right-radius: 8px;}
#mg_cim { font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;height: 270px; padding:0 5px 9px;background-color:#FFFFFF; text-align:left;border:1px solid #765B52;}
#temc_titre {font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#fff; font-weight:bold; width:235px; text-align:center; height:20px; }
#block_temc{position:relative; width:235px; padding:8px 0 0; margin:0 0 0 10px;-moz-border-radius-topleft:8px; -moz-border-radius-topright:8px;background-color:#2d6fa9;-webkit-border-top-left-radius:8px;-webkit-border-top-right-radius:8px;}
#tmcl { font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; height: 215px;*height: 225px; padding:10px;background-color:#FFF;border:1px solid #555}
#tmcl ul{ padding-left:18px}
*html #tmcl ul{ padding:0; margin:0 18px}
#temcp_titre {font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#fff; font-weight:bold; width:222px; text-align:center; height:20px; }
#block_temcp{position:relative; width:222px; padding:8px 0 0 0; margin:0; background-color:#8ac40d;-moz-border-radius-topleft:8px; -moz-border-radius-topright:8px;-webkit-border-top-left-radius: 8px;-webkit-border-top-right-radius: 8px; }
#tmcp { font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; height: 215px;*height: 225px; padding:10px; background-color:#FFF;border:1px solid #555}
#tmcp ul{ padding-left:18px;*padding:0; *margin:0 18px}
/* menu bas gauche */
ul#menuBG {margin:8px 0 0;padding:20px 0 0; width:160px;}
ul#menuBG li {margin:0;padding:0;list-style-type:none;border-top:1px solid white; font-size:11px;font-family:Verdana, Arial, Helvetica, sans-serif;color:#fff;font-weight:700;}
ul#menuBG li a,ul#menuBG li a#live {text-decoration:none;color:#fff;margin:0;display:block;padding:4px 0 4px 25px;*padding:0 0 0 25px; }
ul#menuBG li a:hover,ul#menuBG li a#live{}
div#menuBG_bottom{border-top:1px solid white; 	margin:0 0 8px;width:160px;height:25px;}
/*formulaire*/
.form-contact {	margin:0 20px 0 0;color:#555;font-size:12px;font-family:Verdana,Arial,Helvetica,sans-serif;	font-weight:700;}
.form-contact input,.form-contact textarea,.form-contact select{font-size:11px;padding:2px;width:450px;}
#popErreur {color:#fd0e0e;font-size:11px;}
.btn-submit {margin: 5px 0;font-size:11px;font-family:Verdana,Arial,Helvetica,sans-serif;border:1px solid #A5ACB2;color:#fff;text-transform:uppercase; width:135px;height:20px;}
.form-contact textarea{height: 125px;}
.ligneBleu {margin:3px 0;width:100%;height:3px;font-size:1px;line-height:1px;background-color:<?php echo $bg1; ?>;}
.formRadio input{width:auto;margin-right:7px;}
.formRadio{margin-top:0!important;}
.subscription {-moz-border-radius-bottomleft:3px;-moz-border-radius-bottomright:3px;-moz-border-radius-topleft:3px;-moz-border-radius-topright:3px;background-color:<?php echo $bg1; ?>;height:18px;margin:0 0 5px;padding-top:5px;width:100%;}
.subscription h1 {color:white;font-size:11px;font-weight:700;margin:0 5px 0 10px;text-transform:uppercase;}
/*couleur des lignes de table*/
.sectiontableentry1{background-color: #e8f0f0}
.sectiontableentry2{background-color: #ddd}
/*Forum*/
.bande{ color:#fff;font-size:10px;height:31px;margin-bottom:25px;padding-left:10px;width:98%;}
.bande_recherche {margin-bottom:5px;padding-left:10px;}
.bande a {color:#fff;display:block;float:left;height:26px;margin:0;padding:5px 15px 0;}
.bande a:hover, .bande .actif {background:#86C400  ;}
/*Pagination*/
.pagination {font:12px Verdana, Arial, Helvetica, sans-serif;margin:10px 0;}
#btn_nav {border:0;background:none;}
#btn_next {border:0;background:none;margin:0 4px;}
#btn_prev {border:0;background:none;margin:0 4px;}
.pagination a {background:#fff;border:1px solid <?php echo $bg1; ?>;color:<?php echo $bg1; ?>;padding:0 4px;margin:0 2px;text-decoration:none}
.pagination a:hover {background:#fff;border:1px solid <?php echo $bg1; ?>;color:<?php echo $bg1; ?>;}
.pagination span.active {background:<?php echo $bg1; ?>;border:1px solid <?php echo $bg1; ?>;color:#bd88fe;font-weight:700;padding:0 4px;margin:0 2px;}
/*debut newsticker*/
#newsticker-demo {width:90%;padding:0;}
#newsticker-demo a { text-decoration:none;}
#newsticker-demo img { border: 2px solid #fff; }
#newsticker-demo .title {text-align:center;font-size:14px;font-weight:700;padding:5px;}
.newsticker-jcarousellite { width:100%; }
.newsticker-jcarousellite ul li{ list-style:none; display:block; padding-bottom:1px; margin-bottom:5px;margin-left:0;-moz-padding-start:0 }
.newsticker-jcarousellite .thumbnail { float:left; width:80%; }
.clear { clear: both; }
.odd1
{
    background-color: #ddd;
}
.even1
{
    background-color: #E6EEEE;
}
.tableentete1 {
  background-color: #e6EEEE;
  border: 1px solid #FFF;	
  font-size: 8pt;
  padding: 4px;
  background-repeat: no-repeat;	background-position: center right;cursor: pointer;
}
.tableentete {
  background-color: #e6EEEE;
  border: 1px solid #FFF;	
  font-size: 8pt;
  padding: 4px;
}
#candidature
{background-color: #e8f0f0;margin:10px 0 15px;width: 100%;text-align: left;}
.marked td
{
    background-color:#FC9;
}
.headerSortUp1 {
  background-color: #e6EEEE;
  border: 1px solid #FFF;	
  font-size: 8pt;
  padding: 4px;

 background-repeat: no-repeat;	background-position: center right;cursor: pointer;
}
.headerSortDown1 {
  background-color: #e6EEEE;
  border: 1px solid #FFF;	
  font-size: 8pt;
  padding: 4px;

 background-repeat: no-repeat;	background-position: center right;cursor: pointer;
}
/* tables jquery */
table.tablesorter, #chm-table {background-color: #e8f0f0;margin:10px 0 15px;width: 100%;text-align: left;}
table.tablesorter thead tr th, table.tablesorter tfoot tr th, #chm-table thead tr th, #chm-table tfoot tr th {background-color: #e6EEEE;border: 1px solid #FFF;	font-size: 8pt;padding: 4px;}
table.tablesorter thead tr .header, #chm-table thead tr .header {background-repeat: no-repeat;	background-position: center right;cursor: pointer;}
/*   taha enlever l'espace vide dans la table des offres environement:employeur padding: 4px;*/
table.tablesorter tbody td, #chm-table tbody td {color: #3D3D3D;background-color: #e8f0f0;vertical-align: top;}
table.tablesorter tbody tr.odd td {}
/*table.tablesorter tbody tr.marked td {background-color:#FC9;}*/
table.tablesorter thead tr .headerSortUp { }
table.tablesorter thead tr .headerSortDown { }
table.tablesorter thead tr .headerSortDown, table.tablesorter thead tr .headerSortUp {background-color: #8dbdd8;}
/*Mise en forme*/
.gras{font-weight:700;}
.italique{font-style:italic;}
.clear {clear:both;}
/*Diaporama*/
.selected{margin:1px 0;padding:5px;cursor:pointer;-moz-border-radius:8px;-webkit-border-radius: 8px;border-radius:8px;font-size:10px;border:1px solid #D1D7DC;background-color:#f2f3f6;}
div.selected:hover{background-color:#e1ebc3;}
.diaporama{position:relative;width:210px;height:99px;margin:0;padding:0}
.diaporama li{list-style-type:none;overflow:hidden;position:absolute;}
#content_d .diaporama li{padding:0}
/*********Popup*************/
.popup_block{overflow:auto;position:fixed;_position:absolute; /* hack for internet explorer 6*/	background-color:#fff;-moz-border-radius-topleft:10px;-moz-border-radius-topright:10px;top:200px;left:200px;z-index:999;}
.popup_block .titleBar{margin:0;height:25px;background-color:<?php echo $bg1; ?>;-moz-border-radius-topleft:10px;-moz-border-radius-topright:10px;}
.popup_block .footerBar{margin-right:20px;margin-left:20px;margin-bottom:4px;}
.popup_block .title{height:25px;float:left;font-size:12px;font-weight:700;margin-left:20px;margin-top:1px;	line-height:23px;text-transform:uppercase;color:#FFF;font-family:Verdana,Arial,Helvetica,sans-serif;}
.popup_block .close{height:13px;width:13px;margin-right:7px;margin-top:5px;line-height:30px;float:right;font-size:0;background-image:url(../images/close-b.jpg);background-repeat:no-repeat;text-indent:-10000px;overflow:hidden;}
.popup_block .content{margin:10px 10px 20px 10px;overflow:auto;font-family:Verdana,Arial,Helvetica,sans-serif;	font-size:12px; height: 508px;}
#fade {background: rgba(0, 0, 0, 0.75);position: fixed;_position:absolute; /* hack for internet explorer 6*/width: 100%;height: 100%; /* filter:alpha(opacity=80);opacity: .80;-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)"; */ /*--Transparence sous IE 8--*/left: 0;top: 0;z-index: 10;}
#hideshow {position: absolute;width: 100%;height: 100%;top: 0;left: 0;}
*html #fade {position: absolute;top:expression(eval(document.compatMode &&document.compatMode=='CSS1Compat') ?documentElement.scrollTop: document.body.scrollTop);}
/*POLL*/
#poll{float:left;width:233px; padding:6px 0 0; background-color:#f09215;  margin:6px 0 0; border:1px solid #555; -moz-border-radius-topleft:8px; -moz-border-radius-topright:8px;-webkit-border-top-left-radius: 8px;-webkit-border-top-right-radius: 8px;}
#poll p{margin:0; line-height:2em}
#polldiv {position:relative; height:225px;*height:233px;overflow:auto; padding:5px;background-color:#FFF}
#pollcontainer {	margin:0; padding:0}
#loader{ display:none; text-align:center}
#viewresult{font-size:9px;padding:0 8px}
.pollques {font-size:10px;text-align:justify;padding:4px 0;line-height:1.1em !important}
.option{ margin:5px 0}
.option p{ line-height:1.1em !important}
.bar{ height:10px; background:#39c }
.yourvote{ background:#139}
/*Affichage description*/
a.info #description { display: none; /* on masque l'infobulle */}
a.info:hover { background: none; /* correction d'un bug IE */
               z-index: 999; /* on définit une valeur pour l'ordre d'affichage */
               cursor: pointer; /* on change le curseur par défaut en curseur d'aide */
}
a.info:hover #description { display: inline; /* on affiche l'infobulle */ position: absolute; background: white;color: black;padding: 3px;border: 1px solid black}
div.desactive {
    background-color: red;
}
a.info{
    position:relative;
    /*  z-index:24; */
    /*	background-color:#ccc;*/
    color:#000;
    text-decoration:none}
a.info:hover{
    /*z-index:25;*/
    background-color:#ff0}
a.info span{display: none}
a.info:hover span{
    /*le contenu de la balise span ne
    sera visible que pour l'état a:hover */
    display:block;
    position:absolute;
    bottom:1em; left:1em; width:15em;
    border:1px solid #6699cc;
    background-color:#eeeeee; color:#6699cc;
    text-align: justify;
    font-weight:none;
    padding:1px;
}
a.info1 #description { display: none; /* on masque l'infobulle */}
a.info1:hover { background: none; /* correction d'un bug IE */
               z-index: 999; /* on définit une valeur pour l'ordre d'affichage */
               cursor: pointer; /* on change le curseur par défaut en curseur d'aide */
}
a.info1:hover #description { display: inline; /* on affiche l'infobulle */ position: absolute; background: white;color: black;padding: 3px;border: 1px solid black}
div.desactive {
    background-color: red;
}
a.info1{
    position:relative;
    /*  z-index:24; */
    /*	background-color:#ccc;*/
    color:#000;
    text-decoration:none}
a.info1:hover{
    /*z-index:25;*/
    background-color:#ff0}
a.info1 span{display: none}
a.info1:hover span{
    /*le contenu de la balise span ne
    sera visible que pour l'état a:hover */
    display:block;
    position:absolute;
    bottom:1em; right:1em; width:15em;
    border:1px solid #6699cc;
    background-color:#eeeeee; color:#6699cc;
    text-align: justify;
    font-weight:none;
    padding:1px;
}
/*feedback*/
#navbar {
    height:30px;
}
#navbar ul {
    margin:0;
    padding:0;
    list-style:none;
}
#navbar ul li {
    display:inline;
}
#navbar ul li a {
    float:left;
    color:#fff;
    height:18px;
    margin:0 0 0 5px;
    border:1px solid #000;
    padding:5px 20px;
    text-decoration:none;
    background:#000;
}
#navbar ul li a:hover,
#navbar ul li a.active,
#navbar ul li a.active:hover {
    color:#000;
    border:1px solid #000;
    background:#fff;
}
#navbar ul li:first-child a {
    margin-left:0;
}
#feedback_lightbox
{
    width:350px;
    z-index:9999;
    position:relative;
    top:20%;
    left:30%;
}
#feedback_overlay_box
{
    position:fixed;
    top:0;
    left:0;
    background:rgba(0, 0, 0, 0.8);
    overflow:hidden;
    z-index:9998;
    width:100%;
    display:none;
    height:100%;
}
#feedback_button
{
    width:22px;
    height:90px;
    position:fixed;
    top:40%;
    overflow:hidden;
}
#feedback_button a
{
    width:22px;
    height:90px;
    overflow:hidden;
    background:  #FCB03F;
    display:inline-block;
    padding:px;
    border-radius: 0 5px  5px  0;
    display: block;
    height: 90px;
    line-height: 0;
    text-indent: -99999px;
}
#feedback_close
{ 
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    height: 25px;
    margin: 0;
    width: 340px
}
#feedback_close a
{
    background-image: url("../images/close-b.jpg");
    background-repeat: no-repeat;
    float: right;
    font-size: 0;
    height: 13px;
    line-height: 30px;
    margin-right: 7px;
    margin-top: 5px;
    overflow: hidden;
    text-indent: -10000px;
    width: 13px;
}
#feedback_form
{
    width:280px;
    background: #ffffff  ;
    /*-webkit-border-radius: 10px;
    -moz-border-radius: 10px;*/
    /*   border-radius: 10px;*/
    -webkit-box-shadow: 1px 4px 4px rgba(0, 0, 0, 0.1);
    -moz-box-shadow: 1px 4px 4px rgba(0, 0, 0, 0.1);
    box-shadow: 1px 4px 4px rgba(0, 0, 0, 0.1);
    padding:30px;
}
#feedback_form p
{
    padding:0px 0px 10px 0px;
    margin:0px;
    display:block;
}
#feedback_form p label
{
    display:block;
    font-size:12px;
    line-height:16px;
    padding:0px 0px 3px 0px;
    color:red;
}
#feedback_form p .feedback_text,#feedback_form p .feedback_textarea
{
    border:1px solid #999999;
}
#feedback_error
{
    margin:10px 0px 0px 0px;
    border:1px solid red;
    padding:10px;
    overflow:hidden;
    display:none;
}
#feedback_response
{
    margin:10px 0px 10px 0px;
    border:1px solid green;
    padding:10px;
    color:green;
    overflow:hidden;
    display:none;
}
/*ajouter par taha*/
#alternate-account {
    margin: 0;
    padding: 0;
    vertical-align: top;
    width:100%;
}
#alternate-account div {
background: url(../images/facebook-body.png) repeat-y 0 0;
background-size:200px 10px;
}
#alternate-account li {
margin: 0;
padding: 0;
list-style-type: none;
line-height: 0;
overflow: hidden;
color: #525252;
font: 12px/1.5 Arial, Sans-serif;
}
#alternate-account li {
cursor: pointer;
}
#alternate-account ul {
margin: 0;
padding: 0;
overflow: auto;
list-style-type: disc;
line-height: 1.4;
color: #525252;
font: 12px/1.5 Arial, Sans-serif;
list-style: none;
}
#alternate-account fieldset {
padding: 0 0 30px 36px;
background: url(../images/facebook-bottom.png) no-repeat 0 100%;
background-size:200px 5px;
border:0;
}
#alternate-account h1 {
margin: 0;
padding: 16px 0 20px 36px;
background: url(../images/facebook-top.png) no-repeat 0 0;
background-size:200px 60px;
font-size: 20px;
line-height: 1.2;
color: #333;
font-weight: normal
}
#alternate-account div img
{
margin: 0;
padding: 0;
border: 0;
outline: 0;
font-weight: inherit;
font-style: inherit;
font-size: 100%;
font-family: inherit;
vertical-align: baseline;
}
.tableentete2 {
  background-color: #1768AB;
  font-size: 8pt;
  padding: 4px;
  background-repeat: no-repeat;	background-position: center right;cursor: pointer;
}
.headerSortUp2 {
  background-color: #1768AB;
  font-size: 8pt;
  padding: 4px;
 
 background-repeat: no-repeat;	background-position: center right;cursor: pointer;
}
.headerSortDown2 {
  background-color: #1768AB;
  font-size: 8pt;
  padding: 4px;

 background-repeat: no-repeat;	background-position: center right;cursor: pointer;
}
		.meter {
	 background: none repeat scroll 0 0 #555555;
    border-radius: 25px 25px 25px 25px;
    box-shadow: 0 -1px 1px rgba(255, 255, 255, 0.3) inset;
    height: 20px;
    margin: 60px 0 20px;
    padding: 10px;
    position: relative;
		}
		.meter > span {
			display: block;
			height: 100%;
			   -webkit-border-top-right-radius: 8px;
			-webkit-border-bottom-right-radius: 8px;
			       -moz-border-radius-topright: 8px;
			    -moz-border-radius-bottomright: 8px;
			           border-top-right-radius: 8px;
			        border-bottom-right-radius: 8px;
			    -webkit-border-top-left-radius: 20px;
			 -webkit-border-bottom-left-radius: 20px;
			        -moz-border-radius-topleft: 20px;
			     -moz-border-radius-bottomleft: 20px;
			            border-top-left-radius: 20px;
			         border-bottom-left-radius: 20px;
			background-color: rgb(43,194,83);
			background-image: -webkit-gradient(
			  linear,
			  left bottom,
			  left top,
			  color-stop(0, rgb(43,194,83)),
			  color-stop(1, rgb(84,240,84))
			 );
			background-image: -moz-linear-gradient(
			  center bottom,
			  rgb(43,194,83) 37%,
			  rgb(84,240,84) 69%
			 );
			-webkit-box-shadow:
			  inset 0 2px 9px  rgba(255,255,255,0.3),
			  inset 0 -2px 6px rgba(0,0,0,0.4);
			-moz-box-shadow:
			  inset 0 2px 9px  rgba(255,255,255,0.3),
			  inset 0 -2px 6px rgba(0,0,0,0.4);
			box-shadow:
			  inset 0 2px 9px  rgba(255,255,255,0.3),
			  inset 0 -2px 6px rgba(0,0,0,0.4);
			position: relative;
			overflow: hidden;
		}
		.meter > span:after, .animate > span > span {
			content: "";
			position: absolute;
			top: 0; left: 0; bottom: 0; right: 0;
			background-image:
			   -webkit-gradient(linear, 0 0, 100% 100%,
			      color-stop(.25, rgba(255, 255, 255, .2)),
			      color-stop(.25, transparent), color-stop(.5, transparent),
			      color-stop(.5, rgba(255, 255, 255, .2)),
			      color-stop(.75, rgba(255, 255, 255, .2)),
			      color-stop(.75, transparent), to(transparent)
			   );
			background-image:
				-moz-linear-gradient(
				  -45deg,
			      rgba(255, 255, 255, .2) 25%,
			      transparent 25%,
			      transparent 50%,
			      rgba(255, 255, 255, .2) 50%,
			      rgba(255, 255, 255, .2) 75%,
			      transparent 75%,
			      transparent
			   );
			z-index: 1;
			-webkit-background-size: 50px 50px;
			-moz-background-size: 50px 50px;
			-webkit-animation: move 2s linear infinite;
			   -webkit-border-top-right-radius: 8px;
			-webkit-border-bottom-right-radius: 8px;
			       -moz-border-radius-topright: 8px;
			    -moz-border-radius-bottomright: 8px;
			           border-top-right-radius: 8px;
			        border-bottom-right-radius: 8px;
			    -webkit-border-top-left-radius: 20px;
			 -webkit-border-bottom-left-radius: 20px;
			        -moz-border-radius-topleft: 20px;
			     -moz-border-radius-bottomleft: 20px;
			            border-top-left-radius: 20px;
			         border-bottom-left-radius: 20px;
			overflow: hidden;
		}
		
		.animate > span:after {
			display: none;
		}
		
		@-webkit-keyframes move {
		    0% {
		       background-position: 0 0;
		    }
		    50% {
		       background-position: 50px 50px;
		    }
		}
		
		.orange > span {
			background-color: #f1a165;
			background-image: -moz-linear-gradient(top, #f1a165, #f36d0a);
			background-image: -webkit-gradient(linear,left top,left bottom,color-stop(0, #f1a165),color-stop(1, #f36d0a));
			background-image: -webkit-linear-gradient(#f1a165, #f36d0a);
		}
		
		.red > span {
			background-color: #f0a3a3;
			background-image: -moz-linear-gradient(top, #f0a3a3, #f42323);
			background-image: -webkit-gradient(linear,left top,left bottom,color-stop(0, #f0a3a3),color-stop(1, #f42323));
			background-image: -webkit-linear-gradient(#f0a3a3, #f42323);
		}
		
		.nostripes > span > span, .nostripes > span:after {
			-webkit-animation: none;
			background-image: none;
		}
/* ================================================================
This copyright notice must be kept untouched in the stylesheet at
all times.
The original version of this stylesheet and the associated (x)html
is available at http://www.stunicholls.com/menu/pro_drop_1.html
Copyright (c) 2005-2007 Stu Nicholls. All rights reserved.
This stylesheet and the associated (x)html may be modified in any
way to fit your requirements.
=================================================================== */
#nav {padding-left:0px;height:31px;margin:0;position:absolute;left:0;bottom:0;width:100%; z-index:4; font-family:arial;}
#nav li.top {display:block; float:left;height:32px;width:19.89%;background-color:#DDD8D5;border-left:1px solid white;}
#nav li a.top_link {display:block; float:left; height:32px; line-height:27px; color:#765B52; text-decoration:none; font-size:11px; font-weight:bold; padding:0 0 0 12px; cursor:pointer;}
#nav li a.top_link span {float:left; display:block; padding:0 24px 0 12px; height:32px;}
#nav li a.top_link span.down {float:left; display:block; padding:0 24px 0 12px; height:32px;}
#nav li a.top_link:hover {color:#CD6408;}
#nav li a.top_link:hover span {}
#nav li a.top_link:hover span.down {}
#nav li:hover > a.top_link {color:#CD6408;
}
#nav >li:hover {background:#E1DCD9;
}
#nav li:hover > a.top_link span {}
#nav li:hover > a.top_link span.down {}
/* Default list styling */
#nav li:hover {position:relative; z-index:4;}
/* keep the 'next' level invisible by placing it off screen. */
#nav ul,
#nav li:hover ul ul,
#nav li:hover ul li:hover ul ul,
#nav li:hover ul li:hover ul li:hover ul ul,
#nav li:hover ul li:hover ul li:hover ul li:hover ul ul
{position:absolute; left:-9999px; top:-9999px; width:0; height:0; margin:0; padding:0; list-style:none;}
#nav li:hover ul.sub
{left:0; top:31px; background: #DDD8D5; padding:3px; border:1px solid white; white-space:nowrap; width:184px; height:auto; z-index:4;}
#nav li:hover ul.sub li
{display:block; height:20px; position:relative; float:left; width:184px; font-weight:normal;}
#nav li:hover ul.sub li a
{display:block; font-size:10px; height:20px; width:184px; line-height:20px; text-indent:5px; color:#765B52; text-decoration:none;font-weight:bold;}
#nav li ul.sub li a.fly
{background:#fff  ;}
#nav li:hover ul.sub li a:hover
{background:#F0ECEB; color:#CD6408;}
#nav li:hover ul.sub li a.fly:hover
{background:#E1DCD9  ; color:#765B52;}
#nav li:hover ul li:hover > a.fly {background:#3a93d2  ; color:#fff;}
#nav li:hover ul li:hover ul,
#nav li:hover ul li:hover ul li:hover ul,
#nav li:hover ul li:hover ul li:hover ul li:hover ul,
#nav li:hover ul li:hover ul li:hover ul li:hover ul li:hover ul
{left:90px; top:-4px; background: #fff; padding:3px; border:1px solid #3a93d2; white-space:nowrap; width:200px; z-index:4; height:auto;}
/*Fin*/
html{ font-size:0.625em; }
body{ margin:0; padding:0; font-size:1.2em;font-family: 'Fontastique', sans-serif; color:#000000; background: <?php echo $bg0; ?>; }

td, th, input, textarea, select, button{ font-size:1em; font-weight:normal; font-family:Arial, Verdana, sans-serif; }
th{ text-align:left; }
form, img, fieldset, legend{ margin:0; padding:0; border:0; }
h1, h2, h3, h4, h5, h6{ margin:0; padding:0; font-size:1em; }
hr{ display:none; }
img, input, label, select{ vertical-align:middle; }
p{ margin:10px 0; }
a{ color:#454545; text-decoration:none; }
a:hover, a:focus{ text-decoration:underline; }
a *{ cursor:pointer; }
sup{ font-size:0.833em; }
caption{ text-align:left; font-weight:normal; }
/***** Clearance *****/
.calendar ul, .calendar ul li,
.footer ul, .footer ul li,
.header ul, .header ul li,
.history ul, .history ul li,
.navigation ul, .navigation ul li,
.news ul, .news ul li,
.offers ul, .offers ul li,
.path ul, .path ul li,
.subnavigation ul, .subnavigation ul li,
.toolbox ul, .toolbox ul li,
/*.bloc ul, .bloc ul li,*/
.links ul, .links ul li,
.listbullet .ul, .listbullet .ul .li,
.links, .links li,
.linked ul, .linked ul li,
.actualites ul, .actualites ul li,
.icons ul, .icons ul li,
.tabnavigation ul, .tabnavigation ul li,
.steps ul, .steps ul li,
.steps ol, .steps ol li,

.pagination ul, .pagination ul li,
.list ul, .list ul li,
.colonne ul, .colonne ul li,
.pagination-quiz ul, .pagination-quiz ul li,
.scores ul, .scores ul li,
.quicknavigation ul, .quicknavigation ul li,
.tabbed ul, .tabbed ul li,
.stepped ol, .stepped ol li,
.file ul, .file ul li,
.references ul, .references ul li,
.summary ul, .summary ul li,
.sitemap ul, .sitemap ul li,
.z{ margin:0; padding:0; list-style-type:none; list-style-image:none; }
/***** Structure *****/
.quicknavigation{ padding:10px 0 0 0; text-align:center; background:<?php echo $bg1; ?>; font-size:0.917em; min-height:26px;   }
.quicknavigation a{ color:#FFF; border-bottom: none;}
.quicknavigation .center{ margin:auto; width:995px; height:auto; overflow:hidden; }
.quicknavigation .nav{ display:inline; float:left; padding:0; margin:4px; }
.quicknavigation ul{ }
.quicknavigation .nav ul li{ float:left; margin:0 10px 0 -10px; padding:0 10px; border-left:1px solid #FFF; }
.quicknavigation .nav ul li a{ float:left; margin:-2px 0; }
.quicknavigation .rsscontact{ /*position:absolute; right:2px;  top:-2.9em;color:#fff;*/ display:inline; float:right; width:34.5em;  }
.quicknavigation .rsscontact .rss{float:left; padding:0 0 0 3px;}
.quicknavigation .rsscontact .rss a {display:block; padding:2px 25px 2px 0; color:#fff;   }
.quicknavigation .rsscontact .contactus{float:left; padding:2px 0 0 15px;}
.quicknavigation .rsscontact .contactus a{ color:#fff; padding:0 0 2px 12px; text-decoration:underline; font-weight:bold; }
.quicknavigation .rsscontact .contactus a:hover{ text-decoration:none; }
.quicknavigation .rsscontact .acces{float:left; padding:2px 0 0 15px;}
.quicknavigation .rsscontact .acces a{  color:#fff; padding:0 0 2px 68px; text-decoration:underline; font-weight:bold; }
.quicknavigation .rsscontact .acces a:hover{ text-decoration:none; }
.socialHub{  display:inline; float:left; /*position:absolute; top:-2.1em; right:31.5em; */ padding:0 5px; white-space:nowrap; }
.socialHub .socialButtons, .socialHub .socialButtons ul, .botbar .socialButtons ul { display:inline;}
.socialHub .socialButtons li, .botbar .socialButtons li { display:inline; }
.botbar .socialButtons ul { padding:0; margin:0;}
.socialHub img{ margin:0 10px 0 0; }
.socialHub img{ margin:0 2px 0 0; }
.quicknavigation .socialHub
{
  /*  position:absolute;
    top:-2.8em;*/
    color:#fff!important;
    font-size: inherit;
}
.DynarchCalendar-title, .DynarchCalendar-menu-year{
margin-left: 50px;
}
/*	form submit img	*/
.btnSupprimer {
background: url(../images/icons/delete.png) right no-repeat;
background-color: transparent;
border: none;
border-width: 0px;
height: 20px;
width: 20px;
text-align: left;
padding-left: 8px;
padding-bottom: 1px;
cursor: pointer;
color: transparent;
}
.btnEnregistrer {
background: url(../images/icons/download.png) right no-repeat;
background-color: transparent;
border: none;
border-width: 0px;
height: 20px;
width: 20px;
text-align: left;
padding-left: 8px;
padding-bottom: 1px;
cursor: pointer;
color: transparent;
}
/*********Popup_dossier*************/
.popup_block_dossier{overflow:auto;position:fixed;_position:absolute; /* hack for internet explorer 6*/	background-color:#fff;-moz-border-radius-topleft:10px;-moz-border-radius-topright:10px;top:200px;left:200px;z-index:999;}
.popup_block_dossier .titleBar_dossier{margin:0;height:25px;background-color:<?php echo $bg1; ?>;-moz-border-radius-topleft:10px;-moz-border-radius-topright:10px;}
.popup_block_dossier .footerBar_dossier{margin-right:20px;margin-left:20px;margin-bottom:4px;}
.popup_block_dossier .title_dossier{height:25px;float:left;font-size:12px;font-weight:700;margin-left:20px;margin-top:1px;	line-height:23px;text-transform:uppercase;color:#FFF;font-family:Verdana,Arial,Helvetica,sans-serif;}
.popup_block_dossier .close_dossier{height:13px;width:13px;margin-right:7px;margin-top:5px;line-height:30px;float:right;font-size:0;background-image:url(../images/close-b.jpg);background-repeat:no-repeat;text-indent:-10000px;overflow:hidden;}
.popup_block_dossier .content_dossier{margin:10px 10px 20px 10px;overflow:auto;font-family:Verdana,Arial,Helvetica,sans-serif;	font-size:12px; height: 508px;}
#fade_dossier {background: rgba(0, 0, 0, 0.75);position: fixed;_position:absolute; /* hack for internet explorer 6*/width: 100%;height: 100%; /* filter:alpha(opacity=80);opacity: .80;-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)"; */ /*--Transparence sous IE 8--*/left: 0;top: 0;z-index: 10;}
#hideshow_dossier {position: absolute;width: 100%;height: 100%;top: 0;left: 0;}
*html #fade_dossier {position: absolute;top:expression(eval(document.compatMode &&document.compatMode=='CSS1Compat') ?documentElement.scrollTop: document.body.scrollTop);}


.popup_block_dossier_dir{overflow:auto;position:fixed;_position:absolute; /* hack for internet explorer 6*/	background-color:#fff;-moz-border-radius-topleft:10px;-moz-border-radius-topright:10px;top:200px;left:200px;z-index:999;}
.popup_block_dossier_dir .titleBar_dossier_dir{margin:0;height:25px;background-color:<?php echo $bg1; ?>;-moz-border-radius-topleft:10px;-moz-border-radius-topright:10px;}
.popup_block_dossier_dir .footerBar_dossier_dir{margin-right:20px;margin-left:20px;margin-bottom:4px;}
.popup_block_dossier_dir .title_dossier_dir{height:25px;float:left;font-size:12px;font-weight:700;margin-left:20px;margin-top:1px;	line-height:23px;text-transform:uppercase;color:#FFF;font-family:Verdana,Arial,Helvetica,sans-serif;}
.popup_block_dossier_dir .close_dossier_dir{height:13px;width:13px;margin-right:7px;margin-top:5px;line-height:30px;float:right;font-size:0;background-image:url(../images/close-b.jpg);background-repeat:no-repeat;text-indent:-10000px;overflow:hidden;}
.popup_block_dossier_dir .content_dossier_dir{margin:10px 10px 20px 10px;overflow:auto;font-family:Verdana,Arial,Helvetica,sans-serif;	font-size:12px; height: 508px;}
#fade_dossier_dir {background: rgba(0, 0, 0, 0.75);position: fixed;_position:absolute; /* hack for internet explorer 6*/width: 100%;height: 100%; /* filter:alpha(opacity=80);opacity: .80;-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)"; */ /*--Transparence sous IE 8--*/left: 0;top: 0;z-index: 10;}
#hideshow_dossier_dir {position: absolute;width: 100%;height: 100%;top: 0;left: 0;}
*html #fade_dossier_dir {position: absolute;top:expression(eval(document.compatMode &&document.compatMode=='CSS1Compat') ?documentElement.scrollTop: document.body.scrollTop);}


.imgClass {     background-image: url(../images/icons/download.png);    background-position:  0px 0px;    background-repeat: no-repeat;    width: 16px;    height: 16px;    border: 0px;    /*background-color: #fff;*/    cursor: pointer;    outline: 0;}
.cu {cursor: pointer;}
.csscaree{width: 8px;height: 7px;background: #F00;margin-right: 5px;}
.csspuce{top: 3px;float:left;position:relative;}
.csspuce:before{content: '';border: 4px transparent solid;border-right-width: 0;border-left-color: #FFF;position: absolute;top: 0;right: 2px;}
.copyright{color:#fff;}
.espace_candidat{color: #fff;cursor: pointer;font-weight: 400;padding: 4px 10px;position: relative;background: <?php echo $bg1; ?>;white-space: nowrap;display: inline-block;text-decoration: none;}

table thead th {background-color: <?php echo $bg1; ?> !important;color:#fff;!important }
table thead th b{color:#fff;!important }
table thead th strong{color:#fff;!important }
  .alert {
  padding: 8px 35px 8px 14px;
  margin-bottom: 18px;
  text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
  background-color: #fcf8e3;
  border: 1px solid #fbeed5;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
  color: #c09853;
}
.alert-heading {
  color: inherit;
}
.alert .close {
  position: relative;
  top: -2px;
  right: -21px;
  line-height: 18px;
}
.alert-success {
  background-color: #dff0d8;
  border-color: #d6e9c6;
  color: #468847;
}
.alert-danger,
.alert-error {
  background-color: #f2dede;
  border-color: #eed3d7;
  color: #b94a48;
}
.alert-info {
  background-color: #d9edf7;
  border-color: #bce8f1;
  color: #3a87ad;
}
.alert-block {
  padding-top: 14px;
  padding-bottom: 14px;
}
.alert-block > p,
.alert-block > ul {
  margin-bottom: 0;
}
.alert-block p + p {
  margin-top: 5px;
}
.close {
  float: right;
  font-size: 20px;
  font-weight: bold;
  line-height: 18px;
  color: #000000;
  text-shadow: 0 1px 0 #ffffff;
  opacity: 0.2;
  filter: alpha(opacity=20);
}
.close:hover {
  color: #000000;
  text-decoration: none;
  opacity: 0.4;
  filter: alpha(opacity=40);
  cursor: pointer;
}

 .error{
    color: red;display: block;
  }
  .valid{
    /*color:green;
    box-shadow: 0 0 5px <?php echo $bg1; ?>;
    border-color: #28921f;*/
  }




.badge {
  padding: 1px 9px 2px;
  font-size: 10.025px;
  font-weight: bold;
  white-space: nowrap;
  color: #ffffff;
  background-color: #999999;
  -webkit-border-radius: 9px;
  -moz-border-radius: 9px;
  border-radius: 9px;
}
.badge:hover {
  color: #fff;
  background-color: <?php echo $bg1; ?>;
  text-decoration: none;
  cursor: pointer;
}
.badge-site {
  background-color: <?php echo $bg1; ?>;
}
.badge-site:hover {
  background-color: #999999;
}
.badge-error {
  background-color: #b94a48;
}
.badge-error:hover {
  background-color: #953b39;
}
.badge-warning {
  background-color: #f89406;
}
.badge-warning:hover {
  background-color: #c67605;
}
.badge-success {
  background-color: #468847;
}
.badge-success:hover {
  background-color: #356635;
}
.badge-info {
  background-color: #3a87ad;
}
.badge-info:hover {
  background-color: #2d6987;
}
.badge-inverse {
  background-color: #333333;
}

ul.pagination {
    display: inline-block;
    padding: 0;
    margin: 0;
}
.pagination li {
  display: inline;
}
.pagination a {
  float: left;
  padding: 0 10px;
  line-height: 22px;
  text-decoration: none;
  border: 1px solid #fff;
  border-left-width: 0;
}
.pagination a:hover,
.pagination .active a {
  background-color: <?php echo $bg1; ?>;
  color:#fff;
}
.pagination .active a {
  color: #fff;
  cursor: default;
}
.pagination .disabled span,
.pagination .disabled a,
.pagination .disabled a:hover {
  background-color: transparent;
  cursor: default;
  background-color: <?php echo $bg1; ?>;
  color:#fff;
}
.pagination li:first-child a {
  border-left-width: 1px;
  -webkit-border-radius: 3px 0 0 3px;
  -moz-border-radius: 3px 0 0 3px;
  border-radius: 3px 0 0 3px;
}
.pagination li:last-child a {
  -webkit-border-radius: 0 3px 3px 0;
  -moz-border-radius: 0 3px 3px 0;
  border-radius: 0 3px 3px 0;
}
.pagination-centered {
  text-align: center;
}
.pagination-right {
  text-align: right;
}


#chm-table{
  width:100% !important;
}

#chm-table thead th, #chm-table thead th a, #chm-table thead th a>*{
  color: #fff !important;
}

.panel-default hr{
  margin-top: 10px;
  margin-bottom: 10px;
}

.panel-body h5{
  color: #777;
}

.list-group-item {
  padding: 6px 15px !important;
  border: none !important;
  border-width: 0 !important;
  border-left: 3px solid #fff !important;
  font-size: 12px !important;
  font-weight: 600 !important;
}


.list-group-item-info {
  background: <?= css_bg_from_hex($color_bg, 0.3); ?> !important;
}

.btn-primary {
  background-color: <?= $color_bg ?> !important;
  border-color: <?= css_bg_from_hex($color_bg, 0.2); ?> !important;
}