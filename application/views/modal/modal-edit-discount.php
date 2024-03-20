<!-- Button trigger modal -->

<script>
  function openEditcustomer(id) {
    $.ajax({
        url: '<?= base_url(); ?>Asyncdiscount/customerDetail',
        type: 'GET',
        data: {
          company_id: id
        }
      })
      .done(function(data) {
        console.log(data);
        let json = JSON.parse(data);
        $('#editcustomer input[name=company_id]').val(json[0].company_id)
        $('#editcustomer input[name=sales_area_name]').val(json[0].sales_area_name)
        $('#editcustomer input[name=company_type_name]').val(json[0].company_type_name)
        $('#editcustomer input[name=cluster_name]').val(json[0].cluster_name)
        $('#editcustomer input[name=company_name]').val(json[0].company_name)
        $('#editcustomer input[name=company_code]').val(json[0].company_code)
        $('#editcustomer input[name=discount]').val(json[0].discount)
        delay
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });
  }

</script>
<div class="modal fade" id="editcustomer" tabindex="-1" aria-labelledby="editcustomerLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <form enctype="multipart/form-data" method="POST" action="<?= base_url(); ?>manage/discount_maintenance/edit">
      <input type="hidden" name="company_id">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="addcustomerLabel">Edit customer</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col col-12 col-lg-12 mb-lg-2 mb-2 row">
              <div class="col-2">
                <label class="mb-2">Sales Area</label>
              </div>
              <div class=" col-10">
                <input type="text" name="sales_area_name" class="form-control" required readonly />
              </div>
            </div>
            <div class="col col-12 col-lg-12 mb-lg-2 mb-2 row">
              <div class="col-2">
                <label class="mb-2">Nama Cluster</label>
              </div>
              <div class=" col-10">
                <input type="text" name="cluster_name" class="form-control" required readonly />
              </div>
            </div>
            <div class="col col-12 col-lg-12 mb-lg-2 mb-2 row">
              <div class="col-2">
                <label class="mb-2">Tipe Pelanggan</label>
              </div>
              <div class=" col-10">
                <input type="text" name="company_type_name" class="form-control" required readonly />
              </div>
            </div>
            <div class="col col-12 col-lg-12 mb-lg-2 mb-2 row">
              <div class="col-2">
                <label class="mb-2">Kode</label>
              </div>
              <div class=" col-10">
                <input type="text" name="company_code" class="form-control" required readonly />
              </div>
            </div>
            <div class="col col-12 col-lg-12 mb-lg-2 mb-2 row">
              <div class="col-2">
                <label class="mb-2">Nama</label>
              </div>
              <div class=" col-10">
                <input type="text" name="company_name" class="form-control" required readonly />
              </div>
            </div>
            <div class="col col-12 col-lg-12 mb-lg-2 mb-2 row">
              <div class="col-2">
                <label class="mb-2">Diskon</label>
              </div>
              <div class=" col-10">
                <input type="number" name="discount" step="0.01" min="0" max="100" class="form-control" required />
              </div>
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