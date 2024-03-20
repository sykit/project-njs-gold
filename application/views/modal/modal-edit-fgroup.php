<!-- Button trigger modal -->
<div class="modal fade" id="editFgroup" tabindex="-1" aria-labelledby="editFgroupLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
            <form enctype="multipart/form-data" method="POST" action="<?= base_url() ?>manage/fgroup/edit">
              <div class="modal-header">
                  <h1 class="modal-title fs-5" id="titleFgroup">Edit Kelola Fungsi Name</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <div class="row">
                      <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                          <label class="mb-2">Nama</label>
                          <input type="hidden" name="func_group_id" id="edit-fgroup-id"/>
                          <input type="text" name="func_group_name" id="edit-fgroup-name" class="form-control" />
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

