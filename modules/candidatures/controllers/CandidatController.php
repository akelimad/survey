<?php
/**
 * CandidatController
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
 *
 * @package modules.candidatures.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Candidatures\Controllers;

class CandidatController
{


  /**
   * Download candidat CV
   * 
   * @param int $id_cv
   * @author M'hamed Chanchaf
   */
  public function actionCv($id_cv)
  {
  	if( !isLogged('admin') ) redirect( site_url('backend/login') );
    $cv = \App\Models\Cv::getByID($id_cv);
    $cvPath = site_base('apps/upload/frontend/cv/'. $cv->lien_cv);
    if(file_exists($cvPath)) {
	    header("Content-Description: Téléchargement de CV"); 
	    header("Content-Type: application/octet-stream"); 
	    header("Content-Disposition: attachment; filename=". basename($cvPath));
	    readfile($cvPath);
	    exit;
    } else {
      die("Impossible de trouvez ce CV.");
    }
  }


  /**
   * Download candidat lettre
   * 
   * @param int $id_lettre
   * @author M'hamed Chanchaf
   */
  public function actionLettre($id_lettre)
  {
  	if( !isLogged('admin') ) redirect( site_url('backend/login') );
    $lettre = \App\Models\Lettre::getByID($id_lettre);
    $lettrePath = site_base('apps/upload/frontend/lmotivation/'. $lettre->lettre);
    if(file_exists($lettrePath)) {
	    header("Content-Description: Téléchargement de lettre de motivation"); 
	    header("Content-Type: application/octet-stream"); 
	    header("Content-Disposition: attachment; filename=". basename($lettrePath));
	    readfile($lettrePath);
	    exit;
    } else {
      die("Impossible de trouvez cette lettre de motivation.");
    }
  }




  
} // END Class