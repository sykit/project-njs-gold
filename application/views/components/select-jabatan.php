<select class="form-control" name="func_group_id" required>
    <option value="0"> -- Pilih Jabatan</option>
    <?php 
            foreach($jabatan as $item){
                ?>
    <option value="<?=$item->func_group_id;?>"><?= trim($item->func_group_name); ?></option>
    <?php
            }
        ?>
</select>