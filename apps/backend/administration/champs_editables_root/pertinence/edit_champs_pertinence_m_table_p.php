<?php


echo $_POST['ref_p'];
if ($_POST['ref_p']=="p"){

$sql_tbl_offre_p =  "SELECT * FROM offre " ;
//echo $sql_tbl_offre;
$tbl_offre_p = mysql_query($sql_tbl_offre_p);
  while($offre = mysql_fetch_assoc($tbl_offre_p))
   {
include('edit_champs_pertinence_m_table_p_c.php'); 
   }

}
if ($_POST['ref_p']=="m"){

$sql_tbl_offre_m =  "SELECT * FROM offre " ;
//echo $sql_tbl_offre;
$tbl_offre_m = mysql_query($sql_tbl_offre_m);
  while($offre = mysql_fetch_assoc($tbl_offre_m))
   {
include('edit_champs_pertinence_m_table_m_c.php'); 
   }

}
/*

*/

?>

