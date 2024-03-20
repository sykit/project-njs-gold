<select class="form-control" name="company_id" required>
    <option value="0"> -- Pilih Company Type</option>
    <?php 
            foreach($customer_internal as $item){
                ?>
    <option value="<?=$item->company_id;?>"><?= trim($item->cluster_name); ?> - <?= trim($item->company_name); ?></option>
    <?php
            }
        ?>
</select>