<?php

 // ///////////////////////////Ajout des variables get pour la conservation du filtrage lors de la pagination//////////

        

        $requete = '';

        

        if (isset ( $_POST ['rch_simple'] ) or isset ( $_GET ['rch_simple1'] )) // si recherche simple



        {

            

            $motcle = isset ( $_GET ['motcle1'] ) ? mysql_real_escape_string ( htmlspecialchars ( $_GET ['motcle1'] ) ) : "";

            

            if (! isset ( $_GET ['motcle1'] ) or (empty ( $_GET ['motcle1'] )))

                

                $motcle = isset ( $_POST ['motcle'] ) ? mysql_real_escape_string ( htmlspecialchars ( $_POST ['motcle'] ) ) : "";

            

            $secteur = isset ( $_GET ['secteur1'] ) ? $_GET ['secteur1'] : "";

            

            if (! isset ( $_GET ['secteur1'] ) or (empty ( $_GET ['secteur1'] )))

                

                $secteur = isset ( $_POST ['secteur'] ) ? $_POST ['secteur'] : "";

            

            $fonction = isset ( $_GET ['fonction1'] ) ? $_GET ['fonction1'] : "";

            

            if (! isset ( $_GET ['fonction1'] ) or (empty ( $_GET ['fonction1'] ))) 

            

                $fonction = isset ( $_POST ['fonction'] ) ? $_POST ['fonction'] : "";



                

            

            $localisation = isset ( $_GET ['localisation1'] ) ? $_GET ['localisation1'] : "";

            

            if (! isset ( $_GET ['localisation1'] ) or (empty ( $_GET ['localisation1'] )))

                

                $localisation = isset ( $_POST ['localisation'] ) ? $_POST ['localisation'] : "";

                 

            

            if ($motcle == 'Tapez vos mots clés')

                

                $motcle = '';

            

            else

                

                $requete = '';

            

            if (! empty ( $motcle )) 



            {

                

                $mots = explode ( " ", $motcle ); // séparation des mots

                

                $nombre_mots = count ( $mots ); // compte le nombre de mots

                

                for($i = 0; $i < $nombre_mots; $i ++) 



                {

                    

                    $requete .= ' OR Details LIKE \'%' . $mots [$i] . '%\' OR Profil LIKE \'%' . $mots [$i] . '%\' OR Name LIKE \'%' . $mots [$i] . '%\'  ';

                }

                

                $requete = ltrim ( $requete, ' OR' );

            }

            

            if (! empty ( $secteur )) 



            {

                

                if ($requete == '')

                    

                    $requete .= ' id_sect = ' . $secteur . '';

                

                else

                    

                    $requete .= ' And id_sect = ' . $secteur . '';

            }

            

            if (! empty ( $fonction )) 



            {

                

                if ($requete == '')

                    

                    $requete .= ' offre.id_fonc = ' . $fonction . '';

                

                else

                    

                    $requete .= ' And offre.id_fonc = ' . $fonction . '';

            }

            

            if (! empty ( $localisation )) 



            {

                

                if ($requete == '')

                    

                    $requete .= ' id_localisation = ' . $localisation . '';

                

                else

                    

                    $requete .= ' And id_localisation = ' . $localisation . '';

            }

        }

        

        if (isset ( $_POST ['rch_multiple'] ) || isset ( $_POST ['id_alert'] ) || isset ( $_GET ['motcle'] ) || isset ( $_GET ['rch_multiple1'] )) 



        {

            

            if (isset ( $_POST ['id_alert'] )) 



            {

                

                $id_alert = $_POST ['id_alert'];

                

                $select_alert = mysql_query ( "SELECT * from alert where id_alert = '$id_alert'" );

                

                $alerte = mysql_fetch_array ( $select_alert );

                

                $secteur = explode ( " - ", $alerte ['secteurs'] );

                

                // $fonction = explode ( " - ", $alerte ['fonctions'] );

                

                $localisation = explode ( " - ", $alerte ['localisations'] );

                

                $exp = explode ( " - ", $alerte ['experiences'] );

                

                $poste = explode ( " - ", $alerte ['postes'] );

                

                $motcle = str_replace ( ",", " ", $alerte ['motscles'] );

            } 



            else 



            {

                

                if (isset ( $_GET ['motcle'] ))

                    

                    $motcle = isset ( $_GET ['motcle'] ) ? mysql_real_escape_string ( htmlspecialchars ( $_GET ['motcle'] ) ) : "";

                

                else 



                {

                    

                    $motcle = isset ( $_GET ['motcle1'] ) ? mysql_real_escape_string ( htmlspecialchars ( $_GET ['motcle1'] ) ) : "";

                    

                    if (! isset ( $_GET ['motcle1'] ) or (empty ( $_GET ['motcle1'] )))

                        

                        $motcle = isset ( $_POST ['motcle'] ) ? mysql_real_escape_string ( htmlspecialchars ( $_POST ['motcle'] ) ) : "";

                }

                

                $secteur = isset ( $_GET ['secteur1'] ) ? $_GET ['secteur1'] : "";

                

                if (! isset ( $_GET ['secteur1'] ) or (empty ( $_GET ['secteur1'] )))

                    

                    $secteur = isset ( $_POST ['secteur'] ) ? $_POST ['secteur'] : "";

                

                $fonction = isset ( $_GET ['fonction1'] ) ? $_GET ['fonction1'] : "";

                

                if (! isset ( $_GET ['fonction1'] ) or (empty ( $_GET ['fonction1'] )))

                    

                    $fonction = isset ( $_POST ['fonction'] ) ? $_POST ['fonction'] : "";

                

                $localisation = isset ( $_GET ['localisation1'] ) ? $_GET ['localisation1'] : "";

                

                if (! isset ( $_GET ['localisation1'] ) or (empty ( $_GET ['localisation1'] )))

                    

                    $localisation = isset ( $_POST ['localisation'] ) ? $_POST ['localisation'] : "";

                

                $exp = isset ( $_GET ['exp1'] ) ? $_GET ['exp1'] : "";

                

                if (! isset ( $_GET ['exp1'] ) or (empty ( $_GET ['exp1'] )))

                    

                    $exp = isset ( $_POST ['exp'] ) ? $_POST ['exp'] : "";

                

                $poste = isset ( $_GET ['poste1'] ) ? $_GET ['poste1'] : "";

                

                if (! isset ( $_GET ['poste1'] ) or (empty ( $_GET ['poste1'] )))

                    

                    $poste = isset ( $_POST ['poste'] ) ? $_POST ['poste'] : "";

            }

            

            if ($motcle == 'Tapez vos mots clés')

                

                $motcle = '';

            

            $requete = '';

            

            if (! empty ( $motcle )) 



            {

                

                $premier = true;

                

                $requete .= '( ';

                

                $mots = explode ( " ", $motcle ); // séparation des mots

                

                $nombre_mots = count ( $mots ); // compte le nombre de mots

                

                for($i = 0; $i < $nombre_mots; $i ++) 



                {

                    if ($premier == true) 



                    {

                        

                        $requete .= ' Details LIKE \'%' . $mots [$i] . '%\' OR Profil LIKE \'%' . $mots [$i] . '%\' OR Name LIKE \'%' . $mots [$i] . '%\'  ';

                    } 



                    else 



                    {

                        

                        $requete .= ' OR Details LIKE \'%' . $mots [$i] . '%\' OR Profil LIKE \'%' . $mots [$i] . '%\' OR Name LIKE \'%' . $mots [$i] . '%\'  ';

                    }

                    

                    $premier = false;

                }

                

                $requete = ltrim ( $requete, ' OR' );

                

                $requete .= ' ) ';

            }

            

            if (! empty ( $secteur )) 



            {

                

                if (! empty ( $requete ))

                    

                    $requete .= ' And ';

                

                $requete .= '(';

                

                for($i = 0; $i < count ( $secteur ); $i ++) 



                {

                    

                    if (! empty ( $secteur [$i] ))

                        

                        $requete .= ' id_sect = ' . $secteur [$i] . ' OR ';

                }

                

                $requete = rtrim ( $requete, ' OR ' );

                

                $requete .= ')';

            }

            

            if (! empty ( $fonction )) 



            {

                

                if (! empty ( $requete ))

                    

                    $requete .= ' And ';

                

                $requete .= '(';

                

                for($i = 0; $i < count ( $fonction ); $i ++) 



                {

                    

                    if (! empty ( $fonction [$i] ))

                        

                        $requete .= ' offre.id_fonc = ' . $fonction [$i] . ' OR ';

                }

                

                $requete = rtrim ( $requete, ' OR ' );

                

                $requete .= ')';

            }

            

            if (! empty ( $localisation )) 



            {

                

                if (! empty ( $requete ))

                    

                    $requete .= ' And ';

                

                $requete .= '(';

                

                for($i = 0; $i < count ( $localisation ); $i ++) 



                {

                    

                    if ($localisation [$i] != 1 && ! empty ( $localisation [$i] ))

                        

                        $requete .= ' id_localisation = ' . $localisation [$i] . ' OR ';

                    

                    elseif ($localisation [$i] == 1) 



                    {

                        

                        $requete .= ' id_localisation >= 1 ';

                        

                        break;

                    }

                }

                

                $requete = rtrim ( $requete, ' OR ' );

                

                $requete .= ')';

            }

            

            if (! empty ( $exp )) 



            {

                

                if (! empty ( $requete ))

                    

                    $requete .= ' And ';

                

                $requete .= '(';

                

                for($i = 0; $i < count ( $exp ); $i ++) 



                {

                    

                    if (! empty ( $exp [$i] ))

                        

                        $requete .= ' id_expe = ' . $exp [$i] . ' OR ';

                }

                

                $requete = rtrim ( $requete, ' OR ' );

                

                $requete .= ')';

            }

            

            if (! empty ( $poste )) 



            {

                

                if (! empty ( $requete ))

                    

                    $requete .= ' And ';

                

                $requete .= '(';

                

                for($i = 0; $i < count ( $poste ); $i ++) 



                {

                    

                    if (! empty ( $poste [$i] ))

                        

                        $requete .= ' id_tpost = ' . $poste [$i] . ' OR ';

                }

                

                $requete = rtrim ( $requete, ' OR ' );

                

                $requete .= ')';

            }

        }

        

        if (isset ( $requete )) 



        {

            

            $effacer = array (

                    "And ()",

                    "()" 

            );

            

            $requete = str_replace ( $effacer, '', $requete );

            

            $requete = trim ( $requete );

            

            $requete = ltrim ( $requete, 'And' );

        }

        

        $req = (isset ( $requete ) && ! empty ( $requete )) ? mysql_query ( "select COUNT(*) AS nb_offres FROM offre where offre.date_expiration >= '$today' AND ( " . $requete . " ) And status = 'En cours'  " ) : mysql_query ( "select COUNT(*) AS nb_offres FROM offre where offre.date_expiration >= '$today'   " );

        

        $nbItems = mysql_fetch_array ( $req );

        

        $nbItems = $nbItems ['nb_offres'];

        

        $itemsParPage = 5;

        

        // Nombre de pages

        

        $nbPages = ceil ( $nbItems / $itemsParPage );

        

        // Numéro de Page courante

        

        if (! isset ( $_GET ['idPage'] ))

            

            $pageCourante = 1;

        

        elseif (is_numeric ( $_GET ['idPage'] ) && $_GET ['idPage'] <= $nbPages)

            

            $pageCourante = $_GET ['idPage'];

        

        else

            

            $pageCourante = 1;

            

            // Calcul de la clause LIMIT

        

        $limitstart = $pageCourante * $itemsParPage - $itemsParPage;

        

        $select = isset ( $requete ) && ! empty ( $requete ) ? mysql_query ( "select * from offre  

                  inner join prm_fonctions on prm_fonctions.id_fonc = offre.id_fonc

                  where ( " . $requete . " )    ORDER BY " . $order . "   

                  LIMIT " . $limitstart . ", " . $itemsParPage ) : mysql_query ( "select * from offre  

                  inner join prm_fonctions on prm_fonctions.id_fonc = offre.id_fonc



                  ORDER BY " . $order . "  LIMIT " . $limitstart . ", " . $itemsParPage );
                  // AND offre.date_expiration >= '$today'

        

        $compteur = mysql_num_rows ( $select );

        

        // echo $requete;

?>