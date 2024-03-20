<select class="form-control" name="company_type_id" required>
    <option value="0"> -- Pilih Company Type</option>
    <?php 
            foreach($company_type as $item){
                ?>
    <option value="<?=$item->company_type_id;?>"><?= trim($item->company_type_name); ?></option>
    <?php
            }
        ?>
</select>