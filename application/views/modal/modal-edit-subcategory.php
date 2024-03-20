 <!-- Button trigger modal -->
<div class="modal fade" id="editSubCategory" tabindex="-1" aria-labelledby="editSubCategoryLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fw-bold" id="editSubCategoryLabel">Edit Sub Kategori</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form enctype="multipart/form-data" method="POST" action="<?= base_url(); ?>subcategory/edit_image">
                        <div class="col col-12 col-lg-12 mb-lg-2 mb-2">
                            <label class="mb-2">Ganti Image</label>
                            <input type="hidden" class="form-control prd_sub_cat_id" name="prd_sub_cat_id"/>
                            <input type="hidden" class="form-control prd_sub_image" name="image"/>
                            <input accept="image/*" type="file" name="up_image" class="form-control upload_sm" placeholder="" required />
                            <small class="text-muted text-smallest">Accept (png/jpg/jpeg/webp). Maks. upload
                            4MB</small>
                        </div>
                        <button type="submit" class="btn btn-primary mb-lg-4 mb-3">Simpan</button>
                    </form>

                    <form enctype="multipart/form-data" method="POST"
                        action="<?= base_url();?>subcategory/edit_category">
                        <div class="col col-12 col-lg-12 mb-lg-2 mb-2">
                            <label class="mb-2">Kategori</label>
                            <input type="hidden" class="form-control prd_sub_cat_id" name="prd_sub_cat_id"/>
                            <select class="form-control" name="product_category_id" id="product_category_id" required>
                                <option value=""> -- Pilih Kategori</option>
                                <?php 
                                        foreach($category as $item){
                                            ?>
                                <option value="<?=  $item->product_category_id ; ?>">
                                    <?= $item->product_category_name; ?>
                                </option>
                                <?php
                                        }
                                    ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mb-lg-4 mb-3">Simpan</button>
                    </form>

                    <form enctype="multipart/form-data" method="POST" action="<?= base_url();?>subcategory/edit">
                        <input type="hidden" class="form-control prd_sub_cat_id" name="prd_sub_cat_id" />
                        <div class="col col-12 col-lg-12 mb-lg-2 mb-2">
                            <label class="mb-2">Nama</label>
                            <input type="text" class="form-control" id="product_category_name"
                                name="prd_sub_cat_name" />
                        </div>
                        <button type="submit" class="btn btn-primary mb-lg-4 mb-3">Simpan</button>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div> 