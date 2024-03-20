<select class="form-control" name="product_category_id" required>
    <option value="0"> -- Pilih Kategori</option>
    <?php 
            foreach($category as $item){
                ?>
    <option value="<?=$item->product_category_id;?>"><?= trim($item->product_category_name); ?></option>
    <?php
            }
        ?>
</select>