<?php
                      $fgroup_id_allowed_for_pl = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25];
                      $isFgroupAllow = in_array($fgroupId, $fgroup_id_allowed_for_pl);

                      if($isFgroupAllow){
                        ?>
<a class="fw-normal" href="<?= base_url(); ?>manage/product/list">
    Daftar Katalog Produk
</a>
<?php
                      }
                    ?>

<?php
                      $fgroup_id_allowed_for_pm = [1];
                      $isFgroupAllow = in_array($fgroupId, $fgroup_id_allowed_for_pm);

                      if($isFgroupAllow){
                        ?>
<a class="fw-normal" href="<?= base_url(); ?>manage/product/category">
    Kelola Kategori Produk
</a>
<?php
                      }
                    ?>

<?php
                      $fgroup_id_allowed_for_spm = [1];
                      $isFgroupAllow = in_array($fgroupId, $fgroup_id_allowed_for_spm);

                      if($isFgroupAllow){
                        ?>
<a class="fw-normal" href="<?= base_url(); ?>manage/product/subcategory">
    Product Sub Category Management
</a>
<?php
                      }
                    ?>

<?php
                      $access_control_pm = [1];
                      $isFgroupAllow = in_array($fgroupId, $access_control_pm);

                      if($isFgroupAllow){
                        ?>
<a class="fw-normal" href="<?= base_url(); ?>manage/product">
Kelola Katalog Produk
</a>
<?php
                      }
                    ?>