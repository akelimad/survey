<?php use \Modules\Fiches\Models\Fiche; ?>

<?php if(!empty($ficheTypes) ) : foreach ($ficheTypes as $fiche_type => $name) : ?>
    <tr>
        <td colspan="2">
            <div class="subscription" style="margin: 10px 0 5px;">
                <h1><?= $name; ?></h1>
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <?php
            $offreFicheId = null;
            if( isset($id_offre) && is_numeric($id_offre) ) {
                $offreFicheId = Fiche::getOffreFicheByType($id_offre, $fiche_type);
            }
            $fiche = Fiche::findById($offreFicheId);
            ?>
            <?php if( isset($fiche->name) && $fiche->name != '' && !Fiche::canChangeOffreFiche($id_offre, $fiche_type) ) : ?>
                <input type="text" name="reference" id="reference" value="<?= $fiche->reference .' | '. $fiche->name; ?>" style="width:100%" disabled>
            <?php else : ?>
                <select name="offre_fiche_type[<?= $fiche_type; ?>]" style="width:100%">
                    <option value=""></option>
                    <?php foreach (Fiche::getFichesByType($fiche_type) as $key => $fiche) : 
                        $selected = ($offreFicheId == $fiche->id_fiche) ? 'selected' : '';
                    ?>
                        <option value="<?= $fiche->id_fiche; ?>" <?= $selected; ?>><?= $fiche->reference .' | '. $fiche->name; ?></option>
                    <?php endforeach; ?>
                </select>
            <?php endif; ?>
        </td>
    </tr>
<?php endforeach; endif; ?>