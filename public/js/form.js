$(function () {
    $('.js-skeleton').removeClass('d-none');
    let dTable = new DataTable('#table_product', {
        "bFilter": true,
        "lengthMenu": [10, 20,],
        "bSort": true,
        "ordering": true,
        "processing": true,
        "serverSide": false,
        "responsive": true,
        "language": {
            "emptyTable": "<i class='bi-info-circle-fill'></i>&nbsp;&nbsp;Tidak ada data yang ditampilkan"
        },
        "ajax": URL + 'async/fetch_product',
        "drawCallback": function (settings) {
            setTimeout(() => {
                $('.js-skeleton').addClass('d-none');
                $('.js-table').css('visibility', 'visible');
            },25);
        },
        columnDefs: [
            {
                targets: 2,
                render: function (data, type, row, meta) {
                    return data != 'N/A' ? '<img src="' + URL + 'public/uploads/' + data + '" class="" height="32" />' : '-';
                }
            },
            {
                targets: -1,
                render: function (data, type, row, meta) {
                    return '\
                   <button data-bs-toggle="modal" data-bs-target="#editProduct" data-response="'+ row + '" type="button" class="btn btn-primary update me-2 mb-lg-0 mb-2" id=n-"' + meta.row + '" value="Update"><i class="bi bi-pencil"></i></button>\
                   <button data-bs-toggle="modal" data-bs-target="#delProduct" data-response="'+ row + '" type="button" class="btn btn-danger mb-lg-0 mb-2 delete" id=s-"' + meta.row + '" value="Delete"><i class="bi bi-trash"></i></button>';
                }
            }
        ]
    });

    // start add product
    $('#addProductForm').submit(function (e) {
        e.preventDefault();
        let form = document.getElementById('addProductForm');
        let formData = new FormData(form);

        $.ajax({
            url: URL + 'product/add',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Data berhasil disimpan",
                    showConfirmButton: false,
                    timer: 1500
                });

                setTimeout(function () {
                    $('#addProduct').modal('hide');
                    $('#table_product').dataTable().api().ajax.reload();
                },25)

            },
            error: function (xhr, status, error) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Form gagal disubmit",
                });
                console.error(error);
            }
        });
    });


    $('#editProductForm').submit(function (e) {
        e.preventDefault();
        let form = document.getElementById('editProductForm');
        let formData = new FormData(form);

        $.ajax({
            url: URL + 'product/edit',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Data berhasil diupdate",
                    showConfirmButton: false,
                    timer: 1500
                });

                setTimeout(function () {
                    $('#editProduct').modal('hide');
                    $('#table_product').dataTable().api().ajax.reload();
                },25)

            },
            error: function (xhr, status, error) {
                console.error(error);
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Form gagal disubmit",
                });
            }
        });
    });


    $(":file").on('change', function (e) {
        let anyOversize =
            Array.prototype.some.call(document.querySelectorAll('input[type="file"]'), function (fileInput) {
                return Array.prototype.some.call(fileInput.files, function (file) {
                    return file.size > 4200000;
                });
            });

        if (anyOversize) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Ukuran terlalu besar maksimal 4MB",
            });
        }
    });


    $('#editProductFormImage').submit(function (e) {
        e.preventDefault();
        let form = document.getElementById('editProductFormImage');
        let formData = new FormData(form);

        let anyOversize =
            Array.prototype.some.call(document.querySelectorAll('input[type="file"]'), function (fileInput) {
                return Array.prototype.some.call(fileInput.files, function (file) {
                    return file.size > 3200000;
                });
            });

        if (anyOversize) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Ukuran terlalu besar maksimal 4MB",
            });
        } else {
            $.ajax({
                url: URL + 'product/edit_image',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Data berhasil diupdate",
                        showConfirmButton: false,
                        timer: 1500
                    });

                    setTimeout(function () {
                        $('#editProduct').modal('hide');
                        $('#table_product').dataTable().api().ajax.reload();
                    },25)

                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Form gagal disubmit",
                    });
                    console.error(error);
                }
            });

        }
    });

    // end add produt


    // form filter
    if($('.js-filter').length){
        $('.js-filter').find("select[name='product_category_id']").on('change', function(e){ 
            value = $(this).val();
            if(value){
                $.ajax({
                    url: URL + '/async/fetch_subcatbycat/' + value,
                    success: function(data){
                        $('.js-filter').find("select[name='prd_sub_cat_id']").empty();
                        data = JSON.parse(data);
                        let adapter1 = `<option value=0>-- Pilih Sub Kategori</option>`;
                        $('.js-filter').find("select[name='prd_sub_cat_id']").append(adapter1);
                        for(let i = 0; i < data.length; i++){
                            let adapter = `<option value='`+data[i].prd_sub_cat_id+`'>`+data[i].prd_sub_cat_name+`</option>`;
                            $('.js-filter').find("select[name='prd_sub_cat_id']").append(adapter);
                        }
                    },
                    error: function(err){
                       console.log(err);
                    }
                });
            }
        });
    }

    // end form filter


    // $(".image-picker").imagepicker();
});

