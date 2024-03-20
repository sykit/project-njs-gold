let BASE_URL = $('body').data('url');
let error_thread = [];

$(function () {
    $("body").on("click", "#upload", function () {
        //Reference the FileUpload element.
        var fileUpload = $("#fileUpload")[0];

        $('#upload').attr('disabled', 'disabled');

        //Validate whether File is valid Excel file.
        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.xls|.xlsx)$/;
        if (regex.test(fileUpload.value.toLowerCase())) {
            if (typeof (FileReader) != "undefined") {
                var reader = new FileReader();

                //For Browsers other than IE.
                if (reader.readAsBinaryString) {
                    reader.onload = function (e) {
                        ProcessExcel(e.target.result);
                    };
                    reader.readAsBinaryString(fileUpload.files[0]);
                } else {
                    //For IE Browser.
                    reader.onload = function (e) {
                        var data = "";
                        var bytes = new Uint8Array(e.target.result);
                        for (var i = 0; i < bytes.byteLength; i++) {
                            data += String.fromCharCode(bytes[i]);
                        }
                        ProcessExcel(data);
                    };
                    reader.readAsArrayBuffer(fileUpload.files[0]);
                }
            } else {
                alert("This browser does not support HTML5.");
            }
        } else {
            alert("Please upload a valid Excel file. (*.xls or *.xlsx)");
        }
    });

    function ProcessExcel(data) {

        var err_message = [];
        //Read the Excel File data.
        var workbook = XLSX.read(data, {
            type: 'binary'
        });

        //Fetch the name of First Sheet.
        var firstSheet = workbook.SheetNames[0];

        //Read all rows from First Sheet into an JSON array.
        var excelRows = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[firstSheet]);

        //Create a HTML Table element.
        var table = $("<table />");
        table[0].border = "1";

        //Add the header row.
        var row = $(table[0].insertRow(-1));


        /**
         * Diperlukan validasi terkait order detail
         * 1. Cek apakah nomor model memang tersedia
         * 2. Cek apakah sepuh di nomor model/ produk itu memang ada
         * 3. Cek apakah karat/kadar di nomor model / produk itu ada
         * 4. Cek apabila produk cincin/gelang memang memiliki ukuran yang sama
         * 5. Cek apakah produk gelang memiliki bentuk
         */

        //Add the header cells.
        var headerCell = $("<th />");
        headerCell.html("Model");
        row.append(headerCell);

        var headerCell = $("<th />");
        headerCell.html("Sepuh");
        row.append(headerCell);

        var headerCell = $("<th />");
        headerCell.html("Kadar");
        row.append(headerCell);

        var headerCell = $("<th />");
        headerCell.html("Jumlah");
        row.append(headerCell);

        var headerCell = $("<th />");
        headerCell.html("Ukuran");
        row.append(headerCell);

        var headerCell = $("<th />");
        headerCell.html("Bentuk");
        row.append(headerCell);

        var headerCell = $("<th />");
        headerCell.html("Keterangan");
        row.append(headerCell);

        //Add the data rows from Excel file.
        for (var i = 0; i < excelRows.length; i++) {
            //Add the data row.

            var row = $(table[0].insertRow(-1));

            //Add the data cells.
            var cell = $("<td />");
            cell.html(excelRows[i].Model);
            row.append(cell);

            cell = $("<td />");
            cell.html(excelRows[i].Sepuh);
            row.append(cell);

            cell = $("<td />");
            cell.html(excelRows[i].Kadar);
            row.append(cell);

            cell = $("<td />");
            cell.html(excelRows[i].Jumlah);
            row.append(cell);

            cell = $("<td />");
            cell.html(excelRows[i].Ukuran);
            row.append(cell);

            cell = $("<td />");
            cell.html(excelRows[i].Bentuk);
            row.append(cell);

            cell = $("<td />");
            cell.html(excelRows[i].Keterangan);
            row.append(cell);

            var _qty = excelRows[i].Jumlah;
            var _keterangan = excelRows[i].Keterangan;

            DATA_ORDER_DETAIL.push(
                {
                    product_category_id: '',
                    product_category_name: '',
                    prd_sub_cat_id: '',
                    prd_sub_cat_name: '',
                    product_class_id: '',
                    product_class_name: '',
                    rate_id: '',
                    rate_name: '',
                    sepuh_id: '',
                    sepuh_name: '',
                    ring_size_id: '',
                    ring_size_name: '',
                    bentuk_id: '',
                    bentuk_name: '',
                    bracelet_size_id: '',
                    bracelet_name: '',
                    qty: _qty,
                    keterangan: _keterangan,
                }
            );

            // cek produk apakah terdaftar di sistem
            $.ajax({
                url: BASE_URL + 'asyncsom/product_by_code/' + excelRows[i].Model,
                async: false,
                success: function (data) {
                    data = JSON.parse(data);
                    if (data.length == 0) {
                        err_message.push('data model tidak tersedia, cek di baris ke ' + parseInt(i + 1));
                    } else {
                        DATA_ORDER_DETAIL[i].product_category_id = data[0].product_category_id;
                        DATA_ORDER_DETAIL[i].product_category_name = data[0].product_category_name;
                        DATA_ORDER_DETAIL[i].prd_sub_cat_id = data[0].prd_sub_cat_id;
                        DATA_ORDER_DETAIL[i].prd_sub_cat_name = data[0].prd_sub_cat_name;
                        DATA_ORDER_DETAIL[i].product_class_id = data[0].product_class_id;
                        DATA_ORDER_DETAIL[i].product_class_name = data[0].product_class_name;

                        // cek produk sepuh berdasarkan model dan kode sepuh
                        $.ajax({
                            url: BASE_URL + 'asyncsom/sepuh_by_code/' + excelRows[i].Model + '/' + excelRows[i].Sepuh,
                            async: false,
                            success: function (data2) {
                                data2 = JSON.parse(data2);
                                if (data2.length == 0) {
                                    err_message.push('data sepuh tidak tersedia, cek di baris ke ' + parseInt(i + 1));
                                } else {
                                    if (data2.message != 0) {
                                        if(data2[1] == 0){
                                            err_message.push('data sepuh tidak tersedia, cek di baris ke ' + parseInt(i + 1));
                                        }else{
                                            DATA_ORDER_DETAIL[i].sepuh_name = data2[0].sepuh_code;
                                            DATA_ORDER_DETAIL[i].sepuh_id = data2[0].sepuh_id;
                                        }
                                    }
                                }
                            }
                        });

                        // cek kadar berdasarkan model dan kode kadar
                        $.ajax({
                            url: BASE_URL + 'asyncsom/rate_by_code/' + excelRows[i].Model + '/' + excelRows[i].Kadar,
                            async: false,
                            success: function (datax) {
                                datax = JSON.parse(datax);
                                if (datax.length == 0) {
                                    err_message.push('data kadar tidak tersedia, cek di baris ke ' + parseInt(i + 1));
                                } else {
                                    DATA_ORDER_DETAIL[i].rate_id = datax[0].prd_rate_id;
                                    DATA_ORDER_DETAIL[i].rate_name = datax[0].prd_rate_code;
                                }
                            }
                        });

                        // cek bentuk gelang berdasarkan model dan ukuran
                        if (excelRows[i].Ukuran != '' || excelRows[i].Ukuran != 0) {
                            if (data[0].product_category_id == 1 || data[0].product_category_id == 3 || data[0].product_category_id == 7) {

                                // cek ukuran & sub category cincin 
                                
                                let _checkSubCategoryId1 = SUB_KATEGORI_CINCIN.includes(parseInt(data[0].prd_sub_cat_id));
                                
                                if(_checkSubCategoryId1){
                                    $.ajax({
                                        url: BASE_URL + 'asyncsom/ringsize_by_code/' + excelRows[i].Model + '/' + excelRows[i].Ukuran,
                                        async: false,
                                        success: function (data3) {
                                            data3 = JSON.parse(data3);
                                            if (data3.length == 0) {
                                                err_message.push('data ukuran cincin tidak tersedia, cek di baris ke ' + parseInt(i + 1));
                                            }else{
                                                DATA_ORDER_DETAIL[i].ring_size_id = data3[0].ring_size_id;
                                                DATA_ORDER_DETAIL[i].ring_size_name = data3[0].ring_size_name;
                                            }
                                        }
                                    }) 
                                }

                                // cek ukuran gelang
                                // sub category gelang 
                                let _checkSubCategoryId2 = SUB_KATEGORI_GELANG_SET.includes(parseInt(data[0].prd_sub_cat_id));

                                if(_checkSubCategoryId2){
                                    $.ajax({
                                        url: BASE_URL + 'asyncsom/brackletsize_by_code/' + excelRows[i].Model + '/' + excelRows[i].Ukuran + '/' + excelRows[i].Bentuk,
                                        async: false,
                                        success: function (datay) {
                                            datay = JSON.parse(datay);
                                            if (datay.length > 0) {
                                                DATA_ORDER_DETAIL[i].bracelet_size_id = datay[0].bracelet_size_id;
                                                DATA_ORDER_DETAIL[i].bracelet_name = datay[0].design + '|' + datay[0].size;
                                                DATA_ORDER_DETAIL[i].ring_size_id = datay[0].bracelet_size_id;
                                                DATA_ORDER_DETAIL[i].ring_size_name =  datay[0].design + '|' + datay[0].size;
                                            } else {
                                                err_message.push('data ukuran gelang tidak tersedia, cek di baris ke ' + parseInt(i + 1));
                                            }
                                        }
                                    });
                                }
                            }
                        }
                    }
                }
            });
        }

        var dvExcel = $("#dvExcel");
        dvExcel.html("");
        dvExcel.append(table);

        setTimeout(function () {
            if (err_message.length > 0) {
                for (var x = 0; x < err_message.length; x++) {
                    $('#all_err_message').append('<div class="text-danger">' + err_message[x] + '</div>');
                    $('#dvExcel').empty();
                    DATA_ORDER_DETAIL = [];
                }
            }
        }, 100);
    };

    let somdlValidation = function () {
        if ($th_permintaan.val() == '' || $th_permintaan.children().length == 0) {
            if ($th_permintaan.parent().find('.js-err-msg').length == 0) {
                $th_permintaan.parent().append(`<span class="text-danger js-err-msg">` + MSG_NO_EMPTY + `</span>`);
            }
            error_thread.push('error');
        }

        if ($th_date_expect.val() == '') {
            if ($th_date_expect.parent().find('.js-err-msg').length == 0) {
                $th_date_expect.parent().append(`<span class="text-danger js-err-msg">` + MSG_NO_EMPTY + `</span>`);
            }
            error_thread.push('error');
        }

        console.log(error_thread)
        return error_thread;
    }

    if (error_thread.length > 0) {
        dvExcel.empty();
    }

    // submission listener
    $('#somSubmit button').on('click', function (e) {
        e.preventDefault();

        if ($(this).attr('name') == 'send') {
            // serialize data before submit

            let serializer = {
                activity_id: 1,
                trans_code: $.trim($('.js-kode-transaksi').val()),
                trans_date: $.trim($('#somSubmit').find('input[name="trans_date"]').val()),
                trans_status_id: 2,
                trans_loc: parseInt($.trim($('.js-trans-loc1').val())),
                trans_loc2: parseInt($.trim($('.js-som-ditujukan').val())),
                ref_doc: '',
                ref_doc2: '',
                next_pic: 11,
                next_loc: '',
                date_expected: $.trim($('#somSubmit').find('input[name="date_expected"]').val()),
                date_result: $.trim($('#somSubmit').find('input[name="date_result"]').val()),
                notes: $.trim($('#somSubmit').find('textarea[name="notes"]').val()),
                s1: parseInt($.trim($('.js-som-permintaan').val())), // user code
                s2: '',
                n1: '',
                n2: CURR_USER_ID,
                trans_detail: DATA_ORDER_DETAIL,
                trans_pic_detail: {
                    pic1: CURR_USER_ID,
                    date_submit1: utils.currentTimeMilis()
                }
            };

            if (somdlValidation().length == 0) {
                Swal.fire({
                    text: 'Apakah anda yakin untuk mengirim transaksi ini',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire('Tersimpan', '', 'success');
                        submissionHandler(serializer, 'asyncsom/submit_handler');
                        setTimeout(function () {
                            window.location.reload();
                        }, 250);
                    }
                });
            }
        }
    });
});