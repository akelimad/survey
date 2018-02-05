<?php 
$db = getDB();
$id_workflow = (isset($workflow->id_workflow)) ? $workflow->id_workflow : 0;
$custom = (isset($workflow->custom)) ? $workflow->custom : 0;
$value  = (isset($workflow->value)) ? json_decode($workflow->value) : new \stdClass;

// Prepare recruteurs json
$recruteurs_json = '';
if(isset($value->recruteurs) && !empty($value->recruteurs)) : 
  $recruteurs_arr = [];
  foreach ($value->recruteurs as $key => $id_role) :
    $user = $db->findByColumn('root_roles', 'id_role', $id_role, ['limit' => 1]);
    if( !isset($user->nom) ) continue;
    $recruteurs_arr[] = ['id_role' => $id_role, 'nom' => $user->nom];
  endforeach;
  $recruteurs_json = htmlentities(json_encode($recruteurs_arr));
endif;

// Prepare validateurs json
$validateurs_json = '';
if(isset($value->validateurs) && !empty($value->validateurs)) : 
  $validateurs_arr = [];;
  foreach ($value->validateurs as $key => $id_role) :
    $user = $db->findByColumn('root_roles', 'id_role', $id_role, ['limit' => 1]);
    if( !isset($user->nom) ) continue;
    $validateurs_arr[] = ['id_role' => $id_role, 'nom' => $user->nom];
  endforeach; 
  $validateurs_json = htmlentities(json_encode($validateurs_arr));
endif;


?>
<tr>
  <td colspan="2">
    <div class="ligneBleu"></div>
  </td>
</tr>

<?php if(!isset($workflow->id_workflow)) : ?>
<tr>
  <td width="169">Type de workflow</td>
  <td width="503">
    <div class="btn-group" data-toggle="buttons">
      <label class="btn btn-default btn-xs active">
        <input type="radio" name="wf_type" value="default" autocomplete="off" checked> Pr&eacute;&eacute;tablie
      </label>
      <label class="btn btn-default btn-xs">
        <input type="radio" name="wf_type" value="custom" autocomplete="off"> Personnalis&eacute;
      </label>
    </div>
  </td>
</tr>   
<?php else : ?>
  <input type="hidden" name="id_wf" value="<?= $id_workflow; ?>">
  <input type="hidden" name="wf_type" value="<?= ($custom == 0) ? 'default' : 'custom'; ?>" autocomplete="off" checked>
<?php endif; ?>

<tr class="type_custom" <?= ($custom == 0) ? 'style="display: none;"' : ''; ?>>
  <td width="169">Recruteurs</td>
  <td width="503">
    <input type="text" name="wf_recruteurs" id="wf_recruteurs" value="<?= $recruteurs_json; ?>" class="search-users" placeholder="Rechercher..." style="width: 160px;">
  </td>
</tr>
<tr class="type_custom" <?= ($custom == 0) ? 'style="display: none;"' : ''; ?>>
  <td width="169">Validateurs</td>
  <td width="503">
    <input type="text" name="wf_validateurs" id="wf_validateurs" value="<?= $validateurs_json; ?>" class="search-users" placeholder="Rechercher..." style="width: 160px;">
  </td>
</tr> 

<tr class="type_default" <?= ($custom == 1) ? 'style="display: none;"' : ''; ?>>
  <td width="169">Workflow &#224; appliquer</td>
  <td width="503">
    <?php if(isset($workflow->id_workflow)) : ?>
      <select id="id_workflow" style="width: 512px;" disabled>
        <option value=""><?= $workflow->name; ?></option>
      </select>
    <?php else : ?>
      <select name="id_workflow" id="id_workflow" style="width: 512px;">
        <option value=""></option>
        <?php 
          $workflows = getDB()->prepare("SELECT id_workflow, name FROM workflows WHERE custom=?", [0]); 
          if( !empty($workflows) ) : foreach ($workflows as $key => $w) : ?>
          <option value="<?= $w->id_workflow; ?>"><?= $w->name; ?></option>
        <?php endforeach; endif; ?>
      </select>
    <?php endif; ?>
  </td>
</tr>

<tr>
  <td colspan="2">
    <div class="ligneBleu"></div><br>
  </td>
</tr>