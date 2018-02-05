  <?php

///////////////////////////////////////////////

$cformation=mysql_query("select * from formations where 

  candidats_id= " . safe($_SESSION['abb_id_candidat']) . " ");

$fcount =mysql_num_rows($cformation);

//echo "form".$fcount."<br/>";

///////////////////////////////////////////////

$cexperience=mysql_query("select * from experience_pro where 

    candidats_id= " . safe($_SESSION['abb_id_candidat']) . " ");

$ecount =mysql_num_rows($cexperience);

//echo "exp".$ecount."<br/>";

///////////////////////////////////////////////

$crequetlm=   mysql_query("select * from lettres_motivation where 

  candidats_id = " . safe($_SESSION['abb_id_candidat']) . " AND actif=1");

$lmcount =mysql_num_rows($crequetlm);

//echo "lm".$lmcount."<br/>";

///////////////////////////////////////////////

$crequet=mysql_query("select * from cv where actif='1' 

    and candidats_id = " . safe($_SESSION['abb_id_candidat']) . "");

$cvcount =mysql_num_rows($crequet);

//echo "cv".$cvcount."<br/>";

///////////////////////////////////////////////

$photo = mysql_query("SELECT avg(photo) as photo from candidats where 

    candidats_id = " . safe($_SESSION['abb_id_candidat']) . "");

$resutphoto=mysql_fetch_assoc($photo) ;

$ccphoto=$resutphoto['photo'];

//echo "photo".$ccphoto."<br/>";

/////////////////////////////////////////////// 

$arabic = mysql_query("SELECT  arabic as ar from candidats 

    where candidats_id = " . safe($_SESSION['abb_id_candidat']) . " AND candidats.arabic IS NOT NULL");

$resutar=mysql_fetch_assoc($arabic) ;

$car=($resutar['ar']) ?  1 : 0  ;

//echo "ar".$car."<br/>";

///////////////////////////////////////////////

$french = mysql_query("SELECT french as fr from candidats 

    where candidats_id = " . safe($_SESSION['abb_id_candidat']) . " AND candidats.french IS NOT NULL");

$resutfr=mysql_fetch_assoc($french) ; 

$cfr=($resutfr['fr']) ?  1 : 0  ;

//echo "fr".$cfr."<br/>";

///////////////////////////////////////////////

$english = mysql_query("SELECT  english as en from candidats 

    where candidats_id = " . safe($_SESSION['abb_id_candidat']) . " AND candidats.english IS NOT NULL");

$resuten=mysql_fetch_assoc($english) ; 

$card=($resuten['en']) ?  1 : 0  ;

//echo "en".$card."<br/>";

///////////////////////////////////////////////

$autre = mysql_query("SELECT  autre as au from candidats 

    where candidats_id = " . safe($_SESSION['abb_id_candidat']) . " AND candidats.autre IS NOT NULL");

$resuten=mysql_fetch_assoc($autre) ; 

$cau=($resuten['au']) ?  1 : 0  ;

//echo "au".$card."<br/>";

///////////////////////////////////////////////

$autre1 = mysql_query("SELECT  autre1 as au1 from candidats 

    where candidats_id = " . safe($_SESSION['abb_id_candidat']) . " AND candidats.autre1 IS NOT NULL");

$resuten=mysql_fetch_assoc($autre1) ; 

$cau1=($resuten['au1']) ?  1 : 0  ;

//echo "au1".$card."<br/>";

///////////////////////////////////////////////

$autre2 = mysql_query("SELECT  autre2 as au2 from candidats 

    where candidats_id = " . safe($_SESSION['abb_id_candidat']) . " AND candidats.autre2 IS NOT NULL");

$resuten=mysql_fetch_assoc($autre2) ; 

$cau2=($resuten['au2']) ?  1 : 0  ;

//echo "au2".$card."<br/>";

///////////////////////////////////////////////

$infor = mysql_query("SELECT 

    avg(id_civi) as civi,avg(id_pays) as pays,

    avg(id_situ) as situation,avg(id_fonc) as fonction,

    avg(id_expe) as dure_exp,avg(id_salr) as salaire,

    avg(id_nfor) as nbr_form,avg(id_tfor) as type_formation,

    avg(id_dispo) as dispon,avg(id_sect) as secteur,

    avg(titre) as titre,avg(nom) as nom,

    avg(prenom) as prenom,avg(adresse) as adresse,

    avg(ville) as ville,avg(date_n) as date_naissance,

    avg(nationalite) as nationalite,avg(tel1) as telephone,

    avg(email) as email,avg(mdp) as mdp

    from candidats where 

    candidats_id = " . safe($_SESSION['abb_id_candidat']) . "");

$resutinfor=mysql_fetch_assoc($infor) ;

$ccinfor=$resutinfor['civi']+$resutinfor['pays']+$resutinfor['situation']+$resutinfor['fonction']

+$resutinfor['dure_exp']+$resutinfor['salaire']+$resutinfor['nbr_form']+$resutinfor['type_formation']

+$resutinfor['dispon']+$resutinfor['secteur']+$resutinfor['titre']+$resutinfor['nom']

+$resutinfor['prenom']+$resutinfor['adresse']+$resutinfor['ville']+$resutinfor['date_naissance']

+$resutinfor['nationalite']+$resutinfor['telephone']+$resutinfor['email']+$resutinfor['mdp'];

//echo "infor".$ccinfor."<br/>";

///////////////////////////////////////////////

$prog = 0;

//la photo

if($ccphoto>0){$prog = $prog + 25;}

//echo "<br>".$ccphoto." = ".$prog;

//les langues

if($car>0 OR $cfr>0 OR $card>0  OR $cau>0  OR $cau1>0  OR $cau2>0 ) {$prog = $prog + 25;}

//echo "<br>".$car." = ".$prog; 

//lettre de motivation

if($lmcount>0){$prog = $prog + 25;}

//echo "<br>".$lmcount." = ".$prog;

//Expérience

if($ecount>0){$prog = $prog + 25;}

//echo "<br>".$ecount." = ".$prog;

/*





if($cvcount>0){$prog = $prog + 10;}

//echo "<br>".$cvcount." = ".$prog;

if($fcount>2){$prog = $prog + 25; }

echo "<br>".$fcount." = ".$prog;

if($ccinfor>0){$prog = $prog + 25;}

//echo "<br>".$ccinfor." = ".$prog;

*///* 

//*/

?>



Complété à <b><?php echo $prog; ?>%</b>



<progress id="avancement" value="<?php echo $prog; ?>" max="100" class="bgred" ></progress>



<?php if ($prog != 100): ?> 





<?php /*<a class="info1" href="javascript:void(0)" onclick="return false"><i class="fa fa-external-link"></i>

<span style="width:450px;padding: 5px 5px 0 5px;word-wrap: break-word;left: 0px;  "><p>

 Merci de bien détailler votre CV  Les recruteurs font la présélection des candidatures sur la base des CV complétés sur le site. 

 Détaillez votre CV pour augmenter vos chances d’être contacté par les recruteurs ! </p>

</span>

</a> */ ?>



<?php endif; ?>





      <br/>

	  

    <div class="ligneBleu"></div>

    <?php

$messages=array();

$msgs =""; 

if($ccinfor <= 1 )

{

  $msgs .="<div class='alert alert-error'><ul>

  <li style='color:#FF0000'>Merci de compléter votre profil 

<a href='./informations/'>cliquer içi</a></li></ul></div>";

} 

$id_candidat = $_SESSION['abb_id_candidat'];

$requeteexperiences28 = mysql_query("select * from experience_pro where candidats_id ='$id_candidat' order by id_exp asc ");

$count82 = mysql_num_rows($requeteexperiences28);

if($count82 == 0)

{

/*$msgs .="<div class='alert alert-error'><ul><li style='color:#FF0000'>Il faut avoir renseigné au moins une expérience professionnelle, 

<a href='./experiences/'>cliquer içi</a></li></ul></div>";

*/

}





$requeteformations28 = mysql_query("select * from formations where candidats_id ='$id_candidat' order by id_formation asc ");

$count81 = mysql_num_rows($requeteformations28);

if($count81 == 0)

{

/*$msgs .="<div class='alert alert-error'><ul><li style='color:#FF0000'>Il faut avoir renseigné au moins une formation 

<a href='./formations/'>cliquer içi</a></li></ul></div>";

*/

}

if($count82 < 2 && $count81 < 2)

{

$msgs .="<div class='alert alert-error'><ul><li style='color:#FF0000'>

Afin d'avoir une meilleure visibilité de votre candidature, nous vous informons que vous pourrez ajouter plusieurs formations et expériences professionnelles à partir des menus suivants :

</li>

<li style='color:#FF0000'>Ajouter d'autres formations,

<a href='".$urlcandidat."/cv/formations/'>cliquer içi</a></li>

<li style='color:#FF0000'>Ajouter d'autres expériences professionnelles,

<a href='".$urlcandidat."/cv/experiences/'>cliquer içi</a></li>

</ul></div>";

}

 



array_push($messages,$msgs);



?>





<?php

if(isset($messages) and !empty($messages))  {

        foreach($messages as $messages) 

        ?><?php    

          {     echo $messages;    } 

           ?><?php

      } 



?>









