<style>
	.espace_candidat:hover{
		color: #fff;
		padding-bottom: 3px;
	}
	#chm-table tbody td {
    padding: 4px;
	}
</style>
<?php
use Modules\Workflows\Models\Workflow;

$query = "
	SELECT h1.*, w.name AS wf_name, w.value AS wf_value, w.custom, o.Name AS nom_offre, r.nom AS nom_validateur
	FROM workflow_history h1
	JOIN (SELECT id_offre, MAX(id_history) id_history FROM workflow_history GROUP BY id_offre) h2 ON h1.id_history = h2.id_history AND h1.id_offre = h2.id_offre
	LEFT JOIN workflows AS w ON w.id_workflow=h1.id_workflow
	LEFT JOIN offre AS o ON o.id_offre=h1.id_offre
	LEFT JOIN root_roles AS r ON r.id_role=h1.created_by
";
/*
SELECT h.*, o.Name AS nom_offre, r.nom AS nom_validateur
FROM workflow_history AS h 
LEFT JOIN offre AS o ON o.id_offre=h.id_offre
LEFT JOIN root_roles AS r ON r.id_role=h.created_by
GROUP BY h.id_offre DESC
*/
$table = new \App\Helpers\Table($query, 'id_offre');
$table->setTableClass(['table', 'table-striped']);
$table->setHeaders([
	"id_history" => "#",
	"nom_offre" => trans("Titre de l'offre"),
	"wf_name" => trans("Workflow"),
	"status" => trans("Statut"),
	"current_step" => trans("Étape"),
	"nom_validateur" => trans("Validateur"),
	"created_at" => trans("Date de validation"),
]);

$table->setSortables(['nom_offre', 'nom_validateur', 'status', 'created_at']);
$table->setTemplates([
	'id_history' => function($row) {	
		return $row->object->getIncrement();
	},
	'status' => function($row) {	
		return Workflow::getStatusLabelByName($row->status);
	},
	'current_step' => function($row) {
		$value = json_decode($row->wf_value);
		$count_steps = (isset($value->recruteurs)) ? count($value->recruteurs) : count($value->steps);
    $count = getDB()->prepare("SELECT COUNT(*) AS nbr FROM workflow_history WHERE id_offre=?", [$row->id_offre], true);
		return ($count->nbr - 1) .'/'. $count_steps;
	},
	'created_at' => function($row) {	
		return date('d/m/Y H:i', strtotime($row->created_at));
	} 
]);

if($_SESSION['abb_admin'] == 'root') {
	$table->removeActions(['edit']);
	$table->setAction('delete', [
    'patern' => site_url('backend/module/workflows/workflow/delete/{id_offre}'),
    'attributes' => [
    	'class' => 'btn btn-danger btn-xs',
    	'onclick' => "return confirm('". trans_e("Etes vous sur ?") ."')"
    ]
  ]);
} else {
	$table->removeActions(['edit', 'delete']);
}

$table->setAction('details', [
'label' => trans("Détails"),
    'patern' => site_url('backend/module/workflows/workflow/details/{primary_key}'),
    'icon' => 'fa fa-eye',
    'attributes' => [
    	'class' => 'btn btn-default btn-xs'
    ],
    'show_label' => true
]);
$table->setAction('takers', [
'label' => trans("Preneurs"),
    'patern' => site_url('backend/module/workflows/workflow/takers/{primary_key}'),
    'icon' => 'fa fa-users',
    'attributes' => [
    	'class' => 'btn btn-default btn-xs'
    ],
    'show_label' => true,
    'permission' => function($row) {
    	return ($_SESSION['abb_admin'] == 'root' && $row->custom == 0);
    }
]);

// $table->setPerpage(1);
$table->setOrderby('created_at');
$table->setOrder('DESC');

echo '<a href="'. site_url('backend/module/workflows/workflow/builder') .'" class="btn btn-primary btn-sm mb-15"><i class="fa fa-code-fork"></i>&nbsp;'. trans("Gérer les workflows") .'</a>';

get_flash_message();

$table->render();