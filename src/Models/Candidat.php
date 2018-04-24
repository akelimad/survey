<?php
/**
 * Candidat
 *
 * @author mchanchaf
 *
 * @package app.models
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Models;

use App\File;

class Candidat {

  
  /**
   * Get candidat display name
   *
   * @param object $candidat 
   * @return array $data 
   * 
   * @author Mhamed Chanchaf
   */
  public static function getDisplayName($candidat = null, $with_civilite = true) {
    // Get candidat data
    if (!isset($candidat->candidats_id) && isLogged('candidat')) {
      $candidat = getDB()->findOne('candidats', 'candidats_id', read_session('abb_id_candidat'));
    }

    if (!isset($candidat->candidats_id)) return;
    
    $fullname = trim($candidat->prenom .' '. $candidat->nom);
    if($with_civilite && isset($candidat->id_civi)) {
      $civilite = getDB()->findOne('prm_civilite', 'id_civi', $candidat->id_civi);
      if (isset($civilite->civilite) && !empty($civilite->civilite)) {
        $fullname = $civilite->civilite .' '. $fullname;
      }
    }
    return $fullname;
  }


  /**
   * Tell if password is strong
   *
   * @param string $password
   *
   * @author Mhamed Chanchaf
   */
  public static function isStrongPassword($password)
  {
    $containsLetter  = preg_match('/[a-zA-Z]/', $password);
    $containsDigit   = preg_match('/\d/', $password);
    $containsAll = $containsLetter && $containsDigit;
    return $containsAll;
  }


	/**
   * Get candidat by id
   *
   * @param int $id_candidat 
   * @return array $data 
   * 
   * @author Mhamed Chanchaf
   */
  public static function getByID($id_candidat) {
      return getDB()->findByColumn('candidats', 'candidats_id', $id_candidat, ['limit'=>1]);
  }


  /**
   * Get candidat matched offers
   *
   * @param int $limit
   * @return array $offers
   *
   * @author Mhamed Chanchaf
   */
  public static function getMatchedOffers($limit = 5)
  {
    return getDB()->prepare("SELECT * FROM offre WHERE id_sect=? AND status=? AND DATE(date_expiration) >= CURDATE() ORDER BY id_offre DESC LIMIT {$limit}", [get_candidat('id_sect'), 'En cours']);
  }


  /**
   * Get candidat job alerts
   *
   * @return array $alerts
   *
   * @author Mhamed Chanchaf
   */
  public static function getAlerts()
  {
    return getDB()->prepare("SELECT * FROM alert WHERE candidats_id=?", [get_candidat_id()]);
  }


  /**
   * Check if candidat has at least one resume
   *
   * @return bool
   *
   * @author Mhamed Chanchaf
   */
  public static function hasResume($candidat_id = null)
  {
    if (is_null($candidat_id)) $candidat_id = get_candidat_id();
    
    $count = getDB()->prepare("SELECT COUNT(*) as nbr FROM cv WHERE candidats_id=?", [$candidat_id], true);
    return (intval($count->nbr) > 0);
  }


  /**
   * Check if candidat has at least one formation
   *
   * @return bool
   *
   * @author Mhamed Chanchaf
   */
  public static function hasFormation($candidat_id = null)
  {
    if (is_null($candidat_id)) $candidat_id = get_candidat_id();
    
    $count = getDB()->prepare("SELECT COUNT(*) as nbr FROM formations WHERE candidats_id=?", [$candidat_id], true);
    return (intval($count->nbr) > 0);
  }


  /**
   * Check if candidat has candidature spontannee
   *
   * @return bool
   *
   * @author Mhamed Chanchaf
   */
  public static function hasCandidatureSpontannee($candidat_id = null)
  {
    if (is_null($candidat_id)) $candidat_id = get_candidat_id();
    
    $count = getDB()->prepare("SELECT COUNT(*) as nbr FROM candidature_spontanee WHERE candidats_id=?", [$candidat_id], true);
    return (intval($count->nbr) > 0);
  }


  /**
   * Check if candidat has candidature stage
   *
   * @return bool
   *
   * @author Mhamed Chanchaf
   */
  public static function hasCandidatureStage($candidat_id = null)
  {
    if (is_null($candidat_id)) $candidat_id = get_candidat_id();
    
    $count = getDB()->prepare("SELECT COUNT(*) as nbr FROM candidature_stage WHERE candidats_id=?", [$candidat_id], true);
    return (intval($count->nbr) > 0);
  }


	/**
	 * Get last candidat formation
	 *
	 * @param int $id_candidat
	 * @return array $formation | false
	 *
	 * @author Mhamed Chanchaf
	 */
	public static function getLastFormation($id_candidat) 
	{
		return getDB()->prepare("SELECT f.*, e.nom_ecole FROM `formations` AS f LEFT JOIN prm_ecoles AS e ON e.id_ecole=f.id_ecol WHERE f.candidats_id=? ORDER BY f.date_fin DESC", [$id_candidat], true);
	}


	/**
	 * Get last candidat experience
	 *
	 * @param int $id_candidat
	 * @return array $xperience | false
	 *
	 * @author Mhamed Chanchaf
	 */
	public static function getLastExperience($id_candidat) 
	{
		return getDB()->prepare("SELECT exp.*, p.pays FROM experience_pro AS exp LEFT JOIN prm_pays AS p ON p.id_pays=exp.id_pays WHERE exp.candidats_id=? ORDER BY exp.date_fin DESC", [$id_candidat], true);
	}

	/**
   * Get pays name By ID
   *
   * @param int $id_pays
   *
   * @return string $name
   */
	public static function getPaysByID($id_pays)
	{
		$pays = getDB()->prepare("SELECT pays AS name FROM prm_pays where id_pays=?", [$id_pays], true);
		return (isset($pays->name)) ? $pays->name : '';
	}


	/**
   * Get formation level
   *
   * @param int $id_niv
   *
   * @return string $niv_formation
   */
	public static function getNivFormation($id_niv)
	{
		$niv = getDB()->prepare("SELECT formation FROM prm_niv_formation where id_nfor=?", [$id_niv], true);
		return (isset($niv->formation)) ? $niv->formation : '';
	}


	/**
   * Get sector name by ID
   *
   * @param int $id_sector
   *
   * @return string $sector_name
   */
	public static function getSectorNameByID($id_sector)
	{
		$sector = getDB()->prepare("SELECT FR FROM prm_sectors where id_sect=?", [$id_sector], true);
		return (isset($sector->FR)) ? $sector->FR : '';
	}


	/**
   * Get sector name by ID
   *
   * @param int $id_fonction
   *
   * @return string $fonction_name
   */
	public static function getFonctionNameByID($id_fonction)
	{
		$fonction = getDB()->prepare("SELECT fonction AS name FROM prm_fonctions where id_fonc=?", [$id_fonction], true);
		return (isset($fonction->name)) ? $fonction->name : '';
	}


	/**
   * Get salaire name by ID
   *
   * @param int $id_salaire
   *
   * @return string $salaire_name
   */
	public static function getSalaireNameByID($id_salaire)
	{
		$salaire = getDB()->prepare("SELECT salaire AS name FROM prm_salaires where id_salr=?", [$id_salaire], true);
		return (isset($salaire->name)) ? $salaire->name : '';
	}


	/**
   * Get experience name by ID
   *
   * @param int $id_exp
   *
   * @return string $experience_name
   */
	public static function getExperienceNameByID($id_exp)
	{
		$experience = getDB()->prepare("SELECT intitule AS name FROM prm_experience where id_expe=?", [$id_exp], true);
		return (isset($experience->name)) ? $experience->name : '';
	}

 	/**
	 * Tell if candidats has cv
	 *
	 * @author Mhamed Chanchaf
	 */
	public static function hasCV($id_candidat) 
	{
		$candidat = getDB()->findByColumn('cv', 'candidats_id', $id_candidat, ['limit'=>1]);
		return ( isset($candidat->candidats_id) );
	}

 	/**
	 * Tell if candidats has lettre de motivation
	 *
	 * @author Mhamed Chanchaf
	 */
	public static function hasLM($id_candidat) 
	{
		$candidat = getDB()->findByColumn('lettres_motivation', 'candidats_id', $id_candidat, ['limit'=>1]);
		return ( isset($candidat->candidats_id) );
	}

  public static function deleteAccount($candidat_id)
  {
    $db = getDB();

    $candidat = $db->findOne('candidats', 'candidats_id', $candidat_id);

    // Delete candidat photo
    if (!empty($candidat->photo)) {
      File::delete(site_base('apps/upload/frontend/photo_candidats/'. $candidat->photo));
    }

    $db->delete('agenda', 'candidats_id', $candidat_id);
    $db->delete('agenda_stage', 'candidats_id', $candidat_id);
    $db->delete('alert', 'candidats_id', $candidat_id);
    $db->delete('archive_cvs', 'id_candidat', $candidat_id);
    $db->delete('candidats', 'candidats_id', $candidat_id);
    $db->delete('compte_desactiver', 'candidats_id', $candidat_id);
    $db->delete('dossier_candidat', 'candidats_id', $candidat_id);
    $db->delete('historique_stage', 'candidats_id', $candidat_id);
    $db->delete('his_cvtheq_rol', 'id_candidat', $candidat_id);
    // partenaire
    $db->delete('pertinence_oc', 'candidats_id', $candidat_id);
    $db->delete('popup', 'id_candidat', $candidat_id);

    // Delete candidature and it attachments
    self::deleteCandidatures($candidat_id);
    self::deleteExperiences($candidat_id);
    self::deleteFormations($candidat_id);
    self::deleteResumes($candidat_id);
    self::deleteMotivations($candidat_id);
  }

  public static function deleteCandidatures($candidat_id)
  {
    $db = getDB();

    $cands = $db->findByColumn('candidature', 'candidats_id', $candidat_id);
    if (empty($cands)) return;

    $cands_ids = [];
    foreach ($cands as $key => $cand) {
      $id_candidature = $cand->id_candidature;
      $dirPath = site_base('uploads/candidatures/'. $id_candidature .'/');
      File::deleteDirectory($dirPath);

      $cands_ids[] = $id_candidature;

      // Delete fiches
      $fiches = $db->findByColumn('fiche_candidature', 'id_candidature', $id_candidature);
      if (empty($fiches)) : foreach ($fiches as $key => $fiche) :
        $db->delete('fiche_candidature_results', 'id_fiche_candidature', $fiche->id_fiche_candidature);
      endforeach; endif;
      $db->delete('fiche_candidature', 'id_candidature', $id_candidature);

      $db->delete('historique', 'id_candidature', $id_candidature);
      $db->delete('notation_1', 'id_candidature', $id_candidature);
      $db->delete('notation_2', 'id_candidature', $id_candidature);
      $db->delete('postit', 'id_candidature', $id_candidature);
      $db->delete('role_candidature', 'id_candidature', $id_candidature);
    }

    if (!empty($cands_ids)) {
      $cids = implode(',', $cands_ids);

      $relations = ['candidature_attachments', 'candidature_region', 'candidature_spontanee', 'candidature_stage'];

      foreach ($relations as $key => $table) {
        $db->prepare("DELETE FROM {$table} WHERE id_candidature IN(". $cids .")");
      }
    }

    $db->delete('candidature', 'candidats_id', $candidat_id);
  }

  public static function deleteExperiences($candidat_id)
  {
    $db = getDB();

    $experiences = $db->findByColumn('experience_pro', 'candidats_id', $candidat_id);
    if (empty($experiences)) return;

    foreach ($experiences as $key => $exp) {
      if (!empty($exp->copie_attestation)) {
        File::delete(site_base('apps/upload/frontend/candidat/copie_attestation/'. $exp->copie_attestation));
      }

      if (!empty($exp->bulletin_paie)) {
        File::delete(site_base('apps/upload/frontend/candidat/bulletin_paie/'. $exp->bulletin_paie));
      }
    }

    $db->delete('experience_pro', 'candidats_id', $candidat_id);
  }

  public static function deleteFormations($candidat_id)
  {
    $db = getDB();

    $formations = $db->findByColumn('formations', 'candidats_id', $candidat_id);
    if (empty($formations)) return;

    foreach ($formations as $key => $formation) {
      if (!empty($formation->copie_diplome)) {
        File::delete(site_base('apps/upload/frontend/candidat/copie_diplome/'. $formation->copie_diplome));
      }
    }

    $db->delete('formations', 'candidats_id', $candidat_id);
  }

  public static function deleteResumes($candidat_id)
  {
    $db = getDB();

    $resumes = $db->findByColumn('cv', 'candidats_id', $candidat_id);
    if (empty($resumes)) return;

    foreach ($resumes as $key => $resume) {
      File::delete(site_base('apps/upload/frontend/cv/'. $resume->lien_cv));
    }

    $db->delete('cv', 'candidats_id', $candidat_id);
    $db->delete('cv_importe', 'candidats_id', $candidat_id);
    $db->delete('cv_imp_origin', 'candidats_id', $candidat_id);
    $db->delete('cv_telecharger', 'candidats_id', $candidat_id);
  }

  public static function deleteMotivations($candidat_id)
  {
    $db = getDB();

    $motivations = $db->findByColumn('lettres_motivation', 'candidats_id', $candidat_id);
    if (empty($motivations)) return;

    foreach ($motivations as $key => $m) {
      File::delete(site_base('apps/upload/frontend/lmotivation/'. $m->lettre));
    }

    $db->delete('lettres_motivation', 'candidats_id', $candidat_id);
  }

} // END Class