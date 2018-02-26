<div class='texte' id="account-wrap">



        <h1>MON&nbsp;COMPTE</h1>



        <?php                         

        $query = mysql_query("SELECT * from candidats 

          where email = '" . $_SESSION['abb_login_candidat'] . "'");

        $reponse = mysql_fetch_array($query);                            

        if (isset($_POST['do'])) {                                

        if ($_POST['do'] == "delete") {                                    

        $id_alert = isset($_POST['id_alert']) ? $_POST['id_alert'] : "";        

        mysql_query("DELETE FROM alert WHERE id_alert = '$id_alert' And candidats_id = '" . $reponse['candidats_id'] . "'");                                } 

        elseif ($_POST['do'] == "activate") {                                   

        $id_alert = isset($_POST['id_alert']) ? $_POST['id_alert'] : "";                                    

        $activation = isset($_POST['activation']) ? $_POST['activation'] : "false";                                    

        mysql_query("UPDATE alert SET activate = '$activation' WHERE id_alert = '$id_alert' And candidats_id = '" . $reponse['candidats_id'] . "'");                                }                            

        } 

        ?>



        <table border="0" width="100%">

          <?php include('./moncompte_m_information.php'); ?>

        </table>

        <br/>

        <?php /**/ ?>			

<?php  



	if($_SESSION['r_prm_moncpt_offre']==0){

		 

		

?>

        <table border="0" width="100%">

          <?php include('./moncompte_m_offres.php'); ?>

        </table>

        <?php //* ?>

        <br/>	

	

<?php  

 

		}

		

?>

		

<?php  



	if($_SESSION['r_prm_moncpt_cnddtr']==0){

		 

		

?>

       <table border="0" width="100%" >

          <?php include('./moncompte_m_candidature.php'); ?>

        </table>



         <br/>

	

<?php  

 

		}

		

?>

 

        <table border="0" width="100%" >

        <?php include('./moncompte_m_candidature_spontanee.php'); ?>

        </table>

        <?php    if(isset($_POST['remove_cand_stage']))

        {

        $idcand= $_SESSION['abb_id_candidat'];  

        mysql_query(" delete from candidature_stage where candidats_id='$idcand' ");

        }

        ?>

        <br/>

        <table border="0" width="100%" >

        <?php include('./moncompte_m_candidature_stage.php'); ?>

        </table>

        <br/>

        <table border="0" width="100%">

        <?php include('./moncompte_m_alerts.php'); ?>

        </table>
        <?php if(\App\Route::getRoute() == 'candidat/compte') : ?>
        <br>
        <?php endif; ?>
</div>
<button id="print-account" style="padding: 6px 12px;"><i class="fa fa-print"></i>&nbsp;Imprimer cette page</button>