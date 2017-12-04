<div class='texte' >



        <br/><h1>LISTE DES OFFRES</h1>

        <div class="subscription" style="margin: 10px 0pt; width:99.9%">

          <h1>Liste des offres </h1>

        </div>



        

<?php

$ss = 0;

if (isset($_GET['a'])) $_SESSION['rad1']='';

if (isset($_POST['radio'])) $_SESSION['rad1']=$_POST['radio'];

    $ck0="checked";     $ck1="";            $ck2="";            $ck3="";            $ck4="";

if (isset($_SESSION['rad1'])) {

    if ($_SESSION['rad1'] == 'off_tous') {

            $ss = $_SESSION['tous'];

    $ck0="checked";     $ck1="";            $ck2="";            $ck3="";            $ck4="";            }

    if ($_SESSION['rad1'] == 'off_cours') {

        $ss = $_SESSION['encours'];

    $ck0="";            $ck1="checked";     $ck2="";            $ck3="";            $ck4="";            }

    if ($_SESSION['rad1'] == 'off_archiv') {

        $ss = $_SESSION['archive'];

    $ck0="";            $ck1="";            $ck2="checked";     $ck3="";            $ck4="";            }

    if ($_SESSION['rad1'] == 'off_stages') {

    $ck0="";            $ck1="";            $ck2="";            $ck3="checked";     $ck4="";            }

    if ($_SESSION['rad1'] == 'off_echeance') {

        $ss = $_SESSION['accept1'];

    $ck0="";            $ck1="";            $ck2="";            $ck3="";            $ck4="checked";     }

}

if (isset($_GET['r'])) {

    if ($_GET['r'] == 'c') {

    $ck1="checked";     $ck2="";        $ck3="";        $ck4="";        }

    if ($_GET['r'] == 'a') {

    $ck1="";        $ck2="checked";     $ck3="";        $ck4="";        }

    if ($_GET['r'] == 's') {

    $ck1="";        $ck2="";        $ck3="checked";     $ck4="";        }

    if ($_GET['r'] == 'e') {

    $ck1="";        $ck2="";        $ck3="";        $ck4="checked";     }

}



?>  

<form enctype="multipart/form-data" action="./" method="post">        

<table>

<tr>

<td>

<input name="radio" type="radio" value="off_tous" <?php echo $ck0; ?> onchange="submit(this.form)"/>Tous:&nbsp;(<?php 

                                     $select_encours = mysql_query("select * from offre  ".$q_ref_fili." ");

                                      

                                     $tous = mysql_num_rows($select_encours);

                                     echo $tous;

                                     $_SESSION['tous'] = $tous;

                                     ?>)&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>

<td>

<input name="radio" type="radio" value="off_cours" <?php echo $ck1; ?> onchange="submit(this.form)"/>En cours:&nbsp;(<?php

                                     $select_encours = mysql_query("select * from offre where  (status = 'En cours')  ".$q_ref_fili_and."  ");

                                     $encours = mysql_num_rows($select_encours);

                                     echo $encours;

                                     $_SESSION['encours'] = $encours;

                                     ?>)&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>

<td>

<input name="radio" type="radio" value="off_archiv"  <?php echo $ck2; ?> onchange="submit(this.form)"/>Archivées:&nbsp;(<?php

                                     $select_archive = mysql_query("select * from offre where  (status = 'Archivée')   ".$q_ref_fili_and."  ");

                                     $archive = mysql_num_rows($select_archive);

                                     echo $archive;

                                    $_SESSION['archive'] = $archive;

                                     ?>)&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>

 

<td>

<input name="radio" type="radio" value="off_echeance" <?php echo $ck4; ?> onchange="submit(this.form)"/>Arrivant à échéance dans moins de 7 jours:&nbsp;(<?php

                                    $select_accept1 = mysql_query("select * from offre where (DATEDIFF(date_expiration,CURDATE())>0 And DATEDIFF(date_expiration,CURDATE())<7) ".$q_ref_fili_and."  ");

                                    $accept1 = mysql_num_rows($select_accept1);

                                    echo $accept1;

                                    $_SESSION['accept1'] = $accept1;

                                    ?>)</td>  

</tr>

</table>

</form>

<?php include ("./offres_m_table.php"); ?>

<div class="ligneBleu"></div>



    </div>

