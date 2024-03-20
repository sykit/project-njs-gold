const $el = $("#somAddProduct");
const $el_product_category_id = $el.find("select[name='product_category_id']");
const $el_prd_sub_cat_id = $el.find("select[name='prd_sub_cat_id']");
const $el_prd_class_id = $el.find("select[name='product_class_id'");
const $el_sepuh_id = $el.find("select[name='sepuh_id']");
const $el_rate_id = $el.find("select[name='prd_rate_id");
const $el_qty = $el.find("input[name='qty']");
const $el_keterangan = $el.find("textarea[name='keterangan']");

$(function () {
	$el_product_category_id.select2({
		dropdownParent: "#somAddProduct",
	});
	if ($("#somAddProduct").length > 0) {
		$el_product_category_id.on("change", function (e) {
			let value = $(this).val();
			if (value == 1) {
				$(".js-ring-size").show();
			} else {
				$(".js-ring-size").hide();
			}
			if (value) {
				retrieveSubCategory(value);
				$el_prd_sub_cat_id.select2({
					dropdownParent: "#somAddProduct",
				});
			}
		});

		$el_prd_sub_cat_id.on("change", function (e) {
			let value = $el_product_category_id.val();
			let value2 = $(this).val();
			$(".js-spinner").show();
			setTimeout(function () {
				if (value) {
					retrieveProduct(value, value2);
					$el_prd_class_id.select2({
						dropdownParent: "#somAddProduct",
					});
					$el_rate_id.select2({
						dropdownParent: "#somAddProduct",
					});
					$el_sepuh_id.select2({
						dropdownParent: "#somAddProduct",
					});
				}
			}, 1);
		});

		$(".js-order-detail-reset").on("click", function () {
			$el_product_category_id.val(0).change();
			$el_prd_sub_cat_id.empty();
			$el_sepuh_id.val(0).change();
			$el_qty.val("").change();
			$el_keterangan.text("");
			$el_prd_class_id.empty();
			$el_keterangan.val("");
			$el_sepuh_id.val("").change();
			$el_rate_id.val("").change();
			$(".js-product-selection").empty();
			$(".js-ring-size").hide();
			$(".image_picker_selector").empty();
		});

		$(".js-add-order-detail-item").on("click", function (e) {
			e.preventDefault();
			$(".js-table-order-body").empty();

			console.log(
				$el
					.find("select[name='product_class_id'] option:selected")
					.text()
					.trim()
			);
			DATA_ORDER_DETAIL.push({
				product_category_id: $el
					.find("select[name='product_category_id']")
					.val(),
				product_category_name: $el
					.find("select[name='product_category_id'] option:selected")
					.text()
					.trim(),
				prd_sub_cat_id: $el.find("select[name='prd_sub_cat_id']").val(),
				prd_sub_cat_name: $el
					.find("select[name='prd_sub_cat_id'] option:selected")
					.text()
					.trim(),
				product_class_id: $el.find("select[name='product_class_id']").val(),
				product_class_name: $el
					.find("select[name='product_class_id'] :selected")
					.text()
					.trim(),
				rate_id: $el.find("select[name='prd_rate_id']").val(),
				rate_name: $el
					.find("select[name='prd_rate_id'] option:selected")
					.text()
					.trim(),
				sepuh_id: $el.find("select[name='sepuh_id']").val(),
				sepuh_name: $el
					.find("select[name='sepuh_id'] option:selected")
					.text()
					.trim(),
				ring_size_id: $el.find("select[name='ring_size']").val(),
				ring_size_name:
					$el.find("select[name='ring_size']").val() === ""
						? "-"
						: $el.find("select[name='ring_size'] :selected").text().trim(),
				bracelet_size_id: "",
				bracelet_name: "",
				qty: $el.find("input[name='qty']").val(), // save on n2 trans detail
				keterangan: $el.find("textarea[name='keterangan']").val(),
			});

			$("#somAddProduct").modal("hide");
			$(".js-order-detail-reset").click();
			renderTables();
		});
	}

	$("#somEditProduct").on("show.bs.modal", function (event) {
		let div = $(event.relatedTarget);
		let modal = $(this);
		let index = div.data("index");
 
		$el_product_category_id.select2({
			dropdownParent: "#somEditProduct",
		});

		modal
			.find("select[name='product_category_id']")
			.val(div.data("product-category-id"))
			.change();

		modal.find("select[name='product_category_id']").select2({
			dropdownParent: "#somEditProduct",
		});

		modal.find("select[name='product_category_id']").on("change", function (e) {
			modal.find("select[name='prd_sub_cat_id']").select2({
				dropdownParent: "#somEditProduct",
			});
		});

		modal
			.find("select[name='prd_sub_cat_id']")
			.val(div.data("product-sub-cat-id"))
			.change();

		if (div.data("product-category-id") == 1) {
			$(".js-ring-size").show();
			modal
				.find("select[name='ring_size']")
				.val(div.data("product-size-id"))
				.change();
		} else {
			$(".js-ring-size").hide();
		}

		retrieveProduct(
			div.data("product-category-id"),
			div.data("product-sub-cat-id")
		);

		modal.find("select[name='prd_sub_cat_id']").on("change", function () {
			retrieveProduct(
				div.data("product-category-id"),
				div.data("product-sub-cat-id")
			);
		});

		modal
			.find("select[name='product_class_id']")
			.val(div.data("product-class-id"))
			.change();
		modal
			.find("select[name='prd_rate_id']")
			.val(div.data("product-rate-id"))
			.change();
		modal
			.find("select[name='sepuh_id']")
			.val(div.data("product-sepuh-id"))
			.change();
		modal.find("input[name='qty']").val(div.data("product-qty"));
		modal
			.find("textarea[name='keterangan']")
			.val(div.data("product-keterangan"))
			.text();

		$(".js-edit-order-detail-item").on("click", function (e) {
			e.preventDefault();

			DATA_ORDER_DETAIL[index].product_category_id = modal
				.find("select[name='product_category_id']")
				.val();
			DATA_ORDER_DETAIL[index].prd_sub_cat_id = modal
				.find("select[name='prd_sub_cat_id']")
				.val();
			DATA_ORDER_DETAIL[index].product_class_id = modal
				.find("select[name='product_class_id']")
				.val();
			DATA_ORDER_DETAIL[index].prd_rate_id = modal
				.find("select[name='prd_rate_id']")
				.val();
			DATA_ORDER_DETAIL[index].sepuh_id = modal
				.find("select[name='sepuh_id']")
				.val();
			DATA_ORDER_DETAIL[index].keterangan = modal
				.find("textarea[name='keterangan']")
				.val();
			DATA_ORDER_DETAIL[index].qty = modal.find("input[name='qty']").val();
			DATA_ORDER_DETAIL[index].ring_size_id = modal
				.find("select[name='ring_size_id']")
				.val();

			DATA_ORDER_DETAIL[index].product_category_name = modal
				.find("select[name='product_category_id'] option:selected")
				.text()
				.trim();
			DATA_ORDER_DETAIL[index].prd_sub_cat_name = modal
				.find("select[name='prd_sub_cat_id'] option:selected")
				.text()
				.trim();
			DATA_ORDER_DETAIL[index].product_class_name = modal
				.find("select[name='product_class_id'] option:selected")
				.text()
				.trim();
			DATA_ORDER_DETAIL[index].rate_name = modal
				.find("select[name='prd_rate_id'] option:selected")
				.text()
				.trim();
			DATA_ORDER_DETAIL[index].sepuh_name = modal
				.find("select[name='sepuh_id'] option:selected")
				.text()
				.trim();
			DATA_ORDER_DETAIL[index].ring_size_name =
				modal.find("select[name='ring_size']").val() === ""
					? "-"
					: modal.find("select[name='ring_size'] :selected").text().trim();

            console.log(DATA_ORDER_DETAIL[index]);
			// renderTables();
			// $("#somEditProduct").modal("hide");
		});
	});
});

function retrieveSubCategory($category_id) {
	$.ajax({
		url: URL + "/async/fetch_subcatbycat/" + $category_id,
		success: function (data) {
			$el_prd_sub_cat_id.empty();
			data = JSON.parse(data);
			let adapter1 = `<option value=0>-- Pilih Sub Kategori</option>`;
			$el_prd_sub_cat_id.append(adapter1);
			for (let i = 0; i < data.length; i++) {
				let adapter =
					`<option value='` +
					data[i].prd_sub_cat_id +
					`'>` +
					data[i].prd_sub_cat_name +
					`</option>`;
				$el_prd_sub_cat_id.append(adapter);
			}
		},
	});
}

function retrieveProduct($category_id, $subcategory_id) {
	$(".js-product-selection").empty();
	$(".js-spinner").show();
	$.ajax({
		url:
			URL +
			"/async/fetch_product_query/" +
			$category_id +
			"/" +
			$subcategory_id +
			"/0/0",
		success: function (data) {
			data = JSON.parse(data);
			for (let i = 0; i < data.length; i++) {
				let adapter =
					`<option data-img-src='` +
					URL +
					`/public/uploads/` +
					data[i].image +
					`' data-img-class="number-` +
					data[i].product_class_id +
					`" data-img-alt="image-` +
					data[i].product_class_id +
					`"
                value=` +
					data[i].product_class_id +
					`>` +
					data[i].product_class_name +
					`</option>`;
				$(".js-product-selection").append(adapter);
			}

			setTimeout(function () {
				$(".js-product-selection").imagepicker({
					limit: 10,
				});
				$(".js-spinner").hide();
			});
		},
		error: function (xhr, status, error) {
			console.error(error);
		},
	});
}

function productChange() {
	$el_prd_class_id.on("change", function (e) {
		console.log(e);
		let _prd_class_id = $(this).val();
		$el.find("select[name='sepuh_id']").empty();
		$.ajax({
			url: URL + "asyncsom/product_sepuh/" + _prd_class_id,
			success: function (data) {
				data = JSON.parse(data);
				for (let i = 0; i < data.length; i++) {
					$el
						.find("select[name='sepuh_id']")
						.append(
							`<option value=` +
								data[i].sepuh_id +
								`>` +
								data[i].sepuh_code +
								`</option>`
						);
				}
			},
			error: function (err) {
				console.log(err);
			},
		});

		$el.find("select[name='prd_rate_id']").empty();
		$.ajax({
			url: URL + "asyncsom/product_rate/" + _prd_class_id,
			success: function (data) {
				data = JSON.parse(data);
				for (let i = 0; i < data.length; i++) {
					$el
						.find("select[name='prd_rate_id']")
						.append(
							`<option value=` +
								data[i].prd_rate_id +
								`>` +
								data[i].prd_rate_code +
								`</option>`
						);
				}
			},
			error: function (err) {
				console.log(err);
			},
		});
	});
}
