<?php
/**
 * StatsController
 *
 * @author mchanchaf
 *
 * @package app.controllers.admin
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Controllers\Admin;

use App\Controllers\Controller;

class StatsController extends Controller
{

  /**
   * Get chart data
   * 
   * @return string $data
   *
   * @author Mhamed Chanchaf
   */
  public function getChartData($col1, $col2, $results)
  {
    $data = array(
      'cols' => array(
        array('type' => 'string', 'label' => $col1),
        array('type' => 'number', 'label' => $col2)
      ),
      'rows' => array()
    );

    if( !empty($results) ) : foreach ($results as $key => $r) :
      $data['rows'][] = array('c' => array(
        array('v' => $r->name),
        array('v' => intval($r->nbr))
      ));
    endforeach; endif;

    return json_encode($data);
  }


  /**
   * Get candidats per sectors
   * 
   * @return string $data
   *
   * @author Mhamed Chanchaf
   */
  public function sectorChart()
  {
    $results = getDB()->prepare("
      SELECT COUNT(*) AS nbr, s.FR AS name
      FROM candidats c
      JOIN prm_sectors s ON s.id_sect=c.id_sect
      WHERE c.mdp <> ''
      GROUP BY s.id_sect 
      ORDER BY nbr DESC
    ");

    return $this->getChartData(trans("Secteur"), trans("Nombre de Candidats"), $results);
  }


  /**
   * Get candidats per residence country
   * 
   * @return string $data
   *
   * @author Mhamed Chanchaf
   */
  public function residenceCountryChart()
  {
    $results = getDB()->prepare("
      SELECT p.pays AS name, COUNT(*) AS nbr 
      FROM candidats c
      JOIN prm_pays p ON p.id_pays=c.id_pays
      WHERE c.mdp <> ''
      GROUP BY p.pays 
      ORDER BY nbr DESC
    ");

    return $this->getChartData(trans("Pays"), trans("Nombre de Candidats"), $results);
  }


  public function situationChart()
  {
    $results = getDB()->prepare("
      SELECT s.situation AS name, COUNT(*) AS nbr 
      FROM candidats c
      JOIN prm_situation s ON s.id_situ=c.id_situ
      WHERE c.mdp <> ''
      GROUP BY s.id_situ 
      ORDER BY nbr DESC
    ");

    return $this->getChartData(trans("Situation"), trans("Nombre de Candidats"), $results);
  }


  public function experienceChart()
  {
    $results = getDB()->prepare("
      SELECT e.intitule AS name, COUNT(*) AS nbr 
      FROM candidats c
      JOIN prm_experience e ON e.id_expe=c.id_expe
      WHERE c.mdp <> ''
      GROUP BY e.id_expe 
      ORDER BY nbr DESC
    ");

    return $this->getChartData(trans("Expérience"), trans("Nombre de Candidats"), $results);
  }


  public function offersStatusChart()
  {
    $results = [];
    $status = getDB()->prepare("SELECT IF(date_expiration < CURDATE() AND status = 'En cours', 'Expiré', status) AS status FROM offre");
    if (!empty($status)) : foreach ($status as $key => $value) :
      $nbr = (isset($results[$value->status])) ? $results[$value->status]->nbr : 0;
      $results[$value->status] = (object) [
        'name' => $value->status,
        'nbr' => $nbr + 1
      ];
    endforeach; endif;
    
    return $this->getChartData(trans("Statut"), trans("Nombre des offres"), $results);
  }


  public function candidaturesStatusChart()
  {
    $results = getDB()->prepare("
      SELECT sc.statut AS name, COUNT(*) AS nbr 
      FROM candidature c
      JOIN prm_statut_candidature sc ON sc.id_prm_statut_c=c.status
      GROUP BY c.status 
      ORDER BY nbr DESC
    ");

    return $this->getChartData(trans("Statut"), trans("Nombre de Candidatures"), $results);
  }


} // END Class