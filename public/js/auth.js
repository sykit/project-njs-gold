const URL = $('body').data('url');
const FGROUPID = $('body').data('fgroupid');
const $jsLogin = $('.js-login-form');
const $fgroupLogin = $jsLogin.find("select[name='fgroup']");
const $jsLoginSpinner = $jsLogin.find('.js-spinner');
const $jsLoginCta = $jsLogin.find('.js-btn-login');
const $jsLoginError = $jsLogin.find('.js-login-error');
const $jsBtnLogin = $jsLogin.find('.js-btn-login');

$(function(){
    $('.js-login-email').on('keyup', function(){
        console.log('keyup');
        if($(this).val() == ''){
            $fgroupLogin.addClass('d-none');
            $jsLoginError.addClass('d-none');
            $jsBtnLogin.attr('disabled', true);
        }else{
            $.ajax({
                url: URL + 'async/fg_by_email',
                method: 'POST',
                data: {
                    'email': $(this).val().toString()
                },
                success: function(data){
                    data = JSON.parse(data);
                    if(data.length > 0){
                        $jsLoginError.addClass('d-none');
                        $fgroupLogin.removeClass('d-none');
                        $fgroupLogin.val(data[0].func_group_id).change();
                        $jsBtnLogin.attr('disabled', false);
                    }else{
                        $jsLoginError.removeClass('d-none');
                        $fgroupLogin.addClass('d-none');
                        $jsBtnLogin.attr('disabled', true);
                    }
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        }
    });

});