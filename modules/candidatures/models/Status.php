<?php
/**
 * Status
 *
 * @author mchanchaf
 *
 * @package modules.candidatures.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Candidatures\Models; 

class Status {

  const STATUS_PRESELECTIONNES_REF     = 'N1';
  const STATUS_NON_PRESELECTIONNES_REF = 'N2';

  const STATUS_CONVOQUES_ECRIT_REF     = 'N3';
  const STATUS_CONVOQUES_ORAL_REF      = 'N10';
  
  const STATUS_CONFIRMES_ECRIT_REF     = 'N4';
  const STATUS_CONFIRMES_ORAL_REF      = 'N11';
  
  const STATUS_PRESENTES_ECRIT_REF     = 'N6';
  const STATUS_ARCHIVED_REF            = 'N24';
  

  public static function getNameById($id) 
  {
    $result = getDB()->findOne('prm_statut_candidature', 'id_prm_statut_c', $id);
    return (isset($result->statut)) ? $result->statut : null;
  }

  public static function getIdByRef($reference)
  {
    $result = getDB()->prepare("SELECT id_prm_statut_c as id FROM prm_statut_candidature WHERE ref_statut=?", [$reference], true);
    return (isset($result->id)) ? $result->id : 0;
  }

} // End model