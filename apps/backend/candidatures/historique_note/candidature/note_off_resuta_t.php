<?php
 
session_start();

if(isset($_SESSION['compte_v'])) {  header("Location: ../../../compte/");  } 
if(!isset($_SESSION["abb_admin"]) || $_SESSION["abb_admin"] == "")
      {	
  		header("Location:  ../../../login/") ;
	  } 
	  
	  
$his_join ="";$re_etat="";
		if(isset($_GET['etat']))
$etat = $_GET['etat'];
else
	$etat = '';
		if(!empty($etat))
{	if($etat == 'En cours')
	$_SESSION['etat']=" and (candidature.status = 'En attente' OR candidature.status = 'En cours')";
			
else
{	if ($etat == 'Retenu') {
     $_SESSION['etat'] = " and candidature.id_candidature = historique.id_candidature and historique.status = '$etat'";  
     $his_join = " inner join historique on  candidature.id_candidature = historique.id_candidature " ; 
	}
	else
	$_SESSION['etat']=" and candidature.status = '$etat'";
	}
	}
	else
	$_SESSION['etat'] ="";
	if(isset($_GET['ref']) || isset($_GET['offre']) || isset($_POST['select']))
	{
	if(isset($_GET['offre']) && !empty($_GET['offre'])      )
		$id_o = $_GET['offre'];
	else
		$id_o = $_GET['ref'];
		}
	$url44 = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 
//echo $url44 ;
$_SESSION['url44'] = $url44; 

function couperChaine($chaine, $nbrMotMax) {
    $chaineNouvelle = "";
    $i = 0;
    $t_chaineNouvelle = explode(" ", $chaine);
    foreach ($t_chaineNouvelle as $cle => $mot) {
        if ($cle < $nbrMotMax) {
            $chaineNouvelle .= $mot . " ";
        }
        $i++;
    }
    if ($i <= $nbrMotMax)
        return $chaine;
    else
        return $chaineNouvelle . " ...";
}


    require_once dirname(__FILE__) . "/../../../../../config/config.php";
        mysql_connect($serveur,$user,$passwd);
        mysql_select_db($bdd);
    function time_ago($date, $granularity = 2)
{    $date = strtotime($date);
    $difference = time() - $date;
    $periods = array(
        'decade' => 315360000,
        'année'   => 31536000,
        'mois'  => 2628000,
        'semaine'   => 604800, 
        'jour'    => 86400,
        'heure'   => 3600,
        'minute' => 60,
        'seconde' => 1);
    
    $retval = '';
    if ($difference < 1)
    {
        $retval = "moins de 1 second";
    }
    else
    {
        foreach ($periods as $key => $value)
        {
            if ($difference >= $value)
            {
                $time = floor($difference/$value);
                $difference %= $value;
                $retval .= ($retval ? ' ' : '').$time.' ';
                $retval .= (($time > 1 && $key !='mois') ? $key.'s' : $key);
                $granularity--;
            }
            if ($granularity == '0')
            {
                break;
            }
        }
    }
    return $retval;      
} 


if(isset($_GET['cc']))
{include("./candidat.php");
}   
            $session_tel = "";
        $session_convocation="";
        $session_rencontre= "";
        $session_recontact = "";
        $session_transmis = "";
        $session_retenus= "";
        $count_tel = 0; $count_convocation = 0; $count_rencontre = 0; $count_recontact = 0; $count_transmis = 0; $count_retenu = 0;
        $select_candidature = mysql_query("select candidature.id_candidature from candidature  inner join offre on candidature.id_offre = offre.id_offre ".$his_join." where  offre.id_offre='$id_o' ".$re_etat." ".$_SESSION['etat']." ");
        $select_candidature1 ="select id_candidature from candidature  inner join offre on candidature.id_offre = offre.id_offre ".$his_join." where offre.id_offre='$id_o' and ".$re_etat." ".$_SESSION['etat']."";
        
 
        while($id_candid = mysql_fetch_array($select_candidature))
        {
            $last_status = ''; $last_id = 0;
           
			
            $select_count_hist = mysql_query("select id_candidature,status from historique where id_candidature = '".$id_candid['id_candidature']."' order by  `historique`.`id` DESC limit 0,1");
            if($status = mysql_fetch_array($select_count_hist))
            {
                $last_id = $status['id_candidature'];
                $last_status = $status['status'];
            }
            if($last_status == 'Appel téléphonique')
            {
                $array_tel[] = $last_id;                
                $count_tel++;
            }
            if($last_status == 'Convocation entretien')
            {
                $array_convocation[] = $last_id;
                $count_convocation++;
            }
            if($last_status == 'A rencontrer')
            {
                $array_rencontre[] = $last_id;
                $count_rencontre++; 
            }
            if($last_status == 'A recontacter')
            {
                $array_recontact[] = $last_id;
                $count_recontact++;
            }
            if($last_status == 'Candidature transmise')
            {
                $array_transmis[] = $last_id;
                $count_transmis++;
            }
            if($last_status == 'Retenu')
            {
                $array_retenu[] = $last_id;
                $count_retenu++;
            }
        }
        
        
        if(isset($array_tel)) 
        $session_tel = implode("+",$array_tel);
        if(isset($array_convocation)) 
        $session_convocation= implode("+",$array_convocation);
        if(isset($array_rencontre)) 
        $session_rencontre= implode("+",$array_rencontre);
        if(isset($array_recontact)) 
        $session_recontact = implode("+",$array_recontact);
        if(isset($array_transmis)) 
            $session_transmis = implode("+",$array_transmis);
        if(isset($array_retenu)) 
        $session_retenus= implode("+",$array_retenu);
         
            if(isset($_GET['candidature']))
            $candidature =  $_GET['candidature'];
        elseif(isset($_POST['candidature']))
            $candidature =  $_POST['candidature'];
        else
            $candidature =  "";
            
            
            
                if(isset($_GET['stat'])) // si status historique est rï¿½cupï¿½rï¿½ aprï¿½s le click sur le lien 
        $stat =  $_GET['stat'];
    elseif(isset($_POST['stat'])) //si status historique est rï¿½cupï¿½rï¿½ par le formulaire d'edition de la candidature
        $stat =  $_POST['stat'];
    else
        $stat = "";
        
        
        $stat1=$stat;
        
        switch($candidature)
        {
            case "encours" : 
            if(isset($_SESSION["query"]))
                $_SESSION["query"] = NULL;
            break; 
            case "refus"   : $query = "select * from candidats  inner join candidature on candidats.candidats_id = candidature.candidats_id ".$his_join." inner join offre on candidature.id_offre = offre.id_offre  where  offre.id_offre='$id_o ".$re_etat."' ".$_SESSION['etat']." ";  
                         $_SESSION["query"] = $query;break;
                                             
            default        :      $query = "select * from candidats  inner join candidature on candidats.candidats_id = candidature.candidats_id ".$his_join." inner join offre on candidature.id_offre = offre.id_offre  where  offre.id_offre='$id_o ".$re_etat."' ".$_SESSION['etat']."";
                         $_SESSION["query"] = $query;
                                                
                                                 
        }
        
    switch($stat)
    {
        case "tel": 
        if($session_tel != "")
        {
            $condition = "WHERE ( ";
            $tel = explode("+",$session_tel);
            for($i=0; $i < count($tel); $i++)
                $condition .= "id_candidature =".$tel[$i]." OR ";
            $condition = rtrim($condition," OR ");
                        
                        $condition .=' ) ';
        }
        else
                $condition = "WHERE id_candidature = ''"; 
                
            $query = "select * from candidats inner join candidature on candidats.candidats_id = candidature.candidats_id ".$his_join." inner join offre on candidature.id_offre = offre.id_offre   ".$condition." and offre.id_offre='$id_o' ".$re_etat." ".$_SESSION['etat']."";break;    
        case "entretien": 
        if($session_convocation != "")
        {
            $condition = "WHERE ( ";
            $convocation = explode("+",$session_convocation);
            for($i=0; $i < count($convocation); $i++)
                $condition .= "id_candidature =".$convocation[$i]." OR ";
            $condition = rtrim($condition," OR ");
                       $condition .=' ) ';
        }
        else
            $condition = "WHERE id_candidature = ''";
               
               
        $query = "select * from candidats  inner join candidature on candidats.candidats_id = candidature.candidats_id ".$his_join." inner join offre on candidature.id_offre = offre.id_offre   ".$condition." and offre.id_offre='$id_o' ".$re_etat." ".$_SESSION['etat']."";break;
        case "recontact": 
        if($session_recontact != "")
        {
            $condition = "WHERE ( ";
            $recontact = explode("+",$session_recontact);
            for($i=0; $i < count($recontact); $i++)
                $condition .= "id_candidature =".$recontact[$i]." OR ";
            $condition = rtrim($condition," OR ");
                         $condition .=' ) '; 
        }
        else
            $condition = "WHERE id_candidature = ''"; 
                
        $query = "select * from candidats  inner join candidature on candidats.candidats_id = candidature.candidats_id ".$his_join." inner join offre on candidature.id_offre = offre.id_offre   ".$condition." and offre.id_offre='$id_o' ".$re_etat." ".$_SESSION['etat']."";break;
        case "rencontre": 
        if($session_rencontre != "")
        {
            $condition = "WHERE ( ";
            $rencontre = explode("+",$session_rencontre);
            for($i=0; $i < count($rencontre); $i++)
                $condition .= "id_candidature =".$rencontre[$i]." OR ";
            $condition = rtrim($condition," OR ");
                         $condition .=' ) ';
        }
        else
        $condition = "WHERE id_candidature = ''";
                 
        $query = "select * from candidats inner join candidature on candidats.candidats_id = candidature.candidats_id ".$his_join." inner join offre on candidature.id_offre = offre.id_offre  ".$condition."  and offre.id_offre='$id_o' ".$re_etat." ".$_SESSION['etat']."";break;
        case "transmis":
    if($session_transmis != "")
        {
            $condition = "WHERE ( ";
            $transmis = explode("+",$session_transmis);
            for($i=0; $i < count($transmis); $i++)
                $condition .= "id_candidature =".$transmis[$i]." OR ";
                       
            $condition = rtrim($condition," OR ");
                        $condition .=' ) ';
        }
        else
        $condition = "WHERE id_candidature = ''"; 
                 
        $query = "select * from candidats  inner join candidature on candidats.candidats_id = candidature.candidats_id ".$his_join." inner join offre on candidature.id_offre = offre.id_offre   ".$condition." and offre.id_offre='$id_o' ".$re_etat." ".$_SESSION['etat']."";break;
        case "retenus":
        if($session_retenus != "")
        {
            $condition = "WHERE ( ";
            $retenus = explode("+",$session_retenus);
            for($i=0; $i < count($retenus); $i++)
                $condition .= "id_candidature =".$retenus[$i]." OR ";
            $condition = rtrim($condition," OR ");
                         $condition .=' ) ';
        }
        else
            $condition = "WHERE id_candidature = ''"; 
                 
        $query = "select * from candidats  inner join candidature on candidats.candidats_id = candidature.candidats_id ".$his_join." inner join offre on candidature.id_offre = offre.id_offre   ".$condition."  ".$re_etat." ".$_SESSION['etat']."";break;
            }//fin switch
             if(isset($query))
        $_SESSION["query"] = $query;    
        
         
        
 /////////////////////////////////////////////traitement filtrage -d- ///////////////////////////////////////////////// 
        
        
          if(isset($_GET['envoi_fitrage'])  || isset($_GET['filtrage']) )
      {
              
              
              $filtrage="&filtrage=filtrage";
                     
                       
            
        if(!empty($_GET['motcle'])||!empty($_GET['fonction'])||!empty($_GET['fraicheur'])||!empty($_GET['pays'])||!empty($_GET['formation'])||!empty($_GET['type_formation'])||!empty($_GET['exp'])||!empty($_GET['secteur'])||!empty($_GET['situation'])||!empty($_GET['etablissement'])||!empty($_GET['offre']))
        {
        
            if(!empty($_GET['pays']))
              $requete .= " and candidats.pays = '".$_GET['pays']."'";
              if(!empty($_GET['motcle']))
            {
                $requete .= " And lower(concat_ws(' ',fiche_candidat.titre,fiche_candidat.etablissement,fiche_candidat.diplome,fiche_candidat.description, candidats.nom, candidats.prenom , CONCAT(candidats.prenom, ' ', candidats.nom))) like lower('%".$_GET['motcle']."%')";
            }   
            if(!empty($_GET['formation']))
            {
                            
      if($_GET['formation']=='Bac1')
      $fvar='Bac+1';
          if($_GET['formation']=='Bac2')
      $fvar='Bac+2';
      if($_GET['formation']=='Bac3')
      $fvar='Bac+3';
      if($_GET['formation']=='Bac4')
      $fvar='Bac+4';
      if($_GET['formation']=='Bac5')
      $fvar='Bac+5';
      if($_GET['formation']=='Bac6 et plus')
      $fvar='Bac+6 et plus';
                        $_session['formation']=$fvar;
                    $requete .= " And candidats.formation = '".$fvar."'";
            }   
                        
        
            if(!empty($_GET['fonction']))
            {
                
                    $requete .= " And candidats.id_fonction = '".$_GET['fonction']."'";
            }                   
            if(!empty($_GET['type_formation']))
            {
     
            
                    $requete .= " And candidats.type_formation = '".$_GET['type_formation']."'";
            }
            if(!empty($_GET['exp']))
            {
            
                    $requete .= " And candidats.experience = '".$_GET['exp']."'";
            }
            if(!empty($_GET['secteur']))
            {
            
                    $requete .= " And candidats.domaine = '".addslashes($_GET['secteur'])."'";
            }
            if(!empty($_GET['situation']))
            {
            
                    $requete .= " And candidats.situation = '".$_GET['situation']."'";
            }
                        
                        if(!empty($_GET['offre']))
            {
            
                    $requete .= " And offre.id_offre = '".$Sid_o."'";
            }
            if(!empty($_GET['etablissement']))
            {
                
                    $requete .= " And fiche_candidat.etablissement = '".addslashes($_GET['etablissement'])."'";
            }   
                        if(!empty($_GET['fraicheur']))
            {
            
                    $requete .= " And DATEDIFF(curdate(),dateMAJ)<'".$_GET['fraicheur']."'";
            }   
            
            $_SESSION['query']= $_SESSION['query']." ".$requete." ";
                        
                       
        }
         }
        
          
          
          
          
          if(isset($_GET['actualiser']))
{$_GET['motcle']="";
$_GET['fonction']="";
$_GET['pays']="";
$_GET['exp']="";
$_GET['secteur']="";
$_GET['fraicheur']="";
$_GET['situation']="";
$_GET['etablissement']="";
$_GET['type_formation']="";
$_GET['formation']="";
$_GET['offre']="";
}        
/////////////////////////////////////////////traitement filtrage -f- /////////////////////////////////////////////////  
         
         
        
        $sql_roles = mysql_query("SELECT * FROM  root_roles where login = '".$_SESSION['abb_admin']."' ");
        $rep_roles = mysql_fetch_assoc($sql_roles);
$id_offre = isset($_GET['offre'])  ? $_GET['offre'] : "";
$select = mysql_query("select * from offre where id_offre = '$id_offre'");
$reponse = mysql_fetch_array($select);
$ss  = $reponse['Name']; 
     
       $_SESSION['page_courant ']=$_SERVER['REQUEST_URI'];

 $_SESSION['link_bak_a']=4;
 $_SESSION['link_bak_b']=48;
  
     
  $nom_page_site ="HISTORIQUE DES NOTES"  ;
 
   
 $ariane=" Candidature > <a href='../'>Historique des notes</a> > $ss" ;
 ?>