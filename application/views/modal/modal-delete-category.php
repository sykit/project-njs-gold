<!-- Button trigger modal -->
<div class="modal fade" id="delCategory" tabindex="-1" aria-labelledby="delCategoryLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
            <form enctype="multipart/form-data" method="POST" action="<?= base_url() ?>manage/product/category/delete">
              <div class="modal-header">
                  <h1 class="modal-title fs-5" id="titleFgroup">Hapus</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <div class="row">
                      <div class="col col-12 col-lg-12 mb-lg-2 mb-2">
                          <input type="hidden" name="category_id" id="delete-category-id"/>
                          <input type="hidden" name="category_name" id="delete-category-name" class="form-control" />
                          <div class="text-center">
                            <h6>Apakah anda yakin untuk menghapus data '<span class="namaCategory"></span>' ?</h6>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary">Hapus</button>
              </div>
            </form>
          </div>
    </div>
</div>