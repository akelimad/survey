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

use App\Controllers\Controller;

class CandidatController extends Controller
{


  /**
   * unsubscribe
   *
   * @author mchanchaf
   */
  public function unsubscribe($data) 
  {
    $md5 = $data['params'][1];

    if (form_submited()) {
      $raison_other = (!empty($data['raison_other'])) ? $data['raison_other'] : null;
      getDB()->update('candidats', 'md5(email)', $md5, [
        'nl_emploi' => 0,
        'unsubscribe_reason' => $raison_other
      ]);

      return json_encode(['message' => trans("Votre email a bien été désabonné.")]);
    } else {
      $this->data['layout'] = 'front';
      $this->data['breadcrumbs'] = [
        trans("Accueil"), 
        trans("Se désabonner")
      ];

      $candidat = getDB()->prepare("SELECT nl_emploi FROM candidats WHERE md5(email)=?", [$md5], true);

      $this->data['is_subscribed'] = ($candidat->nl_emploi == 1);

      return get_page('front/candidat/unsubscribe', $this->data, __FILE__);
    }
  }
  
  

  
} // END Class