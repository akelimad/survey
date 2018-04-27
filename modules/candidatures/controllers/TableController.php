<?php
/**
 * TableController
 *
 * @author mchanchaf
 *
 * @package modules.candidatures.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Candidatures\Controllers;

use App\Event;
use App\Controllers\Controller;
use Modules\Candidatures\Models\Candidat;
use Modules\Candidatures\Models\Candidatures;
use Modules\Fiches\Models\Fiche;

use App\Models\Resume;
use App\Models\MotivationLetter;

class TableController extends Controller
{

	private $andWhere = [
		'motcle' 		 => ['c' => 'motcle'], 
		'fonc' 	 		 => ['c' => 'id_fonc'], 
		'situ' 	 		 => ['c' => 'id_situ'], 
		'sect' 	 		 => ['c' => 'id_sect'], 
		'exp'  	 		 => ['c' => 'id_expe'], 
    'nfor'       => ['c' => 'id_nfor'], 
		'dfor' 	 		 => ['cand' => 'domaine_formation_id'], 
		'tfor' 	 		 => ['c' => 'id_tfor'], 
		'fraicheur'  => ['c' => 'CVdateMAJ'], 
		'pays' 			 => ['c' => 'id_pays'],
		'ville'			 => ['c' => 'ville'],
		'ref_offre'  => ['cand' => 'id_offre'],
		'pertinence' => ['cand' => 'pertinence'],
		'ecole' 		 => ['f' => 'id_ecol'],
    'campagne'   => ['co' => 'id_compagne'],
		'age' 	 => ['c' => 'date_n'],
	];

	private $joints = [
		'JOIN formations f ON f.candidats_id=cand.candidats_id' => ['motcle', 'ecole'], 
		'JOIN compagne_offres co ON co.id_offre=cand.id_offre' => ['campagne']
	];

	private $actions = [
    'change_status' => [
      'label' => 'Editer le statut de cette candidature',
      'patern' => '#',
      'icon' => 'fa fa-pencil',
      'callback' => 'showChangeSatatusPopup',
      'bulk_action' => false,
      'attributes' => [
        'class' => 'btn btn-success btn-xs',
      ],
      'permission' => 'can_view_action'
    ],
    'send_cv_mail' => [
      'label' => 'Transférer le CV',
      'bulk_label' => 'Transférer le CV',
      'patern' => '#',
      'icon' => 'fa fa-send-o',
      'callback' => 'showSendCVEmailPopup',
      'bulk_action' => false,
      'attributes' => [
        'class' => 'btn btn-default btn-xs',
      ],
      'permission' => 'can_view_action'
    ],
    'send_mail' => [
      'label' => 'Envoyer un email au candidat',
      'bulk_label' => 'Envoyer un email',
      'patern' => '#',
      'icon' => 'fa fa-envelope-o',
      'callback' => 'showSendEmailPopup',
      'attributes' => [
        'class' => 'btn btn-info btn-xs',
      ],
      'permission' => 'can_view_action'
    ],
    'note_ecrit' => [
      'label' => 'Afficher la note écrite',
      'patern' => '#',
      'icon' => 'fa fa-trophy',
      'bulk_action' => false,
      'attributes' => [
        'class' => 'btn btn-primary btn-xs',
        'onclick' => 'return showNoteEcritPopup({id_candidature})'
      ],
      'permission' => 'can_view_action'
    ],
    'attachments' => [
      'label' => 'Ajouter des pièces jointes',
      'patern' => '#',
      'icon' => 'fa fa-files-o',
      'callback' => 'showAttachmentsPopup',
      'bulk_action' => false,
      'attributes' => [
        'class' => 'btn btn-default btn-xs',
      ],
      'permission' => 'can_view_action'
    ],
    'share_candidature' => [
      'label' => 'Partager la candidature',
      'bulk_label' => 'Partager les candidatures',
      'patern' => '#',
      'icon' => 'fa fa-share-alt',
      'callback' => 'showShareCandidaturePopup',
      'attributes' => [
        'class' => 'btn btn-success btn-xs',
      ],
      'permission' => 'can_view_action'
    ],
    'assign_to_offer' => [
      'label' => "Affecter à une offre",
      'patern' => '/backend/candidatures/assign-to-offer',
      'icon' => 'fa fa-paperclip',
      'bulk_action' => false,
      'callback' => 'assignToOffer',
      'attributes' => [
        'class' => 'btn btn-primary btn-xs',
        'style' => 'margin-left:3px;'
      ],
      'permission' => 'can_view_action'
    ],
    'change_offre' => [
      'label' => "Changer l'offre",
      'patern' => '#',
      'icon' => 'fa fa-retweet',
      'bulk_action' => false,
      'attributes' => [
        'class' => 'btn btn-warning btn-xs',
        'onclick' => 'return showChangeOffrePopup({id_candidature}, {id_offre})'
      ],
      'permission' => 'can_view_action'
    ],
    'fiche_evaluation' => [
      'label' => 'Évaluer ce candidat',
      'patern' => '#',
      'icon' => 'fa fa-file-text-o',
      'callback' => 'showFicheEvaluationPopup',
      'sort_order' => 6,
      'bulk_action' => false,
      'attributes' => [
        'class' => 'btn btn-default btn-xs',
      ],
      'permission' => 'can_view_action'
    ],
    'cand_messages' => [
      'label' => 'Messagerie',
      'patern' => '/backend/message/candidature/{id_candidature}/messages',
      'icon' => 'fa fa-comments-o',
      'sort_order' => 7,
      'bulk_action' => false,
      'attributes' => [
        'class' => 'btn btn-default btn-xs',
      ],
      'permission' => 'can_view_action'
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
			'show_links_first_last' => false,
      'head_actions_width' => '105px'
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
  public function getTable($id)
  {
    $this->params['options']['actions'] = (is_null($id) || $id != 53);

  	$query = $this->buildQuery($id);
  	$table = new \App\Helpers\Table($query, 'id_candidature', $this->params['options']);
  	$table->setTableClass(['table', 'table-striped', 'table-hover']);
  	$table->setTableId('candidatureTable');
  	$table->removeActions(['edit', 'delete']);
  	$table->setTrigger('table_notes', [$this, 'getPertinenceNotice']);

    if( $id == 35 ) {
  	  $table->setOrderby('cand.note_ecrit'); 
    } else {
      $table->setOrderby('cand.'. $this->getDateField($id)); 
    }
    
  	$table->setOrder('DESC');
    $table->setSortables(['note_ecrit', 'note_orale', 'date_cand']);

  	foreach ($this->actions as $key => $attributes) {
  		if( isset($this->params['actions'][$key]) && $this->params['actions'][$key] == false ) continue;
  		$table->setAction($key, $attributes);
  	}

		// Add table columns
  	$table->addColumn('sinfos', trans("Informations"), function($row){
  		$html = '<a href="'. site_url('backend/cv/?candid='.$row->candidats_id) .'" target="_blank" class="cname" title="'. trans("Voir le profile") .'"><i class="fa fa-user"></i>&nbsp;'. $row->fullname .'</a>';

  		if( !is_null($row->date_n) ) {
  			if( $birthday = \eta_date($row->date_n, 'Y-m-d') ) {
    			$age = (time() - strtotime($birthday)) / 3600 / 24 / 365;
    			$html .= '<br><b>'.number_format($age, 0).' ans</b>';
        }
  		}

  		$html .= '<br>'. $row->ville .'&nbsp;|&nbsp;'. Candidat::getPaysByID($row->id_pays);

  		return $html;
  	});

  	$table->addColumn('history', '', function($row){
  		$history = getDB()->prepare("SELECT id, date_modification, status, utilisateur FROM historique WHERE id_candidature=?", [$row->id_candidature]);
  		if ( empty($history) ) return;
  		$html = '<i class="fa fa-history pull-right" data-toggle="popover" data-trigger="click" data-popover-content="#show_h_'. $row->candidats_id .'" title="'. trans("Historique des actions effectuées") .'"></i>';
  		$html .= '<div id="show_h_'. $row->candidats_id .'" class="hidden">';
  		$html .= '<table class="table table-history">';
  		foreach ($history as $key => $h) :
  			$html .= '<tr><td width="110">'. date('d.m.Y H:i', strtotime($h->date_modification)) .'</td><td width="110">'. $h->status .'</td><td width="40">'. $h->utilisateur .'</td><td>';
        if( in_array($h->status, ['Préselectionnés', 'Présélectionné', 'Non présélectionné', 'Non préselectionnés']) ) {
          if( Fiche::historyFicheExists($row->id_candidature, $h->id) ) {
            $html .= '<a href="jaavscript:void(0);" onclick="return showFicheDetails('.$h->id.');"><i class="fa fa-file-text-o"></i></a>';
          }
        }
        $html .='</td></tr>';
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
  		$html .= '<td width="88px">'. trans("Expérience") .'</td>';
  		$html .= '<td>'.Candidat::getExperienceNameByID($row->id_expe).'</td>';
  		$html .= '</tr>';
  		$html .= '<tr>';
  		$html .= '<td>'. trans("Salaire souhaité") .'</td>';
  		$html .= '<td>'.Candidat::getSalaireNameByID($row->id_salr).'</td>';
  		$html .= '</tr>';
  		$html .= '<tr>';
  		$html .= '<td>'. trans("Fraicheur du cv") .'</td>';
  		$html .= '<td>'.timeAgo($row->dateMAJ).'</td>';
  		$html .= '</tr>';
  		$html .= '<tr>';
  		$html .= '<td>'. trans("Mobilité") .'</td>';
  		$html .= '<td><span class="label label-'.$mobiliteClass.'">'. $mobilite .'</span></td>';
  		$html .= '</tr>';
  		$html .= '</tbody>';
  		$html .= '</table>';

  		return $html;
  	}, ['attributes' => ['width'=> '180px']]);

  	$table->addColumn('details', trans("Détails"), function($row){
  		$details = '';

      if (!isset($row->id_cv)) {
        $cv = Resume::getByCandidatId($row->candidats_id, true);
        $row->id_cv = $cv->id_cv;
      }

  		if(isset($row->id_cv) && intval($row->id_cv) > 0 ) {
  			$cv_ext = Resume::getExtension($row->id_cv);
  			if( !is_null($cv_ext) ) {
  				$icon = $this->getIconByExtention($cv_ext);
  				$details .= '<a href="'. site_url('backend/module/candidatures/candidat/cv/'.$row->id_cv) .'" title="'. trans("Télécharger le CV") .'"><i class="'.$icon.'"></i></a>';
  			}
  		}

      if (!isset($row->id_cv)) {
        $lm = MotivationLetter::getByCandidatId($row->candidats_id, true);
        $row->id_lettre = $lm->id_lettre;
      }

  		if(isset($row->id_lettre) && intval($row->id_lettre) > 0 ) {
  			$lettre_ext = MotivationLetter::getExtension($row->id_lettre);
  			if( !is_null($lettre_ext) ) {
  				$icon = $this->getIconByExtention($lettre_ext);
  				$details .= '&nbsp;<a href="'. site_url('backend/module/candidatures/candidat/lettre/'.$row->id_lettre) .'" title="'. trans("Télécharger la lettre de motivation") .'"><i class="'.$icon.'"></i></a>';
  			}
  		}
  		return $details;
  	});

    // Hide column for candidaure spotanees an stage
    if (!in_array($id, ['spontanees', 'stage'])) {
    	$table->addColumn('pertinence', 'P', function($row){
    		$p = Candidat::getPertinance($row->candidats_id, $row->id_offre);
    		$total_p = (isset($p->total_p)) ? $p->total_p : 0;
    		$html = '<i class="fa fa-circle" style="font-size: 1.3em;color:'. $this->getPertinanceColor($total_p) .'" data-toggle="popover"  title="'. trans("Pertinence") .'" data-trigger="click" data-popover-content="#show_p_'. $row->candidats_id .'"></i>';
    		$html .= '<div id="show_p_'. $row->candidats_id .'" class="hidden">';
    		if( isset($p->total_p) ) {
    			$html .= '<table class="table table-pertinance">';
    			$pscores = $this->getPertinanceScores($p);
    			foreach ($pscores as $key => $score) :
    				$html .= '<tr><td>'. $key .'</td><td>=</td><td>'. $score .'&nbsp;%</td></tr>';
    			endforeach;
    			$html .= '<tr><td><strong>'. trans("Pertinence total") .'</strong></td><td>=</td><td><strong>'. $p->total_p .'&nbsp;%</strong></td></tr>';
    			$html .= '</table>';
    		} else {
    			$html .= trans("Aucun résultat.") .'</div>';
    		}
    		$html .= '</div>';
    		return $html;
    	}, ['attributes' => ['title' => trans("Pertinence")]]);

    	$table->addColumn('note_ecrit', 'NE', function($row){
        global $id;
    		if( is_valid_int($row->note_ecrit) ) {
    			$value = ($row->note_ecrit==0.00) ? 0 : $row->note_ecrit;
    			$color = $this->percent2Color($row->note_ecrit, 200, 20);
    			$style = 'background-color:#'.$color.';';
    			$tooltip = '';
    		} else {
    			$value = '<i class="fa fa-times" style="font-size: 10px;"></i>';
    			$style = '';
    			$tooltip = 'data-toggle="tooltip" title="'. trans("Non défini.") .'"';
    		}
        if($id != 53) {
          return '<span class="badge" style="'.$style.'padding: 1px 5px 2px;" onclick="return showNoteEcritPopup('.$row->id_candidature.')" '.$tooltip.'>'.$value.'</i>';
        } else {
    		  return '<span class="badge" style="'.$style.'padding: 1px 5px 2px;" '.$tooltip.'>'.$value.'</i>';
        }
    	}, ['attributes' => ['title' => trans("Note écrite")]]);


      // FICHES D'EVALUATION 
      $table->addColumn('note_orale', 'NO', function($row){
        global $id;
        if( is_valid_int($row->note_orale) ) {
          $value = ($row->note_orale==0.00) ? 0 : $row->note_orale;
          $color = $this->percent2Color($row->note_orale, 200, 4);
          $style = 'background-color:#'.$color.';';
          $tooltip = '';
        } else {
          $value = '<i class="fa fa-times" style="font-size: 10px;"></i>';
          $style = '';
          $tooltip = 'data-toggle="tooltip" title="'. trans("Non défini.") .'"';
        }
        if($id != 53) {
          return '<span class="badge" style="'.$style.'padding: 1px 5px 2px;" onclick="return showNoteOralePopup('.$row->id_candidature.')" '.$tooltip.'>'.$value.'</i>';
        } else {
          return '<span class="badge" style="'.$style.'padding: 1px 5px 2px;" '.$tooltip.'>'.$value.'</i>';
        }
      }, ['attributes' => ['title' => trans("Note Orale")]]);

    	$table->addColumn('titre_offre', trans("Titre du poste"), function($row){
        // $offre = Candidatures::getOfferById($row->id_offre);
    		return $row->offre_name;
    	}, ['attributes' => ['width'=> '120px']]);
    }


  	$table->addColumn('date_cand', trans("Date"), function($row){
  		return '<b>'. date ("d.m.Y", strtotime($row->date_cand)) .'</b>';
  	});

		// TODO - Run table and get results
		// Event::trigger('before_run_candidature_table', ['table' => $table]);

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
  public function buildQuery($id)
  {
    $field_date = $this->getDateField($id);
    $table = $this->getTableName($id);
    
    $status = ($id == 53) ? trans("Archivée") : trans("En cours");
    $condition = " WHERE o.status='". $status ."'";

    if($id != 53) $condition .= " AND cand.status=". $id;

    $condition .= $this->getAndWhereStatement('AND');

  	$joints = $this->getJoints();
    if( !isAdmin() ) {
      $condition .= " AND rc.id_role=". $_SESSION['id_role'];
      $joints .= ' JOIN role_candidature rc ON rc.id_candidature = cand.id_candidature';
    }

    if (!in_array($id, ['spontanees', 'stage'])) {
      $fields = ', o.status AS offre_status, o.Name AS offre_name';
      $joints .= ' JOIN offre o ON o.id_offre = cand.id_offre';
    } else {
      $fields = '';
      $condition = '';
    }

  	$query = "
      SELECT c.candidats_id, CONCAT(c.nom, ' ',c.prenom) AS fullname, c.email, c.titre, c.ville, c.id_situ, c.id_tfor, c.id_nfor, c.id_expe, c.id_sect, c.id_fonc, c.mobilite, c.id_pays, c.id_salr, c.date_n, c.dateMAJ, c.CVdateMAJ, cand.*, cand.{$field_date} as date_cand {$fields}
      FROM {$table} cand 
      JOIN candidats c ON c.candidats_id = cand.candidats_id
      {$joints} {$condition} GROUP BY cand.id_candidature";

  	return $query;
  }

  private function getDateField($id) {
    switch ($id) {
      case 'spontanees':
        return 'date_cs';
        break;
      case 'stage':
        return 'date';
        break;
      default:
        return 'date_candidature';
        break;
    }
  }

  private function getTableName($id) {
    switch ($id) {
      case 'spontanees':
        return 'candidature_spontanee';
        break;
      case 'stage':
        return 'candidature_stage';
        break;
      default:
        return 'candidature';
        break;
    }
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
        case 'age':
        $parts = explode('-', $_GET[$key]);
        if (isset($parts[1])) {
          if ($parts[0] == 0) {
            $andWhere_array[] = "TIMESTAMPDIFF(YEAR, date_n, CURDATE()) <= ". $parts[1];
          } else if ($parts[1] == 0) {
            $andWhere_array[] = "TIMESTAMPDIFF(YEAR, date_n, CURDATE()) >= ". $parts[0];
          } else {
            $andWhere_array[] = "TIMESTAMPDIFF(YEAR, date_n, CURDATE()) BETWEEN ". $parts[0] ." AND ". $parts[1];
          }
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
		return '<b style="font-size: 11px;margin: 10px auto 5px;display: block;">'. trans("* Le point en couleur montre la pertinence de la candidature") .' (<span style="color:#79796A"><a style="color:#00B300">'. trans("Vert") .'</a>: '. trans("pertinence bonne,") .' <a style="color:#CC5500;">'. trans("Orange") .'</a>: '. trans("pertinence moyenne,") .' <a style="color:#CC0000">'. trans("Rouge") .'</a>: '. trans("pertinence faible") .' </span></b>';
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
  	if( $this->pertinence->prm_titre == 1 )   $scores[trans("Pertinence Titre")]			= $cp->prm_titre;
  	if( $this->pertinence->prm_expe == 1 )    $scores[trans("Pertinence expérience")]		= $cp->prm_expe;
  	if( $this->pertinence->prm_local == 1 )   $scores[trans("Pertinence Ville")]			= $cp->prm_local;
  	if( $this->pertinence->prm_tpost == 1 )   $scores[trans("Pertinence Type de poste")]  	= $cp->prm_tpost;
  	if( $this->pertinence->prm_fonc == 1 )    $scores[trans("Pertinence Fonction")]		= $cp->prm_fonc;
  	if( $this->pertinence->prm_nfor == 1 )    $scores[trans("Pertinence Formation")]		= $cp->prm_nfor;
  	if( $this->pertinence->prm_mobil == 1 )   $scores[trans("Pertinence Moblité")]			= $cp->prm_mobil;
  	if( $this->pertinence->prm_n_mobil == 1 ) $scores[trans("Pertinence Niveau Mobilité")] = $cp->prm_n_mobil;
  	if( $this->pertinence->prm_t_mobil == 1 ) $scores[trans("Pertinence Taux Mobilité")]   = $cp->prm_t_mobil;
  	return $scores;
  }


  
} // END Class