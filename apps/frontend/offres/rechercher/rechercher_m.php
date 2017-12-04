<div class='texte' style="padding-top:5px">



      <h1>RECHERCHER UNE OFFRE D'EMPLOI</h1>



      <h3>Consultez les offres d´emploi et utilisez les filtres pour affiner votre recherche et postulez aux annonces qui vous intéressent</h3>



      <table width="100%" border="0" cellspacing="0">



      <form action="<?php echo $urloffre; ?>/" method="post" name="search">



      <tr>



          <td>



            <div class="subscription" style="margin: 10px 0pt;">



              <h1>Mots cl&eacute;s </h1>



            </div>    </td>



    </tr>



        <tr>



          <td>



          <p>Pour une recherche par mot clé saisissez en dessous vos mots clés (ex: Informatique, infographiste,...)</p>



          <input type="text" name="motcle"  style="width:300px" value="<?php 



          if(isset($_SESSION['motcle'])) 



          { 



            echo $_SESSION['motcle']; 



            unset($_SESSION['motcle']);



          }



          else 



            echo 'Tapez vos mots clés'; 



          ?>" onfocus="this.value=''"/>



          <input name="rch_multiple" type="hidden" value="ok" />



          </td>



    </tr>



        <tr>



          <td><div class="subscription" style="margin: 10px 0pt;">



            <h1>Fonction </h1>



            </div></td>



    </tr>



        <tr>



          <td>



          <p>Sélectionnez une ou plusieurs fonctions </p>



          <select name="fonction[]" multiple="multiple" size="6" style="width: 300px; vertical-align: middle;">



            <option value=""></option>



  <?php  



  $req_sec = mysql_query( "select * from prm_fonctions");



                while ( $data = mysql_fetch_array( $req_sec ) ) {



                    $Sector_id = $data['id_fonc'];



                    $Sector = $data['fonction'];



                    if(isset($_SESSION['fonction']))



                    {



                        $sectarray = $_SESSION['fonction'];



                        $find = false;



                        for ($i=0; $i<count($sectarray); $i++)



                        {



                            if($Sector_id == $sectarray[$i])



                                $find = true;



                        }



                        if($find)



                            $selected = 'selected';



                        else



                            $selected = '';



                    }



                    else                    



                        $selected = '';



                    echo "<option value=\"$Sector_id\" ".$selected.">$Sector</option>";



                }



                if(isset($_SESSION['fonction']))



                    unset($_SESSION['fonction']);



?>



            </select>          </td>



    </tr>



        <tr>



          <td>



            <div class="subscription" style="margin: 10px 0pt;">



              <h1>Lieu de travail </h1>



            </div>    </td>



    </tr>



        <tr>



          <td>



          <p>Sélectionnez une ou plusieurs ville</p>



          <select name="localisation[]" multiple="multiple" size="6" style="width: 300px; vertical-align: middle;" >



          <option value=""></option>



<?php



$req_lieu = mysql_query( "SELECT * FROM prm_villes");



                while ( $lieu = mysql_fetch_array( $req_lieu ) ) {



                    $lieu_id = $lieu['id_vill'];



                    $lieu_desc = $lieu['ville'];



                    if(isset($_SESSION['localisation']))



                    {



                        $localarray = $_SESSION['localisation'];



                        $find = false;



                        for ($i=0; $i<count($localarray); $i++)



                        {



                            if($lieu_id == $localarray[$i])



                                $find = true;



                        }



                        if($find)



                            $selected = 'selected';



                        else



                            $selected = '';



                    }



                    else                    



                        $selected = '';



                    echo "<option value=\"$lieu_id\" ".$selected.">$lieu_desc</option>";



                }



                if(isset($_SESSION['localisation']))



                    unset($_SESSION['localisation']);



?>



          </select></td>



    </tr>



        <tr>



          <td>



            <div class="subscription" style="margin: 10px 0pt;">



              <h1>Niveau d'exp&eacute;rience  </h1>



            </div>    </td>



    </tr>



        <tr>



          <td>



          <p>Sélectionnez un ou plusieurs niveau d'expérience </p>



          <select name="exp[]" multiple="multiple" size="8" style="width: 300px; vertical-align: middle;" >



          <option value=""></option>



          <?php



            $req_exp = mysql_query( "SELECT * FROM prm_experience");



                while ( $exp = mysql_fetch_array( $req_exp ) ) {



                    $exp_id = $exp['id_expe'];



                    $exp_desc = $exp['intitule'];



                    if(isset($_SESSION['exp']))



                    {



                        $exparray = $_SESSION['exp'];



                        $find = false;



                        for ($i=0; $i<count($exparray); $i++)



                        {



                            if($exp_id == $exparray[$i])



                                $find = true;



                        }



                        if($find)



                            $selected = 'selected';



                        else



                            $selected = '';



                    }



                    else                    



                        $selected = '';



                    echo "<option value=\"$exp_id\" ".$selected.">$exp_desc</option>";



                }



                if(isset($_SESSION['exp']))



                    unset($_SESSION['exp']);



        ?>



          </select></td>



    </tr>



        <tr>



          <td>



            <div class="subscription" style="margin: 10px 0pt;">



              <h1>Type de poste </h1>



            </div>    </td>



    </tr>



        <tr>



          <td>



          <p>Sélectionnez un ou plusieurs type de poste </p>          



            <?php



            $req_poste = mysql_query( "SELECT * FROM prm_type_poste");



                while ( $poste = mysql_fetch_array( $req_poste ) ) {



                    $poste_id = $poste['id_tpost'];



                    $poste_desc = $poste['designation'];



                    if(isset($_SESSION['poste']))



                    {



                        $postarray = $_SESSION['poste'];



                        $find = false;



                        for ($i=0; $i<count($postarray); $i++)



                        {



                            if($poste_id == $postarray[$i])



                                $find = true;



                        }



                        if($find)



                            $selected = 'checked';



                        else



                            $selected = '';



                    }



                    else                    



                        $selected = '';



                    echo " <input name='poste[]' type='checkbox' value='$poste_id' ".$selected." /> $poste_desc";



                }



                if(isset($_SESSION['poste']))



                    unset($_SESSION['poste']);



                



        ?>



          </select></td>



    </tr>



        <tr>



          <td><div class="ligneBleu"></div><br/>



      <a href="index.php" class="espace_candidat" style="color:#FFFFFF" onclick="document.search.submit();return false;">RECHERCHER</a></td>



    </tr>



    </form>



  </table>





    </div>