<select class="form-control" name="<?= $data_id ?? 'bracelet_size_id1'; ?>">
    <option value=""> -- Pilih Ukuran Gelang</option>
    <?php 
                                        foreach($braceletsize as $item){
                                            ?>
    <option value="<?=  $item->bracelet_size_id ; ?>">
    Bentuk : <?= $item->design; ?> / Ukuran : <?= $item->size; ?>
    </option>
    <?php
                                        }
                                    ?>
</select>