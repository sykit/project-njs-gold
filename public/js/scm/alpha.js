// public variable store disini

let TRANS_CODE_SOM = 'SOM';
let CURR_USER_ID = $('body').data('userid');
let CURR_USER_NAME = $('body').data('username');
let CURR_USER_EMAIL = $('body').data('email');
let CURR_USER_SURNAME = $('body').data('email');
let CURR_USER_FGROUP_ID = $('body').data('fgroupid');
let CURR_USER_FGROUP_NAME = $('body').data('fgroupname');
let IS_AUTHENTICATED =  $('body').data('authenticated');
let MSG_NO_EMPTY = 'Mohon diisi, data tidak boleh kosong';
let MSG_ERROR = 'Data error, mohon periksa kembali';

let DATA_ORDER_DETAIL = [];
let FILTERED_DATA_ORDER_DETAIL = [];

const $el_som = $('#somSubmit');

// subkategori untuk gelang and set, reference : brecelet_size_reference
var SUB_KATEGORI_GELANG_SET = [11,12,13,14,15,16,17,18,27,32,33,34,35,36,37,38,39,40,41,42,43];

// subkategori untuk cincin, reference : ring_size_reference
var SUB_KATEGORI_CINCIN = [1,3,4,9,10,26];

var utils = {
    generateTranscode: function($activity_id, $acitivity_code){
        $.ajax({
            url: URL + 'asyncscm/generate_transcode/' + $activity_id + '/' + $acitivity_code,
            success: function(data){
                console.log(data);
               try{
                   data = JSON.parse(data);
                   $('.js-kode-transaksi').val(data[0]).attr('disabled', true);
               }catch(e){
                console.log(e)
               }
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
         });
    },
    deleteOrder: function(index){
        if(index){
            DATA_ORDER_DETAIL.splice(index, 1); // 2nd parameter means remove one item only
            $('#table_id' + index).remove();
        }else{
            alert('Tidak bisa di delete, tidak ada data yang ditemukan');
        }
    },
    cloneOrder: function(index){
        let newObject = {};
        newObject = DATA_ORDER_DETAIL[index];
        DATA_ORDER_DETAIL.push(newObject);
        renderTables();
    },
    currentTimeMilis: function(){
        return new Date().toISOString().slice(0, 19).replace('T', ' ');
    }
}

function submissionHandler(serializedData, endpointPath) {
	return $.ajax({
		url: URL + endpointPath,
		method: "POST",
		data: serializedData,
		success: function (data) {
			data = JSON.parse(data);
            return data;
		},
		error: function (err) {
            return err;
		},
	});
}