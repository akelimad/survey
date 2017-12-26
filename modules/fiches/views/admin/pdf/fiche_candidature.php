<?php use \Modules\Fiches\Models\Fiche; 

$hasItems = false;
$noteGenerale = $countItems = 0;
?>

<style>
body {
	font-family: Calibri,Arial,sans-serif;
}
table th{
	text-align: left;
}
</style>


<table style="width:800px;margin:0px auto 30px;" border="1" cellspacing="0" cellpadding="5">
  <tr>
    <td width="40%" rowspan="3" align="center">
    	<img src="<?= module_url(__FILE__, 'assets/img/header-logo.png') ?>">
    </td>
    <th width="25%">Référence</th>
    <td width="35%"><?= $fiche->reference; ?></td>
  </tr>
  <tr>
    <th>Date</th>
    <td><?= english_to_french_datetime($fc->created_at); ?></td>
  </tr>
  <tr>
    <th>Évaluateur</th>
    <td><?= $evaluator->nom ?></td>
  </tr>
  <tr>
    <td colspan="3" align="center"><h3 style="margin: 0px;"><?= $name ?></h3></td>
  </tr>
</table>


<table style="width:800px;margin:0px auto 30px;" border="1" cellspacing="0" cellpadding="5">
  <tr>
    <th colspan="2" style="text-align: center;"><h2 style="margin: 0px;">IDENTITE</h2></th>
  </tr>
  <tr>
    <td width="200">Nom et prénom du candidat</td>
    <td><?= $result->displayName; ?></td>
  </tr>
  <tr>
    <td width="200">Candidature pour le poste</td>
    <td><?= $result->offreName; ?></td>
  </tr>
</table>



<?php foreach (Fiche::getBlocksByFicheType($fiche->fiche_type) as $key => $block) : 
$block_items = Fiche::getBlockItems($block->id_block, $fiche->id_fiche);
if( empty($block_items) ) continue;
$hasItems = true;
?>
<table style="width:800px;margin:0px auto 15px;" border="1" cellspacing="0" cellpadding="5">
	<tr>
    <th style="padding: 3px 5px;background-color: #003E78;color: #fff;"><?= $block->name; ?></th>
    <th width="120" align="center" style="padding: 3px 5px;background-color: #003E78;color: #fff;">
      <?php if( in_array($block->fields_type, ['select', 'number']) ) : ?>Note (1 à 4)<?php endif; ?>
    </th>
    <?php if( $block->show_observations == '1' ) : ?>
      <th style="padding: 3px 5px;background-color: #003E78;color: #fff;">Observations</th>
    <?php endif; ?>
  </tr>

  <?php foreach ($block_items as $key => $item) : 
    $blockItem = null;
    if (isset($fc->id_fiche_candidature)) {
      $blockItem = Fiche::getBlockItem($fc->id_fiche_candidature, $block->id_block, $item->id_item);                    
    }
    $noteGenerale += (isset($blockItem->value)) ? $blockItem->value : 0;
    $countItems += 1;
    ?>
    <tr>
      <td style="padding: 5px; vertical-align: middle;">
        <strong><?= $item->name; ?></strong>
      </td>
      <td width="120" align="center" style="padding: 5px;">
        <?php if( $block->fields_type == 'checkbox' ) : ?>
         <?= (isset($blockItem->value) && $blockItem->value=='1') ? '<span class="label label-success">Oui</span>' : '<span class="label label-danger">Non</span>';?>
       <?php elseif( in_array($block->fields_type, ['select', 'number']) ) : ?>
        <span style="padding:0px 5px;"><?= (isset($blockItem->value)) ? $blockItem->value : 0; ?></span>
      <?php endif; ?>
    </td>
    <?php if( $block->show_observations == '1' ) : ?>
      <td width="120" style="padding: 5px;"><?= (isset($blockItem->observations)) ? $blockItem->observations : '';?></td>
    <?php endif; ?>
  </tr>
  <?php endforeach; ?>

</table>
<?php endforeach; ?>       


<?php if($fiche->fiche_type == 1) : ?>
<table style="width:800px;margin:0px auto 15px;" border="1" cellspacing="0" cellpadding="5">
  <tr>
    <th align="left">Note générale</th>
    <th width="120" style="text-align: center;"><?= number_format(($noteGenerale/$countItems), 2); ?></th>
    <?php if( $block->show_observations == '1' ) : ?>
      <th width="120"></th>
    <?php endif; ?>
  </tr>
</table>
<?php endif; ?>


<!-- Fiche d’évaluation - footer -->
<?php if($fiche->fiche_type == 1) : ?>
	<table style="width:800px;margin:0px auto;" border="0" cellspacing="0" cellpadding="5">
   <tr>
     <th width="70%">Avis final de l’évaluateur</th>
     <td width="10"></td>
     <th>Signature</th>
   </tr>
   <tr>
     <td height="100" style="vertical-align:top;border: 2px solid #000;"><?= $fc->comments; ?></td>
     <td></td>
     <td style="vertical-align:top;border: 2px solid #000;"></td>
   </tr>
 </table>
<?php endif; ?>


<!-- Fiche de présélection - footer --> 
<?php if($fiche->fiche_type == 0) : ?>
  <table style="width:800px;margin:0px auto 30px;" border="1" cellspacing="0" cellpadding="5">
    <tr>
      <th width="190" height="100">Décision</th>
      <td><label><input type="checkbox">Eliminé</label></td>
      <td><label><input type="checkbox">Retenu</label></td>
    </tr>
  </table>

  <table style="width:800px;margin:0px auto 30px;" border="1" cellspacing="0" cellpadding="5">
    <tr>
      <th width="190" height="100">Commentaire(s)</th>
      <td><?= $fc->comments; ?></td>
    </tr>
  </table>

  <table style="width:800px;margin:0px auto;" border="1" cellspacing="0" cellpadding="5">
    <tr>
      <th rowspan="2" width="180">Signatures des Directeurs concernés (minimum, deux signatures / 4)</th>
      <?php for ($i=0; $i < count($evaluators); $i++) : ?>
       <th><?= $evaluators[$i]->nom; ?></th>
     <?php endfor; ?>
   </tr>
   <tr>
    <?php for ($i=0; $i < count($evaluators); $i++) : ?>
    	<th></th>
    <?php endfor; ?>
  </tr>
</table>
<?php endif; ?>