<!-- Button trigger modal -->
<script>
  function openDeleteUser(id,surname) {
    $('#delUser input[name=user_id]').val(id)
    $('#delUser input[name=surname]').val(surname)
    $('#delUser span.namaUser').empty().append(surname)
  }
</script>
<div class="modal fade" id="delUser" tabindex="-1" aria-labelledby="delUserLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <form enctype="multipart/form-data" method="POST" action="<?= base_url() ?>manage/users/delete">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="titleFgroup">Hapus</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col col-12 col-lg-12 mb-lg-2 mb-2">
              <input type="hidden" name="user_id" id="delete-user-id" />
              <input type="hidden" name="surname" id="delete-surname" class="form-control" />
              <div class="text-center">
                <h6>Apakah anda yakin untuk menghapus data '<span class="namaUser"></span>' ?</h6>
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