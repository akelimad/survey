    

<div class='texte'  style="width:720px">
<br/><h1>Statut Candidature</h1>
<div class="subscription" style="margin: 10px 0pt;">
<h1>Configuration des  champs editables </h1>
</div>
			  
<?php ///////////////////////////////////////////////////////////////////////////////////  -debut  ?>
<?php include('../edit_champs_m_menu.php');?>
<?php ///////////////////////////////////////////////////////////////////////////////////  -f head ?>	
<?php
$af0="block";
$af="none";
$p = (isset($_GET["p"])) ? $_GET["p"] :  "no" ;
if($p=='ec') {
// -----------------------------------
   $af0="none";
   $af="block";
// -----------------------------------
} 
?>
<?php
  

$ref_statut = (isset($_POST['ref_statut']))? $_POST['ref_statut'] : "";
$statut = (isset($_POST['statut']))? $_POST['statut'] : "";

$ref= (isset($_POST['ref']))? $_POST['ref'] : "";

$popup_1 = (isset($_POST['popup_1']))? $_POST['popup_1'] : "";
$popup_2 = (isset($_POST['popup_2']))? $_POST['popup_2'] : "";
$popup_3 = (isset($_POST['popup_3']))? $_POST['popup_3'] : "";
$popup_4 = (isset($_POST['popup_4']))? $_POST['popup_4'] : "";
$popup_5 = (isset($_POST['popup_5']))? $_POST['popup_5'] : "";
$popup_6 = (isset($_POST['popup_6']))? $_POST['popup_6'] : "";
$popup_7 = (isset($_POST['popup_7']))? $_POST['popup_7'] : "";
$popup_8 = (isset($_POST['popup_8']))? $_POST['popup_8'] : "";

$etat_1= (isset($_POST['etat_1']))? $_POST['etat_1'] : 0 ;
$etat_2= (isset($_POST['etat_2']))? $_POST['etat_2'] : 0 ;
$etat_3= (isset($_POST['etat_3']))? $_POST['etat_3'] : 0 ;
$etat_4= (isset($_POST['etat_4']))? $_POST['etat_4'] : 0 ;
$etat_5= (isset($_POST['etat_5']))? $_POST['etat_5'] : 0 ;
$etat_6= (isset($_POST['etat_6']))? $_POST['etat_6'] : 0 ;
$etat_7= (isset($_POST['etat_7']))? $_POST['etat_7'] : 0 ;
$etat_8= (isset($_POST['etat_8']))? $_POST['etat_8'] : 0 ;

$order_statut = (isset($_POST['order_statut']))? $_POST['order_statut'] : "";


if(isset($_POST['sendAdd_trole']) and $_POST['statut']!="")
{
$qsql = "INSERT INTO prm_statut_candidature (id_prm_statut_c,ref_statut,ref_email,statut,popup_1,etat_1,popup_2,etat_2,popup_3,etat_3,popup_4,etat_4,popup_5,etat_5,popup_6,etat_6,popup_7,etat_7,popup_8,etat_8,order_statut) 
  VALUES ('','".safe($ref_statut)."','".safe($ref)."','".safe($statut)."','".safe($popup_1)."','".safe($etat_1)."','".safe($popup_2)."' ,'".safe($etat_2)."','".safe($popup_3)."','".safe($etat_3)."','".safe($popup_4)."' , '".safe($etat_4)."','".safe($popup_5)."' ,'".safe($etat_5)."','".safe($popup_6)."','".safe($etat_6)."','".safe($popup_7)."' , '".safe($etat_7)."'
  ,'".safe($popup_8)."' , '".safe($etat_8)."' , '".safe($order_statut)."' )";
$addSect = mysql_query($qsql);
//$id=0;
    if(!$addSect){
    echo '<span style="color:red"  > Une erreur s\'est produite lors de la mise &agrave; jour de cette configuration  </span>';
    $maj=0;
    }else{
    echo '<span style="color:green"  > Cette configuration a bien &eacute;t&eacute; mise &agrave; jour  </span>';
    $sql = "select * from prm_compte_desactiver ";
    $select = mysql_query($sql);
    }
// -----------------------------------
   echo "<script>";
   echo "showonlyone('newboxes10');";
   echo "</script>";        
// -----------------------------------
}
?>
<tr>
<td COLSPAN=5>
<?php ///////////////////////////////////////////////////////////////////////////////////  -d body ?>	
<div  style="border: 1px solid black; background-color: #fff; padding: 5px;">
<?php ///////////////////////////////////////////////////////////////////////////////////  -d  ?>   
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="formulaire_a" >
<?php include('edit_champs_candidature_m_form.php'); ?>
</form>
<br>
<div class="ligneBleu"></div><br>
<?php include('edit_champs_candidature_m_table.php'); ?>
<?php ///////////////////////////////////////////////////////////////////////////////////  -f  ?>   
</div>
</td>
<?php ///////////////////////////////////////////////////////////////////////////////////  -f body ?>   
</tr>
</table>        
<?php ///////////////////////////////////////////////////////////////////////////////////  -fin  ?>
<br>
</div> 