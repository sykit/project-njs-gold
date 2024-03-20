<select class="form-control" name="prd_sub_cat_id" <?= $disabled ?? '';?> required>
    <option value="0"> -- Pilih Sub Kategori</option>
    <?php 
        foreach($subcategory as $item){
            ?>
            <option value="<?=  $item->prd_sub_cat_id ; ?>"><?= trim($item->prd_sub_cat_name); ?></option>
    <?php
        }
    ?>
</select>