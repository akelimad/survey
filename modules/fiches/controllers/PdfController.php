<?php
/**
 * PdfController
 * 
 * @author mchanchaf
 *
 * @package app.fiches.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Fiches\Controllers;

use Mpdf\Mpdf;
use App\Models\Candidat;
use App\Controllers\Controller;
use Modules\Fiches\Models\Fiche;

class PdfController extends Controller
{


  /**
   * Render fiche PDF
   * 
   * @author M'hamed Chanchaf
   */
  public function actionFicheCandidature($id)
  {
    $db = getDB();

    $fc = $db->prepare("SELECT * FROM fiche_candidature WHERE id_fiche_candidature=?", [$id], true);
    if( !isset($fc->id_fiche) ) die(trans("Impossible de trouver cette fiche."));

    $result = $db->prepare("
      SELECT concat(c.nom, ' ', c.prenom) AS displayName, o.Name as offreName
      FROM candidats c
      JOIN candidature AS ca ON ca.candidats_id=c.candidats_id 
      JOIN offre AS o ON o.id_offre=ca.id_offre
      WHERE ca.id_candidature=?
    ", [$fc->id_candidature], true);

    $fiche = $db->findOne('fiches', 'id_fiche', $fc->id_fiche);
    $evaluator = $db->findOne('root_roles', 'id_role', $fc->id_evaluator);

    $evaluators = $db->prepare("
      SELECT r.nom
      FROM root_roles r
      JOIN fiche_candidature AS fc ON fc.id_evaluator=r.id_role
      WHERE fc.id_candidature=? AND fc.id_fiche=?
    ", [$fc->id_candidature, $fc->id_fiche]);
    
    ob_start();
    get_view('admin/pdf/fiche_candidature', [
      'fc' => $fc,
      'result' => $result,
      'fiche' => $fiche,
      'evaluator' => $evaluator,
      'evaluators' => $evaluators,
      'name' => Fiche::getTypeName($fiche->fiche_type) .'&nbsp;('.$fiche->name.')'
    ], __FILE__);
    $html = ob_get_clean();
    
    return $this->getPDF($html);
  }


  private function getPDF($html)
  {
    try
    {
      $filename = 'fiche_'. date('d_m_Y_His') .'.pdf';
      $mpdf = new Mpdf();
      $mpdf->SetDisplayMode('fullpage');
      $mpdf->setDefaultFont("Arial");
      $mpdf->WriteHTML($html);
      $mpdf->Output($filename, 'D');
    } catch(\Exception $e) {}
  }





} // END Class