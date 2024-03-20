<!-- Button trigger modal -->

<script>
  function openEditUser(id) {
    $.ajax({
        url: '<?= base_url(); ?>Asyncuser/getDetail',
        type: 'GET',
        data: {
          user_id: id
        }
      })
      .done(function(data) {
        console.log(data);
        let json = JSON.parse(data);
        $('#editUser input[name=user_id]').val(json[0].user_id)
        $('#editUser input[name=surname]').val(json[0].surname)
        $('#editUser input[name=username]').val(json[0].username)
        $('#editUser input[name=email]').val(json[0].email)
        $('#editUser select[name=func_group_id]').val(json[0].func_group_id).select2().trigger("change");
        $('#editUser select[name=company_id]').val(json[0].company_id).select2().trigger("change");
        // $('#editUser .select2').select2().trigger("change");
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });
  }
</script>
<div class="modal fade" id="editUser" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <form enctype="multipart/form-data" method="POST" action="<?= base_url(); ?>manage/users/edit">
      <input type="hidden" name="user_id">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editUserLabel">Edit User</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <input type="hidden" name="user_id" id="edit-user-id">
            <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
              <label class="mb-2">Nama</label>
              <input type="text" class="form-control" name="surname" id="edit-surname" required />
            </div>
            <div class="col col-12 col-lg-6 mb-lg-2 mb-2" required>
              <label class="mb-2">Username</label>
              <input type="text" class="form-control" name="username" required />
            </div>
            <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
              <label class="mb-2">Email</label>
              <input type="text" class="form-control" name="email" required />
            </div>
            <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
              <label class="mb-2">Password</label>
              <input type="password" class="form-control" name="password" placeholder="wajib di isi jika ingin mengganti password" />
            </div>
            <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
              <label class="mb-2 col-12">Jabatan</label>
              <?php $this->load->view('/components/select-jabatan'); ?>
            </div>

            <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
              <label class="mb-2">Confirm Password</label>
              <input type="password" class="form-control" name="confirm_password" placeholder="wajib di isi jika ingin mengganti password" />
            </div>
            <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
              <label class="mb-2 col-12">Company</label>
              <?php $this->load->view('/components/select-company'); ?>

            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>