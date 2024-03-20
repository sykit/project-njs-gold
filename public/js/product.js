$(function(){ 
    if($('.js-productlist').length > 0){
        let pathname = window.location.pathname;
        let category_id = "";
        let subcategory_id = "";
        let weight = "";
        let rate_id = "";

        function fetchData(category_id, subcategory_id, rate_id, weight){
            $('.js-productloader').show();
            $('.js-productlist').empty();
            console.log('category id');
            console.log(category_id);
            console.log('subcategory id');
            console.log(subcategory_id);
            console.log('rate_id');
            console.log(rate_id);
            console.log('weight');
            generateURL = URL + 'async/fetch_product_query/' + category_id + '/' + subcategory_id + '/' + rate_id + '/' + weight;
            $.ajax({
                url : generateURL,
                success: function(data){
                    console.log(data);
                    data = JSON.parse(data);
                    if(data.length == 0){
                        $('.js-productlist').empty();
                        $('.js-productlist').append('<div class="text-center">Tidak ada data</div>');
                        $('.js-productloader').hide();
                        $('.js-productlist').show();
                    }else{
                        $('.js-productlist').empty();
                        setTimeout(function(){
                            for(let i = 0; i < data.length; i++){
                                let adapter = `
                                <a style="cursor:pointer;" data-productid="`+data[i].product_class_id+`" data-bs-toggle="modal" data-bs-target="#productDetail" class="col col-lg-2 col-6 mb-lg-4 mb-4">
                                    <img class="w-100 lazyload blur-up product-card" data-src="`+URL+ '/public/uploads/' + data[i].image+`" onerror="this.src='`+URL+`public/images/placeholder.jpeg'"
                                        alt="" />
                                    <div class="fw-bold pt-2">`+data[i].product_class_name+`</div>
                                </a>
                                `;
                                $('.js-productloader').hide();
                                $('.js-productlist').append(adapter);
                                $('.js-productlist').show();
                            }
                        },25);
                    }
                },
                error: function(err){
                    console.log(err);
                }
            });
        };
        
        if(pathname.includes('njs-gold-scm')){
            console.log('develpment--env');
            category_id = pathname.split('/')[3] || 0;
            subcategory_id = pathname.split('/')[4] || 0;
            rate_id = pathname.split('/')[5] || 0;
            weight = pathname.split('/')[6] || 0;
            $("select[name='product_category_id']").val(category_id).change();
            if(subcategory_id != '' || subcategory_id != 0) {
                $("select[name='prd_sub_cat_id']").attr('disabled', false);
                $('.js-form-range').attr('disabled', false);
            }else{
                $('.js-form-range').attr('disabled', true);
            }

            dataRate = rate_id.split('-');
            $("input:checkbox[name=rate]").each(function() { 
                for(let i = 0 ; i < dataRate.length ; i++){
                    if($(this).val() == dataRate[i]){
                        $(this).attr('checked','checked');
                    }
                }
            });

            $('.js-form-rangeval').text(weight);
            setTimeout(function(){
                fetchData(category_id, subcategory_id, rate_id, weight);
            },25);
        }else{
            console.log('production--env');
            category_id = pathname.split('/')[2] || 0;
            subcategory_id = pathname.split('/')[3] || 0;
            rate_id = pathname.split('/')[4] || 0;
            weight = pathname.split('/')[5] || 0;
            $("select[name='product_category_id']").val(category_id).change();
            if(subcategory_id != '' || subcategory_id != 0) {
                $("select[name='prd_sub_cat_id']").attr('disabled', false);
                $('.js-form-range').attr('disabled', false);
            }else{
                $('.js-form-range').attr('disabled', true);
            }

            dataRate = rate_id.split('-');
            $("input:checkbox[name=rate]").each(function() { 
                for(let i = 0 ; i < dataRate.length ; i++){
                    if($(this).val() == dataRate[i]){
                        $(this).attr('checked','checked');
                    }
                }
            });
            $('.js-form-rangeval').text(weight);
            setTimeout(function(){
                fetchData(category_id, subcategory_id, rate_id, weight);
            },25);
        }

        $("select[name='product_category_id']").on('change', function(e){  
            category_id = $(this).val();
            if(category_id == 0){
                $("select[name='product_category_id']").val('');
                $("select[name='prd_sub_cat_id']").val('').change();
                $("select[name='prd_sub_cat_id']").attr('disabled', true);
                category_id = 0;
                subcategory_id = 0;
                weight = 0;
                urlFormat = URL + 'products/' + category_id + '/' + subcategory_id + '/' + rate_id + '/' + weight;
                $('.js-form-range').attr('disabled', true);
                window.history.replaceState('cat2', 'cat2', urlFormat);
                setTimeout(function(){
                    fetchData(category_id, subcategory_id, rate_id, weight);
                },25);
            }else{
                subcategory_id = subcategory_id == '' ? 0 : subcategory_id;
                urlFormat = URL + 'products/' + category_id + '/' + subcategory_id + '/' + rate_id + '/' + weight;
                window.history.replaceState('cat1', 'cat1', urlFormat);
                $('.js-form-range').attr('disabled', false);
                $("select[name='prd_sub_cat_id']").attr('disabled', false);
                setTimeout(function(){
                    fetchData(category_id, subcategory_id, rate_id, weight);
                },25);
            }
            
        });

        $("select[name='prd_sub_cat_id']").on('change', function(e){  
            subcategory_id = $(this).val();
            subcategory_id = subcategory_id == '' ? 0 : subcategory_id;
            weight = weight == '' ? 0 : weight;
            urlFormat = URL + 'products/' + category_id + '/' + subcategory_id + '/' + rate_id + '/' + weight;
            console.log(urlFormat);
            window.history.replaceState('subcat', 'subcat', urlFormat);
            setTimeout(function(){
                fetchData(category_id, subcategory_id, rate_id, weight);
            },25);
        });

        $('.form-check-input').on('change', function(e){
            let array = [] || 0;
            array.push(0);
            $("input:checkbox[name=rate]:checked").each(function() { 
                array.push(parseInt($(this).val()));
            }); 
            rate_id = array.map((element) => element).join('-');
            weight = weight == '' ? 0 : weight;
            urlFormat = URL + 'products/' + category_id + '/' + subcategory_id + '/' + rate_id + '/' + weight;
            console.log(urlFormat);
            window.history.replaceState('check', 'check', urlFormat);
            setTimeout(function(){
                fetchData(category_id, subcategory_id, rate_id, weight);
            },25);
        });


        $('.js-form-range').ready(function() {
            let val = $(this).val();
            setTimeout(function(){
                $('.js-form-rangeval').text(val);
            },25)
        });

        $('.js-form-range').on('change', function(){
            let val = $(this).val();
            console.log(val);
            $('.js-form-rangeval').text(val);
            weight = val;
            console.log(rate_id);
            urlFormat = URL + 'products/' + category_id + '/' + subcategory_id + '/' + rate_id + '/' + weight;
            console.log(urlFormat);
            window.history.replaceState('range', 'range', urlFormat);
            setTimeout(function(){
                fetchData(category_id, subcategory_id, rate_id, weight);
            },10);
        });
    }
    
    $('#productDetail').on('shown.bs.modal', function(event){
        let div = $(event.relatedTarget);
        let product_id = div.data('productid');
        let modal          = $(this);
        let product_image = $('.js-product-image');
        let product_kode = $('.js-product-code');
        let product_name = $('.js-product-name') || '';
        let product_rw = $('.js-product-rate-weight');
        let product_variant = $('.js-product-variant');
        let product_ringvariant = $('.js-product-ringvariant');
        let product_braceletvariant = $('.js-product-braceletvariant');
        let prd_cat_detail = $('.js-prod-cat-detail');
        let prd_subcat_detail = $('.js-prod-subcat-detail');
        let product_sepuh = $('.js-product-sepuh');

        modal.find("input[name='product_class_id']").val(product_id);

        $.ajax({
            url: URL + '/async/fetch_product_id/' + product_id,
            success: function(data){
                data = JSON.parse(data);
                let str = "";
                let str_ring = "";
                for(let i = 0; i < data.length; i++){
                    product_image.attr('data-src', URL + '/public/uploads/' + data[i].image).change();
                    product_image.attr('src', URL + '/public/uploads/' + data[i].image).change();
                    product_kode.text(data[i].product_class_code);
                    product_name.text(data[i].product_class_name);
                    product_rw.text(data[i].prd_class_rate_name + ' : ' + data[i].prd_class_weight1 + 'gr  ');
                    prd_cat_detail.text(data[i].product_category_name);
                    prd_subcat_detail.text(data[i].prd_sub_cat_name);
                    var sepuh_text = ""
                    if(data[i].sepuh_code != null){
                        sepuh_text = data[i].sepuh_code+" | "+data[i].sepuh_name
                    }else{
                        sepuh_text = '-'
                    }
                    product_sepuh.text(sepuh_text);
                    let first = true
                    for (let j = 2; j <=12; j++){
                        var name = "prd_class_rate_name"+j;
                        var weight = "prd_class_weight"+j;
                        if(data[i][name] != null && data[i][name].trim() != ""){
                            if(!first){
                                str += ' | '
                            }
                            str += data[i][name] + ': ' + data[i][weight]+ 'gr  '
                        }
                        first = false
                    }
                    
                    if(data[i].product_category_id == "1"||( data[i].product_category_id == "7" && data[i].prd_sub_cat_id == "26")){
                        $('.js-rings-size').removeClass('d-none');
                        $('.js-bracelet-size').addClass('d-none');
                        if( data[i].ring_size_id1 != null){
                            str_ring += data[i].ring2_size1 
                        }
                        if( data[i].ring2_size2 != null){
                            str_ring += ", "+data[i].ring2_size2
                        }
                        if( data[i].ring2_size3 != null){
                            str_ring += ", "+data[i].ring2_size3 
                        }
                        if( data[i].ring2_size4 != null){
                            str_ring += ", "+data[i].ring2_size4
                        }
                        if( data[i].ring2_size5 != null){
                            str_ring += ", "+data[i].ring2_size5
                        }
                        if( data[i].ring2_size6 != null){
                            str_ring += ", "+data[i].ring2_size6
                        }
                        if( data[i].ring2_size7 != null){
                            str_ring += ", "+data[i].ring2_size7
                        }
                        if( data[i].ring2_size8 != null){
                            str_ring += ", "+data[i].ring2_size8
                        }
                        if( data[i].ring2_size9 != null){
                            str_ring += ", "+data[i].ring2_size9
                        }
                        if( data[i].ring2_size10 != null){
                            str_ring += ", "+data[i].ring2_size10
                        }
                        if( data[i].ring2_size11 != null){
                            str_ring += ", "+data[i].ring2_size11
                        }
                        if( data[i].ring2_size12 != null){
                            str_ring += ", "+data[i].ring2_size12
                        }
                        
                        product_ringvariant.text(str_ring || '-');
                    }else if(data[i].product_category_id == "3"||( data[i].product_category_id == "7" && data[i].prd_sub_cat_id == "27")){
                        $('.js-rings-size').addClass('d-none');
                        $('.js-bracelet-size').removeClass('d-none');
                        if( data[i].bracelet_size != null){
                            str_ring += data[i].bracelet_size 
                        }
                        
                        product_braceletvariant.text(str_ring || '-');
                    }else{
                        $('.js-rings-size').addClass('d-none');
                        $('.js-bracelet-size').addClass('d-none');
                    }

                    console.log(str);
                    if(str == ''){
                        str = '-';
                    }
                    product_variant.text(str);
                }
                $('.js-modal-product').hide();
                $('.js-product-detail').show();
            },
            error: function(err){
                console.log(err);
            }
        });
    }); 
});