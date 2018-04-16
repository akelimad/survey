<?php
/**
 * CandidatController
 *
 * @author mchanchaf
 *
 * @package modules.candidat.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Candidat\Controllers;

class CandidatController
{


  /**
   * unsubscribe
   *
   * @author mchanchaf
   */
  public function unsubscribe($data) 
  {
    $md5 = $data['params'][1];

    $this->data['layout'] = 'front';
    $this->data['breadcrumbs'] = [
      trans("Accueil"), 
      trans("Se désabonner")
    ];

    getDB()->update('candidats', 'md5(email)', $md5, ['nl_emploi' => 0]);

    return get_page('front/candidat/unsubscribe', $this->data, __FILE__);
  }
  
  

  
} // END Class