<select class="form-control" name="cluster_id" required>
    <option value="0"> -- Pilih Cluster</option>
    <?php 
            foreach($cluster as $item){
                ?>
    <option value="<?=$item->cluster_id;?>"><?= trim($item->cluster_name); ?></option>
    <?php
            }
        ?>
</select>