<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asyncscm extends CI_Controller {
    public function __construct()
	{
      parent::__construct();
	}

    public function generate_transcode($activity_id, $code){
        /**
         * Alternate logic
        * 1. Cek semua transheader dengan like berdasarkan trans_code
        * 2. Split code transcode dan ambil tanggal ny saja
        * 3. Cek apakah tanggal hari ini = tanggal terakhir som yang ada ditable
        * 4. Jika sekarang > tanggal terakhir di table som, maka tanggal baru di add dan urutan mulai dari 1
        * 5. Jika tidak maka sekarang == tanggal terakhir di table som maka urutan mulai dari last_id + 1;
        * 6. Ada kasus transaksi belum terdaftar atau ter create di transheader
        */

        $q1 = 'SELECT * FROM trans_header a WHERE trans_code like "%"?"%" ORDER BY th_id DESC LIMIT 1';
        $result1 = $this->db->query($q1, array($code))->result();

        if(sizeof($result1) == 0){
            $trans_code = strtoupper($code);
            $activity_code = strtoupper($code);
            $trans_date = date("m/d/Y");
            $trans_autoid = 1;
    
            $today_date =  date("m/d/Y");
    
            $new_trans_code = '';
            $new_activity_code = $code;
            $new_trans_date = '';
            $new_trans_autoid = NULL;
    
            $new_trans_date = $today_date;
            $new_trans_autoid = 1;
            
    
            $new_trans_code = strtoupper($new_activity_code .'-'. $new_trans_date . '-' . $new_trans_autoid);
            echo json_encode(array($new_trans_code));
        }else{
            $trans_code = explode('-', $result1[0]->trans_code);
            $activity_code = $trans_code[0];
            $trans_date = $trans_code[1];
            $trans_autoid = $trans_code[2];
    
            $today_date =  date("m/d/Y");
    
            $new_trans_code = '';
            $new_activity_code = $code;
            $new_trans_date = '';
            $new_trans_autoid = NULL;
    
            if($today_date > $trans_date){
                $new_trans_date = $today_date;
                $new_trans_autoid = 1;
            }else if($today_date == $trans_date){
                $new_trans_date = $today_date;
                $new_trans_autoid = $trans_autoid + 1;
            } else {
                $new_trans_date = $today_date;
                $new_trans_autoid = $trans_autoid + 1;
            }
    
            $new_trans_code = strtoupper($new_activity_code .'-'. $new_trans_date . '-' . $new_trans_autoid);
            echo json_encode(array($new_trans_code));
        }

    }
}