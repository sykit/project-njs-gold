$(function(){ 
    // modal for fgroup
    $('#editFgroup').on('show.bs.modal', function (event) {
        let div = $(event.relatedTarget);
        let modal          = $(this);
        modal.find('#edit-fgroup-id').attr("value",div.data('fgroup-id'));
        modal.find('#edit-fgroup-name').attr("value",div.data('fgroup-name'));
    });

    $("#delFgroup").on('show.bs.modal', function (event) {
        let div = $(event.relatedTarget);
        let modal          = $(this);
        modal.find('#delete-fgroup-id').attr("value",div.data('fgroup-id'));
        modal.find('#delete-fgroup-name').attr("value",div.data('fgroup-name'));
        modal.find('.namaFgroup').text(div.data('fgroup-name'));
    });

    // end modal for fgroup


    // modal edit category product
    $("#editCategory").on('show.bs.modal', function (event) {
        let div = $(event.relatedTarget) 
        let modal          = $(this)
        modal.find('#edit-category-id').attr("value",div.data('category-id'));
        modal.find('#edit-category-name').attr("value",div.data('category-name'));
        modal.find('#edit-category-image').attr("value",div.data('category-image'));
        modal.find('.namaFgroup').text(div.data('fgroup-name'));
    });

    $("#delCategory").on("show.bs.modal", function(event){
        let div = $(event.relatedTarget);
        let modal          = $(this);
        modal.find('#delete-category-id').attr("value",div.data('category-id'));
        modal.find('#delete-category-name').attr("value",div.data('category-name'));
        modal.find('#delete-category-image').attr("value",div.data('category-image'));
        modal.find('.namaCategory').text(div.data('category-name'));
    });
    // end modal edit category product


    // modal edit subcategory product   
    $("#editSubCategory").on("show.bs.modal", function(event){ 
        let div = $(event.relatedTarget);
        let modal          = $(this);
        modal.find('.prd_sub_cat_id').attr("value",div.data('subcategory-id'));
        modal.find('#product_category_name').attr("value",div.data('subcategory-name'));
        modal.find('.prd_sub_image').attr("value",div.data('subcategory-image'));
        
    });
    $("#delSubCategory").on("show.bs.modal", function(event){
        let div = $(event.relatedTarget);
        let modal          = $(this);
        modal.find('#delete-subcategory-id').attr("value",div.data('subcategory-id'));
        modal.find('#delete-subcategory-name').attr("value",div.data('subcategory-name'));
        modal.find('#delete-subcategory-image').attr("value",div.data('subcategory-image'));
        modal.find('.namaSubCategory').text(div.data('subcategory-name'));
    });
    // end modal edit subcategory product


    // all product state
    
    $("#editProduct").on("show.bs.modal", function(event){ 
        $('.js-skeleton-modal').removeClass('d-none');

        let div = $(event.relatedTarget);
        let modal          = $(this);
        let response = div.data('response');
        let id_product = response.split(',')[1];
        $.ajax({
            url: URL + '/async/fetch_product_id/' + id_product,
            success: function(callback){
                let response = JSON.parse(callback);
                setTimeout(function(){
                    $('.js-skeleton-modal').addClass('d-none');
                    $('.js-form').css('visibility','visible');
                },25);
                console.log(response)

                if(response[0].product_category_id == "1"||(response[0].product_category_id == "7" && response[0].prd_sub_cat_id == "26")){
                    $('.js-ukuran-cincin').removeClass('d-none');
                    $('.js-ukuran-gelang').addClass('d-none')
                    modal.find("select[name='ring_size_id1']").val(response[0].ring_size_id1).select2().trigger("change");
                    modal.find("select[name='ring_size_id2']").val(response[0].ring_size_id2).select2().trigger("change");
                    modal.find("select[name='ring_size_id3']").val(response[0].ring_size_id3).select2().trigger("change");
                    modal.find("select[name='ring_size_id4']").val(response[0].ring_size_id4).select2().trigger("change");
                    modal.find("select[name='ring_size_id5']").val(response[0].ring_size_id5).select2().trigger("change");
                    modal.find("select[name='ring_size_id6']").val(response[0].ring_size_id6).select2().trigger("change");
                    modal.find("select[name='ring_size_id7']").val(response[0].ring_size_id7).select2().trigger("change");
                    modal.find("select[name='ring_size_id8']").val(response[0].ring_size_id8).select2().trigger("change");
                    modal.find("select[name='ring_size_id9']").val(response[0].ring_size_id9).select2().trigger("change");
                    modal.find("select[name='ring_size_id10']").val(response[0].ring_size_id10).select2().trigger("change");
                    modal.find("select[name='ring_size_id11']").val(response[0].ring_size_id11).select2().trigger("change");
                    modal.find("select[name='ring_size_id12']").val(response[0].ring_size_id12).select2().trigger("change");
                }else if(response[0].product_category_id == "3" ||(response[0].product_category_id == "7" && response[0].prd_sub_cat_id == "27")){
                    $('.js-ukuran-gelang').removeClass('d-none');
                    $('.js-ukuran-cincin').addClass('d-none');
                    modal.find("select[name='bracelet_size_id1']").val(response[0].bracelet_size_id).select2().trigger("change");
                }else{
                    $('.js-ukuran-cincin').addClass('d-none');
                    $('.js-ukuran-gelang').addClass('d-none')
                }

                modal.find("input[name='product_class_id']").val(response[0].p_id);
                modal.find("input[name='product_class_name']").val(response[0].product_class_name);
                modal.find("input[name='product_class_code']").val(response[0].product_class_code);
                modal.find("select[name='product_category_id']").val(response[0].product_category_id).select2().trigger("change");
                modal.find("select[name='prd_sub_cat_id']").val(response[0].prd_sub_cat_id).select2().trigger("change");
                modal.find("select[name='sepuh_id']").val(response[0].sepuh_id).select2().trigger("change");

                modal.find("select[name='prd_rate_id']").val(response[0].prd_rate_id).select2().trigger("change");
                modal.find("select[name='prd_rate_id2']").val(response[0].prd_class_rate_id2).select2().trigger("change");
                modal.find("select[name='prd_rate_id3']").val(response[0].prd_class_rate_id3).select2().trigger("change");
                modal.find("select[name='prd_rate_id4']").val(response[0].prd_class_rate_id4).select2().trigger("change");
                modal.find("select[name='prd_rate_id5']").val(response[0].prd_class_rate_id5).select2().trigger("change");
                modal.find("select[name='prd_rate_id6']").val(response[0].prd_class_rate_id6).select2().trigger("change");
                modal.find("select[name='prd_rate_id7']").val(response[0].prd_class_rate_id7).select2().trigger("change");
                modal.find("select[name='prd_rate_id8']").val(response[0].prd_class_rate_id8).select2().trigger("change");
                modal.find("select[name='prd_rate_id9']").val(response[0].prd_class_rate_id9).select2().trigger("change");
                modal.find("select[name='prd_rate_id10']").val(response[0].prd_class_rate_id10).select2().trigger("change");
                modal.find("select[name='prd_rate_id11']").val(response[0].prd_class_rate_id11).select2().trigger("change");
                modal.find("select[name='prd_rate_id12']").val(response[0].prd_class_rate_id12).select2().trigger("change");

                modal.find("input[name='prd_sub_cat_id']").val(response[0].prd_sub_cat_id);
                modal.find("input[name='prd_class_weight1']").val(response[0].prd_class_weight1);
                modal.find("input[name='prd_class_weight2']").val(response[0].prd_class_weight2);
                modal.find("input[name='prd_class_weight3']").val(response[0].prd_class_weight3);
                modal.find("input[name='prd_class_weight4']").val(response[0].prd_class_weight4);
                modal.find("input[name='prd_class_weight5']").val(response[0].prd_class_weight5);
                modal.find("input[name='prd_class_weight6']").val(response[0].prd_class_weight6);
                modal.find("input[name='prd_class_weight7']").val(response[0].prd_class_weight7);
                modal.find("input[name='prd_class_weight8']").val(response[0].prd_class_weight8);
                modal.find("input[name='prd_class_weight9']").val(response[0].prd_class_weight9);
                modal.find("input[name='prd_class_weight10']").val(response[0].prd_class_weight10);
                modal.find("input[name='prd_class_weight11']").val(response[0].prd_class_weight11);
                modal.find("input[name='prd_class_weight12']").val(response[0].prd_class_weight12);
            },
            error: function(err){
                console.log(err);
            }
        })
    });

    $("#addProduct").on("shown.bs.modal", function(){
        let div = $(event.relatedTarget);
        let modal          = $(this);

        modal.find("input[name='product_class_code']").on('keyup', function(e){
            let _this = $(this);
            $.ajax({
                url: URL + '/async/check_product_code',
                method: 'POST',
                data: {
                    'product_class_code': _this.val(),
                },
                success: function(data){
                    console.log(data);
                    data = JSON.parse(data);
                    if(data.length > 0){
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Kode produk sudah terdaftar. Mohon periksa lagi data di produk katalog.",
                        });

                        setTimeout(function(){
                            _this.val('');
                        }, 1);
                    }
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            })
        });

        modal.find("select[name='product_category_id']").on('change', function(e){
            value = $(this).val();
            if(value == ''){
                $('.js-ukuran-cincin').addClass('d-none');
                $('.js-ukuran-gelang').addClass('d-none');
            }else{
                if(value == 1){
                    $('.js-ukuran-cincin').removeClass('d-none');
                    $('.js-ukuran-gelang').addClass('d-none');
                }else if(value == 3){
                    $('.js-ukuran-cincin').addClass('d-none');
                    $('.js-ukuran-gelang').removeClass('d-none');
                }else{
                    $('.js-ukuran-cincin').addClass('d-none');
                    $('.js-ukuran-gelang').addClass('d-none');
                }
            }
            $.ajax({
                url: URL + '/async/fetch_subcatbycat/' + value,
                success: function(data){
                    data = JSON.parse(data);
                    modal.find("select[name='prd_sub_cat_id']").empty();
                    if(!data.length){
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Tidak ada data subcategory, mohon info admin untuk diupdate",
                        });
                    }else{
                        for(let i = 0; i < data.length; i++){
                            let adapter = `<option value='`+data[i].prd_sub_cat_id+`'>`+data[i].prd_sub_cat_name+`</option>`;
                            modal.find("select[name='prd_sub_cat_id']").append(adapter);
                        }
                    }
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        });
        modal.find("select[name='prd_sub_cat_id']").on('change', function(e){
            value = $(this).val();
            product_category_id = modal.find("select[name='product_category_id']").val();

            if(value == ''){
                $('.js-ukuran-cincin').addClass('d-none');
                $('.js-ukuran-gelang').addClass('d-none');
            }else{
                if(product_category_id == 1||( product_category_id == 7 && value == 26)){
                    $('.js-ukuran-cincin').removeClass('d-none');
                    $('.js-ukuran-gelang').addClass('d-none');
                }else if(product_category_id == 3|| (product_category_id == 7 && value == 27)){
                    $('.js-ukuran-cincin').addClass('d-none');
                    $('.js-ukuran-gelang').removeClass('d-none');
                }else{
                    $('.js-ukuran-cincin').addClass('d-none');
                    $('.js-ukuran-gelang').addClass('d-none');
                }
            }
           
        });
    });

    $("#addProduct").on("hidden.bs.modal", function(){ 
        let div = $(event.relatedTarget);
        let modal          = $(this);

        modal.find("input[name='product_class_id']").val('');
        modal.find("input[name='product_class_name']").val('');
        modal.find("input[name='product_class_code']").val('');
        modal.find("select[name='product_category_id']").val('');
        modal.find("select[name='prd_sub_cat_id']").val('');

        modal.find("select[name='prd_rate_id']").val('');
        modal.find("select[name='prd_rate_id2']").val('');
        modal.find("select[name='prd_rate_id3']").val('');
        modal.find("select[name='prd_rate_id4']").val('');
        modal.find("select[name='prd_rate_id5']").val('');
        modal.find("select[name='prd_rate_id6']").val('');
        modal.find("select[name='prd_rate_id7']").val('');
        modal.find("select[name='prd_rate_id8']").val('');
        modal.find("select[name='prd_rate_id9']").val('');
        modal.find("select[name='prd_rate_id10']").val('');
        modal.find("select[name='prd_rate_id11']").val('');
        modal.find("select[name='prd_rate_id12']").val('');

        modal.find("input[name='prd_sub_cat_id']").val('');
        modal.find("input[name='prd_class_weight1']").val('');
        modal.find("input[name='prd_class_weight2']").val('');
        modal.find("input[name='prd_class_weight3']").val('');
        modal.find("input[name='prd_class_weight4']").val('');
        modal.find("input[name='prd_class_weight5']").val('');
        modal.find("input[name='prd_class_weight6']").val('');
        modal.find("input[name='prd_class_weight7']").val('');
        modal.find("input[name='prd_class_weight8']").val('');
        modal.find("input[name='prd_class_weight9']").val('');
        modal.find("input[name='prd_class_weight10']").val('');
        modal.find("input[name='prd_class_weight11']").val('');
        modal.find("input[name='prd_class_weight12']").val('');
    });

    // end product state


    // delete product
    $("#delProduct").on("shown.bs.modal", function(event){
        let div = $(event.relatedTarget);
        let modal          = $(this);
        let response = div.data('response');
        let id_product = response.split(',')[1];
        let nama_product = response.split(',')[0];
        modal.find("input[name='product_class_id']").val(id_product);
        modal.find("input[name='product_class_name']").val(nama_product);
        modal.find('.namaProduct').text(nama_product);
    });
    // end delete product
});