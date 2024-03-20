// reference all global varibles in som.js
$(function () {
  if ($(".js-trans-som-complete").length > 0) {
    $.ajax({
      url: URL + "asyncsom/transacation_data?th_code=" + trans_code.toString().trim(),
      success: function (data) {
        data = JSON.parse(data);

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

          rendersTableCompletes();
        } else {
          console.log("tidak ada data trans detail");
        }
      },
    });
  }
});

function rendersTableCompletes() {
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
