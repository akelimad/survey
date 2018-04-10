<?php use \Modules\Fiches\Models\Fiche; 

$hasItems = false;
?>

<div class="row mb-15">   
    <div class="col-md-4"><strong><?php trans_e("Nom et prénom du candidat"); ?></strong></div>
    <div class="col-md-8">: <?= $candidature->displayName; ?></div>
</div>

<form action="" method="post" id="ficheEvaluationForm">
    
    <input type="hidden" name="fiche[id]" value="<?= $id_fiche; ?>">
    <input type="hidden" name="fiche[type]" value="<?= $fiche_type; ?>">
    <input type="hidden" name="fiche[id_candidature]" value="<?= $candidature->cid; ?>">

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
                                    <?php if( $block->fields_type == 'number' ) : ?><?php trans_e("Note (1 à 4)"); ?><?php endif; ?>
                                </th>
                                <?php if( $block->show_observations == '1' ) : ?>
                                    <th style="padding: 3px 5px;background-color: #636e79ba !important;"><?php trans_e("Observations"); ?></th>
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
                                <td width="120" align="right" style="padding: 5px;">
                                    <?php if( $block->fields_type == 'checkbox' ) : ?>
                                        <input type="checkbox" name="fiche[blocks][<?= $block->id_block; ?>][<?= $item->id_item; ?>]" value="1" <?= (isset($blockItem->value) && $blockItem->value=='1') ? 'checked' : '';?> style="transform: scale(1.3);margin: 0px;" required>
                                    <?php elseif( $block->fields_type == 'number' ) : ?>
                                        <input type="number" min="1" step="1" name="fiche[blocks][<?= $block->id_block; ?>][<?= $item->id_item; ?>][value]" value="<?= (isset($blockItem->value)) ? $blockItem->value : '';?>" style="width: 70px;" required>
                                    <?php elseif( $block->fields_type == 'select' ) : ?>
                                        <select name="fiche[blocks][<?= $block->id_block; ?>][<?= $item->id_item; ?>][value]" style="width: 100%;height: 22px;" required>
                                        <option value=""></option>
                                        <?php foreach (Fiche::getNotes() as $nk => $note) : 
                                            $selected = (isset($blockItem->value) && $nk==$blockItem->value) ? 'selected' : '';
                                        ?>
                                            <option value="<?= $nk; ?>" <?= $selected; ?>><?= $nk; ?>&nbsp;(<?= $note; ?>)</option>
                                        <?php endforeach; ?>
                                        </select>
                                    <?php endif; ?>
                                </td>
                                <?php if( $block->show_observations == '1' ) : ?>
                                <td width="120" style="padding: 5px;">
                                    <input type="text" name="fiche[blocks][<?= $block->id_block; ?>][<?= $item->id_item; ?>][observations]" value="<?= (isset($blockItem->observations)) ? $blockItem->observations : '';?>">
                                </td>
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
                    <h1><label for="fiche_comments"><?php trans_e("Commentaire(s)"); ?></label></h1>
                </div>
                <textarea name="fiche[comments]" id="fiche_comments" style="width:100%;" rows="6"><?= (isset($fiche_candidature->comments)) ? $fiche_candidature->comments : ''; ?></textarea>
            </td>
        </tr>
        <?php endif; ?>
    </table>

    <?php if( $hasItems ) : ?>
    <div class="ligneBleu" style="width: 100%;"></div>
    <div class="form-group mt-10 mb-0">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-hidden="true"><?php trans_e("Fermer"); ?></button>
        <button type="submit" class="btn btn-primary btn-sm pull-right"><?php trans_e("Valider la fiche"); ?></button>
    </div>
    <?php else : ?>
        <?php get_alert('info', trans("Cette fiche n'a aucune élément."), false) ?>
    <?php endif; ?>
</form>