<?php

   header('content-type: text/css');

   ob_start('ob_gzhandler');

   header('Cache-Control: max-age=31536000, must-revalidate');

   // etc. 

   

    require_once dirname(__FILE__) . "/../../../config/config.php";

	

	$bg=$color_bg_menu;

?> 

.champs_editable{border: 1px solid black; background-color: #F7F7F7;  padding: 5px;}

*{margin:0px;border-collapse:collapse;font-family:Helvetica;}
/*color:#000000;*/

img{border:0px;}

ul li{/*list-style-type:none;*/}

ul li.menugauche {list-style-type:none;}

a{text-decoration:none;color:#000000;font-family:Helvetica;padding-bottom:1px;}

a:hover, a:focus{text-decoration:none;color:#000000;} /*border-bottom:1px dotted #333333;padding-bottom:1px;*/

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

.textsouligne{text-decoration:underline;}

.italique{font-style:italic;}

.maincolor{color:#666666;}

.rouge{color:#ff0000;}

.grisclair{color:#ab1355}

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

ul#menu_aide_navigation li.BT_plan_active{width:80px;height:20px; color:#000000;}

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

ul.menu-langue-site li a{padding-top:10px;height:20px;display:block;color:#999999;text-align:center;border-bottom:0px;padding-bottom:0px;}

ul.menu-langue-site li a:hover, ul.menu-langue-site li a:focus{ color:#333333;}

li.langue-active{padding-top:10px;height:20px;display:block;color:#666666;}

#panier{float:right;text-align:right;padding:8px 0px 0px 30px;font-size:1.2em;font-weight:bold;}

#panier a{color:#666666;}

#panier a:hover, #contenu a:focus{border-bottom:1px dotted #333333;padding-bottom:1px;color:#333333}

#wrapper{float:left;width:100%;}

#colG{width:295px;float:left;padding-left:6px;}

#menu-fo{float:left;width:295px;padding-top:20px;}

#menu-fo1{float:left;width:190px;padding-top:20px;}

ul#menu_site_carriere li.borderbas{border-bottom:1px dotted #cccccc;}

ul#menu_site_carriere li{border-top:1px dotted #cccccc;height:25px;font-family:Verdana, Arial, Helvetica, sans-serif;list-style-type:none;}

ul#menu_site_carriere li a{text-transform:uppercase;border-bottom:0px;padding:5px 0 0 10px;height:20px;display:block;}

ul#menu_site_carriere li a:hover, ul#menu_site_carriere li a:focus{background:<?php echo $bg; ?>;color:#fff;padding:5px 0 0 10px;}

ul#menu_site_carriere li.menufo-active{background:<?php echo $bg; ?>;padding:2px 0 0 0px;text-transform:uppercase;}

ul#menu_site_carriere li.menufo-active a{color:#fff;}

#espacecandidat{float:left;}

#bloc_espace_haut{width:292px;height:10px;background:url(BG_espace_haut.png) no-repeat top left;float:left;}

#bloc_espace_fond{width:262px;padding:0 15px 5px 15px;background:url(BG_espace_fond.jpg) repeat-y top left;float:left;}

#bloc_espace_bas{width:292px;height:15px;background:url(BG_espace_bas.png) no-repeat top left;float:left;}

ul.message-erreur{width:255px;border:1px solid #ff0000;padding:5px 2px 5px 5px;margin:2px 0 7px 0;color:#ff0000;font-family:Verdana, Arial, Helvetica, sans-serif;font-size:0.9em;}

ul.message-erreur li{list-style-type:disc;list-style-position:inside;text-indent:5px}

ul.message-erreur p{margin-bottom:5px}

#espacecandidat hr{border-bottom:3px dotted #cccccc;padding-bottom:10px;margin-bottom:10px;}

div.espace_nonlogue table{width:265px}

#espacecandidat label{color:#999999;}

#espacecandidat input.checkbox,

#espacecandidat input[type=checkbox],

#espacecandidat span.checkbox{width:20px;border:0px;}

#espacecandidat input.bt_connexion,

#espacecandidat img.bt_connexion,

#contenu input.bt_connexion{width:22px;height:20px;border:0px;}

p.bonjour{color:#999999;margin-bottom:10px;}

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

#moteur{margin-bottom:10px;background:url(BG_moteur.jpg);width:630px;height:100px;padding:10px 15px 5px 15px;}

#moteur label{padding-right:3px;font-weight:bold;font-size:1.1em}

#moteur select{border:1px solid #cccccc;width:180px;}

#moteur td.quoi, td.ou, td.contrat, td.keyword{padding-bottom:15px;}

#moteur td.keyword{width:58%;text-align:left;}

#moteur td.keyword input{width:275px;}

#moteur td.quoi{width:38%;text-align:left;}

#moteur td.ou{width:39%;text-align:center;}

#moteur td.contrat{width:40%;text-align:right;}

#moteur td.offres{background:url(picto-offre.gif) no-repeat bottom left;padding-left:25px;}

#moteur td.r_avance{background:url(r_avance.png) no-repeat bottom left;padding-left:25px;}

#moteur td.flux{padding-left:20px;text-align:center;}

#moteur td.recherche{text-align:right}

#contenu .recherche{clear:both;}

#moteur input.bt_recherche{width:168px;height:26px;border:0px;}

#filariane{margin-bottom:20px;color:#999999;float:left;width:100%}

#filariane ul#menu_filariane li{display:block;float:left;padding-right:4px;}

#filariane ul#menu_filariane a{text-decoration:none;color:#999999;border-bottom:1px dotted #ffffff;padding-bottom:1px;}

#filariane ul#menu_filariane a:hover, ul#menu_filariane a:focus{color:#999999;border-bottom:1px dotted #999999;text-decoration:none;padding-bottom:1px;}

#filariane ul#menu_filariane li span.textsouligne-filariane{border-bottom:1px dotted #999999;}

#titrepages{float:left;clear:both;width:100%;}

#contenu{width:100%;float:left;}

.baseline-seo{color:#999999;margin-bottom:20px;}

#footer{height:50px;float:left;width:100%;}

ul.menu_footer li{display:inline;border-right:1px solid #cccccc;padding:0 5px;}

ul.menu_footer li.sansbordure{border:0px}

ul.menu_footer li a{text-decoration:none;color:#000000;border-bottom:0px;padding-bottom:1px;}

ul.menu_footer li a:hover, ul.menu_footer li a:focus{text-decoration:none;color:#666666;border-bottom:1px dotted #666666;padding-bottom:1px;}

span.copyright{color:#999999;}

#menufooter{}

a.retourhaut{float:right;display:block;height:15px;padding-right:20px;border-bottom:0px;color:#999999;}

a:hover.retourhaut span{color:#666666;border-bottom:1px dotted #666666;padding-bottom:1px;}

#menu, #menu ul {

    margin: 0;

    padding: 0;

    list-style: none;

} #menu {

    width: 100%; 

    background-color: #f7f7f7;

    background-image: linear-gradient(#f7f7f7, #f7f7f7);

	-moz-box-shadow: 0 2px 1px #9c9c9c;

	-webkit-box-shadow: 0 2px 1px #9c9c9c;



box-shadow:

    0 1px 1px #777;

} #menu:before, #menu:after {

    content: "";

    display: table;

} #menu:after {

    clear: both;

} #menu {

    zoom: 1;

	padding: 4px 0 0 0;

} #menu li {

    float: left;

    /*border-right: 1px solid #222;

    box-shadow: 1px 0 0 #444;*/

    position: relative;

} #menu a {

    float: left;

    padding: 0 40px;

    color: <?php echo $bg; ?>;

    text-transform: uppercase;

    text-decoration: none;

    text-shadow: 0 1px 0 #000;

	font: bold 12px/25px Arial, Helvetica;

	border-bottom: none;

} #menu li:hover > a {

    color: #fff;

    background-color: <?php echo $bg; ?>;

} * html #menu li a:hover { /* IE6 only */

    color: #fff;

    background-color: <?php echo $bg; ?>;

} #menu ul {

    margin: 20px 0 0 0;

    _margin: 0; /*IE6 only*/

    opacity: 0;

    visibility: hidden;

    position: absolute;

    width:218px;

    top: 27px;

    left: 0;

    right: -1px;

    z-index: 1000000;

    background: #f7f7f7;

    background: linear-gradient(#f7f7f7, #f7f7f7);



box-shadow:

    0 -1px 0 rgba(255, 255, 255, .3);



transition:all

    .2s



ease-in-out;

} #menu li:hover > ul {

    opacity: 1;

    visibility: visible;

    margin: 0;

} #menu ul ul {

    top: 0;

    left: 150px;

    margin: 0 0 0 20px;

    _margin: 0; /*IE6 only*/

    box-shadow: -1px 0 0 rgba(255, 255, 255, .3);

} #menu ul li {

    float: none;

    display: block;

    border: 0;

    _line-height: 0; /*IE6 only*/

    box-shadow: 0 1px 0 #cccccc, 0 2px 0 #cccccc;

}  #menu ul a {

    padding: 5px;

    _height: 10px; /*IE6 only*/

    display: block;

    white-space: nowrap;

    float: none;

    text-transform: none;

	border-bottom: none;

} #menu ul a:hover {

    background-color: <?php echo $bg; ?>;

} 





#menu li.active{

    background: #ccddff;

}



/*---------------------------MENU ACCORDIANT----*/

ul#menu_site_carriere ul { display: none;   }



ul#menu_site_carriere li ul li a { 

  display: block;  

  padding:5px 0 0 10px; 

}

ul#menu_site_carriere li ul li a:hover {

  background: #f7f7f7;

}



ul#menu_site_carriere ul li.borderbas{

	border-bottom:1px dotted #cccccc;}

   