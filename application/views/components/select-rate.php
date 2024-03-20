<select class="form-control js-rate-product" name="<?= $data_id; ?>">
    <option value=""> -- Pilih Varian Kadar</option>
    <?php 
        foreach($rate as $item){
            ?>
    <option value="<?=  $item->prd_rate_id; ?>">
    <?= $item->prd_rate_name; ?>
    <?php
        if($item->prd_rate_name != '250'){
            ?>
                (<?= $item->prd_rate_code; ?>) 
            <?php
        }
    ?>
    </option>
    <?php
        }
    ?>
</select>