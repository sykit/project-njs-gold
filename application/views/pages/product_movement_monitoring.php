<!-- bottombar -->
<?php $this->load->view("bottombar.php") ?>
<!-- end bottombar -->

<div class="container-fluid">
	<div class="row mb-3 mb-lg-1">
		<div class="col col-xl-2 col-1 d-none d-lg-block p-0 m-0">

			<!-- start sidebar -->
			<?php $this->load->view("sidemenu.php") ?>
			<!-- end sidebar -->

		</div>

		<div class="col col-xl-10 col-md-10 m-0 p-0">
			<div class="menu__right">
				<div class="menu__right--topper">
					<!-- start topbar -->
					<?php $this->load->view("topbar.php") ?>
					<!-- end topba -->
				</div>
				<div class="menu__right--wrapper">
					<!-- breadcrumb -->
					<div class="d-block ms-auto">
						<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Beranda</a></li>
								<li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
							</ol>
						</nav>
					</div>
					<!-- end breadcrumb -->

					<!-- respons -->
					<?php $this->load->view('/components/response.php'); ?>
					<!-- end respons -->

					<div class="row mb-lg-3 mb-2 mt-lg-3  pt-lg-2">
						<div class="mb-lg-5 mb-2 mt-lg-4  pt-lg-2">
							<div class="col col-12 col-lg-6 mb-lg-2 mb-2" id="rangeView">
								<div class="row">
									<div class="col-2 d-flex align-items-center">
										<label class="text-right">Tanggal Mulai</label>
									</div>
									<div class="col-10">
										<input type="date" name="start_data" class="form-control js-report-mv-date-start" />
									</div>
								</div>
								<div class="row mt-3">
									<div class="col-2 d-flex align-items-center">
										<label class="text-right">Tanggal Selesai</label>
									</div>
									<div class=" col-10">
										<input type="date" name="end_date" class="form-control js-report-mv-date-end" />
									</div>
								</div>
								<div class="row mt-3">
									<div class="col-2">

									</div>
									<div class="col-push-2 col-10">
										<button type="button" class="btn btn-primary" onclick="updateTable()">
											Proses
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col col-12 col-lg-12">
						<table class="table table-strip" id="tabel_product_movement">
							<thead>
								<tr>
									<th>Jumlah Order</th>
									<th>Jumlah Terverifikasi</th>
									<th>Jumlah Proses SPOP</th>
									<th>Pengiriman Hasil Produksi</th>
									<th>Serah Terima Produksi</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view("modal/modal-detail-product-movement.php"); ?>

<script>
	let dTable = "";

	$(function() {
		// init
		updateTable();
	});

	function updateTable() {
		let start_data = $('#rangeView input[name=start_data]').val();
		let end_date = $('#rangeView input[name=end_date]').val();

		// set dafault value
		if (!start_data) {
			const dateThirtyDaysAgo = new Date(new Date().setDate(new Date().getDate() - 30)).toISOString().slice(0, 10);
			$('#rangeView input[name=start_data]').attr('value', dateThirtyDaysAgo);
			start_data = $('#rangeView input[name=start_data]').val();
		}
		if (!end_date) {
			const dateNow = new Date().toISOString().slice(0, 10);
			$('#rangeView input[name=end_date]').attr('value', dateNow);
			end_date = $('#rangeView input[name=end_date]').val();
		}

		const activity_id = {
			jumlah_order: 1,
			jumlah_verif: 13,
			jumlah_spop: 14,
			jumlah_GD: 15,
			jumlah_GR: 16
		}

		$.ajax({
			url: URL + "Asyncproductmovement/getSummaryProductMovement/" + start_data + "/" + end_date,
			success: function(data) {
				data = JSON.parse(data);

				if (typeof dTable === 'string') {
					dTable = new DataTable('#tabel_product_movement', {
						bFilter: false,
						bSort: false,
						ordering: false,
						processing: true,
						serverSide: false,
						responsive: true,
						searching: false,
						paging: false,
						select: true,
						bInfo: false,
						data: data,
						columns: [{
								data: 'jumlah_order',
								class: 'text-end'
							},
							{
								data: 'jumlah_verif',
								class: 'text-end'
							},
							{
								data: 'jumlah_spop',
								class: 'text-end'
							},
							{
								data: 'jumlah_GD',
								class: 'text-end'
							},
							{
								data: 'jumlah_GR',
								class: 'text-end'
							}
						],
						language: {
							"emptyTable": "<i class='bi-info-circle-fill'></i>&nbsp;&nbsp;Tidak ada data yang ditampilkan"
						},
						createdRow: function(row, data, dataIndex) {
							let str = '<a class="text-primary" data-bs-target="#detailProdukMovement" data-bs-toggle="modal" onclick="openDetailProductMovement(\'' + activity_id.jumlah_order + '\',\'Jumlah Order\')" >' + data.jumlah_order + '</a>'
							$(row).find('td:eq(0)').empty().append(str);

							let str1 = '<a class="text-primary" data-bs-target="#detailProdukMovement" data-bs-toggle="modal" onclick="openDetailProductMovement(\'' + activity_id.jumlah_verif + '\',\'Jumlah Terverifikasi\')" >' + data.jumlah_verif + '</a>'
							$(row).find('td:eq(1)').empty().append(str1);

							let str2 = '<a class="text-primary" data-bs-target="#detailProdukMovement" data-bs-toggle="modal" onclick="openDetailProductMovement(\'' + activity_id.jumlah_spop + '\',\'Jumlah Proses SPOP\')" >' + data.jumlah_spop + '</a>'
							$(row).find('td:eq(2)').empty().append(str2);

							let str3 = '<a class="text-primary" data-bs-target="#detailProdukMovement" data-bs-toggle="modal" onclick="openDetailProductMovement(\'' + activity_id.jumlah_GD + '\',\'Pengiriman Hasil Produksi	\')" >' + data.jumlah_GD + '</a>'
							$(row).find('td:eq(3)').empty().append(str3);

							let str4 = '<a class="text-primary" data-bs-target="#detailProdukMovement" data-bs-toggle="modal" onclick="openDetailProductMovement(\'' + activity_id.jumlah_GR + '\',\'Serah Terima Produksi	\')" >' + data.jumlah_GR + '</a>'
							$(row).find('td:eq(4)').empty().append(str4)
						}
					});
				} else {
					dTable.clear();
					dTable.rows.add(data);
					dTable.draw();
				}
			},
			error: function(error) {
				console.log('error', error);
			}
		});
	}
</script>