<style>
#menu-fo {
    padding-top: 0px;
}
input, select {
    width: 100%;
    height: 21px;
}
.subscription {
    height: 22px;
}
</style>
<div id="gauche" style="width:100%;">
    <?php include ( site_base("lib/menu/menu_g_a_admin.php") ); ?>
    <div id="content_d" style="width: 735px;">
        <div class="mb-30">
            <h1 style="display: inline;">CRÉATION D'UNE FICHE</h1>
            <a href="<?= site_url('backend/module/fiches/fiche'); ?>" class="btn btn-primary btn-xs pull-right"><i class="fa fa-arrow-left"></i>&nbsp;Retour à la liste</a>
        </div>

        <div class="mb-10"><?php \App\Session::getFlash(); ?></div>

        <form action="" method="POST">
            <div class="subscription" style="margin: 10px 0pt;">
                <h1>DÉTAILS DE FICHE</h1>
            </div>

            <table style="width: 100%;">
                <tr> 
                    <td valign="top" width="180">
                        <label for="reference">Référence</label>
                    </td>
                    <td>
                        <input type="text" name="reference" id="reference" value="<?= (isset($data->reference)) ? $data->reference : ''; ?>" <?= (isset($data->id_fiche)) ? 'disabled' : 'required'; ?>>
                    </td>
                </tr>
                <tr>
                    <td style="height:5px;"></td>
                </tr>
                <tr> 
                    <td valign="top" width="180">
                        <label for="name">Titre</label>
                    </td>
                    <td>
                        <input type="text" name="name" id="name" value="<?= (isset($data->name)) ? $data->name : ''; ?>" required>
                    </td>
                </tr>
                <tr>
                    <td style="height:5px;"></td>
                </tr>
                <tr> 
                    <td valign="top" width="180">
                        <label for="type">Type</label>
                    </td>
                    <td>
                        <select name="type" id="type" disabled>
                            <option value=""></option>
                            <?php
                                foreach ($data->types as $key => $value) :
                                $selected = (isset($data->fiche_type) && $data->fiche_type == $key) ? 'selected' : '';
                            ?>
                                <option value="<?= $key; ?>" <?= $selected; ?>><?= $value; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
            </table>

            <div class="subscription" style="margin: 10px 0pt;">
                <h1>CRITERES DE L’ANNONCE</h1>
            </div>

            <?php foreach ($data->blocks as $key => $block) : ?>
                
                <h3><?= $block->name; ?></h3>

                <table class="blockTable" id="blockTable<?= $block->id_block; ?>" style="width:100%;">
                <?php
                    $block_items[0] = (object) [
                        'id_item' => 'new_0',
                        'name' => ''
                    ];
                    if(isset($data->block_items[$block->id_block]) && !empty($data->block_items[$block->id_block])) {
                        $block_items = $data->block_items[$block->id_block];
                    } else if (isset($data->id_fiche)) {
                        $block_items = getDB()->prepare("SELECT * FROM fiche_items WHERE id_fiche=? AND id_block=?", [
                            $data->id_fiche,
                            $block->id_block
                        ]) ?: $block_items;
                    }
                    // Show block items
                    if( !empty($block_items) ) : foreach ($block_items as $key => $item) :                    
                ?>
                    <tr data-id="<?= $item->id_item; ?>">
                        <td>
                            <input type="text" name="block_items[<?= $block->id_block; ?>][<?= $item->id_item; ?>]" class="mb-5" value="<?= $item->name; ?>">
                        </td>
                        <td style="vertical-align: top;width: 30px;">
                            <a href="javascript:void(0)" class="btn btn-danger btn-xs deleteLine ml-5" style="margin-top: -1px;"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>

                <?php endforeach; endif; ?>
                </table>

                <a href="javascript:void(0)" class="btn btn-default btn-xs addLine" data-table="<?= $block->id_block; ?>"><i class="fa fa-plus"></i>&nbsp;Ajouter une ligne</a>
                
            <?php endforeach; ?>

            <table style="width:100%;">
                <tr>
                    <td colspan="8">
                        <div class="ligneBleu mt-20"></div>
                        <a href="<?= site_url('backend/module/fiches/fiche'); ?>" class="btn btn-danger btn-sm">Fermer</a>
                        <button class="btn btn-primary btn-sm pull-right">Enregistrer la fiche</button>
                    </td>
                </tr>
            </table>
            

        </form>
        

    </div>
</div>



<script>
jQuery(document).ready(function(){
       
    // Add new Line
    $(".addLine").click(function(event){
        event.preventDefault()

        var blockTable = $('#blockTable'+$(this).data('table'))
        var expLength = $(blockTable).find("tbody tr").length
        var copy = $(blockTable).find("tbody tr:first").clone()
            copy.find('td:eq(1)>a').show()

        var dataID = $(copy).data('id');
        var itemInput = copy.find('td:eq(0)>input')
            itemName = itemInput.attr('name')
            itemInput.attr('name', itemName.replace(dataID, 'new_'+expLength))
            itemInput.val('')

        $(blockTable).append(copy)
    })

    $(".blockTable").on('click', '.deleteLine', function(){
        if( $(this).closest('table').find("tbody tr").length == 1 ) {
            $(this).closest('tr').find('td:eq(0)>input').val('')
        } else {
            $(this).closest('tr').remove();
        }
    });


        

});
</script>