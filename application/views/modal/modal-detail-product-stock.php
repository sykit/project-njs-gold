<!-- Button trigger modal -->

<script>
  function openDetailProductStok(product_category_id, prd_sub_cat_id, prd_sub_cat_name) {
    $('#detailProdukStock #namaKategori').empty().append(prd_sub_cat_name)
    let url = URL + 'Asyncproductstock/getDetailProductStock?product_category_id=' + product_category_id + '&prd_sub_cat_id=' + prd_sub_cat_id 
    dTable2.clear().draw();
    dTable2.ajax.url(url).load();
  }
  let dTable2 = ""

  $(function() {
    dTable2 = new DataTable('#tabel_detail_product_Stock', {
      "bFilter": true,
      "lengthMenu": [10, 20, ],
      "bSort": true,
      "ordering": true,
      "processing": true,
      "serverSide": false,
      "responsive": true,
      "language": {
        "emptyTable": "<i class='bi-info-circle-fill'></i>&nbsp;&nbsp;Tidak ada data yang ditampilkan"
      },
      "ajax": {
        "url": URL + 'Asyncproductstock/getDetailProductStock',
        "dataSrc": "",
        timeout: 3000,
      },
      "drawCallback": function(settings) {
        setTimeout(() => {
          $('.js-skeleton').addClass('d-none');
          $('.js-table').css('visibility', 'visible');
        }, 25);
      },
      columns: [{
          data: 'prd_sub_cat_name'
        },
        {
          data: 'product_class_code'
        },
        {
          data: 'prd_rate_code'
        },
        {
          data: 'sepuh_code'
        },
        {
          data: 'jumlah',
          class: 'text-end'
        },
        {
          data: 'jewelry_weight',
          class: 'text-end'
        },

      ],
      error: function(jqXHR, textStatus, errorThrown) {
        // Do something here
      }

    });
  });

  
</script>
<div class="modal fade" id="detailProdukStock" tabindex="-1" aria-labelledby="detailProdukStockLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <input type="hidden" name="company_id">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="detailProdukStockLabel">Kategori Produk : <span id="namaKategori" class="modal-title fs-5"></span></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div class="row">
            <div class="col col-12 col-lg-12 mb-lg-2 mb-2 row">
              <table class="table table-strip " id="tabel_detail_product_Stock" style="width: 100%">
                <thead>
                  <tr>
                    <th>Sub Kategori Produk</th>
                    <th>Model</th>
                    <th>Kadar</th>
                    <th>Sepuh</th>
                    <th>Jumlah (pcs)</th>
                    <th>Berat (gr)</th>
                  </tr>
                </thead>
              </table>
            </div>


          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
  </div>
</div>