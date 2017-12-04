 
 
<?php
//////////////////////////////////////////  
  if(isset($_POST['envoi'])){  

    $email0   = isset($_POST['email1'])  ? trim($_POST['email1'])               : "";
    $email_req0    =  $email0; /*str_replace("'","\'",$email0);*/
  $requet = mysql_query("SELECT * from candidats WHERE email = '".safe($email_req0)."' AND status=1"); 
  $reponse = mysql_fetch_array($requet);   
      if(is_array($reponse))
      {     
          include("./post_candidat.php"); 
          $messageemail=array(); 
        array_push($messageemail,"<ul><li style='color:#FF0000'>Cet email est déjà existe, veuillez utiliser une autre adresse E-mail !</li></ul>");
        ?>
        
<?php      } else {

/** Validate captcha */
if (!empty($_REQUEST['captcha'])) {
    if (empty($_SESSION['captcha']) || trim(strtolower($_REQUEST['captcha'])) != $_SESSION['captcha']) {
      
          include("./post_candidat.php"); 
$messagecaptcha=array(); 
array_push($messagecaptcha,"<ul><li style='color:#FF0000'>Le CAPTCHA n'a pas été entré correctement. Essayez à nouveau.</li></ul>");

        ?>
 

<?php 
    } else {
    include("./enregistrement_candidat.php");

    }
 
    unset($_SESSION['captcha']);
} 

}
 
  }
  ?>
<!-- START CONTAINER -->

<div id='container'>


    <?php include ( dirname(__FILE__) . $tempurl2 . "/header.php"); ?>
    

  <!-- END ENTETE -->

  <!-- START GAUCHE -->
<br/>
  <div id='gauche' style="width:100%">



<div id="content_g">
 <table width="210"  cellpadding="0" cellspacing="0" style="border-collapse:collapse;" >
  <tr>
    <td >
  <?php // include (  dirname(__FILE__) . $menuurl . "/menu_gauche_t.php"); ?> 
    <?php include (  dirname(__FILE__) . $menuurl2 . "/menu_gauche.php"); ?>

    </td>
  </tr>
 </table>
</div>


    <div id='content_d' style="width:720px">

      <div class='texte'>
 <br/>
        <h1>CRÉER MON ESPACE CANDIDAT</h1>

    <br/> 



        
        <ul>
          <?php

      if(isset($messages) and !empty($messages))  {
        foreach($messages as $m) 
        ?><div class="alert alert-error"><?php    
          {     echo $m;    } 
           ?></div><?php
      } 
      
      ?>
        </ul> 
        <!-- -->
        <?php 
        if(isset($messageemail) and !empty($messageemail))  {
        foreach ($messageemail as $messageemail) ?>
            <div class="alert alert-error">
                <?php { echo $messageemail; }?>
            </div>
        <?php } ?>
        <!-- -->
          <?php 
        if(isset($messagecaptcha) and !empty($messagecaptcha))  {
        foreach ($messagecaptcha as $messagecaptcha) ?>
            <div class="alert alert-error">
                <?php { echo $messagecaptcha; }?>
            </div>
        <?php } ?>
        <?php 
        if(isset($messagesuc) and !empty($messagesuc))  {
        foreach ($messagesuc as $messagesuc) ?>
            <div class="alert alert-success">
                <?php { echo $messagesuc; }?>
            </div>
        <?php } ?>

  <div id="form">
<form action="<?php echo($_SERVER['REQUEST_URI']); ?>" id="form_inscription" method="post"  
enctype="multipart/form-data" style="border:none" data-parsley-validate>  
<div>
    <table>
            <tr>

              <td style="width: 720px;"><div class="ligneBleu"></div>

                <p style="color:#CC0000"> les champs marqués par (*) sont obligatoires<br/></p></td>

            </tr>


    </table>

<?php  
// Génère : solution pour ckeditor bug PHP
$tag_ckedit = array("<br />", "<p> </p><br />", "<p> </p>");
?>

    <?php include("./formulaire.php");?>
	
</div>
</form>   
  </div>
 
      </div>

    </div>

  </div>

  <!-- fin content gauche -->

</div>

<!-- END CONTAINER -->

<!-- BEGIN PUB FORMAT 5 -->

 

</div>
 
 
</div>

<!-- FIN PUB FORMAT 6 -->
<?php

    
    
    $popup_div='
             <style>  
            /*********Popup*************/
            .popup_block{overflow:auto;position:fixed;_position:absolute; /* hack for internet explorer 6*/ background-color:#fff;-moz-border-radius-topleft:10px;-moz-border-radius-topright:10px;top:200px;left:200px;z-index:999;}
            .popup_block .titleBar{margin:0;height:25px;background-color:#E20026;-moz-border-radius-topleft:10px;-moz-border-radius-topright:10px;}
            .popup_block .footerBar{margin-right:20px;margin-left:20px;margin-bottom:4px;}
            .popup_block .title{height:25px;float:left;font-size:12px;font-weight:700;margin-left:20px;margin-top:1px;  line-height:23px;text-transform:uppercase;color:#FFF;font-family:Verdana,Arial,Helvetica,sans-serif;}
            .popup_block .close{height:13px;width:13px;margin-right:7px;margin-top:5px;line-height:30px;float:right;font-size:0;background-image:url(../images/close-b.jpg);background-repeat:no-repeat;text-indent:-10000px;overflow:hidden;}
            .popup_block .content{margin:10px 10px 20px 10px;overflow:auto;font-family:Verdana,Arial,Helvetica,sans-serif;  font-size:12px; height: 508px;}
            #fade {background: #000;position: fixed;_position:absolute; /* hack for internet explorer 6*/width: 100%;height: 100%; /* filter:alpha(opacity=80);opacity: .80;-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)"; */ /*--Transparence sous IE 8--*/left: 0;top: 0;z-index: 10;}
            #hideshow {position: absolute;width: 100%;height: 100%;top: 0;left: 0;}
            .popup_block .close {height: 13px;width: 13px;margin-right: 7px;margin-top: 5px;line-height: 30px;float: right;font-size: 0;background-image:url(../assets/images/close-b.jpg);background-repeat: no-repeat;text-indent: -10000px;overflow: hidden;}
             </style> 
              <script language="javascript">
            function hideDiv0() { 
              if (document.getElementById) { // DOM3 = IE5, NS6 
                document.getElementById("repertoire0").style.visibility = "hidden"; 
              } else { 
                if (document.layers) { // Netscape 4 
                  document.repertoire0.visibility = "visible";  
                } else { // IE 4 
                  document.all.repertoire0.style.visibility = "hidden"; 
                } 
              } 
            }
            function showDiv0() { 


              if (document.getElementById) { // DOM3 = IE5, NS6 
                document.getElementById("repertoire0").style.visibility = "visible";  
              } else { 
                if (document.layers) { // Netscape 4 
                  document.repertoire0.visibility = "hidden"; 
                } else { // IE 4 
                  document.all.repertoire0.style.visibility = "visible";   
                } 
              } 
                  
            }
            </script>
              
                    <div id="repertoire0"  style="visibility: hidden;" >
                    <div id="fils0">
                     <div id="fade"></div>
                      <div class="popup_block"   style="width: 55%; z-index: 999; top: 15%; left: 20%; overflow:auto" >                     
                      <div class="titleBar">
                        <div class="title">les Conditions d\'utilisation et les Règles de confidentialité.</center></div>
                        <a href="javascript:hideDiv0()" id="fermer"><div class="close_dossier" style="cursor: pointer;">close</div></a>
                      </div> ';
                      
        $popup_div.='

                
<div style=" padding: 10px; ">
<!--<center><h1>CONDITIONS GENERALES D\'UTILISATION  </h1></center>-->

<p align="justify">
1. Le présent site Web et l\'ensemble de son contenu, y compris textes, images fixes ou animées, bases de données, programmes, langage, jsp,cgi, etc.,nommé ci-après le Site Web e-talent, est protégé par le droit d\'auteur.
</p><p align="justify">
2. La solution e-talent ne vous concède qu\'une autorisation de visualisation de son contenu à titre personnel et privé, à l\'exclusion de toute visualisation ou diffusion publique. L\'autorisation de reproduction ne vous est concédée que sous forme numérique sur votre ordinateur de consultation aux fins de visualisation des pages consultées par votre logiciel de navigation. Conformément à la loi 09-08 relative à la protection des personnes physiques à l’égard du traitement des données à caractère personnel  du 18 Février 2009  (BO n° 5714 du 05/03/2009), les personnes concernées par le traitement de données personnelles disposent d’un droit d’accès, de rectification et de suppression des données personnelles qui les  concernent.
</p><p align="justify">
3. Toute autre utilisation non expressément visée aux présentes n\'est pas permise et nécessite l\'accord exprès écrit et préalable des reponsables de la solution e-talent. Il ne vous est pas permis en dehors des utilisations expressément concédées ci-dessus, notamment : de reproduire des marques et logos de '.$titre_site.', d\'utiliser tous programmes utilisés par le Site Web, etc.
</p><p align="justify">
4. Malgré les soins apportés par l\'équipe e-talent, les informations contenues dans le présent site Web sont données à titre indicatif et sont sujettes à changement sans préavis.
</p><p align="justify">
5. E-talent ne vous garantit pas l\'exactitude, complétude, adéquation ou fonctionnement du site Web ou de l\'information qu\'il contient, ni que ladite information a été vérifiée.
</p><p align="justify">
6. E-talent n\'assume aucune responsabilité relative à l\'information contenue et à l\'existence ou la disponibilité de toute offre mentionnée dans le présent site Web et décline toute responsabilité découlant d\'une négligence ou autre concernant cette information.
</p><p align="justify">
7. Le présent Site Web a été créé au Maroc. En utilisant le présent Site Web, vous acceptez les conditions d\'utilisation décrites ci-avant, sans préjudice de tous recours de nature contractuelle ou délictuelle pouvant être exercés par e-talent. Tout litige portant sur l\'interprétation ou l\'exécution d\'un engagement contractuel prévu au présent site sera de la compétence exclusive des tribunaux marocaines faisant application de la loi marocaine.
</p><p align="justify">
L\'ensemble des éléments de ce site est protégé par copyright © '.$titre_site.' par - tous droits réservés.
<br>
Tous les éléments de propriété intellectuelle, marques, noms commerciaux et logos sont la propriété de '.$titre_site.', sauf mentions contraires. Toute reproduction du présent site Web est interdit.
</p>

                                       
</div>  
        
        '; 
        $popup_div.='</div></div> </div>'; 
  
  
    
    echo $popup_div;
    
?> 