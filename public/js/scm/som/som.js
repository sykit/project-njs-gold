const $th_ditujukan = $(".js-som-ditujukan");
const $th_kode_transaksi = $(".js-kode-transaksi");
const $th_tanggal_transaksi = $("select[name='trans_date']");
const $th_status_transaksi = $(".js-trans-status");
const $th_lokasi_transaksi = $(".js-trans-loc1");

const $th_permintaan = $(".js-som-permintaan");
const $th_date_expect = $(".js-som-date-expect");
const $th_date_result = $(".js-som-date-result");
const $table_order_som = $(".js-table-order-body");
const $th_notes = $(".js-som-notes");
const $th_notes_verify = $(".js-vsom-notes-verifier");

$(function () {
	if ($(".js-trans-som").length > 0) {
		utils.generateTranscode(1, "som");
		setInterval(function () {
			utils.generateTranscode(1, "som");
		}, 3000);

		$th_ditujukan.empty();
		$th_ditujukan.select2();
		$th_tanggal_transaksi.select2();
		$th_status_transaksi.select2();
		$th_lokasi_transaksi.select2();
		$th_permintaan.select2();

		$.ajax({
			url: URL + "asyncsom/companytype",
			success: function (data) {
				data = JSON.parse(data);
				let adapter = `<option value=0>-- Pilih Kategori Pelanggan</option>`;
				let datalen = data.length;
				$th_ditujukan.append(adapter);
				for (let i = 0; i < datalen; i++) {
					adapter =
						`<option value='` +
						data[i].company_type_id +
						`'>` +
						data[i].company_type_name +
						`</option>`;
					$th_ditujukan.append(adapter);
				}
			},
			error: function (err) {
				console.log(err);
			},
		});

		$th_ditujukan.on("change", function (e) {
			let val = $(this).val();
			let adapter = `<option value="0">-- Pilih Permintaan untuk</option>`;

			$th_permintaan.empty();
			$th_permintaan.append(adapter);

			if (val != 0 || val != "0") {
				$.ajax({
					url: URL + "asyncsom/company/" + val,
					success: function (data) {
						data = JSON.parse(data);
						let datalen = data.length;
						for (let i = 0; i < datalen; i++) {
							adapter =
								`<option value='` +
								data[i].company_id +
								`'>` +
								data[i].company_code +
								`</option>`;
							$th_permintaan.append(adapter);
						}
					},
					error: function (err) {
						console.log(err);
					},
				});
			} else {
				$th_permintaan.empty();
			}
		});

		$th_permintaan.on("change", function (e) {
			let val = $(this).val();
			$th_permintaan.parent().find(".js-err-msg").remove();
			$.ajax({
				url: URL + "asyncsom/user/" + val,
				success: function (data) {
					data = JSON.parse(data);
				},
				error: function (err) {
					console.log(err);
				},
			});
		});

		$th_date_expect.on("change", function () {
			$th_date_expect.parent().find(".js-err-msg").remove();
		});

		// start validation process
		let somValidation = function () {
			let error_thread = [];
			if ($th_permintaan.val() == "" || $th_permintaan.children().length == 0) {
				if ($th_permintaan.parent().find(".js-err-msg").length == 0) {
					$th_permintaan
						.parent()
						.append(
							`<span class="text-danger js-err-msg">` + MSG_NO_EMPTY + `</span>`
						);
				}
				error_thread.push("error");
			}

			if ($th_date_expect.val() == "") {
				if ($th_date_expect.parent().find(".js-err-msg").length == 0) {
					$th_date_expect
						.parent()
						.append(
							`<span class="text-danger js-err-msg">` + MSG_NO_EMPTY + `</span>`
						);
				}
				error_thread.push("error");
			}

			if ($table_order_som.length > 0) {
				if ($table_order_som.children().length == 0) {
					error_thread.push("error");
					Swal.fire({
						icon: "error",
						title: "Data order kosong",
						text: "Mohon tambahkan data order",
					});
				}
			}

			console.log(error_thread);
			return error_thread;
		};

		// submission listener
		$("#somSubmit button").on("click", function (e) {
			e.preventDefault();
			if ($(this).attr("name") == "save") {
				// save
				somValidation();

				// serialize data before save
				let serialize = {
					activity_id: 1,
					trans_code: $.trim($(".js-kode-transaksi").val()),
					trans_date: $.trim(
						$("#somSubmit").find('input[name="trans_date"]').val()
					),
					trans_status_id: parseInt($.trim($(".js-trans-status").val())),
					trans_loc: parseInt($.trim($(".js-trans-loc1").val())),
					trans_loc2: parseInt($.trim($(".js-som-ditujukan").val())),
					ref_doc: "",
					ref_doc2: "",
					next_pic: "",
					next_loc: "",
					date_expected: $.trim(
						$("#somSubmit").find('input[name="date_expected"]').val()
					),
					date_result: $.trim(
						$("#somSubmit").find('input[name="date_result"]').val()
					),
					notes: $.trim($("#somSubmit").find('textarea[name="notes"]').val()),
					s1: parseInt($.trim($(".js-som-permintaan").val())), // user code
					s2: "",
					n1: "",
					n2: CURR_USER_ID,
					trans_detail: DATA_ORDER_DETAIL,
					trans_pic_detail: {
						pic1: CURR_USER_ID,
					},
				};

				if (somValidation().length == 0) {
					Swal.fire({
						text: "Apakah anda yakin untuk simpan transaksi ini",
						showDenyButton: false,
						showCancelButton: true,
						confirmButtonText: "Yes",
					}).then((result) => {
						if (result.isConfirmed) {
							Swal.fire("Tersimpan!", "", "success");
							submissionHandler(serialize, "asyncsom/save_handler");
						}
					});
				}
			} else if ($(this).attr("name") == "send") {
				// send

				// serialize data before submit
				let serialize = {
					activity_id: 1,
					trans_code: $.trim($(".js-kode-transaksi").val()),
					trans_date: $.trim(
						$("#somSubmit").find('input[name="trans_date"]').val()
					),
					trans_status_id: 2,
					trans_loc: parseInt($.trim($(".js-trans-loc1").val())),
					trans_loc2: parseInt($.trim($(".js-som-ditujukan").val())),
					ref_doc: "",
					ref_doc2: "",
					next_pic: 11,
					next_loc: "",
					date_expected: $.trim(
						$("#somSubmit").find('input[name="date_expected"]').val()
					),
					date_result: $.trim(
						$("#somSubmit").find('input[name="date_result"]').val()
					),
					notes: $.trim($("#somSubmit").find('textarea[name="notes"]').val()),
					s1: parseInt($.trim($(".js-som-permintaan").val())), // user code
					s2: "",
					n1: "",
					n2: CURR_USER_ID,
					trans_detail: DATA_ORDER_DETAIL,
					trans_pic_detail: {
						pic1: CURR_USER_ID,
						date_submit1: utils.currentTimeMilis(),
					},
				};
				if (somValidation().length == 0) {
					Swal.fire({
						text: "Apakah anda yakin untuk mengirim transaksi ini",
						showDenyButton: false,
						showCancelButton: true,
						confirmButtonText: "Yes",
					}).then((result) => {
						if (result.isConfirmed) {
							Swal.fire("Tersimpan!", "", "success");
							submissionHandler(serialize, "asyncsom/submit_handler");
						}
					});
				}
			} else if ($(this).attr("name") == "reject") {
				// reject
				let serialize = {
					activity_id: 1,
					trans_status_id: -99,
					trans_code: $.trim($("#somSubmit").find('input[name="trans_code"]').val())
				};
				submissionHandler(serialize, "asyncsom/update_handler");
			} else if ($(this).attr("name") == "followup") {
				submissionHandler(serialize, "asyncsom/followup_handler");
			} else if ($(this).attr("name") == "print") {
				printData($(".print-area"));
			}
		});
	}
});

function renderTables() {
	$(".js-table-order-body").empty();
	setTimeout(function () {
		spinLoader(".js-table-order-body");
		setTimeout(function () {
			$(".js-table-order-body").empty();
			for (let i = 0; i < DATA_ORDER_DETAIL.length; i++) {
				$adapter =
					`<tr id='table_id` +
					i +
					`'>
                               <td>` +
					parseInt(i + 1) +
					`</td>
                               <td>` +
					DATA_ORDER_DETAIL[i].product_class_name +
					`</td>
                               <td>` +
					DATA_ORDER_DETAIL[i].product_category_name +
					`</td>
                               <td>` +
					DATA_ORDER_DETAIL[i].prd_sub_cat_name +
					`</td>
                               <td>` +
					DATA_ORDER_DETAIL[i].sepuh_name +
					`</td>
                               <td>` +
					DATA_ORDER_DETAIL[i].rate_name +
					`</td>
                               <td>` +
					DATA_ORDER_DETAIL[i].qty +
					`</td>
                               <td>` +
					DATA_ORDER_DETAIL[i].ring_size_name +
					`</td>
                               <td>` +
					DATA_ORDER_DETAIL[i].keterangan +
					`</td>
                               <td class="d-flex gap-2 no-print">
                                   <button title="Edit Data" type="button" type="button" class="fw-bold btn btn-primary" 
                                       data-bs-toggle="modal" 
                                       data-bs-target="#somEditProduct"
                                       data-product-class-id="` +
					DATA_ORDER_DETAIL[i].product_class_id +
					`"
                                       data-product-category-id="` +
					DATA_ORDER_DETAIL[i].product_category_id +
					`"
                                       data-product-sub-cat-id="` +
					DATA_ORDER_DETAIL[i].prd_sub_cat_id +
					`"
                                       data-product-rate-id="` +
					DATA_ORDER_DETAIL[i].rate_id +
					`"
                                       data-product-size-id="` +
					DATA_ORDER_DETAIL[i].ring_size_id +
					`"
                                       data-product-qty="` +
					DATA_ORDER_DETAIL[i].qty +
					`"
                                       data-product-keterangan="` +
					DATA_ORDER_DETAIL[i].keterangan +
					`"
                                       data-product-sepuh-id="` +
					DATA_ORDER_DETAIL[i].sepuh_id +
					`"
                                       data-index="` +
					i +
					`"
                                       
                                       ><i class="bi bi-pencil"></i></button>
                                   <button title="Hapus Data" type="button" class="fw-bold btn btn-danger" onclick="utils.deleteOrder(` +
					i +
					`)"><i class="bi bi-trash"></i></button>
                                   <button title="Duplikat Data" type="button" class="fw-bold btn btn-warning" onclick="utils.cloneOrder(` +
					i +
					`)">
																			<i class="bi bi-clipboard-check"></i>
                                   </button>
                               </td>
                           </tr>`;
				$(".js-table-order-body").append($adapter);
			}
		}, 50);
	}, 1);
}

function renderTablesFilter() {
	$(".js-table-order-body").empty();
	setTimeout(function () {
		spinLoader(".js-table-order-body");
		setTimeout(function () {
			$(".js-table-order-body").empty();
			for (let i = 0; i < DATA_ORDER_DETAIL.length; i++) {
				$adapter =
					`<tr id='table_id` +
					i +
					`'>
                               <td>` +
					parseInt(i + 1) +
					`</td>
                               <td>` +
					DATA_ORDER_DETAIL[i].product_class_name +
					`</td>
                               <td>` +
					DATA_ORDER_DETAIL[i].product_category_name +
					`</td>
                               <td>` +
					DATA_ORDER_DETAIL[i].prd_sub_cat_name +
					`</td>
                               <td>` +
					DATA_ORDER_DETAIL[i].sepuh_name +
					`</td>
                               <td>` +
					DATA_ORDER_DETAIL[i].rate_name +
					`</td>
                               <td>` +
					DATA_ORDER_DETAIL[i].qty +
					`</td>
                               <td>` +
					DATA_ORDER_DETAIL[i].ring_size_name +
					`</td>
                               <td>` +
					DATA_ORDER_DETAIL[i].keterangan +
					`</td>
					<td>
						<select class="js-som-toprocess" onchange="processSOMVerification(this)" id="som-process-`+i+`" data-index="`+i+`" style="padding: 4px 8px; border: 1px solid #ccc; border-radius: 5px; ">
							<option value='1'>Proses</option>
							<option value='0'>Tunda/Tolak</option>
						</select>
					</td>
                           </tr>`;
				$(".js-table-order-body").append($adapter);
			}
		}, 50);
	}, 1);
}

function processSOMVerification(e){
	let $elem = $(e);
	let index = $elem.data('index');
	let value = $elem.val();
	DATA_ORDER_DETAIL[index].isProcessed = value;
}

function filterPROCESS_SOM(){
	let i = 0 ;
	FILTERED_DATA_ORDER_DETAIL = [];

	if(DATA_ORDER_DETAIL.length == 0) return;
	for(i ; i < DATA_ORDER_DETAIL.length ; i++){
		if(DATA_ORDER_DETAIL[i].isProcessed == 1){
			FILTERED_DATA_ORDER_DETAIL.push(DATA_ORDER_DETAIL[i]);
		}
	}

	console.log(FILTERED_DATA_ORDER_DETAIL);
}