// reference all global varibles in som.js
// query param from uri inprogress?th_code=SOM-12/18/2023-6
const trans_code_som = urlParams.has("som_th_code") ? urlParams.get("som_th_code") : "";
const $formParent = $('#sovSubmit');

$(function () {
	if ($(".js-trans-somv").length > 0) {
		utils.generateTranscode(13, "vsom");
		setInterval(function () {
			utils.generateTranscode(13, "vsom");
		}, 3000);

		$th_ditujukan.empty();
		$th_ditujukan.select2();
		$th_tanggal_transaksi.select2();
		$th_status_transaksi.select2();
		$th_lokasi_transaksi.select2();
		$th_permintaan.select2();

		$.ajax({
			url: URL + "asyncsom/transacation_data?th_code=" + trans_code_som.toString().trim(),
			success: function (data) {
				data = JSON.parse(data);
				$th_notes.text(data[0][0].notes);

				// retrieve trans header
				setTimeout(function () {
					$th_ditujukan.trigger("change.select");
					setTimeout(function () {
						$th_ditujukan.val(data[0][0].trans_loc2).change();
					}, 50);
				}, 15);

				setTimeout(function () {
					$th_permintaan.trigger("change.select");
					setTimeout(function () {
						$th_permintaan.val(data[0][0].s1).change();
						$th_date_expect.val(data[0][0].date_expected);
						$('.js-ref-doc-id').val(data[0][0].th_id);
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
						DATA_ORDER_DETAIL[index].isProcessed = 1;

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

					renderTablesFilter();

				} else {
					console.log("tidak ada data trans detail");
				}

			},
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
		$("#sovSubmit button").on("click", function (e) {
			e.preventDefault();

			if ($(this).attr("name") == "save") {
				// save
				somValidation();
				filterPROCESS_SOM();

				// serialize data before save
				let serialize = {
					activity_id: 13,
					trans_code: $.trim($(".js-kode-transaksi").val()),
					trans_date: $.trim(
						$("#sovSubmit").find('input[name="trans_date"]').val()
					),
					trans_status_id: parseInt($.trim($(".js-trans-status").val())),
					trans_loc: parseInt($.trim($(".js-trans-loc1").val())),
					trans_loc2: parseInt($.trim($(".js-som-ditujukan").val())),
					ref_doc: parseInt($("#sovSubmit").find('.js-ref-doc-id').val()),
					ref_doc2: "",
					next_pic: "",
					next_loc: "",
					date_expected: $.trim(
						$("#sovSubmit").find('input[name="date_expected"]').val()
					),
					date_result: $.trim(
						$("#sovSubmit").find('input[name="date_result"]').val()
					),
					notes: $.trim($("#sovSubmit").find('textarea[name="notes_verify"]').val()),
					s1: parseInt($.trim($(".js-som-permintaan").val())), // user code
					s2: $formParent.find('.js-ref-doc').val(),
					n1: "",
					n2: CURR_USER_ID,
					trans_detail: FILTERED_DATA_ORDER_DETAIL,
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
				// serialize data before submit
				let serialize = {
					activity_id: 13,
					trans_code: $.trim($(".js-kode-transaksi").val()),
					trans_date: $.trim(
						$formParent.find('input[name="trans_date"]').val()
					),
					trans_status_id: 6,
					trans_loc: parseInt($.trim($(".js-trans-loc1").val())),
					trans_loc2: parseInt($.trim($(".js-som-ditujukan").val())),
					ref_doc: parseInt($("#sovSubmit").find('.js-ref-doc-id').val()),
					ref_doc2: "",
					next_pic: 5, // check workflow table
					next_loc: "",
					date_expected: $.trim(
						$formParent.find('input[name="date_expected"]').val()
					),
					date_result: $.trim(
						$formParent.find('input[name="date_result"]').val()
					),
					notes: $.trim($("#sovSubmit").find('textarea[name="notes_verify"]').val()),
					s1: parseInt($.trim($(".js-som-permintaan").val())), // user code
					s2: $formParent.find('.js-ref-doc').val(),
					n1: "",
					n2: CURR_USER_ID,
					trans_detail: FILTERED_DATA_ORDER_DETAIL,
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
					activity_id: 13,
					trans_status_id: -99,
					trans_code: $.trim($("#sovSubmit").find('input[name="trans_code"]').val())
				};
				submissionHandler(serialize, "asyncsom/update_handler");
			} else if ($(this).attr("name") == "followup") {
				// serialize data before submit
				let serialize = {
					activity_id: 13,
					trans_code: $.trim($(".js-kode-transaksi").val()),
					trans_date: $.trim(
						$formParent.find('input[name="trans_date"]').val()
					),
					trans_status_id: 4,
					trans_loc: parseInt($.trim($(".js-trans-loc1").val())),
					trans_loc2: parseInt($.trim($(".js-som-ditujukan").val())),
					ref_doc: parseInt($("#sovSubmit").find('.js-ref-doc-id').val()),
					ref_doc2: "",
					next_pic: 11,
					next_loc: "",
					date_expected: $.trim(
						$formParent.find('input[name="date_expected"]').val()
					),
					date_result: $.trim(
						$formParent.find('input[name="date_result"]').val()
					),
					notes: $.trim($("#sovSubmit").find('textarea[name="notes_verify"]').val()),
					s1: parseInt($.trim($(".js-som-permintaan").val())), // user code
					s2: $formParent.find('.js-ref-doc').val(),
					n1: "",
					n2: CURR_USER_ID,
					trans_detail: FILTERED_DATA_ORDER_DETAIL,
					trans_pic_detail: {
						pic1: CURR_USER_ID,
						date_submit1: utils.currentTimeMilis(),
					},
				};
				submissionHandler(serialize, "asyncsom/followup_handler");
			} else if ($(this).attr("name") == "print") {
				printData($(".print-area"));
			}
		});
	}
});