<!-- Button trigger modal -->
<div class="modal fade" id="addSubCategory" tabindex="-1" aria-labelledby="addSubCategoryLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <form enctype="multipart/form-data" method="POST" action="<?= base_url(); ?>subcategory/add">
                <div class="modal-header">
                    <h1 class="modal-title fw-bold" id="addSubCategoryLabel">Tambah Sub Kategori</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                            <label class="mb-2">Image</label>
                            <input accept="image/*" type="file" name="up_image" class="form-control upload_sm" placeholder="" required />
                            <small class="text-muted text-smallest">Accept (png/jpg/jpeg/webp). Maks. upload
                            4MB</small>
                        </div>
                        <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                            <label class="mb-2">Kategori</label>
                            <?php $this->load->view('/components/select-category'); ?>
                        </div>
                        <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                            <label class="mb-2">Nama</label>
                            <input type="text" class="form-control" name="prd_sub_cat_name"/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>