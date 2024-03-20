<!-- Button trigger modal -->
<div class="modal fade" id="editCategory" tabindex="-1" aria-labelledby="editCategoryLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fw-bold" id="editCategoryLabel">Edit Kategori</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form enctype="multipart/form-data" method="POST" action="<?= base_url(); ?>category/edit_image">
                        <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                            <label class="mb-2">Ganti Image</label>
                            <input type="hidden" name="category_id" id="edit-category-id"/>
                            <input type="hidden" name="category_image" id="edit-category-image"/>
                            <input accept="image/*" type="file" name="up_image" class="form-control upload_sm" placeholder="" required/>
                            <small class="text-muted text-smallest">Accept (png/jpg/jpeg/webp). Maks. upload
                            4MB</small>
                        </div>
                        <button type="submit" class="btn btn-primary mb-4">Simpan</button>
                    </form>
                    <form enctype="multipart/form-data" method="POST" action="<?= base_url(); ?>category/edit">
                        <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                            <label class="mb-2">Nama</label>
                            <input type="hidden" name="category_id" id="edit-category-name"/>
                            <input type="text" class="form-control" name="category_name" id="edit-category-name" required/>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>