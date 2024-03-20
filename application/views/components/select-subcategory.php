<select class="form-control" name="prd_sub_cat_id" <?= $disabled ?? '';?> required>
    <option value=""> -- Pilih Sub Kategori</option>
    <?php 
                                        foreach($subcategory as $item){
                                            ?>
    <option value="<?=  $item->prd_sub_cat_id ; ?>"><?= $item->prd_sub_cat_name; ?>
    </option>
    <?php
                                        }
                                    ?>
</select>