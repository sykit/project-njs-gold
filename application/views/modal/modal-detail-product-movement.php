<!-- Modal Detail Product Movement -->
<div class="modal fade" id="detailProdukMovement" tabindex="-1" aria-labelledby="detailProdukMovementLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
		<input type="hidden" name="company_id">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="detailProdukMovementLabel"><span id="namaSection" class="modal-title fs-5"></span></h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">

				<div class="row">
					<div class="col col-12 col-lg-12 mb-lg-2 mb-2 row">
						<table class="table table-strip " id="tabel_detail_product_movement" style="width: 100%">
							<thead>
								<tr>
									<th>Kode Transaksi</th>
									<th>Transaksi</th>
									<th>Tanggal Transaksi</th>
									<th>Kode Pelanggan</th>
									<th>PIC Transaksi</th>
									<th>Kategori Produk</th>
									<th>Sub Kategori Produk</th>
									<th>Kadar</th>
									<th>Sepuh</th>
									<th>Jumlah Order</th>
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

<script>
	let dTable2 = "";

	function openDetailProductMovement(activity_id, name_section) {
		let start_data = $('#rangeView input[name=start_data]').val();
		let end_date = $('#rangeView input[name=end_date]').val();

		$('#detailProdukMovement #namaSection').empty().append(name_section)

		$.ajax({
			url: URL + "Asyncproductmovement/getAllProductMovement/" + start_data + "/" + end_date + "/" + activity_id,
			success: function(data) {
				data = JSON.parse(data);

				console.log('data success', data);

				if (typeof dTable2 === 'string') {
					dTable2 = new DataTable('#tabel_detail_product_movement', {
						bFilter: false,
						bSort: false,
						ordering: false,
						processing: true,
						serverSide: false,
						responsive: true,
						searching: true,
						paging: true,
						select: true,
						bInfo: true,
						data: data,
						columns: [{
								data: 'trans_code'
							},
							{
								data: 'activity_name'
							},
							{
								data: 'submit_date'
							},
							{
								data: 'company_code'
							},
							{
								data: 'pic'
							},
							{
								data: 'product_category_name'
							},
							{
								data: 'prd_sub_cat_name'
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
							}
						],
						language: {
							"emptyTable": "<i class='bi-info-circle-fill'></i>&nbsp;&nbsp;Tidak ada data yang ditampilkan"
						}
					});
				} else {
					dTable2.clear();
					dTable2.rows.add(data);
					dTable2.draw();
				}
			},
			error: function(error) {
				console.log('error', error);
			}
		});
	}
</script>