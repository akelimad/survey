<?php
/**
 * AttachmentController
 *
 * @author mchanchaf
 *
 * @package modules.candidatures.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Candidatures\Controllers;


class AttachmentController
{


  	/**
	 * Get table object
	 *
	 * @return object $table
	 *
	 * @author Mhamed Chanchaf
	 */
	public function getTable($id_candidature, $options=[])
	{
		$query = "SELECT * FROM `candidature_attachments` WHERE `id_candidature`=".$id_candidature;
		$table = new \App\Helpers\Table($query, 'id_attachment', $options);
		$table->setTableClass(['table', 'table-striped', 'table-hover' , 'mb-5']);
		$table->setTableId('attachmentsTable');
		$table->setOrderby('id_attachment');
		$table->setOrder('DESC');

		$table->setAction('save_title', [
            'label' => 'Sauvegarder',
            'patern' => '#',
            'callback' => 'saveAttachementTitle',
            'icon' => 'fa fa-save',
            'sort_order' => 1,
            'attributes' => array(
                'class' => 'btn btn-success btn-xs',
                'style' => 'display:none;margin-left: -7px;'
            )
		]);

		$table->setAction('download', [
            'label' => 'Télécharger',
            'patern' => site_url('uploads/candidatures/{id_candidature}/attachments/{file_name}'),
            'icon' => 'fa fa-download',
            'sort_order' => 1,
            'attributes' => array(
                'class' => 'btn btn-default btn-xs'
            )
		]);

		$table->setAction('edit', [
            'patern' => '#',
            'callback' => 'editCandidatureAttachment',
            'sort_order' => 2
		]);

		$table->setAction('delete', [
            'patern' => '#',
            'callback' => 'deleteCandidatureAttachment',
            'sort_order' => 3
		]);

		$table->addColumn('title', 'Titre', function($row) {
			return '<input type="hidden" class="title_input" value="'.$row->title.'"><strong class="title" data-toggle="tooltip" data-placement="right" title="Cliquer pour télécharger"><a href="'.site_url('uploads/candidatures/'.$row->id_candidature.'/attachments/'.$row->file_name).'" target="_blank">'.$row->title.'</a></strong>';
		});

		$table->addColumn('created_at', 'Date de création', function($row){
			return date("d.m.Y H:i", strtotime($row->created_at));
		});

		$table->addColumn('updated_at', 'Date de modification', function($row){
			return date("d.m.Y H:i", strtotime($row->updated_at));
		});

		$table->_run();

		return $table;
	}




  
} // END Class