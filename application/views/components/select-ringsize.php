<select class="form-control" name="<?= $data_id ?? 'ring_size_id1'; ?>">
    <option value=""> -- Pilih Ukuran Cincin</option>
    <?php 
                                        foreach($ringsize as $item){
                                            ?>
    <option value="<?=  $item->ring_size_id ; ?>">
    Ukuran : <?= $item->size; ?>
    </option>
    <?php
                                        }
                                    ?>
</select>