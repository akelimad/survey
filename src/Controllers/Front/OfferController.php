<?php
/**
 * OfferController
 *
 * @author mchanchaf
 *
 * @package app.controllers.front
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Controllers\Front;

use Mpdf\Mpdf;
use App\Controllers\Controller;
use App\Helpers\Pagination;
use App\Helpers\Table;
use App\Ajax;
use App\Route;
use App\Mail\Mailer;
use App\Models\Candidat;

class OfferController extends Controller
{

  private $andWhere = [
    's'   => ['o' => 'Name'],
    'f'   => ['o' => 'id_fonc'],
    'l'   => ['o' => 'id_localisation'],
    'e'   => ['o' => 'id_expe'],
    'nf'  => ['o' => 'id_nfor'],
    'tp'  => ['o' => 'id_tpost'],
    'sec' => ['o' => 'id_sect'],
    'm'   => ['o' => 'niveau_mobilite']
  ];

  public function index($data)
  {
    $this->data['layout'] = 'front';
    $this->data['breadcrumbs'] = [trans("Accueil"), trans("Offres d'emploi")];
    
    $perpage = 5;
    $currentPage = Table::getPage();
    $pagi = new Pagination($currentPage, $this->buildQuery(), [
      'url' => Table::getPaginationUrl(),
      'db_handle' => getDB()->pdo,
      'results_per_page' => $perpage,
      'show_links_first_last' => false
    ]);

    if( true === $pagi->success ){
      $this->data['offers'] = $pagi->resultset->fetchAll(\PDO::FETCH_OBJ);
      $this->data['pagi']   = $pagi;
      $this->data['perpage']   = $perpage;
      $this->data['currentPage']   = $currentPage;
    }

    return get_page('front/offer/index', $this->data);
  }

  public function offer($data)
  {
    $offer = getDB()->findOne('offre', 'id_offre', $data['id']);

    if(!isset($offer->id_offre)) {
      redirect(site_url());
    }

    // Mark this offer as seen
    // TODO - make it unique
    getDB()->update('offre', 'id_offre', $offer->id_offre, [
      'vue' => (intval($offer->vue) + 1)
    ]);

    $this->data['offer'] = $offer;
    $this->data['tpost'] = getDB()->findOne('prm_type_poste', 'id_tpost', $offer->id_tpost);
    $this->data['exp'] = getDB()->findOne('prm_experience', 'id_expe', $offer->id_expe);
    $this->data['nfor'] = getDB()->findOne('prm_niv_formation', 'id_nfor', $offer->id_nfor);
    $this->data['fonc'] = getDB()->findOne('prm_fonctions', 'id_fonc', $offer->id_fonc);

    // Get location
    $this->data['lieu'] = $this->getLocationById($offer->id_localisation);

    $this->data['layout'] = 'front';
    $this->data['breadcrumbs'] = [trans("Accueil"), trans("Offres d'emploi"), $offer->Name];

    return get_page('front/offer/single', $this->data);
  }


  public function printOffer($data)
  {
    $offer = getDB()->findOne('offre', 'id_offre', $data['id']);
    if(!isset($offer->id_offre)) {
      redirect(site_url());
    }
    $this->data['offer'] = $offer;
    $this->data['tpost'] = getDB()->findOne('prm_type_poste', 'id_tpost', $offer->id_tpost);
    $this->data['exp'] = getDB()->findOne('prm_experience', 'id_expe', $offer->id_expe);
    $this->data['nfor'] = getDB()->findOne('prm_niv_formation', 'id_nfor', $offer->id_nfor);
    $this->data['fonc'] = getDB()->findOne('prm_fonctions', 'id_fonc', $offer->id_fonc);

    // Get location
    $this->data['lieu'] = $this->getLocationById($offer->id_localisation);

    ob_start();
    echo get_view('front/offer/print', $this->data);
    $content = ob_get_clean();
    try
    {
      $filename = $offer->Name .'_'. date('d_m_Y_His') .'.pdf';
      $mpdf = new Mpdf();
      $mpdf->SetDisplayMode('fullpage');
      $mpdf->setDefaultFont("Arial");
      $mpdf->WriteHTML($content);
      $mpdf->Output($filename, 'I');
    } catch(\Exception $e) {}
  }

  public function sendToFriend($data)
  {
    if(!isLogged('candidat')) return $this->connect();

    if(isset($data['email']) && !empty($data['email'])) {
      $sender = getDB()->findOne('candidats', 'candidats_id', read_session('abb_id_candidat'));

      if(!isset($sender->candidats_id)) {
        return $this->jsonResponse('error', trans("Votre session est expiré, essaye de vous reconnecter."));
      }

      $offerLink = site_url('offre/'.$data['id_offre']);
      $subject  = trans("Je vous recommande cette offre d'emploi sur") ." ". site_url();
      $message  = "<b>". trans("Bonjour,") ."</b><br><p>". trans("Je crois que cette offre pourrait vous interessez.") ."</p>";
      $message .= "<p>". trans("Pour la consulter, cliquer sur le lien suivant:") ."<br><a href=".$offerLink.">".$offerLink."</a></p>";
      $message .= trans("Cordialement.");

      $from_name = Candidat::getDisplayName($sender, false);

      $send = Mailer::send($data['email'], $subject, $message, [
        'titre' => trans("Envoyer l'offre à un ami"),
        'coresp_nom' => Candidat::getDisplayName($sender, true),
        'from' => [
          'name'  => $from_name,
          'email' => $sender->email
        ],
        'replyto' => [
          'name'  => $from_name,
          'email' => $sender->email
        ],
        'isHTML' => true
      ]);

      return $this->jsonResponse($send['response'], $send['message']);
    }

    return Ajax::renderAjaxView(trans("Envoyer l'offre à un ami"), 'front/offer/send-to-friend', $data);
  }


  public function postuler($data)
  {
    // Check if candiat logged
    if(!isLogged('candidat')) {
      return json_encode(['status' => 'hide_form', 'title' => trans("Connectez-vous!"), 'content' => trans("Vous devez") .' <strong onclick="return chmAuth.loginModal()" style="cursor: pointer;">'. trans("vous connecter") .'</strong> '. trans("pour répondre à cette l'offre.")]);
    }

    $candidat_id = read_session('abb_id_candidat');
    $id_offre = (isset($data['id'])) ? $data['id'] : 0;   

    // Check if candidat has formation
    if(!Candidat::hasResume()) {
      return json_encode(['status' => 'hide_form', 'title' => trans("Profile incomplète!"), 'content' => trans("Il faut avoir renseigné au moins un CV pour pouvoir pour postuler à cet offre.")]);
    }

    // Check if candidat has formation
    if(!Candidat::hasFormation()) {
      return json_encode(['status' => 'hide_form', 'title' => trans("Profile incomplète!"), 'content' => trans("Il faut avoir renseigné au moins une formation pour pouvoir pour postuler à cet offre.")]);
    }

    // Check if candidat already applied to this offer
    $count = getDB()->prepare("SELECT COUNT(*) as nbr FROM candidature WHERE candidats_id=? AND id_offre=?", [$candidat_id, $id_offre], true);

    if(intval($count->nbr) > 0) {
      return json_encode(['status' => 'hide_form', 'title' => trans("Déja postulé!"), 'content' => trans("Vous avez déjà postulé à cette offre, vous ne pouvez postuler qu'une seule fois.")]);
    }

    // Check if offer available
    $data['offer'] = getDB()->prepare("SELECT o.id_offre, o.Name, o.date_insertion, o.id_localisation FROM offre o WHERE o.id_offre=? AND o.status=? AND DATE(o.date_expiration) >= CURDATE()", [$id_offre, 'En cours'], true);
    if(!isset($data['offer']->id_offre)) {
      return json_encode(['status' => 'hide_form', 'title' => trans("Offre introuvable!"), 'content' => trans("Impossible de postuler à cet offre pour le moment, soit qu'il est expiré ou supprimé.")]);
    }

    // Get location
    $data['lieu'] = $this->getLocationById($data['offer']->id_localisation);

    $data['candidat_cvs'] = getDB()->prepare("SELECT id_cv, titre_cv FROM cv WHERE candidats_id=? AND actif=1 ORDER BY id_cv DESC", [$candidat_id]);
    $data['candidat_lms'] = getDB()->prepare("SELECT id_lettre, titre FROM lettres_motivation WHERE candidats_id=? AND actif=1 ORDER BY id_lettre DESC", [$candidat_id]);

    $data['domaines_formation'] = getDB()->prepare("SELECT * FROM prm_domaines_formation");

    return Ajax::renderAjaxView(trans("Répondre à l'offre:") .' <span class="font-weight-normal">'. $data['offer']->Name .'</span>', 'front/offer/postuler', $data);
  }


  public function storeCandidature($data)
  {
    // Check if candiat logged
    if(!isLogged('admin') && !isLogged('candidat')) {
      return $this->jsonResponse('error', trans("Vous devez vous connecter pour répondre à cette l'offre."));
    }

    $db = getDB();

    $candidat_id = (isset($data['candidat_id'])) ? $data['candidat_id'] : read_session('abb_id_candidat');

    // Check if candidat account exists
    $candidat = $db->findOne('candidats', 'candidats_id', $candidat_id);
    if(!isset($candidat->candidats_id) && !isLogged('admin')) {
      return $this->jsonResponse('error', trans("Votre session est expiré, essaye de vous reconnecter."));
    }

    $id_offre = (isset($data['candidature']['id_offre'])) ? $data['candidature']['id_offre'] : 0;

    // Get offer
    $offer = $db->findOne('offre', 'id_offre', $id_offre);
    if(!isset($offer->id_offre)) {
      return $this->jsonResponse('error', trans("Impossible de trouver l'offre oû vous voulez postuler."));
    }

    // Check if candidat already applied to this offer
    $count = $db->prepare("SELECT COUNT(*) as nbr FROM candidature WHERE candidats_id=? AND id_offre=?", [$candidat_id, $id_offre], true);

    if(intval($count->nbr) > 0) {
      if (!isLogged('admin')) {
        return $this->jsonResponse('error', trans("Vous avez déjà postulé à cette offre, vous ne pouvez postuler qu'une seule fois."));
      } else {
        return $this->jsonResponse('success', trans("Le candidat") .' <b>'. Candidat::getDisplayName($candidat, false) .'</b> '. trans("a déjà postulé à l'offre") .' <b>'. $offer->Name .'</b>');
      }
    }

    if(!isset($data['candidature']['motivation']) || empty($data['candidature']['motivation'])) {
      return $this->jsonResponse('error', trans("Le message de motivation est obligatoire."));
    }

    $id_lettre = (isset($data['candidature']['id_lettre'])) ? intval($data['candidature']['id_lettre']) : 0;

    // Get candidat pertinence
    $nbr_p_c = $percent_titre = $percent_expe = $percent_ville = $percent_tposte = $percent_fonction = $percent_formation = $percent_mobilite = $percent_niveau_mobilite = $percent_taux_mobilite = 0;

    $pertinence = $db->findOne('prm_pertinence', 'ref_p', 'p');
    if(!isset($pertinence->id_prm_p)) return;

    if($pertinence->prm_titre == 1) {
      $nbr_p_c += 100;
      $percent_titre = (strpos($candidat->titre, $offer->Name) !== false) ? 100 : 0;
    }

    if($pertinence->prm_expe == 1) {
      $nbr_p_c += 100;
      $percent_expe = ($candidat->id_expe == $offer->id_expe) ? 100 : 0;
    }
    
    $localisation = $this->getLocationById($offer->id_localisation);

    if($pertinence->prm_local == 1) {
      $nbr_p_c += 100;
      if ($candidat->ville == $localisation->name) $percent_ville = 100;
    }

    if($pertinence->prm_tpost == 1) {
      $nbr_p_c += 100;
    }  

    if($pertinence->prm_fonc == 1) {
      $nbr_p_c += 100;
      if ($candidat->id_fonc == $offer->id_fonc) $percent_fonction = 100;
    }    

    if($pertinence->prm_nfor == 1) {
      $nbr_p_c += 100;
      if ($candidat->id_nfor == $offer->id_nfor) $percent_formation = 100;
    }

    if($pertinence->prm_mobil == 1) {
      $nbr_p_c += 100;
      if ($candidat->mobilite == $offer->mobilite) $percent_mobilite = 100;
    }

    if($pertinence->prm_n_mobil == 1) {
      $nbr_p_c += 100;
      if ($candidat->niveau_mobilite == $offer->niveau_mobilite) $percent_niveau_mobilite = 100;
    }

    if($pertinence->prm_t_mobil == 1) {
      $nbr_p_c += 100;
      if ($candidat->taux_mobilite == $offer->taux_mobilite) $percent_taux_mobilite = 100;
    }
    
    // Get candidat experiences
    $experiences = $db->findByColumn('experience_pro', 'candidats_id', $candidat_id);
    if(!empty($experiences)) : foreach ($experiences as $key => $experience) :
      if($pertinence->prm_local == 1 && $experience->ville == $localisation->name) {
        $percent_ville = 100;
      }
      if($pertinence->prm_tpost == 1 && $experience->id_tpost == $offer->id_tpost) {
        $percent_tposte = 100;
      }
      if($pertinence->prm_fonc == 1 && $experience->id_fonc == $offer->id_fonc) {
        $percent_tposte = 100;
      }
    endforeach; endif;

    // Get candidat formations
    $formations = $db->findByColumn('formations', 'candidats_id', $candidat_id);
    if(!empty($formations)) : foreach ($formations as $key => $formation) :
      if($pertinence->prm_nfor == 1 && $formation->nivformation == $offer->id_nfor) {
        $percent_formation = 100;
        break;
      }
    endforeach; endif;

    // Calculate pertinance
    $somme_n1 = $percent_titre / $nbr_p_c;
    $somme_n2 = $percent_expe / $nbr_p_c;
    $somme_n3 = $percent_ville / $nbr_p_c;
    $somme_n4 = $percent_tposte / $nbr_p_c;
    $somme_n5 = $percent_fonction / $nbr_p_c;
    $somme_n6 = $percent_formation / $nbr_p_c;
    $somme_n7 = $percent_mobilite / $nbr_p_c;
    $somme_n8 = $percent_niveau_mobilite / $nbr_p_c;
    $somme_n9 = $percent_taux_mobilite / $nbr_p_c;
    // Total
    $t_s_n = $somme_n1 + $somme_n2 +$somme_n3 + $somme_n4 + $somme_n5 + $somme_n6 + $somme_n7 + $somme_n8 + $somme_n9;
    $s_note_finale = $t_s_n * 100;
    $r_note_finale = number_format($s_note_finale, 2);

    // Create new candidature row
    $candidature_id = $db->create('candidature', [
      'candidats_id'      => $candidat_id,
      'id_cv'             => $data['candidature']['id_cv'],
      'id_lettre'         => $id_lettre,
      'id_offre'          => $id_offre,
      'domaine_formation_id' => (isset($data['candidature']['domaine_formation_id'])) ? $data['candidature']['domaine_formation_id'] : 0,
      'lettre_motivation' => $data['candidature']['motivation'],
      'date_candidature'  => date('Y-m-d'),
      'status'            => 0,
      'pertinence'        => $r_note_finale,
      'notation'          => 0
    ]);
    if ($candidature_id < 1) {
      return $this->jsonResponse('error', trans("Une erreur est survenu lors d'envoi de candidature."));
    }


    // Calculate candidat notation
    $note_ecole = $note_filiere = 0;
    $cformation = $db->prepare("SELECT * from formations WHERE candidats_id=? ORDER BY id_formation ASC", [$candidat_id], true);

    // offre_necole
    $offre_necole = $db->findByColumn('offre_necole', 'id_offre', $id_offre);
    if(!empty($offre_necole)) : foreach ($offre_necole as $key => $value) :
      if($value->id_ecol == $cformation->id_ecole) {
        $note_ecole = $value->note;
        break;
      }
    endforeach; endif;

    // offre_nfiliere
    $offre_nfiliere = $db->findByColumn('offre_nfiliere', 'id_offre', $id_offre);
    if(!empty($offre_nfiliere)) : foreach ($offre_nfiliere as $key => $value) :
      if($value->id_fili == $cformation->diplome) {
        $note_filiere = $value->note;
        break;
      }
    endforeach; endif;

    $note_diplome = $this->getNoteDiplome($cformation->date_fin);
    $note_experience = $this->getNoteExperience($candidat_id);
    $note_stages = $this->getNoteStages($candidat_id);

    // notation_1
    $notation_id = $db->create('notation_1', [
      'id_candidature' => $candidature_id,
      'note_ecole' => $note_ecole,
      'note_filiere' => $note_filiere,
      'note_diplome' => $note_diplome,
      'note_experience' => $note_experience,
      'note_stages' => $note_stages,
      'obs' => ''
    ]);

    $sum_not = $note_ecole + $note_filiere + $note_diplome + $note_experience + $note_stages;
    $db->update('candidature', 'id_candidature', $candidature_id, ['notation' => $sum_not]);

    // Create pertinance row
    $pertinence_id = getDB()->create('pertinence_oc', [
      'ref_p' => 'p', 
      'candidats_id' => $candidat_id, 
      'id_offre'     => $id_offre,
      'prm_titre'    => $percent_titre,
      'prm_expe'     => $percent_expe, 
      'prm_local'    => $percent_ville, 
      'prm_tpost'    => $percent_tposte,
      'prm_fonc'     => $percent_fonction, 
      'prm_nfor'     => $percent_formation, 
      'prm_mobil'    => $percent_mobilite, 
      'prm_n_mobil'  => $percent_niveau_mobilite,
      'prm_t_mobil'  => $percent_taux_mobilite, 
      'total_p'      => $r_note_finale
    ]);

    // Candidature region
    if (!isLogged('admin')) {
      $candidature_region_id = getDB()->create('candidature_region', [
        'id_candidature' => $candidature_id,
        'id_region'      => $data['region']['id'],
        'ville_region'   => $data['region']['ville'],
        'date_action'    => date("Y-m-d H:i:s")
      ]);
    }

    // Candidature region
    $commentaire = '';
    if (
      isset($data['cand_type']) && 
      in_array($data['cand_type'], ['spontanees', 'stage'])
    ) {
      $type = ($data['cand_type'] == 'spontanees') ? 'spontanées' : 'pour un stage'; 
      $commentaire = "Affecter la candidature {$type} à l'offre N°". $offer->reference;
    }
    $historique_id = getDB()->create('historique', [
      'id_candidature' => $candidature_id,
      'status' => "En attente",
      'date_modification' => date("Y-m-d H:i:s"),
      'utilisateur' => (isBackend()) ? get_admin('email') : $candidat->email,
      'lieu' => '',
      'commentaire' => $commentaire
    ]);

    if (!isLogged('admin')) {
      // Disable update account links
      $db->update('candidats', 'candidats_id', $candidat_id, ['can_update_account' => 0]);

      // Notify website RH about new candidature
      $this->sendCandidatureEmail($candidat, $offer, $candidature_id);
      
      // Return success message
      return $this->jsonResponse('success', trans("Votre candidature a bien été envoyée avec succès."));
    } else {
      return $this->jsonResponse('success', trans("La candidature a été affecté à l'offre") .' <b>'. $offer->Name .'</b> '. trans("pour le candidat:") .' <b>'. Candidat::getDisplayName($candidat, false) .'</b>');
    }
  }


  private function sendCandidatureEmail($candidat, $offer, $candidature_id)
  {
    global $email_e;

    // Send confirm email to candidat
    $template = getDB()->findOne('root_email_auto', 'ref', 'i');
    if(!isset($template->id_email)) return;

    $variables = Mailer::getVariables($candidat, $offer, $candidature_id);
    $subject = Mailer::renderMessage($template->objet, $variables);
    $message = Mailer::renderMessage($template->message, $variables);

    $send = Mailer::send($candidat->email, $subject, $message, [
      'titre' => $template->titre,
      'type_email' => 'Envoi automatique'
    ]);

    // Notify RH team
    if($send['response'] == 'success') {
      $message = '<p><strong>'. trans("Bonjour,") .'</strong></p>';
      $message .= '<p>'. trans("Une nouvelle candidature a été reçu sur l'offre:") .' <strong>'. $offer->Name .'</strong>';
      $message .= '<br>'. trans("Pour consulter les nouvelles candidatures") .' <strong><a href="'. site_url('backend/module/candidatures/candidature/list/0') .'">'. trans("cliquez ici") .'</a></strong></p>';
      $message .= '<p>'. trans("Cordialement") .'</p>';
      $receivers = [$email_e];
      if($email_e != $template->email) $receivers[] = $template->email;
      Mailer::send($receivers, trans("Nouvelle candidature reçu"), $message, ['isHTML' => true]);
    }
  }


  // TODO - Check this logique with Mr Hamza
  public function getNoteDiplome($date_fin)
  {
    $date_f_cl = 0;
    $note_diplome = 1;
    $date_f = explode("/", $date_fin);
    if(isset($date_f[2])) {
      $date_f_cl = (date("md", date("U", mktime(0, 0, 0, $date_f[0], $date_f[1], $date_f[2]))) > date("md") ? ((date("Y") - $date_f[2]) - 1) : (date("Y") - $date_f[2]));
    } else if (isset($date_f[1])) {
      $date_f_cl = (date("m", date("U", mktime(0, $date_f[0] ))) > date("m") ? ((date("Y") - $date_f[1]) - 1) : (date("Y") - $date_f[1]));
    }
    if($date_f_cl < 2) {
      $note_diplome = 5;
    } else if ($date_f_cl < 4 and $date_f_cl > 1) {
      $note_diplome = 3;
    }
    return $note_diplome;
  }


  public function getNoteExperience($candidat_id)
  {
    $note_experience = $sum_day_exp = 0;
    $exp_pro = getDB()->prepare("SELECT * from experience_pro where id_tpost <> '4' and candidats_id=?", [$candidat_id]);
    if(!empty($exp_pro)) : foreach ($exp_pro as $key => $value) :
      $start_date = french_to_english_date($value->date_debut);
      $end_date = (empty($value->date_fin)) ? date("Y-m-d") : french_to_english_date($value->date_fin);
      $date_diff = strtotime($end_date) - strtotime($start_date);
      $sum_day_exp += floor($date_diff / (60 * 60 * 24));
    endforeach; endif;

    $day_yr = $sum_day_exp / 365;
    $note_experience = round($day_yr * 8, 0) ;

    return ($note_experience > 40) ? 40 : $note_experience;
  }

  // TODO - Check this method logique
  public function getNoteStages($candidat_id, $note_experience = null)
  {
    if(is_null($note_experience)) {
      $note_experience = $this->getNoteExperience($candidat_id);
    }
    $note_stages = 0;
    $exp_pro = getDB()->prepare("SELECT * from experience_pro where id_tpost = '4' and candidats_id=?", [$candidat_id]);
    if(!empty($exp_pro)) : foreach ($exp_pro as $key => $value) :
      $note_stages += 5;
    endforeach; endif;

    // Experience plus de 3 ans ==> stages = 0
    if($note_experience > 23) $note_stages = 0;

    return $note_stages;
  }


  private function getLocationById($id_localisation)
  {
    if(read_session('r_prm_region_off') == 0) {
      return getDB()->prepare("SELECT id_region AS id, nom_region AS name FROM prm_region WHERE id_region=?", [$id_localisation], true);
    } else {
      return getDB()->prepare("SELECT id_vill AS id, ville AS name FROM prm_villes WHERE id_vill=?", [$id_localisation], true);
    }
  }


	public function searchForm($data)
	{
    $data = Ajax::getUrlParams($data);
    return Ajax::renderAjaxView('', 'front/partials/offer-search', $data);
	}


  /**
   * Generate query string
   *
   * @return object $query
   *
   * @author Mhamed Chanchaf
   */
  public function buildQuery()
  {
    return "SELECT o.id_offre, o.reference, o.Name, o.date_expiration, o.Profil, f.fonction FROM offre o LEFT JOIN prm_fonctions f ON f.id_fonc = o.id_fonc ". $this->getAndWhereStatement('WHERE');
  }


  /**
   * Get And Where Statement
   *
   * @param  string $separator
   * @return string $andwhere_statement
   *
   * @author Mhamed Chanchaf
   */
  public function getAndWhereStatement($separator='AND') 
  {
    $andWhere_array = [];
    foreach ($this->andWhere as $key => $column) {
      if( !isset($_GET[$key]) || empty($_GET[$key]) ) continue;
      switch ($key) {
        case 's':
          $keywords = explode(" ", mysql_real_escape_string(htmlspecialchars($_GET[$key])));
          $parts = array();
          for ($i = 0; $i < count($keywords); $i++) {
            $parts[] = "(o.Name LIKE '%". $keywords[$i] ."%' OR o.Details LIKE '%". $keywords[$i] ."%' OR o.Profil LIKE '%". $keywords[$i] ."%')";
          }
          $andWhere_array[] = '('. implode(' AND ', $parts) .')';
        break;
        default:
          if(is_array($_GET[$key])) {
            $andWhere_array[] = key($column) .".". reset($column) ." IN('". implode("','", $_GET[$key]) ."')";
          } else {
            $andWhere_array[] = key($column) .".". reset($column) ."='{$_GET[$key]}'";
          }
        break;
      }
    }
    $andWhere_array[] = (Route::getRoute() == 'offres/stage') ? "o.id_tpost='4'" : "o.id_tpost!='4'";

    // Afficher les offres expirées au candidats dans la page des offres.
    if (get_setting('front_show_expired_offers_on_frentend') != 1) {
      $andWhere_array[] = "o.status='En cours'";
      $andWhere_array[] = "DATE(o.date_expiration) >= CURDATE()";
    }

    return (!empty($andWhere_array)) ? " {$separator} ". implode(' AND ', $andWhere_array) : '';
  }

  private function connect()
  {
    return json_encode(['status' => 'hide_form', 'title' => 'Connectez-vous !', 'content' => 'Vous devez <strong onclick="return chmAuth.loginModal()" style="cursor: pointer;">vous connecter</strong> pour envoyer cette offre par email.']);
  }


	
} // END Class