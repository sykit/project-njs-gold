<select class="form-control" name="sepuh_id" <?= $disabled ?? '';?> >
    <option value=""> -- Pilih Varian Sepuh</option>
    <?php 
                                        foreach($sepuh as $item){
                                            ?>
    <option value="<?=$item->sepuh_id;?>"><?=$item->sepuh_code;?> | <?=trim($item->sepuh_name);?></option>
    <?php
                                        }
                                    ?>
</select>