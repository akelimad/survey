<?php
/**
 * CandidatController
 *
 * @author mchanchaf
 *
 * @package modules.candidatures.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Candidatures\Controllers;

use App\Models\Resume;
use App\Models\MotivationLetter;

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
    $cv = Resume::getByID($id_cv);
    if (!isset($cv->lien_cv) || empty($cv->lien_cv)) {
      die(tarns("Impossible de trouver ce CV."));
    }
    $cvPath = get_resume_base($cv->lien_cv, [
      'candidat_id' => $cv->candidats_id
    ]);

    // Process download
    if(file_exists($cvPath)) {
      header('Content-Description: File Transfer');
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename="'.basename($cvPath).'"');
      header('Expires: 0');
      header('Cache-Control: must-revalidate');
      header('Pragma: public');
      header('Content-Length: ' . filesize($cvPath));
      flush(); // Flush system output buffer
      readfile($cvPath);
      exit;
    } else {
      die(trans("Impossible de trouver ce CV."));
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
    $lettre = MotivationLetter::getByID($id_lettre);
    if (!isset($lettre->lettre) || empty($lettre->lettre)) {
      die(trans("Impossible de trouver ce CV."));
    }
    $lettrePath = get_motivation_letter_base($lettre->lettre, [
      'candidat_id' => $lettre->candidats_id
    ]);

    // Process download
    if(file_exists($lettrePath)) {
      header('Content-Description: File Transfer');
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename="'.basename($lettrePath).'"');
      header('Expires: 0');
      header('Cache-Control: must-revalidate');
      header('Pragma: public');
      header('Content-Length: ' . filesize($lettrePath));
      flush(); // Flush system output buffer
      readfile($lettrePath);
      exit;
    } else {
      die(trans("Impossible de trouver cette lettre de motivation."));
    }
  }




  
} // END Class