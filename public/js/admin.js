const BASE_URL = $('body').data('url');

$(function(){
    $.ajax({
        url: BASE_URL + 'async/fetch_classtype',
        method: 'GET',
        success: function (callback) {
           let response = JSON.parse(callback);
           $.each(response, function(key, obj){
                $('.js-classtype').append('<option data-index="'+key+'" value="'+obj.id_classtype+'">'+obj.nama+'</option>')
           });
        }
     });

     $('.js-classtype').on('change', function(){
        let value = $(this).val();
        $.ajax({
            url: BASE_URL + 'async/fetch_subclasstype?id_classtype='+ value,
            method: 'GET',
            success: function (callback) {
               let response = JSON.parse(callback);
               $('.js-subclasstype').empty();
               $.each(response, function(key, obj){
                    $('.js-subclasstype').append('<option data-index="'+key+'" value="'+obj.id_subclasstype+'">'+obj.nama+'</option>')
               });
            },
            error: function(err){
               console.log(err);
            }
         });
    });
});