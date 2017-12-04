

<?php



/********************************erreur authentif initial pos/////////////*/

  if(isset($_POST['non_confirm'])){ $_SESSION['compte_non_confirm'] = '0';}

 

		if(isset($_SESSION['compte_non_confirm']) and $_SESSION['compte_non_confirm'] == '1' ) { 



                    $id_s = (isset($_SESSION['id_compte_non_confirm'])) ? $_SESSION['id_compte_non_confirm'] : '' ;

					$sql_10_c="select * from candidats where candidats_id = '$id_s'   limit 0,1 ";

                    if($select10_c  = mysql_query($sql_10_c)){          

                            $reponse10_c = mysql_fetch_array($select10_c);  

							$mp       = $reponse10_c['mdp'] ; 

                            } 

		?> 

			<div id="repertoire"> 

                <div id="fils"> 

                  <div id="fade"></div> 

                  <div class="popup_block"  style="width: 420px; z-index: 999; top: 30%; left: 32%;" > 

               <form name= "f_c" action="<?php echo $site; ?>" method="post" id="formpopup"> 

						<input  type="hidden" name="non_confirm" value="non_confirm"   />    

			   <div class="titleBar"> 

                      <div class="title">Activation de votre compte</div> 

							<input class="close" style="cursor: pointer;height: 16px;width: 18px;" name="fermer" value="fermer" type="submit" /> 

					  </div> 

                    <div id="content" class="content"> 

                        <table border="0" cellspacing="0" cellpadding="2"> 

                          

						  <tr><td>  <p><b style="color:#008C00">Votre compte a été créé.<br>

																Pour l'activer, suivez le lien d'activation envoyé à votre adresse e-mail.

																</b></p>

						  <p><b ><?php echo "Si vous voulez envoyer un autre email de confirmation <a href=\"./confirmation/?p=".$mp."&i=".$id_s."&r=r\" style=\"color:#008C00\" >cliquer içi.</a>"; ?></b></p> </td> </tr> 

						  

						  

                        </table> 

                    </div> 

				</form> 

                  </div> 

                </div> 

            </div> 

		<?php 

		  } 

		?>



<!-- début moteur -->				

<div id="moteur">

  <a id="ancremoteur" name="ancremoteur"></a> 					

  <form action="<?php echo $urloffre ?>/" method="post" id="form11">

    <fieldset class="fieldset_sansborder">

    <div onkeypress="javascript:return WebForm_FireDefaultButton(event, 'ctl00_moteurRapideOffre_BT_recherche')">

    <table width="100%">

    <tbody>

    <tr>

    <td><a href="<?php echo $urloffre ?>/">

    <?php

    $today = date("Y-m-d");

    $query = mysql_query("SELECT COUNT(*) AS nb_offre From offre where status = 'En cours' AND offre.date_expiration >= '$today' ");

    $nombre = mysql_fetch_array($query);

    echo '<b>' . $nombre['nb_offre'] . '</b>';

    ?></a> offres en ligne 

    </td>

    </tr>

    <tr>

    <td><input name="motcle" type="text"  style="width:260px;" value="Tapez vos mots cl&eacute;s" onfocus="this.value=''" maxlength="80"  />

    <input name="rch_simple" type="hidden" value="ok" />

    </td>

    <td ><span style="width:144px;height:30px">

    <select style="width:155px;" name="fonction">

    <option value="">Fonction</option>

    <?php

    $sql = mysql_query("select * from prm_fonctions");

    while ($result = mysql_fetch_array($sql)) {

    $val = $result['id_fonc'];

    $txt = $result['fonction'];

    echo '<option value="' . $val . '">' . $txt . '</option>';

    }

    ?>

    </select>

    </span>

    </td>

    <td>&#32;&#32;</td>

    <td><span style="width:58px;height:31px">

    <select style="width:155px;" name="localisation">

    <option value="">Ville</option>

    <?php

    $req_lieu = mysql_query("SELECT * FROM prm_villes");

    while ($lieu = mysql_fetch_array($req_lieu)) {

    $lieu_id = $lieu['id_vill'];

    $lieu_desc = $lieu['ville'];

    echo "<option value=\"$lieu_id\">$lieu_desc</option>";

       }    ?>

    </select>

    </span></td>

    <td>&#32;&#32;</td>

    <td>&#32;&#32;</td>

    <td style="height:32px">&nbsp;</td>

    </tr>

    <tr>

    <td colspan="3">

    <table width="100%">

      <tbody><tr>

      <td >

      

      <a id="ctl00_moteurRapideOffre_lnkVoirDerniereOffre" href="<?php echo $urloffre ?>/">

      <i class="fa fa-list-ul fa-lg" ></i> Voir toutes les offres</a>

      </td>

      <td >

      <a id="ctl00_moteurRapideOffre_lnkVoirDerniereOffre" href="<?php echo $urloffre ?>/rechercher/">

      <i class="fa fa-search-plus fa-lg" ></i> Recherche avanc&eacute;e</a>

      </td>

      <td  align="left">

      <i class="fa fa-search fa-lg" ></i>

      <input name="ctl00$moteurRapideOffre$BT_recherche" value="Rechercher" style="  background-image: none;" 

      id="ctl00_moteurRapideOffre_BT_recherche" class="btnrecherche" type="submit">

      </td>

      </tr>

      </tbody>

    </table>

      </td>

      </tr>

      </tbody>

    </table>

    </div>

    </fieldset>          

  </form>            

</div>

<!--  fin moteur -->  				

<div>								

</div>

<!--  debut offre emploi -->  								

<div>

  <table cellpadding="0" cellspacing="0" style="border-collapse:collapse;" >

    <tr>

      <td>

        <div id='blockblack2' >

          <div id='bh_titre' >

          <h2><a class="section-link" href='<?php echo $urloffre ?>/'>Les dernières offres d'emploi </a></h2>

          </div>

          <div id="annonces" style="height:100%; margin-left:0px">

           <?php require_once dirname(__FILE__) . "/annonce.php";

     echo '<br/><div style=" background-color: white;width: 645px;height: 20px; "> <a href="' . $urloffre . '/"><b>

     <i class="fa fa-th-list fa-lg" ></i> TOUTES LES OFFRES</b></a></div>' ;



            ?>



          </div>

        </div>

      </td>

    </tr>

  </table>

</div>

<!--  fin offre emploi -->    