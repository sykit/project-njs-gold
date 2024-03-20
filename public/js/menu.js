$(function(){

    /**
     * Menu for Group ID for Katalog Produk
     */
    $.ajax({
        url: URL + 'activityasync/render_menu/' + FGROUPID + '/1',
        method: 'GET',
        async: false,
        success: function(data){
            data = JSON.parse(data);
            setTimeout(function(){
                $('.js-skeleton-menu').addClass('d-none');
            }, 25);
            for(let i=0; i<data.length; i++){
                let adapter = `<a class="fw-normal" href="`+URL+data[i].routes+`">`+data[i].activity_name+`</a>`;
                $('.js-menu-catalog').append(adapter);
            }
        },
        error: function(err){
            console.log(err);
        }
    });

    /**
     * Menu for Group ID for administartion utilities & miscellaneous
     */
    $.ajax({
        url: URL + 'activityasync/render_menu/' + FGROUPID + '/8',
        method: 'GET',
        async: false,
        success: function(data){
            data = JSON.parse(data);
            setTimeout(function(){
                $('.js-skeleton-menu').addClass('d-none');
            }, 25);
            for(let j=0; j<data.length; j++){
                let adapter = `<a class="fw-normal" href="`+URL+data[j].routes+`">`+data[j].activity_name+`</a>`;
                $('.js-menu-administration').append(adapter);
            }
        },
        error: function(err){
            console.log(err);
        }
    });

    /**
     * Menu for Report
     */
    $.ajax({
        url: URL + 'activityasync/render_menu/' + FGROUPID + '/7',
        method: 'GET',
        async: false,
        success: function(data){
            data = JSON.parse(data);
            setTimeout(function(){
                $('.js-skeleton-menu').addClass('d-none');
            }, 25);
            for(let j=0; j < data.length; j++){
                let adapter = `<a class="fw-normal" href="`+URL+data[j].routes+`">`+data[j].activity_name+`</a>`;
                $('.js-menu-report').append(adapter);
            }
        },
        error: function(err){
            console.log(err);
        }
    });
});