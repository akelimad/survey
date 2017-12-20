<?php use \Modules\Fiches\Models\Fiche; 

$hasItems = false;
?>

<?php if( isset($fiche_offre->name) ) : ?>

<table id="fiche-container" class="mb-15" style="width:100%;">

    <input type="hidden" name="fiche[id]" value="<?= $id_fiche; ?>">
    <input type="hidden" name="fiche[type]" value="0">
    <input type="hidden" name="fiche[id_candidature]" value="<?= $id_candidature; ?>">

    <?php if(!empty($ficheTypes) ) : foreach ($ficheTypes as $fiche_type => $name) : ?>
        <tr class="ficheType_<?= $fiche_type; ?>" style="display:none;">
            <td>
                <div class="subscription" style="margin: 10px 0 5px;height: 23px;">
                    <h1><?= $name; ?>&nbsp;(<?= $fiche_offre->name ?>)</h1>
                </div>
            </td>
        </tr>
        <tr class="ficheType_<?= $fiche_type; ?>" style="display:none;">
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
                                    <?php if( $block->fields_type == 'number' ) : ?>Note (1 à 4)<?php endif; ?>
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
                                <td width="120" align="right" style="padding: 5px;">
                                    <?php if( $block->fields_type == 'checkbox' ) : ?>
                                        <input type="checkbox" name="fiche[blocks][<?= $block->id_block; ?>][<?= $item->id_item; ?>][value]" value="1" <?= (isset($blockItem->value) && $blockItem->value=='1') ? 'checked' : '';?> style="transform: scale(1.3);margin: 0px;">
                                    <?php elseif( $block->fields_type == 'number' ) : ?>
                                        <input type="number" min="1" step="1" name="fiche[blocks][<?= $block->id_block; ?>][<?= $item->id_item; ?>][value]" value="<?= (isset($blockItem->value)) ? $blockItem->value : '';?>" style="width: 70px;">
                                    <?php elseif( $block->fields_type == 'select' ) : ?>
                                        <select name="fiche[blocks][<?= $block->id_block; ?>][<?= $item->id_item; ?>][value]" style="width: 100%;height: 22px;">
                                        <option value=""></option>
                                        <?php foreach (Fiche::getNotes() as $nk => $note) : ?>
                                            <option value="<?= $nk; ?>"><?= $note; ?></option>
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
    <?php endforeach; endif; ?>

    <tr id="ficheCandidatureCommentsRow" style="display:none;">
        <td>
            <?php if( $hasItems ) : ?>
            <div class="subscription" style="height:23px;margin: 10px 0 5px;">
                <h1><label for="fiche_comments">Commentaire(s)</label></h1>
            </div>
            <textarea name="fiche[comments]" style="width:100%;" rows="6"><?= (isset($fiche_candidature->comments)) ? $fiche_candidature->comments : ''; ?></textarea>
            <?php else : ?>
                <?php get_alert('info', 'Cette fiche n\'a aucune élément.', false) ?>
            <?php endif; ?>
        </td>
    </tr>
</table>

<script>
jQuery(document).ready(function($){

    $('#status_id').change(function(){
        var $ref = $(this).find('option:selected').data('ref')

        if( $ref == 'N_0' || $ref == 'N_1' ) {
            $('.ficheType_0').show()
            $('.ficheType_1').hide()
            $('#ficheCandidatureCommentsRow').show()
        } else {
            $('.ficheType_0').hide()
            $('.ficheType_1').hide()
            $('#ficheCandidatureCommentsRow').hide()
        }
    })

})
</script>
<?php endif; ?>