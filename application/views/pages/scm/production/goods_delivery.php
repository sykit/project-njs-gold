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
 								<li class="breadcrumb-item"><a href="<?= base_url(); ?>transactions">Transaksi</a></li>
 								<li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
 							</ol>
 						</nav>
 					</div>
 					<!-- end breadcrumb -->

 					<div class="row mb-lg-5 mb-2 mt-lg-4 pt-lg-2 transaction js-trans-prod-gd">
 						<div class="col col-12 col-lg-12">
 							<form id="gdSubmit" enctype="multipart/form-data" method="POST">
 								<div class="card text-left">
 									<div class="card-header">
 										<div class="d-flex gap-3 scm-header-menu">
 											<button type="button" name="save" title="Simpan"><i class="bi bi-save2-fill fs-3"></i></button>
 											<button type="button" name="send" title="Kirim" disabled><i class="bi bi-send-check-fill fs-3"></i></button>
 											<button type="button" name="print" title="Cetak" disabled><i class="bi bi-printer-fill fs-3"></i></button>
 										</div>
 									</div>
 									<div class="card-body print-area" id="transaction-content">
 										<div class="trans-title">
 											<h4 class="fw-bold mb-4 mb-lg-2"><?= $title; ?></h4>
 										</div>
 										<div class="transaction__header">
 											<div class="row mb-2">
 												<div class="col col-lg-2">
 													<label>
 														Kode Transaksi
 													</label>
 												</div>
 												<div class="col col-lg-4">
 													<input type="text" class="form-control js-kode-transaksi" name="trans_code" />
 												</div>
 											</div>
 											<div class="row mb-2">
 												<div class="col col-lg-2">
 													<label>
 														Tanggal Transaksi
 													</label>
 												</div>
 												<div class="col col-lg-4">
 													<select class="form-control js-gd-trans-date" name="trans_date" disabled>
 														<option value="<?php echo strtotime(date_create()->format('l, d-M-Y H:i:s')) * 1000; ?>" selected><?php echo date_create()->format('l, d-M-Y H:i:s'); ?></option>
 													</select>
 												</div>
 											</div>
 											<div class="row mb-2">
 												<div class="col col-lg-2">
 													<label>
 														Status Transaksi
 													</label>
 												</div>
 												<div class="col col-lg-4">
 													<select name="trans_status_id" class="form-control js-trans-status" disabled>
 														<?php
															foreach ($trans_status as $key => $item) {
																// 1 = draf
																$selected = $key == 1 ? 'selected' : '';
															?>
 															<option value="<?= $item->trans_status_id; ?>" <?= $selected; ?>>
 																<?= $item->trans_status_name; ?></option>
 														<?php
															}
															?>
 													</select>
 												</div>
 											</div>
 											<div class="row mb-2">
 												<div class="col col-lg-2">
 													<label>
 														Lokasi Transaksi
 													</label>
 												</div>
 												<div class="col col-lg-4">
 													<select class="form-control js-trans-loc1" name="trans_loc" disabled>
 														<?php
															foreach ($trans_loc as $item) {
															?>
 															<option value="<?= $item->company_id; ?>">
 																<?= $item->company_name; ?>
 															</option>
 														<?php
															}
															?>
 													</select>
 												</div>
 											</div>
 										</div>
 										<hr style="color:black" />
 										<div class="text-center text--blue-soft mb-lg-3 mb-4">
 											*DOKUMEN INI MERUPAKAN BUKTI TRANSAKSI YANG DIAKUI OLEH PT NJS*
 										</div>

 										<div class="transaction__detail">
 											<h6 class="fw-bold mb-4">Deskripsi Permintaan</h6>
 											<div class="row mb-2">
 												<div class="col col-lg-2">
 													<label>
 														Nomor SPOP
 													</label>
 												</div>
 												<div class="col col-lg-4">
 													<select class="form-control js-gd-nomor-spop" name="nomor-spop">
 														<option value=""> -- Pilih Nomor SPOP</option>
 														<?php
															foreach ($trans_spop as $item) {
															?>
 															<option value="<?= $item->trans_code; ?>">
 																<?= $item->trans_code; ?>
 															</option>
 														<?php
															}
															?>
 													</select>
 												</div>
 											</div>
 											<div class="row mb-2">
 												<div class="col col-lg-2">
 													<label>
 														Tipe Pelanggan
 													</label>
 												</div>
 												<div class="col col-lg-4">
 													<input type="text" class="form-control js-gd-ditujukan" disabled />
 												</div>
 											</div>
 											<div class="row mb-2">
 												<div class="col col-lg-2">
 													<label>
 														Kode Pelanggan
 													</label>
 												</div>
 												<div class="col col-lg-4">
 													<input type="text" class="form-control js-gd-ditujukan-code" disabled />
 												</div>
 											</div>
 											<div class="row mb-2">
 												<div class="col col-lg-2">
 													<label>
 														Total Berat
 													</label>
 												</div>
 												<div class="col col-lg-4">
 													<input type="number" class="form-control js-gd-total-berat" disabled />
 												</div>
 											</div>
 											<div class="row mb-2">
 												<div class="col col-lg-2">
 													<label>
 														Catatan
 													</label>
 												</div>
 												<div class="col col-lg-4">
 													<textarea class="form-control js-gd-notes" name="notes" rows="2" maxlength="64"></textarea>
 												</div>
 											</div>
 											<hr />
 											<div class="row mt-4">
 												<div class="col col-4 col-lg-2">
 													Disampaikan oleh:
 												</div>
 												<div class="col col-4 col-lg-2" style="border-bottom: 1px solid #ccc;">
 													<b><?php echo $this->session->userdata('surname'); ?></b>
 												</div>
 												<div class="col col-4 col-lg-2" style="border-bottom: 1px solid #ccc;">
 													<?php echo date('Y/m/d'); ?>
 												</div>
 											</div>

 											<div class="table-responsive mt-5">
 												<table class="table table-strip" id="js-table-trans-gp">
 													<thead>
 														<th>No</th>
 														<th>Nomor Model</th>
 														<th>Kategori</th>
 														<th>Sub Kategori</th>
 														<th>Kode Sepuh</th>
 														<th>Kode Kadar</th>
 														<th>Ukuran</th>
 														<th>Jumlah Order (pcs)</th>
 														<th>Jumlah Kirim (pcs)</th>
 														<th>Berat Kirim(gr)</th>
 													</thead>
 												</table>
 											</div>
 										</div>
 									</div>
 								</div>
 							</form>
 						</div>
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>
 </div>

 <script>
 	const $kode_transaksi = $(".js-kode-transaksi");
 	const $gd_nomor_spop = $(".js-gd-nomor-spop");
 	const $gd_ditujukan = $(".js-gd-ditujukan");
 	const $gd_ditujukan_code = $(".js-gd-ditujukan-code");
 	const $gd_total_berat = $(".js-gd-total-berat");
 	const $gd_trans_date = $(".js-gd-trans-date");
 	const $gd_jumlah_kirim = $(".js-gd-jumlah-kirim");
 	const $gd_notes = $(".js-gd-notes");
 	const trans_status = <?php echo json_encode($trans_status); ?>;
 	const workflow = <?php echo json_encode($workflow); ?>;
 	let datatable = "";
 	let data_trans_spop_selected = {};
 	let data_trans_detail = [];
 	let company_trans_loc2 = {};
 	let trans_header = {};
 	let submitted = false;
 	let loading = false;

 	$(document).ready(function() {
 		if ($(".js-trans-prod-gd").length > 0) {
 			utils.generateTranscode(15, "gd");

 			$gd_nomor_spop.select2();

 			// watch $gd_nomor_spop changes
 			$gd_nomor_spop.on("change", function(e) {
 				if (e !== null && e.target.value !== '') {
 					fetchTransDetail(e.target.value);

 					// error message
 					$gd_nomor_spop.parent().find(".js-err-msg").remove();
 				} else {
 					// clear value
 					$gd_ditujukan.val('');
 					$gd_ditujukan_code.val('');
 					$gd_total_berat.val(0);
 					datatable.clear().draw();
 				}
 			});

 			// submission listener
 			$("#gdSubmit button").on("click", function(e) {
 				e.preventDefault();

 				// re run generate trans code
 				utils.generateTranscode(15, "gd");

 				if ($(this).attr("name") == "save") {
 					Swal.fire({
 						title: "Pengiriman Hasil Produksi",
 						text: "Apakah anda yakin untuk menyimpan transaksi ini?",
 						icon: "question",
 						showCancelButton: true,
 						confirmButtonText: "Ya",
 						confirmButtonColor: "#3085d6",
 						cancelButtonColor: "#d33",
 						cancelButtonText: "Tidak"
 					}).then(async function(result) {
 						if (result.isConfirmed) {
 							getValueTransDetail();

 							// validation before submit
 							if (loading === true || isValid() === false) {
 								return;
 							}

 							loading = true;

 							// serialize data before save
 							let serialize = {
 								activity_id: 15,
 								trans_code: $kode_transaksi.val(),
 								trans_date: $gd_trans_date.val(),
 								trans_status_id: 1, // Draf -> Perlu Penyerahan Hasil Produksi 
 								trans_loc: 1,
 								trans_loc2: _.toNumber(data_trans_spop_selected.trans_loc2),
 								ref_doc: _.toNumber(data_trans_spop_selected.th_id),
 								next_pic: _.toNumber(_.get(_.find(workflow, function(w) {
 									return w.activity_id == 15
 								}), 'pic2', 0)),
 								next_loc: 1,
 								notes: _.trim($gd_notes.val()),
 								trans_detail: data_trans_detail,
 								trans_pic_detail: {
 									ths_id: _.toNumber(data_trans_spop_selected.th_id),
 									pic1: CURR_USER_ID,
 									pic2: _.toNumber(_.get(_.find(workflow, function(w) {
 										return w.activity_id == 15
 									}), 'pic2', 0))
 								}
 							};

 							const result = await submissionHandler(serialize, "Scm/Production/asyncgoodsdelivery/save_handler");
 							Swal.fire("Saved!", "", "success");

 							loading = false;

 							refetchAfterSave(result);
 						}
 					});
 				} else if ($(this).attr("name") == "send") {
 					Swal.fire({
 						title: "Pengiriman Hasil Produksi",
 						text: "Apakah anda yakin untuk kirim transaksi ini?",
 						icon: "question",
 						showCancelButton: true,
 						confirmButtonText: "Ya",
 						confirmButtonColor: "#3085d6",
 						cancelButtonColor: "#d33",
 						cancelButtonText: "Tidak"
 					}).then(async function(result) {
 						if (result.isConfirmed) {

 							// validation before submit
 							if (loading === true || isValid() === false) {
 								return;
 							}

 							loading = true;

 							// serialize data before save
 							let serialize = {
 								th_id: trans_header.th_id,
 								trans_status_id: 7
 							};

 							const result = await submissionHandler(serialize, "Scm/Production/asyncgoodsdelivery/send_handler");
 							Swal.fire("Status transaksi terkirim!", "", "success");

 							loading = false;

 							$('.js-trans-status').val('7');
 						}
 					});
 				} else if ($(this).attr("name") == "print") {
 					printData($(".print-area"));
 				}
 			});
 		}
 	});

 	function refetchAfterSave(data) {
 		data = JSON.parse(data);
 		trans_header = _.get(data, 'trans_header');

 		if (data.message == 'success') {
 			submitted = true;
 			fetchTransDetail(_.get(data, 'trans_header.trans_code'));

 			// disabled some tag
 			$gd_notes.prop('disabled', 'disabled');
 			$gd_nomor_spop.val(_.get(data, 'trans_header.trans_code'));
 			$gd_nomor_spop.prop('disabled', 'disabled');
 			$("#gdSubmit button[name=save]").prop('disabled', 'disabled');
 			$("#gdSubmit button[name=send]").prop('disabled', false);
 			$("#gdSubmit button[name=print]").prop('disabled', false);
 		}
 	}

 	function fetchTransDetail(th_code) {
 		return $.ajax({
 			url: URL +
 				"asyncsom/transacation_data?th_code=" +
 				th_code,
 			success: async function(data) {
 				data = JSON.parse(data);

 				data_trans_spop_selected = _.get(data, '0.0');
 				data_trans_detail = _.get(data, '1', []);

 				const trans_loc2 = _.get(data, '0.0.trans_loc2', '');

 				// set value total berat
 				const tberat = _.reduce(data_trans_detail, (acc, cval) => {
 					return acc + (cval.n2 ? _.toNumber(cval.n2) : 0)
 				}, 0);
 				$gd_total_berat.val(tberat);

 				// set list table
 				renderTableTransGD(data_trans_detail);

 				// fetch data company and set value tipe pelanggan and kode pelanggan
 				await fetchCompanyById(trans_loc2);
 				$gd_ditujukan.val(_.get(company_trans_loc2, 'company_type_name', ''));
 				$gd_ditujukan_code.val(_.get(company_trans_loc2, 'company_code', ''));
 			},
 		});
 	}

 	function fetchCompanyById(company_id) {
 		return $.ajax({
 			url: URL + "company/getcompanybyid/" + company_id,
 			success: function(data) {
 				data = JSON.parse(data);
 				company_trans_loc2 = data;
 			},
 			error: function(error) {
 				//
 			}
 		});
 	}

 	function renderTableTransGD(data) {
 		if (typeof datatable === 'string') {
 			datatable = new DataTable('#js-table-trans-gp', {
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
 						data: null
 					},
 					{
 						data: 'product_class_name'
 					},
 					{
 						data: 'product_category_name'
 					},
 					{
 						data: 'prd_sub_cat_name'
 					},
 					{
 						data: 'sepuh_name'
 					},
 					{
 						data: 'prd_rate_code'
 					},
 					{
 						data: 'ring_size'
 					},
 					{
 						data: 'n2' // qty
 					},
 					{
 						data: null
 					},
 					{
 						data: null
 					}
 				],
 				language: {
 					"emptyTable": "<i class='bi-info-circle-fill'></i>&nbsp;&nbsp;Tidak ada data yang ditampilkan"
 				},
 				createdRow: function(row, data, dataIndex) {
 					$(row).find('td:eq(0)').empty().append(dataIndex + 1);
 					$(row).find('td:eq(8)').empty().append(`
						<div class="input-group">
							<input id="jumlah-kirim-${dataIndex}" data-id="${data.td_id}" min="0" max="${data.n2}" value="${data.n2}" type="number" class="form-control" aria-label="jumlah-kirim-${dataIndex}" placeholder="0" ${submitted ? 'disabled' : ''} />
						</div>
					`);
 					$(row).find('td:eq(9)').empty().append(`
						<div class="input-group">
							<input id="berat-kirim-${dataIndex}" data-id="${data.td_id}" min="0" max="${data.n2}" value="${data.n3 ? data.n3 : ''}" type="number" class="form-control" aria-label="berat-kirim-${dataIndex}" placeholder="0" ${submitted ? 'disabled' : ''} />
						</div>
					`);
 					$(row).find('td:eq(10)').empty().append('-');
 				}
 			});
 		} else {
 			datatable.clear();
 			datatable.rows.add(data);
 			datatable.draw();
 		}
 	}

 	function getValueTransDetail() {
 		const inputs = document.getElementsByTagName("input");

 		const jumlah_kirim = _.filter(inputs, (v) => {
 			return v.id.startsWith('jumlah-kirim');
 		});
 		const berat_kirim = _.filter(inputs, (v) => {
 			return v.id.startsWith('berat-kirim');
 		});

 		data_trans_detail.forEach(function(v) {
 			const [jk_index, bk_index] = [
 				_.findIndex(jumlah_kirim, function(o) {
 					return v.td_id == _.get(o, "attributes.data-id.value")
 				}),
 				_.findIndex(berat_kirim, function(o) {
 					return v.td_id == _.get(o, "attributes.data-id.value")
 				})
 			];
 			_.set(v, 'n1', _.toNumber(_.get(v, 'n1')));
 			_.set(v, 'n2', _.toNumber(_.get(jumlah_kirim[jk_index], 'value')));
 			_.set(v, 'n3', _.toNumber(_.replace(_.get(berat_kirim[bk_index], 'value'), ',', '.')));
 		});
 	}

 	// start validation process
 	function isValid() {
 		const error_thread = [];

 		if ($gd_nomor_spop.val() == "") {
 			if ($gd_nomor_spop.parent().find(".js-err-msg").length == 0) {
 				$gd_nomor_spop
 					.parent()
 					.append(
 						`<span class="text-danger js-err-msg">` + MSG_NO_EMPTY + `</span>`
 					);
 			}
 			error_thread.push("error");
 		}

 		if (data_trans_detail.length == 0) {
 			error_thread.push("error");
 			Swal.fire({
 				icon: "error",
 				title: "Data order kosong",
 				text: "Mohon pilih transaksi SPOP yang memiliki data order!",
 			});
 		} else if (data_trans_detail.length > 0) {
 			data_trans_detail.forEach(function(v) {
 				if (v.n2 > v.n1) {
 					error_thread.push("error");
 					Swal.fire({
 						icon: "error",
 						title: "Data Order",
 						text: "Jumlah kirim tidak boleh lebih dari jumlah order!",
 					});
 					return;
 				}
 				if ((v.n2 !== '' || v.n2 > 0) && (v.n3 == '' || v.n3 === 0)) {
 					error_thread.push("error");
 					Swal.fire({
 						icon: "error",
 						title: "Data Order",
 						text: "Mohon lengkapi jumlah kirim atau berat kirim pada data order!",
 					});
 				}
 			})
 		}

 		return !error_thread.length;
 	};
 </script>