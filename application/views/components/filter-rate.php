<div class="form-group">
  
    <?php
foreach($rate as $item){ 
    ?>
        <div class="form-check">
            <input class="form-check-input" name="rate" type="checkbox" value="<?= $item->prd_rate_id; ?>" id="<?= $item->prd_rate_name; ?>">
            <label class="form-check-label" for="<?=$item->prd_rate_name; ?>">
                <?php
                echo $item->prd_rate_name ;
                if($item->prd_rate_name != '250'){
                    echo '(' . $item->prd_rate_code. ')';
                }
                ?>
            </label>
        </div>
        <?php
}
?>
</div>