<div class='texte' style="width: 700px;">



                        <h1>RESULTAT DE LA RECHERCHE</h1>



                        <?php

						  

							$today = date("Y-m-d"); 

							

							

                        if ((isset($_POST['keywords']) && !empty($_POST['keywords'])) || isset($_SESSION['recherche'])) {



                            if (isset($_POST['keywords']) && !empty($_POST['keywords'])) {



                                $requete = '';



                                $motcle = mysql_real_escape_string(htmlspecialchars($_POST['keywords']));



                                $mots = explode(" ", $motcle); //séparation des mots



                                $nombre_mots = count($mots); //compte le nombre de mots         



                                for ($i = 0; $i < $nombre_mots; $i++) {



                                    $requete .= ' OR Name LIKE "%' . $mots[$i] . '%" OR Details LIKE "%' . $mots[$i] . '%" OR Profil LIKE "%' . $mots[$i] . '%"';

                                }



                                $requete = ltrim($requete, ' OR');



                                $keyword = $motcle;



                                $_SESSION['recherche'] = $requete;



                                $_SESSION['keyword'] = $keyword;

                            } else {



                                $requete = $_SESSION['recherche'];



                                $keyword = $_SESSION['keyword'];

                            }



                            // On met dans une variable le nombre d'offre qu'on veut par page



                            

                            

                            



                              $itemsParPage = 5;



                            // On récupère le nombre total des offres



                            if (isset($requete) && !empty($requete)) {



                                $req = mysql_query("select COUNT(*) AS nb_offres FROM offre where offre.status = 'En cours' AND offre.date_expiration >= '$today' AND ( " . $requete . " ) ");



                                $donnees = mysql_fetch_array($req);



                              

                                $nbItems = $donnees['nb_offres'];

                            }



                            // On calcule le nombre de pages à créer



                            

                            

                            $nbPages = ceil($nbItems/$itemsParPage);







                          

                             

                             if(!isset($_GET['idPage'])) 

            $pageCourante = 1;

        elseif(is_numeric($_GET['idPage']) && $_GET['idPage']<=$nbPages)

            $pageCourante = $_GET['idPage'];

        else

            $pageCourante = 1;  



        //Calcul de la clause LIMIT

                             $limitstart = $pageCourante*$itemsParPage-$itemsParPage;

 

                            //affichage de la liste des offres    

                            if (isset($requete) && !empty($requete))

                              

							 $sql_select = "select * from offre 

                    inner join prm_fonctions on prm_fonctions.id_fonc = offre.id_fonc

                    where offre.status = 'En cours' AND offre.date_expiration >= '$today' AND  ( " . $requete . " )  ORDER BY id_offre DESC LIMIT " . $limitstart . ", " . $itemsParPage;

                  $select = mysql_query($sql_select);

					

				//	echo $sql_select.'<br>++++++';

					

                            $compteur = mysql_num_rows($select);



                            if ($compteur) {



                                $total = $pageCourante * $itemsParPage;



                                $debut = $itemsParPage * ($pageCourante - 1) + 1;



                                $fin = $total < $nbItems ? $total : $nbItems;



                                echo '<p align="left" style="display:inline">Résultat ' . $debut . ' à ' . $fin . ' sur ' . $nbItems . ' pour <b>' . $keyword . '</b></p>';



                                echo '<ul><br/>';

?>



<table width="100%" >



        <?php

            

            $ii = 1;

            

            while ( $retour = mysql_fetch_array ( $select ) ) 



            {

                

                $detail = substr ( $retour ['Details'], 0, 280 );

                $profil = substr ( $retour ['Profil'], 0, 280 );

                ?>



<tr>

<td colspan="2"></td>

<td colspan="2">

<h3>



<b><a href="<?php echo ''. $urloffre . '/' . $retour['id_offre'] . '' ; ?>">

 <i class="fa fa-location-arrow fa-lg" style="color:<?php echo $color_bg;?>;"></i>

<?php echo $retour['Name'].''; ?></a>

<?php echo ' || '.date("d.m.Y",strtotime($retour['date_insertion'])); ?></b>

</h3>

<b>Profils recherchés</b>

<p align="justify" style="width: 100%;"><?php  echo strip_tags(stripslashes($profil))."..."; ?>

<a href="<?php echo $urloffre . '/'.$retour['id_offre'].''; ?>" >

voir l'offre</a></p>



<h4> <b>Réf. <?php echo $retour['reference']; ?></b> || 

<b>Date d’expiration: <?php echo date("d.m.Y",strtotime($retour['date_expiration'])); ?></b>

|| <b><?php echo $retour['fonction']; ?></b> </h4>

<div style="margin: 2px 0; background-color: #0B0B0B;"></div>

</td>

</tr>

<?php

    }            

  ?>

</tbody>

</table>



<?php

 /*                               while ($retour = mysql_fetch_array($select)) {



                                    $description = $retour['Details'];



                                    $apercu_description = substr($description, 0, 400);







                                    echo '<li style="text-align:justify"><a class="titre_offre" href="' . $urloffre . '/index.php?id=' . $retour['id_offre'] . '">' . $retour['Name'] . ' | '.date("d-m-Y",strtotime($retour['date_insertion'])) .'

                                    </a><br/>' . strip_tags($apercu_description) . '...<br/></li>';

                                }

*/

                                echo '<br/></ul><div class="ligneBleu"></div>';

?>

                              <div class="pagination" style="  float: left;">

                            

                              <?php

        //Système de pagination

            $lapage = '?'  ;

            require_once (dirname ( __FILE__ ) . $incurl2.'/class.pagination2.php');

            

            //Pagination::affiche ( $lapage, 'idPage', $nbPages, $pageCourante, 2 );

            Pagination::affiche ( $lapage, 'idPage', $nbPages, $pageCourante, 2 );

        /*

        $lapage = 'pages/' ;$urlvarinfo=$urlinfos.'/rechercher';

                                require_once(dirname(__FILE__) . $incurl2 . '/class.pagination.php');

            Pagination::affiche ( $lapage, 'idPage', $nbPages, $pageCourante, 2, $urlvarinfo); 

        */

                                ?>



        </div>

                  <?php          }



                            else{    $keyw  = isset($_POST['keywords'])? strip_tags($_POST['keywords']) : "";

                                echo' <h3>Aucun résultat ne correspond aux termes de recherche spécifiés (' . $keyw . ')</h3> <br/>Suggestions :



                <ul><li> Vérifiez l’orthographe des termes de recherche.</li>



                    <li> Essayez d\'autres mots.</li>



                    <li> Utilisez des mots plus généraux.</li></ul>';

                    }

                        }



                        else

                            echo'<p>Désolé, cette recherche n\'a produit aucun résultat.</p>



            <ul>



            <li>Veuillez faire une nouvelle recherche.</li>



            <li>Vous pouvez en tout temps utiliser nos outils pour raffiner votre recherche, ou chercher un poste selon votre profil d\'intérêt en emploi en vous inscrivant comme candidat.</li>



    </ul>';

                        ?>



                    </div>