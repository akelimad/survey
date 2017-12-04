<?php
/**
 * Méthode qui gère la pagination
 * @author Snoupix.com tutoriaux, actualités et encylopédie sur la programmation et le design Web...
 * Ce code est sous licence Creative Commons: Enjoy!
 */
   class Pagination{
   		/**
   		 * Fonction qui retourne une div de pagination en fonction de plusieurs paramètres
   		 * @return $html une chaine contenant une div.
   		 * @param object $chemin
   		 * @param object $nomget
   		 * @param object $total
   		 * @param object $courante[optional]
   		 * @param object $affichage[optional]
   		 */
		public static function affiche($chemin,$nomget,$total,$courante=1,$affichage=2){
			//variable contenant le code HTML a retourner
			$html = '';
			//Si il n'y a pas plus d'une page on renvoit rien...
			if($total<=1)
				return $html;
			
			$precedent = $courante-1;
			$suivant = $courante+1;
			$textePrecedent = '&#171; Pr&eacute;c&eacute;dente';
			$texteSuivant = ' Suivante &#187;';
			
			$html .= '<nav><ul class="pagination">';
			
			
			/*Boutons précédent*/
			if ($courante == 2) // si on est sur la page 2, Nous retournons sur la page initiale (permet d'éviter les doublons index.php et index.php?page=1)
            	//$html.= Pagination::lien($chemin,$textePrecedent);
				// taha precedente ne s'affiche pas sur la 2emme page
				$html.= Pagination::lien($chemin,$textePrecedent,$nomget,$precedent);
       		elseif($courante > 2) // si la page courante est supérieure à 2 le bouton précédent renvoit sur la page dont le numéro est immédiatement inférieur
            	$html.= Pagination::lien($chemin,$textePrecedent,$nomget,$precedent);
        	else // sinon on désactive le bouton précédent
            	$html.= '<li class="disabled"><a class="active">'.$textePrecedent.'</a></li>';


				
			/*Affichage des numéros des pages*/
			
			
			if($total < 7 + $affichage*2){
				//affiche tous les numéros
				$html.= ($courante == 1) ? '<li class="active"><a class="active">1</a></li>' : Pagination::lien($chemin,'1',$nomget,1);

	            // On boucle toutes les pages restantes boucle for
	            for ($i = 2; $i <= $total; $i++){
	                if ($i == $courante) // La page courante est affichée différemment
	                    $html.= '<li class="active"><a class="active">'.$i.'</a></li>';
	                else
	                    $html.= Pagination::lien($chemin,$i,$nomget,$i);
	            }
			} elseif($total > 5 + ($affichage * 2)){
				/*Il y'en a trop donc il va falloir des "..." */
				if($courante < 1+($affichage * 2)){
					$html.= ($courante == 1) ? '<li class="active"><a class="active">1</a></li>' : Pagination::lien($chemin,'1',$nomget,1);

		             // On boucle toutes les pages restantes boucle for
		           for($i = 2; $i < 4 + ($affichage * 2); $i++){
		                if ($i == $courante)// La page courante est affichée différemment
		                    $html.= '<li class="active"><a class="active">'.$i.'</a></li>';
		                else
		                    $html.= Pagination::lien($chemin,$i,$nomget,$i);
					}
					  // les ... pour marquer la troncature
                	$html.= "";

	                // et enfin les deux dernières pages
	                $html.= Pagination::lien($chemin,$total-1,$nomget,$total-1);
	                $html.= Pagination::lien($chemin,$total,$nomget,$total);
				}elseif($total - ($affichage * 2) > $courante && $courante > ($affichage * 2)){
	                // on affiche les deux premières pages
	                $html.= Pagination::lien($chemin,'1',$nomget,1);
	                $html.= Pagination::lien($chemin,'2',$nomget,2);
	
	                // les ... pour marquer la troncature
	                $html.= "";
	
	                // puis sept pages : les trois précédent la page courante, la page courante, puis les trois lui succédant
	                for ($i= $courante - $affichage; $i<= $courante + $affichage; $i++){
	                    if ($i== $courante)
	                        $html.= '<li class="active"><a class="active">'.$i.'</a></li>';
	                    else
	                        $html.= Pagination::lien($chemin,$i,$nomget,$i);
	                }
	
	                // les ... pour marquer la troncature
	                $html.= "";

                	// et enfin les deux dernière spages
                	$html.= Pagination::lien($chemin,$total-1,$nomget,$total-1);
                	$html.= Pagination::lien($chemin,$total,$nomget,$total);
            	}
				 else{
	                // on affiche les deux premières pages
	                $html.= Pagination::lien($chemin,'1',$nomget,1);
	                $html.= Pagination::lien($chemin,'2',$nomget,2);
	
	                // les ... pour marquer la troncature
	                $html.= "";
	
	                // et enfin les neuf dernières pages
	                for ($i = $total - (2 + ($affichage * 2)); $i <= $total; $i++){
	                    if ($i == $courante)
	                        $html.= '<li class="active"><a class="active">'.ceil($i).'</a></li>';
	                    else
	                        $html.= Pagination::lien($chemin,$i,$nomget,$i);
	                }
 	           }
			}
            
			/*Bouton suivant*/
			if ($courante < $total)
            	$html.= Pagination::lien($chemin,$texteSuivant,$nomget,$suivant);
        	else
			    $html.= '<li class="disabled"><a class="active">'.$texteSuivant.'</a></li>';


			
			$html .= '</ul></nav>';
			
			echo $html;
   		}
		
		/**
		 * Méthode qui renvoit un lien en fonction de plusieurs paramètres
		 * @return $lien un lien 
		 * @param object $chemin notre fichier
		 * @param object $texte texte du lien
		 * @param object $parametre[optional] parametre GET
		 * @param object $valeur[optional] valeur du parametre GET
		 */
		public static function lien($chemin,$texte,$parametre='',$valeur=''){
			$lien = '<li ><a class="active" href="'.$chemin;
			
			if(!empty($parametre)){
				$lien .= '&'.$parametre.'='.ceil($valeur);
			if(is_numeric($texte) ) 
			$lien .= '">'.ceil($texte).'</a>';
			else $lien .= '">'.$texte.'</a></li>';
			}
			return $lien;
		}
		
		
   }
?>
