<!-- Button trigger modal -->
<div class="modal fade" id="addcustomer" tabindex="-1" aria-labelledby="addcustomerLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <form enctype="multipart/form-data" method="POST" action="<?= base_url(); ?>manage/customer_data/add">

      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="addcustomerLabel">Tambah customer</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col col-12 col-lg-12 mb-lg-2 mb-2 row">
              <div class="col-2">
                <label class="mb-2 ">Sales Area</label>
              </div>
              <div class="col-10">
                <select class="form-control" name="sales_area_id" onchange="updateClusterAdd()" required>
                  <?php
                  foreach ($sales_area as $item) {
                  ?>
                    <option value="<?= $item->sales_area_id; ?>"><?= trim($item->sales_area_name); ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="col col-12 col-lg-12 mb-lg-2 mb-2 row">
              <div class="col-2">
                <label class="mb-2 text-right">Nama Cluster</label>
              </div>
              <div class=" col-10">
                <select class="form-control" name="cluster_id" required>
                </select>
              </div>
            </div>
            <div class="col col-12 col-lg-12 mb-lg-2 mb-2 row">
              <div class="col-2">
                <label class="mb-2 text-right">Tipe Pelanggan</label>
              </div>
              <div class=" col-10">
                <select class="form-control" name="company_type_id" required>
                  <?php
                  foreach ($company_type as $item) {
                  ?>
                    <option value="<?= $item->company_type_id; ?>"><?= trim($item->company_type_name); ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="col col-12 col-lg-12 mb-lg-2 mb-2 row">
              <div class="col-2">
                <label class="mb-2">Kode Pelanggan</label>
              </div>
              <div class=" col-10">
                <input type="text" name="company_code" class="form-control" required />
              </div>
            </div>
            <div class="col col-12 col-lg-12 mb-lg-2 mb-2 row">
              <div class="col-2">
                <label class="mb-2">Nama Pelanggan</label>
              </div>
              <div class=" col-10">
                <input type="text" name="company_name" class="form-control" required />
              </div>
            </div>
            <div class="col col-12 col-lg-12 mb-lg-2 mb-2 row">
              <div class="col-2">
                <label class="mb-2">Nama Owner</label>
              </div>
              <div class=" col-10">
                <input type="text" name="company_owner_name" class="form-control" required />
              </div>
            </div>
            <div class="col col-12 col-lg-12 mb-lg-2 mb-2 row">
              <div class="col-2">
                <label class="mb-2">Nomor Telpon</label>
              </div>
              <div class=" col-10">
                <input type="text" name="company_phone" class="form-control" required />
              </div>
            </div>
            <div class="col col-12 col-lg-12 mb-lg-2 mb-2 row">
              <div class="col-2">
                <label class="mb-2">Alamat</label>
              </div>
              <div class=" col-10">
                <textarea name="company_address" id="" cols="100" rows="5"></textarea>
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
<script>
  function updateClusterAdd() {
        let sales_area_id = $('#addcustomer select[name=sales_area_id]').val()
        console.log(sales_area_id);

        generateURL = URL + 'Asynccustomer/getClusterBySalesArea'

        $.ajax({
            url: generateURL,
            type: "GET",
            data: {
                sales_area_id: sales_area_id,
            },
            success: function(data) {
                console.log(data);
                data = JSON.parse(data);
                let cluster_id = $('#addcustomer select[name=cluster_id]')
                cluster_id.empty()
                for(let i = 0; i<data.length; i++){
                    cluster_id.append('<option value="'+data[i].cluster_id+'">'+data[i].cluster_name+'</option>')
                }
                cluster_id.select2()
            },
            error: function(err) {
                console.log(err);
            }
        });
    }
    function openAddCustomer(){
      updateClusterAdd()
    }
</script>