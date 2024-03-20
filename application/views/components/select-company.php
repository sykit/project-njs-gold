<select class="form-control" name="company_id" required>
    <option value="0"> -- Pilih Company</option>
    <?php 
            foreach($company as $item){
                ?>
    <option value="<?=$item->company_id;?>"><?= trim($item->company_name); ?></option>
    <?php
            }
        ?>
</select>