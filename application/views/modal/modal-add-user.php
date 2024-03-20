<!-- Button trigger modal -->
<div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
  <form enctype="multipart/form-data" method="POST" action="<?= base_url(); ?>manage/users/add">

    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addUserLabel">Tambah User</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                <label class="mb-2">Nama</label>
                <input type="text" name="surname" class="form-control" required/>
            </div>
            <div class="col col-12 col-lg-6 mb-lg-2 mb-2" required>
                <label class="mb-2">Username</label>
                <input type="text" name="username" class="form-control" required/>
            </div>
            <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                <label class="mb-2">Email</label>
                <input type="text" name="email" class="form-control" required/>
            </div>
            <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                <label class="mb-2">Password</label>
                <input type="password" name="password" class="form-control" required/>
            </div>
            <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                <label class="mb-2 col-12">Kelola Fungsi</label>
                <?php $this->load->view('/components/select-jabatan'); ?>

            </div>
            <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                <label class="mb-2">Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" required/>
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