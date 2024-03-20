const $th_por_ditujukan = $(".js-por-ditujukan");
const $th_por_kode_transaksi = $(".js-kode-transaksi");
const $th_por_tanggal_transaksi = $("select[name='trans_date']");
const $th_por_status_transaksi = $(".js-trans-status");
const $th_por_lokasi_transaksi = $(".js-trans-loc1");

const $th_por_permintaan = $(".js-por-permintaan");
const $th_por_date_expect = $(".js-por-date-expect");
const $th_por_date_result = $(".js-por-date-result");
const $table_order_por = $(".js-table-order-body");
const $th_por_notes = $(".js-por-notes");
const $th_por_notes_verify = $(".js-por-notes-verifier");

$(function () {
	if ($(".js-trans-por").length > 0) {
		utils.generateTranscode(1, "por");
		setInterval(function () {
			utils.generateTranscode(18, "por");
		}, 3000);

		$th_por_ditujukan.empty();
		$th_por_ditujukan.select2();
		$th_por_tanggal_transaksi.select2();
		$th_por_status_transaksi.select2();
		$th_por_lokasi_transaksi.select2();
		$th_por_permintaan.select2();

		$.ajax({
			url: URL + "asyncsom/companytype",
			success: function (data) {
				data = JSON.parse(data);
				let adapter = `<option value=0>-- Pilih Kategori Pelanggan</option>`;
				let datalen = data.length;
				$th_por_ditujukan.append(adapter);
				for (let i = 0; i < datalen; i++) {
					adapter =
						`<option value='` +
						data[i].company_type_id +
						`'>` +
						data[i].company_type_name +
						`</option>`;
					$th_por_ditujukan.append(adapter);
				}
			},
			error: function (err) {
				console.log(err);
			},
		});

		$th_por_ditujukan.on("change", function (e) {
			let val = $(this).val();
			let adapter = `<option value="0">-- Pilih Permintaan untuk</option>`;

			$th_por_permintaan.empty();
			$th_por_permintaan.append(adapter);

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
							$th_por_permintaan.append(adapter);
						}
					},
					error: function (err) {
						console.log(err);
					},
				});
			} else {
				$th_por_permintaan.empty();
			}
		});

		$th_por_permintaan.on("change", function (e) {
			let val = $(this).val();
			$th_por_permintaan.parent().find(".js-err-msg").remove();
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

		$th_por_date_expect.on("change", function () {
			$th_por_date_expect.parent().find(".js-err-msg").remove();
		});

		// start validation process
		let porValidation = function () {
			let error_thread = [];
			if ($th_por_permintaan.val() == "" || $th_por_permintaan.children().length == 0) {
				if ($th_por_permintaan.parent().find(".js-err-msg").length == 0) {
					$th_por_permintaan
						.parent()
						.append(
							`<span class="text-danger js-err-msg">` + MSG_NO_EMPTY + `</span>`
						);
				}
				error_thread.push("error");
			}

			if ($th_por_date_expect.val() == "") {
				if ($th_por_date_expect.parent().find(".js-err-msg").length == 0) {
					$th_por_date_expect
						.parent()
						.append(
							`<span class="text-danger js-err-msg">` + MSG_NO_EMPTY + `</span>`
						);
				}
				error_thread.push("error");
			}

			if ($table_order_por.length > 0) {
				if ($table_order_por.children().length == 0) {
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
		$("#porSubmit button").on("click", function (e) {
			e.preventDefault();
			if ($(this).attr("name") == "save") {
				// save
				porValidation();

				// serialize data before save
				let serialize = {
					activity_id: 1,
					trans_code: $.trim($(".js-kode-transaksi").val()),
					trans_date: $.trim(
						$("#porSubmit").find('input[name="trans_date"]').val()
					),
					trans_status_id: parseInt($.trim($(".js-trans-status").val())),
					trans_loc: parseInt($.trim($(".js-trans-loc1").val())),
					trans_loc2: parseInt($.trim($(".js-por-ditujukan").val())),
					ref_doc: "",
					ref_doc2: "",
					next_pic: "",
					next_loc: "",
					date_expected: $.trim(
						$("#porSubmit").find('input[name="date_expected"]').val()
					),
					date_result: $.trim(
						$("#porSubmit").find('input[name="date_result"]').val()
					),
					notes: $.trim($("#porSubmit").find('textarea[name="notes"]').val()),
					s1: parseInt($.trim($(".js-por-permintaan").val())), // user code
					s2: "",
					n1: "",
					n2: CURR_USER_ID,
					trans_detail: DATA_ORDER_DETAIL,
					trans_pic_detail: {
						pic1: CURR_USER_ID,
					},
				};

				if (porValidation().length == 0) {
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
						$("#porSubmit").find('input[name="trans_date"]').val()
					),
					trans_status_id: 2,
					trans_loc: parseInt($.trim($(".js-trans-loc1").val())),
					trans_loc2: parseInt($.trim($(".js-por-ditujukan").val())),
					ref_doc: "",
					ref_doc2: "",
					next_pic: 11,
					next_loc: "",
					date_expected: $.trim(
						$("#porSubmit").find('input[name="date_expected"]').val()
					),
					date_result: $.trim(
						$("#porSubmit").find('input[name="date_result"]').val()
					),
					notes: $.trim($("#porSubmit").find('textarea[name="notes"]').val()),
					s1: parseInt($.trim($(".js-por-permintaan").val())), // user code
					s2: "",
					n1: "",
					n2: CURR_USER_ID,
					trans_detail: DATA_ORDER_DETAIL,
					trans_pic_detail: {
						pic1: CURR_USER_ID,
						date_submit1: utils.currentTimeMilis(),
					},
				};
				if (porValidation().length == 0) {
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
					trans_code: $.trim($("#porSubmit").find('input[name="trans_code"]').val())
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

function renderTablesPor() {
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
                                       data-bs-target="#porEditProduct"
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

function renderTablesPorFilter() {
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
						<select class="js-por-toprocess" onchange="processPORVerification(this)" id="por-process-`+i+`" data-index="`+i+`" style="padding: 4px 8px; border: 1px solid #ccc; border-radius: 5px; ">
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

function processPORVerification(e){
	let $elem = $(e);
	let index = $elem.data('index');
	let value = $elem.val();
	DATA_ORDER_DETAIL[index].isProcessed = value;
}

function filterPROCESS_POR(){
	let i = 0 ;
	FILTERED_DATA_ORDER_DETAIL = [];
	for(i ; i < DATA_ORDER_DETAIL.length ; i++){
		if(DATA_ORDER_DETAIL[i].isProcessed == 1){
			FILTERED_DATA_ORDER_DETAIL.push(DATA_ORDER_DETAIL[i]);
		}
	}

	console.log(FILTERED_DATA_ORDER_DETAIL);
}
$(function () {
	if ($(".js-trans-por-inprocess").length > 0 || $(".js-trans-por-masuk").length > 0) {
		$.ajax({
			url:
				URL +
				"asyncsom/transacation_data?th_code=" +
				trans_code.toString().trim(),
			success: function (data) {
				data = JSON.parse(data);

				// retrieve trans header
				setTimeout(function () {
					$th_por_ditujukan.trigger("change.select");
					setTimeout(function () {
						$th_por_ditujukan.val(data[0][0].trans_loc2).change();
					}, 50);
				}, 15);

				setTimeout(function () {
					$th_por_permintaan.trigger("change.select");
					setTimeout(function () {
						$th_por_permintaan.val(data[0][0].s1).change();
						$th_por_date_expect.val(data[0][0].date_expected);
					}, 100);
				}, 100);

				// retrieve trans detail
				if (data[1].length) {
					DATA_ORDER_DETAIL = data[1];
					for (let index = 0; index < data[1].length; index++) {
						DATA_ORDER_DETAIL[index].product_category_id = data[1][index].product_category_id;
						DATA_ORDER_DETAIL[index].prd_sub_cat_id = data[1][index].product_sub_category_id;
						DATA_ORDER_DETAIL[index].product_class_id = data[1][index].product_class_id;
						DATA_ORDER_DETAIL[index].prd_rate_id = data[1][index].rate_id;
						DATA_ORDER_DETAIL[index].sepuh_id = data[1][index].sepuh_id;
						DATA_ORDER_DETAIL[index].qty = data[1][index].n2 || "-";
						DATA_ORDER_DETAIL[index].product_category_name = data[1][index].product_category_name;
						DATA_ORDER_DETAIL[index].prd_sub_cat_name = data[1][index].prd_sub_cat_name;
						DATA_ORDER_DETAIL[index].product_class_name = data[1][index].product_class_name;
						DATA_ORDER_DETAIL[index].rate_name = data[1][index].prd_rate_code;
						DATA_ORDER_DETAIL[index].sepuh_name = data[1][index].sepuh_code;

						var isRingCategory = SUB_KATEGORI_CINCIN.includes(parseInt(data[1][index].product_sub_category_id));
						var isOtherCategory = SUB_KATEGORI_GELANG_SET.includes(parseInt(data[1][index].product_sub_category_id));
						if(isRingCategory){
							DATA_ORDER_DETAIL[index].ring_size_id = data[1][index].ring_size_id;
							DATA_ORDER_DETAIL[index].ring_size_name = data[1][index].ring_size;
						}else if(isOtherCategory){
							DATA_ORDER_DETAIL[index].ring_size_id = data[1][index].bracelet_size_id;
							DATA_ORDER_DETAIL[index].ring_size_name = data[1][index].bracelet_size + ' ' + data[1][index].bracelet_design;
						}
						
						DATA_ORDER_DETAIL[index].keterangan = data[1][index].td_notes == null ? '-' : data[1][index].td_notes;
					}

					rendersTableInprocessPor();
				} else {
					console.log("tidak ada data trans detail");
				}
			},
		});
	}
});

function rendersTableInprocessPor() {
	$(".js-table-order-body-inprocess").empty();
	setTimeout(function () {
		spinLoader(".js-table-order-body-inprocess");
		setTimeout(function () {
			$(".js-table-order-body-inprocess").empty();
			for (let i = 0; i < DATA_ORDER_DETAIL.length; i++) {
				var ring_size = DATA_ORDER_DETAIL[i].ring_size_name == undefined ? '-' : DATA_ORDER_DETAIL[i].ring_size_name;

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
					DATA_ORDER_DETAIL[i].qty +
					`</td>
							<td>` +
					ring_size+
					`</td>
							<td>` +
					DATA_ORDER_DETAIL[i].n2 +
					`</td>
						</tr>`;
				$(".js-table-order-body-inprocess").append($adapter);
			}
		}, 50);
	}, 1);
}
// reference all global varibles in som.js
// query param from uri inprogress?th_code=SOM-12/18/2023-6
const urlParams = new URLSearchParams(window.location.search);

// remarks has true check, get for edit
const trans_code = urlParams.has("th_code") ? urlParams.get("th_code") : "";

$(function () {
	if (
		$(".js-trans-por-inprogress").length > 0
	) {
		$.ajax({
			url:
				URL +
				"asyncsom/transacation_data?th_code=" +
				trans_code.toString().trim(),
			success: function (data) {
				data = JSON.parse(data);

				// retrieve trans header
				setTimeout(function () {
					$th_por_ditujukan.trigger("change.select");
					setTimeout(function () {
						$th_por_ditujukan.val(data[0][0].trans_loc2).change();
					}, 50);
				}, 15);

				setTimeout(function () {
					$th_por_permintaan.trigger("change.select");
					setTimeout(function () {
						$th_por_permintaan.val(data[0][0].s1).change();
						$th_por_date_expect.val(data[0][0].date_expected);
					}, 100);
				}, 100);

				// retrieve trans detail
				if (data[1].length) {
					DATA_ORDER_DETAIL = data[1];
					for (let index = 0; index < data[1].length; index++) {
						DATA_ORDER_DETAIL[index].product_category_id = data[1][index].product_category_id;
						DATA_ORDER_DETAIL[index].prd_sub_cat_id = data[1][index].product_sub_category_id;
						DATA_ORDER_DETAIL[index].product_class_id = data[1][index].product_class_id;
						DATA_ORDER_DETAIL[index].prd_rate_id = data[1][index].rate_id;
						DATA_ORDER_DETAIL[index].sepuh_id = data[1][index].sepuh_id;
						DATA_ORDER_DETAIL[index].qty = data[1][index].n1 || "-";
						DATA_ORDER_DETAIL[index].weight = data[1][index].n2 || "-";
						DATA_ORDER_DETAIL[index].product_category_name = data[1][index].product_category_name;
						DATA_ORDER_DETAIL[index].prd_sub_cat_name = data[1][index].prd_sub_cat_name;
						DATA_ORDER_DETAIL[index].product_class_name = data[1][index].product_class_name;
						DATA_ORDER_DETAIL[index].rate_name = data[1][index].prd_rate_code;
						DATA_ORDER_DETAIL[index].sepuh_name = data[1][index].sepuh_code;

						var isRingCategory = SUB_KATEGORI_CINCIN.includes(parseInt(data[1][index].product_sub_category_id));
						var isOtherCategory = SUB_KATEGORI_GELANG_SET.includes(parseInt(data[1][index].product_sub_category_id));
						if(isRingCategory){
							DATA_ORDER_DETAIL[index].ring_size_id = data[1][index].ring_size_id;
							DATA_ORDER_DETAIL[index].ring_size_name = data[1][index].ring_size;
						}else if(isOtherCategory){
							DATA_ORDER_DETAIL[index].ring_size_id = data[1][index].bracelet_size_id;
							DATA_ORDER_DETAIL[index].ring_size_name = data[1][index].bracelet_size + ' ' + data[1][index].bracelet_design;
						}
						
						DATA_ORDER_DETAIL[index].keterangan = data[1][index].td_notes == null ? '-' : data[1][index].td_notes;
					}

					rendersTableInprogressPor();
				} else {
					console.log("tidak ada data trans detail");
				}
			},
		});

		$th_por_ditujukan.on("change", function (e) {
			let val = $(this).val();
			let adapter = `<option value="0">-- Pilih Permintaan untuk</option>`;

			$th_por_permintaan.empty();
			$th_por_permintaan.append(adapter);

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
							$th_por_permintaan.append(adapter);
						}
					},
					error: function (err) {
						console.log(err);
					},
				});
			} else {
				$th_por_permintaan.empty();
			}
		});

		$th_por_permintaan.on("change", function (e) {
			let val = $(this).val();
			$th_por_permintaan.parent().find(".js-err-msg").remove();

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

		$th_por_date_expect.on("change", function () {
			$th_por_date_expect.parent().find(".js-err-msg").remove();
		});

		// start validation process
		let porValidation = function () {
			let error_thread = [];
			// if ($th_por_permintaan.val() == "" || $th_por_permintaan.children().length == 0) {
			// 	if ($th_por_permintaan.parent().find(".js-err-msg").length == 0) {
			// 		$th_por_permintaan
			// 			.parent()
			// 			.append(
			// 				`<span class="text-danger js-err-msg">` + MSG_NO_EMPTY + `</span>`
			// 			);
			// 	}
			// 	error_thread.push("error");
			// }

			// if ($th_por_date_expect.val() == "") {
			// 	if ($th_por_date_expect.parent().find(".js-err-msg").length == 0) {
			// 		$th_por_date_expect
			// 			.parent()
			// 			.append(
			// 				`<span class="text-danger js-err-msg">` + MSG_NO_EMPTY + `</span>`
			// 			);
			// 	}
			// 	error_thread.push("error");
			// }

			// if ($table_order_por.length > 0) {
			// 	if ($table_order_por.children().length == 0) {
			// 		error_thread.push("error");
			// 		Swal.fire({
			// 			icon: "error",
			// 			title: "Data order kosong",
			// 			text: "Mohon tambahkan data order",
			// 		});
			// 	}
			// }

			console.log(error_thread);
			return error_thread;
		};

		// submission listener
		$("#somInprogressSubmit button").on("click", function (e) {
			e.preventDefault();
			if ($(this).attr("name") == "save") {
				// serialize data before submit
				let serialize = {
					activity_id: "1",
					trans_status_id: 1,
					trans_code: $.trim($("#somInprogressSubmit").find('input[name="trans_code"]').val())
				};
				if (porValidation().length == 0) {
					Swal.fire({
						text: "Apakah anda yakin untuk mengirim transaksi ini",
						showDenyButton: false,
						showCancelButton: true,
						confirmButtonText: "Yes",
					}).then((result) => {
						if (result.isConfirmed) {
							Swal.fire("Tersimpan!", "", "success");
							submissionHandler(serialize, "asyncsom/update_handler");
						}
					});
				}
			}
			else if ($(this).attr("name") == "send") {
				// serialize data before submit
				let serialize = {
					activity_id: "1",
					trans_status_id: 2,
					trans_code: $.trim($("#somInprogressSubmit").find('input[name="trans_code"]').val())
				};
				if (porValidation().length == 0) {
					Swal.fire({
						text: "Apakah anda yakin untuk mengirim transaksi ini",
						showDenyButton: false,
						showCancelButton: true,
						confirmButtonText: "Yes",
					}).then((result) => {
						if (result.isConfirmed) {
							Swal.fire("Tersimpan!", "", "success");
							submissionHandler(serialize, "asyncsom/update_handler");
						}
					});
				}
			} else if ($(this).attr("name") == "reject") {
				// reject
				let serialize = {
					activity_id: "1",
					trans_status_id: -99,
					trans_code: $.trim($("#somInprogressSubmit").find('input[name="trans_code"]').val())
				};
				Swal.fire({
					text: "Apakah anda yakin untuk menolak transaksi ini",
					showDenyButton: false,
					showCancelButton: true,
					confirmButtonText: "Yes",
				}).then((result) => {
					if (result.isConfirmed) {
						Swal.fire("Berhasil di tolak!", "", "success");
						submissionHandler(serialize, "asyncsom/update_handler");
					}
				});
			} else if ($(this).attr("name") == "followup") {
				submissionHandler(serialize, "asyncsom/followup_handler");
			} else if ($(this).attr("name") == "print") {
				printData($(".print-area"));
			}
		});
	}
});
function rendersTableInprogressPor() {
	$(".js-table-order-body-inprocess").empty();
	setTimeout(function () {
		spinLoader(".js-table-order-body-inprocess");
		setTimeout(function () {
			$(".js-table-order-body-inprocess").empty();
			for (let i = 0; i < DATA_ORDER_DETAIL.length; i++) {
				var ring_size = DATA_ORDER_DETAIL[i].ring_size_name == undefined ? '-' : DATA_ORDER_DETAIL[i].ring_size_name;

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
					DATA_ORDER_DETAIL[i].qty +
					`</td>
							<td>` +
					ring_size+
					`</td>
							<td>` +
					DATA_ORDER_DETAIL[i].n2 +
					`</td>
						</tr>`;
				$(".js-table-order-body-inprocess").append($adapter);
			}
		}, 50);
	}, 1);
}
// reference all global varibles in som.js
$(function () {
	if ($(".js-trans-por-complete").length > 0) {
	  $.ajax({
		url: URL + "asyncsom/transacation_data?th_code=" + trans_code.toString().trim(),
		success: function (data) {
		  data = JSON.parse(data);
  
		  // retrieve trans header
		  setTimeout(function () {
			$th_por_ditujukan.trigger("change.select");
			setTimeout(function () {
			  $th_por_ditujukan.val(data[0][0].trans_loc2).change();
			}, 50);
		  }, 15);
  
		  setTimeout(function () {
			$th_por_permintaan.trigger("change.select");
			setTimeout(function () {
			  $th_por_permintaan.val(data[0][0].s1).change();
			  $th_por_date_expect.val(data[0][0].date_expected);
			}, 100);
		  }, 100);
  
		  // retrieve trans detail
		  if (data[1].length) {
			DATA_ORDER_DETAIL = data[1];
			for (let index = 0; index < data[1].length; index++) {
			  DATA_ORDER_DETAIL[index].product_category_id = data[1][index].product_category_id;
						  DATA_ORDER_DETAIL[index].prd_sub_cat_id = data[1][index].product_sub_category_id;
						  DATA_ORDER_DETAIL[index].product_class_id = data[1][index].product_class_id;
						  DATA_ORDER_DETAIL[index].prd_rate_id = data[1][index].rate_id;
						  DATA_ORDER_DETAIL[index].sepuh_id = data[1][index].sepuh_id;
						  DATA_ORDER_DETAIL[index].qty = data[1][index].n2 || "-";
						  DATA_ORDER_DETAIL[index].product_category_name = data[1][index].product_category_name;
						  DATA_ORDER_DETAIL[index].prd_sub_cat_name = data[1][index].prd_sub_cat_name;
						  DATA_ORDER_DETAIL[index].product_class_name = data[1][index].product_class_name;
						  DATA_ORDER_DETAIL[index].rate_name = data[1][index].prd_rate_code;
						  DATA_ORDER_DETAIL[index].sepuh_name = data[1][index].sepuh_code;
  
						  var isRingCategory = SUB_KATEGORI_CINCIN.includes(parseInt(data[1][index].product_sub_category_id));
						  var isOtherCategory = SUB_KATEGORI_GELANG_SET.includes(parseInt(data[1][index].product_sub_category_id));
						  if(isRingCategory){
							  DATA_ORDER_DETAIL[index].ring_size_id = data[1][index].ring_size_id;
							  DATA_ORDER_DETAIL[index].ring_size_name = data[1][index].ring_size;
						  }else if(isOtherCategory){
							  DATA_ORDER_DETAIL[index].ring_size_id = data[1][index].bracelet_size_id;
							  DATA_ORDER_DETAIL[index].ring_size_name = data[1][index].bracelet_size;
						  }
						  
						  DATA_ORDER_DETAIL[index].keterangan = data[1][index].td_notes == null ? '-' : data[1][index].td_notes;
			}
  
			rendersTableCompletesPor();
		  } else {
			console.log("tidak ada data trans detail");
		  }
		},
	  });
	}
  });
  
  function rendersTableCompletesPor() {
	$(".js-table-order-body-complete").empty();
	setTimeout(function () {
	  spinLoader(".js-table-order-body-complete");
	  setTimeout(function () {
		$(".js-table-order-body-complete").empty();
		for (let i = 0; i < DATA_ORDER_DETAIL.length; i++) {
		  $adapter = `<tr id='table_id` + i + `'>
							  <td>`+ parseInt(i + 1) + `</td>
							  <td>`+ DATA_ORDER_DETAIL[i].product_class_name + `</td>
							  <td>`+ DATA_ORDER_DETAIL[i].product_category_name + `</td>
							  <td>`+ DATA_ORDER_DETAIL[i].prd_sub_cat_name + `</td>
							  <td>`+ DATA_ORDER_DETAIL[i].sepuh_name + `</td>
							  <td>`+ DATA_ORDER_DETAIL[i].rate_name + `</td>
							  <td>`+ DATA_ORDER_DETAIL[i].qty + `</td>
							  <td>`+ DATA_ORDER_DETAIL[i].ring_size_name + `</td>
							  <td>`+ DATA_ORDER_DETAIL[i].keterangan + `</td>
						  </tr>`;
		  $(".js-table-order-body-complete").append($adapter);
		}
	  }, 50);
	}, 1);
  }
  