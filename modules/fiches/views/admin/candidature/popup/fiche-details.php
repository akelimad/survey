<?php use \Modules\Fiches\Models\Fiche; 

$hasItems = false;
?>

<div class="row mb-15">   
    <div class="col-md-4"><strong>Nom et prénom du candidat</strong></div>
    <div class="col-md-5">: <?= $candidature->displayName; ?></div>
    <div class="col-md-3 pull-right">
        <a target="_blank" href="<?= site_url('/backend/module/fiches/pdf/fiche_candidature/'.$fiche_candidature->id_fiche_candidature); ?>" class="btn btn-primary btn-xs"><i class="fa fa-file-pdf-o"></i>&nbsp;Télécharger</a>
    </div>
</div>

<table id="fiche-container" class="mb-15" style="width:100%;">
    <tr class="ficheType_<?= $fiche_type; ?>">
        <td>
            <div class="subscription" style="margin: 0 0 5px;height: 23px;">
                <h1><?= $name; ?></h1>
            </div>
        </td>
    </tr>
    <tr class="ficheType_<?= $fiche_type; ?>">
        <td>
            <?php foreach (Fiche::getBlocksByFicheType($fiche_type) as $key => $block) : 
                $block_items = Fiche::getBlockItems($block->id_block, $id_fiche);
                if( empty($block_items) ) continue;
                $hasItems = true;
            ?>
                <table class="table table-striped mb-10">
                    <thead>
                        <tr>
                            <th style="padding: 3px 5px;background-color: #636e79ba !important;"><?= $block->name; ?></th>
                            <th style="padding: 3px 5px;background-color: #636e79ba !important;">
                                <?php if( in_array($block->fields_type, ['select', 'number']) ) : ?>Note (1 à 4)<?php endif; ?>
                            </th>
                            <?php if( $block->show_observations == '1' ) : ?>
                                <th style="padding: 3px 5px;background-color: #636e79ba !important;">Observations</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($block_items as $key => $item) : 
                        $blockItem = null;
                        if (isset($fiche_candidature->id_fiche_candidature)) {
                            $blockItem = Fiche::getBlockItem($fiche_candidature->id_fiche_candidature, $block->id_block, $item->id_item);                    
                        }
                    ?>
                        <tr>
                            <td style="padding: 5px; vertical-align: middle;">
                                <strong><?= $item->name; ?></strong>
                            </td>
                            <td width="120" align="left" style="padding: 5px;">
                                <?php if( $block->fields_type == 'checkbox' ) : ?>
                                     <?= (isset($blockItem->value) && $blockItem->value=='1') ? '<span class="label label-success">Oui</span>' : '<span class="label label-danger">Non</span>';?>
                                <?php elseif( in_array($block->fields_type, ['select', 'number']) ) : ?>
                                    <span class="label label-default" style="background-color:#<?= percent2Color($blockItem->value, 200, 4) ?>"><?= (isset($blockItem->value)) ? $blockItem->value : 0; ?></span>
                                <?php endif; ?>
                            </td>
                            <?php if( $block->show_observations == '1' ) : ?>
                            <td width="120" style="padding: 5px;"><?= (isset($blockItem->observations)) ? $blockItem->observations : '';?></td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>    
            <?php endforeach; ?>       
        </td>
    </tr>
    <?php if( $hasItems ) : ?>
    <tr id="ficheCandidatureCommentsRow">
        <td>
            <div class="subscription" style="height:23px;margin: 10px 0 5px;">
                <h1><label for="fiche_comments">Commentaire(s)</label></h1>
            </div>
            <textarea name="fiche[comments]" id="fiche_comments" style="width:100%;background-color: #fff;" rows="6" disabled><?= (isset($fiche_candidature->comments)) ? $fiche_candidature->comments : ''; ?></textarea>
        </td>
    </tr>
    <?php endif; ?>
</table>