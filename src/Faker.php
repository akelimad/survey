<?php
/**
 * Faker
 * 
 * Generate fake data
 * $faker = new \App\Faker();
 * $faker->createOffers();
 * $faker->createCandidats();
 *
 * TRUNCATE `candidats`;
 * TRUNCATE `candidature`;
 * TRUNCATE `cv`;
 * TRUNCATE `experience_pro`;
 * TRUNCATE `formations`;
 * TRUNCATE `historique`;
 * TRUNCATE `lettres_motivation`;
 * TRUNCATE `notation_1`;
 * TRUNCATE `pertinence_oc`;
 * TRUNCATE `offre`;
 *
 * @author mchanchaf
 *
 * @package app
 * @version 1.0
 * @since 1.5.0
 */
namespace App;

use Faker\Factory;

class Faker
{


  public function createOffers($id_tpost = 1, $number = 20)
  {
    $faker = Factory::create('fr_FR');

    $date_insertion = $this->randomDate('2018-02-01', date('Y-m-d H:i:s'));
    $date_expiration = date('Y-m-d', strtotime($date_insertion . '3 months'));

    for ($i=0; $i < $number; $i++) {
      getDB()->create('offre', [
        'reference' => $i+1,
        'Name' => $faker->jobTitle,
        'id_sect' => 17,
        'Details' => $faker->text(900),
        'Profil' => $faker->text(900),
        'Contact' => 'contact@etalent.ma',
        'Photo_offre' => null,
        'id_entreprise' => 1,
        'Email' => 'root@etalent.ma',
        'date_insertion' => $date_insertion,
        'date_expiration' => $date_expiration,
        'id_expe' => 1,
        'id_localisation' => rand(1, 12),
        'id_tpost' => $id_tpost,
        'mobilite' => 'non',
        'niveau_mobilite' => 1,
        'taux_mobilite' => 1,
        'vue' => rand(0, 2350),
        'candidature' => 0,
        'status' => 'En cours',
        'anonymat' => 1,
        'send_candidature' => 'true',
        'ordre' => $i,
        'id_fonc' => rand(1, 25),
        'id_nfor' => rand(1, 8),
        'ref_filiale' => 0
      ]);
    }
  }


  public function createCandidats($number = 150)
  {
    $faker = Factory::create('fr_FR');
    $db = getDB();

    for ($i=0; $i < $number; $i++) {
      $cdata = $this->getCandidatData($faker);
      $candidat_id = $db->create('candidats', $cdata);

      // add formation
      $f_date_debut = $this->randomDate('2010-01-01', '2014-01-01', 'd/m/Y');
      $f_date_fin = date('d/m/Y', strtotime(eta_date($f_date_debut, 'Y-m-d') . rand(6, 24) . ' months'));
      $db->create('formations', [
        'candidats_id' => $candidat_id,
        'id_ecol' => rand(1, 260),
        'date_debut' => $f_date_debut,
        'date_fin' => $f_date_fin,
        'diplome' => rand(1, 280),
        'description' => $faker->text(120),
        'nivformation' => rand(1, 14)
      ], false);

      // add experience
      $exp_date_debut = $this->randomDate('2014-02-01', '2018-03-01', 'd/m/Y');
      $exp_date_fin = date('d/m/Y', strtotime(eta_date($exp_date_debut, 'Y-m-d') . rand(6, 24) . ' months'));
      $db->create('experience_pro', [
        'candidats_id' => $candidat_id,
        'id_sect' => rand(1, 50),
        'id_fonc' => rand(1, 30),
        'id_tpost' => rand(1, 4),
        'id_pays' => 22,
        'poste' => $faker->text(30),
        'entreprise' => $faker->company,
        'ville' => $faker->city,
        'description' => $faker->text(120),
        'salair_pecu' => rand(3000, 12000),
        'date_debut' => $exp_date_debut,
        'date_fin' => $exp_date_fin
      ], false);

      // Create CV
      $cv_id = $db->create('cv', [
        'candidats_id' => $candidat_id,
        'titre_cv' => $faker->text(20),
        'lien_cv' => 'resume.pdf',
        'principal' => 1,
        'actif' => 1
      ], false);

      // Create LM
      $lettre_id = $db->create('lettres_motivation', [
        'candidats_id' => $candidat_id,
        'lettre' => 'letter.docx',
        'titre' => $faker->text(20),
        'principal' => 1,
        'actif' => 1
      ], false);

      // Create candidature
      $offer_id = rand(1, 20);
      $date_candidature = $this->randomDate($cdata['date_inscription'], '2018-03-01', 'Y-m-d');
      $candidature_id = $this->createCandidature($faker, $date_candidature, $candidat_id, $cv_id, $lettre_id, $offer_id);

      // Save history
      $db->create('historique', [
        'id_candidature' => $candidature_id,
        'status' => 'En attente',
        'date_modification' => $date_candidature,
        'utilisateur' => $cdata['email'],
        'lieu' => null,
        'commentaire' => null
      ]);

      // notation_1 
      $lettre_id = $db->create('notation_1', [
        'id_candidature' => $candidature_id,
        'note_ecole' => 0,
        'note_filiere' => 0,
        'note_diplome' => 3,
        'note_experience' => 0,
        'note_stages' => 0,
        'obs' => null
      ]);

      // pertinence_oc 
      $lettre_id = $db->create('pertinence_oc', [
        'ref_p' => 'p',
        'candidats_id' => $candidat_id,
        'id_offre' => $offer_id,
        'prm_titre' => rand(0, 100),
        'prm_expe' => rand(0, 100),
        'prm_local' => rand(0, 100),
        'prm_tpost' => rand(0, 100),
        'prm_mobil' => rand(0, 100),
        'prm_n_mobil' => rand(0, 100),
        'prm_t_mobil' => rand(0, 100),
        'prm_fonc' => rand(0, 100),
        'prm_nfor' => rand(0, 100),
        'total_p' => rand(0, 100),
        'datetime' => $date_candidature
      ]);


      // Change candiadture status
      $this->changeCandidatureStatus($faker, $candidature_id, $candidat_id, $date_candidature);
    }
  }


  public static function changeCandidatureStatus($faker, $candidature_id, $candidat_id, $date_candidature)
  {
    $workflow = [
      [17],
      [31],
      [17, 32, 35],
      [33, 36],
      [39, 40, 50],
      [43],
      [47],
      [48],
      [43, 48],
      [39, 46]
    ];

    $db = getDB();
    $rand_wf = $workflow[array_rand($workflow)];

    foreach ($rand_wf as $key => $status_id) {
      if(rand(1, 15) == 10) continue;
      
      // Update candidature status
      $db->update('candidature', 'id_candidature', $candidature_id, [
        'status' => $status_id
      ]);

      // Get status by id
      $prm_statut = $db->findOne('prm_statut_candidature', 'id_prm_statut_c', $status_id);

      // Save history
      $comments = $faker->text(120);
      $id_historique = $db->create('historique', [
        'id_candidature' => $candidature_id,
        'status' => $prm_statut->statut,
        'date_modification' => $date_candidature,
        'utilisateur' => 'root@etalent.ma',
        'commentaire' => $comments,
        'lieu' => ''
      ]);

      // Save agenda record
      $agendaData = array(
        'candidats_id' => $candidat_id,
        'id_candidature' => $candidature_id,
        'action' => $prm_statut->statut,
        'obs' => $comments,
        'lieu' => '',
        'start' => $date_candidature,
        'end' => $date_candidature,
        'confirmation_statu' => ($prm_statut->ref == 'N_2' || $prm_statut->ref == 'N_9') ? 1 : 0,
      );

      $agenda = $db->findOne('agenda', 'id_candidature', $candidature_id);
      if( isset($agenda->id_agend) ) {
        $db->update('agenda', 'id_agend', $agenda->id_agend, $agendaData);
        $id_agend = $agenda->id_agend;
      } else {
        $id_agend = $db->create('agenda', $agendaData);
      }
    }
  }


  private function getCandidatData($faker)
  {
    $levels = ['Maîtrisé', 'Courant', 'Basique', 'Néant'];
    $situs = [1, 2, 4];

    return [
      'id_civi' => rand(1, 3),
      'id_pays' => 22,
      'id_situ' => $situs[array_rand($situs)],
      'id_sect' => rand(1, 25),
      'id_fonc' => rand(1, 25),
      'id_salr' => rand(1, 8),
      'id_nfor' => rand(1, 14),
      'id_tfor' => rand(1, 11),
      'id_dispo' => rand(1, 3),
      'id_expe' => rand(1, 10),
      'titre' => $faker->text(30),
      'nom' => $faker->lastName,
      'prenom' => $faker->firstName,
      'date_n' => $this->randomDate('2000-01-01', '1980-01-01', 'd/m/Y'),
      'adresse' => $faker->address,
      'code' => $faker->postcode,
      'ville' => $faker->city,
      'nationalite' => $faker->country,
      'cin' => strtoupper($faker->bothify('??###')),
      'tel1' => $faker->mobileNumber,
      'tel2' => null,
      'email' => $faker->email,
      'mdp' => md5('123azerty'),
      'mobilite' => 'non',
      'arabic' => $levels[array_rand($levels)],
      'french' => $levels[array_rand($levels)],
      'english' => $levels[array_rand($levels)],

      'pupille' => null,
      'handicape' => null,
      'note_diplome' => 0,
      'nl_emploi' => null,
      'nl_partenaire' => '123azerty',
      'date_inscription' => $this->randomDate('2017-01-01', '2018-03-01', 'Y-m-d'),
      'status' => 1,
      'last_connexion' => $this->randomDate('2018-01-01', '2018-03-01', 'Y-m-d'),
      'vues' => rand(300, 1200),
      'dateMAJ' => $this->randomDate('2018-01-01', '2018-03-01', 'Y-m-d H:i:s'),
      'CVdateMAJ' => $this->randomDate('2018-01-01', '2018-03-01', 'Y-m-d H:i:s'),
      'can_update_account' => 1
    ];
  }

  private function createCandidature($faker, $date_candidature, $candidat_id, $cv_id, $lettre_id, $offer_id)
  {
    return getDB()->create('candidature', [
      'candidats_id' => $candidat_id,
      'id_cv' => $cv_id,
      'id_lettre' => $lettre_id,
      'id_offre' => $offer_id,
      'lettre_motivation' => $faker->text(200),
      'date_candidature' => $date_candidature,
      'status' => 0,
      'pertinence' => rand(20, 100),
      'notation' => rand(10, 100),
      'note_orale' => null,
      'note_ecrit' => null
    ]);
  }

   
  /**
   * Find a randomDate between $start_date and $end_date
   * @return timestamp
   */
  public function randomDate($start_date, $end_date, $format = 'Y-m-d H:i:s')
  {
    // Convert to timetamps
    $min = strtotime($start_date);
    $max = strtotime($end_date);
    // Generate random number using above bounds
    $val = rand($min, $max);
    // Convert back to desired date format
    return date($format, $val);
  }


} //End class