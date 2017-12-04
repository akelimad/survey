    

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
$type_p = (isset($_POST['type_p']))? $_POST['type_p'] : "";

$prm_titre= (isset($_POST['prm_titre']))? $_POST['prm_titre'] : "";
$prm_expe = (isset($_POST['prm_expe']))? $_POST['prm_expe'] : "";
$prm_local = (isset($_POST['prm_local']))? $_POST['prm_local'] : "";
$prm_tpost = (isset($_POST['prm_tpost']))? $_POST['prm_tpost'] : "";
$prm_fonc = (isset($_POST['prm_fonc']))? $_POST['prm_fonc'] : "";
$prm_nfor = (isset($_POST['prm_nfor']))? $_POST['prm_nfor'] : "";
$prm_mobil = (isset($_POST['prm_mobil']))? $_POST['prm_mobil'] : "";
$prm_n_mobil = (isset($_POST['prm_n_mobil']))? $_POST['prm_n_mobil'] : "";
$prm_t_mobil = (isset($_POST['prm_t_mobil']))? $_POST['prm_t_mobil'] : "";


if(isset($_POST['sendAdd_trole']) and $_POST['type_p']!="")
{
$qsql = "INSERT INTO prm_pertinence
 (ref_p,type_p,prm_titre,prm_expe,
  prm_local,prm_tpost,prm_fonc,prm_nfor,
  prm_mobil,prm_n_mobil,prm_t_mobil) 
  VALUES ('".safe($ref_statut)."','".safe($type_p)."','".safe($prm_titre)."','".safe($prm_expe)."',
    '".safe($prm_local)."','".safe($prm_tpost)."' ,'".safe($prm_fonc)."','".safe($prm_nfor)."',
    '".safe($prm_mobil)."','".safe($prm_n_mobil)."','".safe($prm_t_mobil)."' )";
$addSect = mysql_query($qsql);
//$id=0;
    if(!$addSect){
    echo '<span style="color:red"  > Une erreur s\'est produite lors de la mise &agrave; jour de cette configuration  </span>';
    echo $qsql;
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
<?php include('edit_champs_pertinence_m_form.php'); ?>
</form>
<br>
<div class="ligneBleu"></div><br>
<?php include('edit_champs_pertinence_m_table.php'); ?>
<?php ///////////////////////////////////////////////////////////////////////////////////  -f  ?>   
</div>
</td>
<?php ///////////////////////////////////////////////////////////////////////////////////  -f body ?>   
</tr>
</table>        
<?php ///////////////////////////////////////////////////////////////////////////////////  -fin  ?>
<br>
</div> 