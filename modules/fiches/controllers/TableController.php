<?php
/**
 * TableController
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
 *
 * @package app.assets
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Fiches\Controllers;

use App\Controllers\Controller;
use \Modules\Fiches\Models\Fiche;

class TableController extends Controller
{


  	/**
	 * Get table object
	 *
	 * @return object $table
	 *
	 * @author Mhamed Chanchaf
	 */
	public function getTable()
	{
		$query = "SELECT * FROM fiches";
		$table = new \App\Helpers\Table($query, 'id_fiche');
		$table->setTableClass(['table', 'table-striped', 'table-hover']);
		$table->setTableId('ficheTable');
		$table->setOrderby('created_at');
		$table->setOrder('DESC');

		// Add table columns
		$table->addColumn('reference', 'Référence', function($row) {
			return $row->reference;
		});

		$table->addColumn('fiche_type', 'Type', function($row) {
			$types = Fiche::getTypes();
			return $types[$row->fiche_type] ?: $row->fiche_type;
		});

		$table->addColumn('name', 'Titre', function($row) {
			return $row->name;
		});

		$table->addColumn('created_at', 'Date de création', function($row) {
			if( $row->created_at != '' ) {
				return date('d.m.Y H:i', strtotime($row->created_at));
			}
			return null;
		});

		$table->addColumn('updated_at', 'Date de modification', function($row) {
			if( $row->updated_at != '' ) {
				return date('d.m.Y H:i', strtotime($row->updated_at));
			}
			return null;
		});

		$table->setAction('delete', [
			'attributes' => [
				'class' => 'btn btn-danger btn-xs',
				'onclick' => 'return confirm(\'Êtes vous sûr de vouloir supprimer cette fiche ?\')',
			]
		]);

		// Run table and get results
		$table->_run();

		return $table;
	}


	/**
	 * Get Note orale table object
	 *
	 * @return object $table
	 *
	 * @author Mhamed Chanchaf
	 */
	public function getNoteOraleTable()
	{
		$query = "
	      SELECT r.nom, fc.comments, fc.created_at, fc.updated_at, COUNT(fcr.id_result) AS nbr, SUM(fcr.value) AS total
	      FROM fiches f
	      JOIN fiche_candidature fc ON fc.id_fiche=f.id_fiche
	      JOIN fiche_candidature_results fcr ON fcr.id_fiche_candidature=fc.id_fiche_candidature
	      JOIN root_roles r ON r.id_role=fc.id_evaluator
	      WHERE fc.id_candidature=".$_POST['id_candidature']." AND f.fiche_type=1 GROUP BY fcr.id_fiche_candidature
	    ";
		$table = new \App\Helpers\Table($query, 'id_fiche', [
			'currentPage' => $_POST['page'],
			'actions' => false,
			'show_before_table_form' => false
		]);
		$table->setTableClass(['table', 'table-striped', 'table-hover']);
		$table->setTableId('noteOraleTable');
		$table->setOrderby('updated_at');
		$table->setOrder('DESC');


		$table->addColumn('nom', 'Évaluateur', function($row) {
			return $row->nom;
		});

		$table->addColumn('created_at', 'Date de création', function($row) {
			if( $row->created_at != '' ) {
				return date('d.m.Y H:i', strtotime($row->created_at));
			}
			return null;
		});

		$table->addColumn('updated_at', 'Date de modification', function($row) {
			if( $row->updated_at != '' ) {
				return date('d.m.Y H:i', strtotime($row->updated_at));
			}
			return null;
		});

		$table->addColumn('comments', 'Commentaire(s)', function($row) {
			return $row->comments;
		});

		$table->addColumn('note', 'Note', function($row) {
			$note_orale = number_format($row->total/$row->nbr, 2);
			$color = $this->percent2Color($note_orale, 200, 4);
			return '<span class="badge" style="background-color:#'.$color.';padding: 1px 5px 2px;">'.$note_orale.'</i>';
		});

		// Run table and get results
		$table->_run();

		return $table;
	}


  
} // END Class