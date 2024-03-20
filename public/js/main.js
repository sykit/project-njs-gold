$(function(){
    $('.js-card').matchHeight()
    $('.js-switch').on('change', function(){
            $(this).val($(this).prop('checked'))
        $('.js-form').submit();
    });

     $('.js-category-menu > a').on('mouseenter', function(e){
        product_category_id = $(this).data('idcategory');
        $('.js-skeleton-block').show();
        $('.js-hero-menu').show();
        $.ajax({
            url: URL + 'api/v1/subcat/' + product_category_id,
            success: function(response){
                    setTimeout(function(){
                        $('.js-csubmenu').empty();
                        $('.js-skeleton-block').hide();
                        response = JSON.parse(response);
                        if(response.length == 0){
                            $('.js-csubmenu').append('<div class="text-center">Tidak ada data</div>');
                        }else{
                            for(let i = 0; i < response.length; i++){
                                let category_id = response[i].product_category_id;
                                let subcategory_id = response[i].prd_sub_cat_id;
                                let rate_id = 0;
                                let weight = 0;
                                let adapter = `<a class="mb-3" href="`+URL+`products/`+category_id+`/`+subcategory_id+`/`+rate_id+`/`+weight+`">
                                    <img class="lazyload blur-up" data-src='`+URL+`/public/uploads/`+response[i].image+`' width="200" height="200" alt="" onerror="this.src='`+URL+`public/images/placeholder.jpeg'"/>
                                    <div class="mt-2 text">`+response[i].prd_sub_cat_name+`</div>
                                </a>
                                `;
                                $('.js-csubmenu').append(adapter);
                                adapterLink = '<div class="text-center fw-bold mt-3"><a href="'+URL+'products/'+response[i].product_category_id+'/0/0/0">Lihat Semua</a></div>';
                            }
                            $('.js-csubmenu').append(adapterLink);
                        }
                    }, 1);
                },error: function(err){
                    console.log(err);
                }
            });
     });

     $('.js-category-menu').on('mouseleave', function(e){
        let target = $(e.currentTarget).hasClass('js-category-menu');
        if(target){
            $('.js-hero-menu').hide();
        }
     });

     $('.js-category-menu').on('mouseenter', function(e){
        let target = $(e.currentTarget).hasClass('js-category-menu');
        if(target){
            $('.js-hero-menu').show();
        }
     });

     // start new product
     if($('.js-newproduct').length){
        $.ajax({
            url: URL + '/api/v1/products',
            success: function(response){
                response = JSON.parse(response);
                if(response.length == 0){
                    $('.js-newproduct').append('<div class="text-center">Tidak ada data</div>');
                }else{
                    setTimeout(function(){
                        $('.js-newprodpl').hide();
                        $('.js-total-newproduct').text(response.length);
                        $('.js-newproduct').empty();
                        for(let i = 0; i < response.length; i++){
                            let adapter = `
                            <a style="cursor:pointer;" href="#productDetail" data-productid="`+response[i].product_class_id+`" data-bs-toggle="modal" data-bs-target="#productDetail" class="col col-lg-2 col-6 mb-lg-4 mb-4">
                                <img class="w-100 lazyload blur-up product-card" data-src="`+URL+ '/public/uploads/' + response[i].image+`" onerror="this.src='`+URL+`public/images/placeholder.jpeg'"
                                    alt="" />
                                <div class="fw-bold pt-2">`+response[i].product_class_name+`</div>
                            </a>
                            `;
                            $('.js-newproduct').append(adapter);
                        }
                    },25);
                }
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        })
     }

     $('.no-print').css('display', 'block');
     window.onafterprint = function(){
         $(window).off('mousemove', window.onafterprint);
         $('.no-print').css('display', 'block');
     }
 
     setTimeout(function(){
         $(window).one('mousemove', window.onafterprint);
     }, 1);
}); 

/**
 * 
 * @param {*} $jqSelector specify $('#product) or $('.product)
 */
function printData($jqSelector)
{
    $jqSelector.printThis({
        header: ""
    });
    $('.no-print').css('display', 'none');
}
/**
 * 
 * @param {*} $attachToSelector jquery id element
 */
function spinLoader($attachToSelector){
    $(`<div class="text-center spinner-border" role="status" style="position:absolute;left:0%;">
        <span class="visually-hidden">Loading...</span>
    </div>`).appendTo('attachTo');
}