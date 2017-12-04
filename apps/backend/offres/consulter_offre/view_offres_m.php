<div class='texte' >
<?php 
 if(isset($_GET['ref']) || isset($_GET['offre']) || isset($_POST['select']))
    {
if(isset($_GET['offre']) && !empty($_GET['offre'])      )
   $id_o = $_GET['offre'];
else
$id_o = $_GET['ref'];
  
include ("./view_offres_m_voir.php");
  }

     ?>
    </div>
