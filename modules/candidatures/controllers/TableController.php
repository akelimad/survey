<?php
/**
 * TableController
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
 *
 * @package modules.candidatures.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Candidatures\Controllers;

use \Modules\Candidatures\Models\Candidat;
use \Modules\Candidatures\Models\Candidatures;

class TableController
{


	private $andWhere = [
		'motcle' 		 => ['c' => 'motcle'], 
		'fonc' 	 		 => ['c' => 'id_fonc'], 
		'situ' 	 		 => ['c' => 'id_situ'], 
		'sect' 	 		 => ['c' => 'id_sect'], 
		'exp'  	 		 => ['c' => 'id_expe'], 
		'nfor' 	 		 => ['c' => 'id_nfor'], 
		'tfor' 	 		 => ['c' => 'id_tfor'], 
		'fraicheur'  => ['c' => 'CVdateMAJ'], 
		'pays' 			 => ['c' => 'id_pays'],
		'ville'			 => ['c' => 'ville'],
		'ref_offre'  => ['cand' => 'id_offre'],
		'pertinence' => ['cand' => 'pertinence'],
		'ecole' 		 => ['f' => 'id_ecol'],
		'campagne' 	 => ['co' => 'id_compagne']
	];

	private $joints = [
		'JOIN formations f ON f.candidats_id=cand.candidats_id' => ['motcle', 'ecole'], 
    'JOIN compagne_offres co ON co.id_offre=cand.id_offre' => ['campagne']
	];

	private $actions = [
		'change_status' => [
			'label' => 'Editer le statut de cette candidature',
			'bulk_label' => 'Editer le statut',
			'patern' => '#',
			'icon' => 'fa fa-pencil',
			'callback' => 'showChangeSatatusPopup',
			'bulk_action' => false,
			'attributes' => [
				'class' => 'btn btn-success btn-xs',
			]
		],
		'send_mail' => [
			'label' => 'Envoyer un email au candidat',
			'bulk_label' => 'Envoyer un email',
			'patern' => '#',
			'icon' => 'fa fa-envelope-o',
			'callback' => 'showSendEmailPopup',
			'attributes' => [
				'class' => 'btn btn-default btn-xs',
			]
		]
	];

	private $pertinence;

	public $params = [
		'filterFields' => [],
		'options' => [
			'bulk_actions' => true,
			'actions' => true,
			'show_thead' => true,
			'show_footer' => true,
			'show_increment' => false,
			'show_links_first_last' => false
		],
		'actions' => [
			'send_mail' => true
		]
	];

	public function __construct($options=[], $andWhere=[], $joints=[])
	{
		$this->params['options'] = array_replace_recursive($this->params['options'], $options);
		$this->andWhere = array_replace_recursive($this->andWhere, $andWhere);
		$this->joints   = array_replace_recursive($this->joints, $joints);
		$this->pertinence = getDB()->findOne('prm_pertinence', 'ref_p', 'p');
	}



  /**
	 * Get table object
	 *
	 * @return object $table
	 *
	 * @author Mhamed Chanchaf
	 */
  public function getTable()
  {
  		$query = $this->buildQuery();
		$table = new \App\Helpers\Table($query, 'id_candidature', $this->params['options']);
		$table->setTableClass(['table', 'table-striped', 'table-hover']);
		$table->setTableId('candidatureTable');
		$table->removeActions(['edit', 'delete']);
		$table->setTrigger('table_notes', [$this, 'getPertinenceNotice']);
		$table->setOrderby('cand.date_candidature');
		$table->setOrder('DESC');
  		// Add custom actions
		foreach ($this->actions as $key => $attributes) {
			if( isset($this->params['actions'][$key]) && $this->params['actions'][$key] == false ) continue;
			$table->setAction($key, $attributes);
		}

		// Add table columns
		$table->addColumn('sinfos', 'Informations Candidats', function($row){
			$html = '<a href="'. site_url('backend/cv/?candid='.$row->candidats_id) .'" target="_blank" class="cname" title="Voir le profile"><i class="fa fa-user"></i>&nbsp;'. $row->fullname .'</a>';

			if( !is_null($row->date_n) ) {
				$birthday = date('Y-m-d', french_to_english_date($row->date_n));
				$age = (time() - strtotime($birthday)) / 3600 / 24 / 365;
				$html .= '<br><b>'.number_format($age, 0).' ans</b>';
			}

			$html .= '<br>'. $row->ville .'&nbsp;|&nbsp;'. Candidat::getPaysByID($row->id_pays);

			return $html;
		});

		$table->addColumn('history', '', function($row){
			$history = getDB()->prepare("SELECT date_modification, status, utilisateur FROM historique WHERE id_candidature=?", [$row->id_candidature]);
			if ( empty($history) ) return;
			$html = '<i class="fa fa-history pull-right" data-toggle="popover" data-trigger="hover" data-popover-content="#show_h_'. $row->candidats_id .'" title="Historique des actions effectuées"></i>';
			$html .= '<div id="show_h_'. $row->candidats_id .'" class="hidden">';
			$html .= '<table class="table table-history">';
			foreach ($history as $key => $h) :
				$html .= '<tr><td width="110">'. date('d.m.Y H:i', strtotime($h->date_modification)) .'</td><td>'. $h->status .'</td><td>'. $h->utilisateur .'</td></tr>';
			endforeach;
			$html .= '</table></div>';
			return $html;
		});

		$table->addColumn('exp_salr', '', function($row){
			$mobilite = (isset($row->mobilite) && $row->mobilite!='') ? ucfirst($row->mobilite) : 'Non';
			$mobiliteClass = ($mobilite=='Oui') ? 'success' : 'default';

			$html  = '<table>';
				$html .= '<tbody>';
				$html .= '<tr>';
					$html .= '<th width="88px">Expérience</th>';
					$html .= '<td>'.Candidat::getExperienceNameByID($row->id_expe).'</td>';
				$html .= '</tr>';
				$html .= '<tr>';
					$html .= '<th>Salaire souhaité</th>';
					$html .= '<td>'.Candidat::getSalaireNameByID($row->id_salr).'</td>';
				$html .= '</tr>';
				$html .= '<tr>';
					$html .= '<th>Fraicheur du cv</th>';
					$html .= '<td>'.timeAgo($row->dateMAJ).'</td>';
				$html .= '</tr>';
				$html .= '<tr>';
					$html .= '<th>Mobilité</th>';
					$html .= '<td><span class="label label-'.$mobiliteClass.'">'. $mobilite .'</span></td>';
				$html .= '</tr>';
				$html .= '</tbody>';
			$html .= '</table>';
			
			return $html;
		}, ['width'=> '180px']);

		$table->addColumn('details', 'Détails', function($row){
			$details = '';
			if( intval($row->id_cv) > 0 ) {
				$cv_ext = \App\Models\Cv::getExtension($row->id_cv);
				if( !is_null($cv_ext) ) {
					$icon = $this->getIconByExtention($cv_ext);
					$details .= '<a href="'. site_url('backend/module/candidatures/candidat/cv/'.$row->id_cv) .'" title="Télécharger le CV"><i class="'.$icon.'"></i></a>';
				}
			}
			if( intval($row->id_lettre) > 0 ) {
				$lettre_ext = \App\Models\Lettre::getExtension($row->id_lettre);
				if( !is_null($lettre_ext) ) {
					$icon = $this->getIconByExtention($lettre_ext);
					$details .= '&nbsp;<a href="'. site_url('backend/module/candidatures/candidat/lettre/'.$row->id_lettre) .'" title="Télécharger la lettre de motivation"><i class="'.$icon.'"></i></a>';
				}
			}
			return $details;
		});

		$table->addColumn('pertinence', 'P', function($row){
			$p = Candidat::getPertinance($row->candidats_id, $row->id_offre);
			$total_p = (isset($p->total_p)) ? $p->total_p : 0;
			$html = '<i class="fa fa-circle" style="font-size: 1.3em;color:'. $this->getPertinanceColor($total_p) .'" data-toggle="popover" data-trigger="hover" data-popover-content="#show_p_'. $row->candidats_id .'"></i>';
			$html .= '<div id="show_p_'. $row->candidats_id .'" class="hidden">';
			if( isset($p->total_p) ) {
				$html .= '<table class="table table-pertinance">';
				$pscores = $this->getPertinanceScores($p);
				foreach ($pscores as $key => $score) :
					$html .= '<tr><td>'. $key .'</td><td>=</td><td>'. $score .'&nbsp;%</td></tr>';
				endforeach;
					$html .= '<tr><td><strong>Pertinence total</strong></td><td>=</td><td><strong>'. $p->total_p .'&nbsp;%</strong></td></tr>';
				$html .= '</table>';
			} else {
				$html .= 'Aucun résultat.</div>';
			}
			$html .= '</div>';
			return $html;
		});

		$table->addColumn('ref_offre', 'Réf', function($row){
			$offre = Candidatures::getOfferById($row->id_offre);
			$row->titre_offre = $offre->Name;
			return $offre->reference;
		});

		$table->addColumn('titre_offre', 'Titre du poste', function($row){
			return $row->titre_offre;
		}, ['width'=> '140px']);

		$table->addColumn('date_cand', 'Date', function($row){
			return '<b>'. date ("d.m.Y", strtotime($row->date_candidature)) .'</b>';
		});

		// Run table and get results
		$table->_run();

		return $table;
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
  	$andWhere = $this->getAndWhereStatement();
  	$joints   = $this->getJoints();
  	$query = "SELECT c.candidats_id, CONCAT(c.nom, ' ',c.prenom) AS fullname, c.email, c.titre, c.ville, c.id_situ, c.id_tfor, c.id_nfor, c.id_expe, c.id_sect, c.id_fonc, c.mobilite, c.id_pays, c.id_salr, c.date_n, c.dateMAJ, c.CVdateMAJ, cand.* FROM candidature cand INNER JOIN candidats c ON c.candidats_id = cand.candidats_id {$joints} WHERE cand.status='". $_GET['id'] ."' {$andWhere} GROUP BY cand.id_candidature";
  	return $query;
  }


  /**
   * Set table action
   *
   * @param string name
   * @param array args
   *
   * @return void
   */
  public function addAction($name, $args=[])
  {
    $this->actions[$name] = array_merge([
    	'label' => 'Sans titre',
      'patern' => '',
      'icon' => '',
      'permission' => true,
      'bulk_action' => true,
      'attributes' => array(
        'class' => 'btn btn-default btn-xs'
      ),
      'callable' => null
    ], $args);
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
					case 'motcle':
						$keywords = explode(" ", mysql_real_escape_string(htmlspecialchars($_GET[$key])));
						$parts = array();
						for ($i = 0; $i < count($keywords); $i++) {
							$parts[] = "(c.nom LIKE '%". $keywords[$i] ."%' OR c.prenom LIKE '%". $keywords[$i] ."%' OR c.titre LIKE '%". $keywords[$i] ."%' OR c.email LIKE '%". $keywords[$i] ."%' OR f.description LIKE '%". $keywords[$i] ."%')";
						}
						$andWhere_array[] = '('. implode(' AND ', $parts) .')';
						break;
					case 'fraicheur':
						$andWhere_array[] = "DATEDIFF(curdate(), c.". reset($column) .")<{$_GET[$key]}";
						break;
					case 'pertinence':
						switch ($_GET[$key]) {
							case '30':
								$andWhere_array[] = key($column) .".". reset($column) ." BETWEEN 0 AND 30";
								break;
							case '60':
								$andWhere_array[] = key($column) .".". reset($column) ." BETWEEN 31 AND 60";
								break;
							case '100':
								$andWhere_array[] = key($column) .".". reset($column) ." BETWEEN 61 AND 100";
								break;
						}
						break;
					default:
						$andWhere_array[] = key($column) .".". reset($column) ."='{$_GET[$key]}'";
						break;
				}
				$andWhere_array[] = "c.status=1";
		}
		return (!empty($andWhere_array)) ? " {$separator} ". implode(' AND ', $andWhere_array) : '';
	}


	/**
	 * Get Joints
	 *
	 * @return string $joints
	 *
	 * @author Mhamed Chanchaf
	 */
	public function getJoints() 
	{
		$joints = [];
		$get_keys = array_keys( array_filter($_GET) );
		foreach ($this->joints as $join_sql => $value) {
			$matches = array_intersect($get_keys, $value);
			if( !empty($matches) ) {
				$joints[] = $join_sql;
			}
		}
		return (!empty($joints)) ? implode(' ', $joints) : '';
	}


	/**
	 * Get pertinence notice
	 *
	 * @return string $notice
	 *
	 * @author Mhamed Chanchaf
	 */
	public function getPertinenceNotice() 
	{
		return '<b style="font-size: 11px;margin: 10px auto 5px;display: block;">* Le point en couleur montre la pertinence de la candidature (<span style="color:#79796A"><a style="color:#00B300">Vert</a>: pertinence bonne, <a style="color:#CC5500;">Orange</a>: pertinence moyenne,  <a style="color:#CC0000">Rouge</a>: pertinence faible  </span></b>';
	}


	/**
   * Get icon by extention
   *
   * @param string $ext 
   * @return string $icon 
   * 
   * @author Mhamed Chanchaf
   */
  public function getIconByExtention($ext) {
    switch ($ext) {
    	case 'pdf':
    		return 'fa fa-file-pdf-o';
    		break;
    	case 'doc' || 'docx':
    		return 'fa fa-file-word-o';
    		break;
    	default:
    		return 'fa fa-file';
    		break;
    }
  }


	/**
   * Get Pertinance Color
   *
   * @param int $total_p 
   * @return string $color 
   * 
   * @author Mhamed Chanchaf
   */
  public function getPertinanceColor($total_p) {
  	if($total_p == 100 ) {
  		return '#00B300';
  	} elseif ($total_p < 100 AND $total_p >= 40) {
  		return '#CC5500';
  	} elseif ($total_p <  40 ){
  		return '#D50000';
  	}
  	return '#000000';
  }


  /**
   * Get Pertinance scores
   *
   * @param object $cp Candidat Pertinance 
   * @return array $scores 
   * 
   * @author Mhamed Chanchaf
   */
  public function getPertinanceScores($cp) {
  	$scores = array();
  	if( $this->pertinence->prm_titre == 1 )   $scores['Pertinence Titre']			= $cp->prm_titre;
  	if( $this->pertinence->prm_expe == 1 )    $scores['Pertinence expérience']		= $cp->prm_expe;
  	if( $this->pertinence->prm_local == 1 )   $scores['Pertinence Ville']			= $cp->prm_local;
  	if( $this->pertinence->prm_tpost == 1 )   $scores['Pertinence Type de poste']  	= $cp->prm_tpost;
  	if( $this->pertinence->prm_fonc == 1 )    $scores['Pertinence Fonction']		= $cp->prm_fonc;
  	if( $this->pertinence->prm_nfor == 1 )    $scores['Pertinence Formation']		= $cp->prm_nfor;
  	if( $this->pertinence->prm_mobil == 1 )   $scores['Pertinence Moblité']			= $cp->prm_mobil;
  	if( $this->pertinence->prm_n_mobil == 1 ) $scores['Pertinence Niveau Mobilité'] = $cp->prm_n_mobil;
  	if( $this->pertinence->prm_t_mobil == 1 ) $scores['Pertinence Taux Mobilité']   = $cp->prm_t_mobil;
  	return $scores;
  }

  


  
} // END Class