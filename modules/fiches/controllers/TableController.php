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

use \Modules\Fiches\Models\Fiche;

class TableController
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




  
} // END Class