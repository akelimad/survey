<?php use \Modules\Fiches\Models\Fiche; ?>

<form action="" method="post" id="ficheEvaluationForm">
    <table id="fiche-container" class="mb-15" style="width:100%;">
        <tr class="ficheType_<?= $fiche_type; ?>">
            <td>
                <div class="subscription" style="margin: 10px 0 5px;height: 23px;">
                    <h1><?= $name; ?></h1>
                </div>
            </td>
        </tr>
        <tr class="ficheType_<?= $fiche_type; ?>">
            <td>
                <?php foreach (Fiche::getBlocksByFicheType($fiche_type) as $key => $block) : ?>
                    <table class="table table-striped mb-10">
                        <thead>
                            <tr>
                                <th style="padding: 3px 5px;background-color: #636e79ba !important;"><?= $block->name; ?></th>
                                <th style="padding: 3px 5px;background-color: #636e79ba !important;">
                                    <?php if( $block->fields_type == 'number' ) : ?>Note (1 à 4)<?php endif; ?>
                                </th>
                                <?php if( $block->show_observations == '1' ) : ?>
                                    <th style="padding: 3px 5px;background-color: #636e79ba !important;">Observations</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $block_items = Fiche::getBlockItemsByCandidatureId($block->id_block, $id_candidature);
                        foreach ($block_items as $key => $item) : 
                            $candItem = null;
                            if (isset($fiche_candidature->id_fiche_candidature)) {
                                $candItem = getDB()->prepare("SELECT * FROM fiche_candidature_results WHERE id_fiche_candidature=? AND id_item=?", [
                                    $fiche_candidature->id_fiche_candidature,
                                    $item->id_item
                                ], true);                    
                            }
                        ?>
                            <tr>
                                <td style="padding: 5px; vertical-align: middle;">
                                    <strong><?= $item->name; ?></strong>
                                </td>
                                <td width="120" align="right" style="padding: 5px;">
                                    <?php if( $block->fields_type == 'checkbox' ) : ?>
                                        <input type="checkbox" name="fiche_result[<?= $block->id_block; ?>][<?= $item->id_item; ?>]" value="1" <?= (isset($candItem->value) && $candItem->value=='1') ? 'checked' : '';?> style="transform: scale(1.3);margin: 0px;">
                                    <?php elseif( $block->fields_type == 'number' ) : ?>
                                        <input type="number" min="1" step="1" name="fiche_result[<?= $block->id_block; ?>][<?= $item->id_item; ?>][value]" value="<?= (isset($candItem->value)) ? $candItem->value : '';?>" style="width: 70px;">
                                    <?php elseif( $block->fields_type == 'select' ) : ?>
                                        <select name="fiche_result[<?= $block->id_block; ?>][<?= $item->id_item; ?>][value]" style="width: 100%;height: 22px;">
                                        <option value=""></option>
                                        <?php foreach (Fiche::getNotes() as $nk => $note) : ?>
                                            <option value="<?= $nk; ?>"><?= $nk; ?>&nbsp;(<?= $note; ?>)</option>
                                        <?php endforeach; ?>
                                        </select>
                                    <?php endif; ?>
                                </td>
                                <?php if( $block->show_observations == '1' ) : ?>
                                <td width="120" style="padding: 5px;">
                                    <input type="text" name="fiche_result[<?= $block->id_block; ?>][<?= $item->id_item; ?>][observations]" value="<?= (isset($candItem->observations)) ? $candItem->observations : '';?>">
                                </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>    
                <?php endforeach; ?>       
            </td>
        </tr>
        <tr id="ficheCandidatureCommentsRow">
            <td>
                <div class="subscription" style="height:23px;margin: 10px 0 5px;">
                    <h1><label for="fiche_comments">Commentaire(s)</label></h1>
                </div>
                <textarea name="fiche[comments]" id="fiche_comments" style="width:100%;" rows="6"><?= (isset($fiche_candidature->comments)) ? $fiche_candidature->comments : ''; ?></textarea>
            </td>
        </tr>
    </table>

    <div class="ligneBleu" style="width: 100%;"></div>
    <div class="form-group mt-10 mb-0">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-hidden="true">Fermer</button>
        <button type="submit" class="btn btn-primary btn-sm pull-right">Valider la fiche</button>
    </div>
</form>