<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asyncsom extends CI_Controller {
    public function __construct()
	{
      parent::__construct();
	}

    public function companytype(){
       $result = $this->company_model->companyType();
       echo json_encode($result);
    }

    public function company($company_type_id){
        $result = $this->company_model->company($company_type_id);
        echo json_encode($result);
    }

    public function user($company_id){
        $result = $this->company_model->user($company_id);
        echo json_encode($result);
    }

    public function product_sepuh($product_id){
        $result = $this->sepuh_model->sepuhByProduct($product_id);
        echo json_encode($result);
    }

    public function product_rate($product_id){
        $result = $this->productrate_model->rateByProduct($product_id);
        echo json_encode($result);
    }

    public function product_by_code($product_class_name){
        $result = $this->productdetail_model->productIdByCode($product_class_name);
        echo json_encode($result);
    }

    public function sepuh_by_code($product_class_name, $sepuh_code){
        $result = $this->productdetail_model->productSepuhByCode($product_class_name, $sepuh_code);
        echo json_encode($result);
    }

    public function ringsize_by_code($product_class_name, $ringsize){
        $result = $this->productdetail_model->productSizeByCode($product_class_name, $ringsize);
        echo json_encode($result);
    }

    public function brackletsize_by_code($product_class_name, $bracklet_size, $bracklet_design){
        $result = $this->productdetail_model->productBraceletSizeByCode($product_class_name, $bracklet_size, $bracklet_design);
        echo json_encode($result);
    }

    public function set_by_code($product_class_name, $set_size, $set_design){
        $result = $this->productdetail_model->productBraceletSizeByCode($product_class_name, $ringsize);
        echo json_encode($result);
    }

    public function rate_by_code($product_class_name, $product_rate_code){
        $result = $this->productdetail_model->productRateByCode($product_class_name, $product_rate_code);
        echo json_encode($result);
    }

    public function transacation_data_thid(){
        $th_id = $_GET['th_id'];
        $th = $this->transheader_model->getTransHeaderByThId($th_id);
		$td = $this->transdetail_model->getTransDetailByThId($th_id);
		$tp = $this->transpicdetail_model->getTranspicByThId($th_id);
        $data = array(
            $th,
            $td,
            $tp
        );

        echo json_encode($data);
    }

    public function transacation_data(){
        $th_code = $_GET['th_code'];
        $th = $this->transheader_model->getTransHeaderByThCode($th_code);
		$td = $this->transdetail_model->getTransDetailByCode($th_code);
		$tp = $this->transpicdetail_model->getTranspicByThCode($th_code);
        $data = array(
            $th,
            $td,
            $tp
        );

        echo json_encode($data);
    }

    public function update_handler(){
        $activity_id = $this->input->post('activity_id');
        $trans_code = $this->input->post('trans_code');
        $trans_status_id = $this->input->post('trans_status_id');
        $next_pic = $this->input->post('next_pic') ?? 0;
        $result = $this->activity_model->update_trans_status($trans_code, $trans_status_id, $next_pic);
        echo json_encode($result); 
    }

    public function save_handler(){
        $activity_id = $this->input->post('activity_id');
        $trans_code = $this->input->post('trans_code');
        $trans_date = date('Y-m-d H:i:s');
        $trans_status_id = $this->input->post('trans_status_id');
        $trans_loc = $this->input->post('trans_loc');
        $trans_loc2 = $this->input->post('trans_loc2');
        $ref_doc = $this->input->post('ref_doc');
        $ref_doc2 = $this->input->post('ref_doc2');
        $next_pic = $this->input->post('next_pic');
        $next_loc = $this->input->post('next_loc');
        $date_expected = $this->input->post('date_expected');
        $date_result = $this->input->post('date_result');
        $notes = $this->input->post('notes');
        $s1 = $this->input->post('s1');
        $s2 = $this->input->post('s2');
        $n1 = $this->input->post('n1');
        $n2 = $this->input->post('n2');
        $trans_detail = $this->input->post('trans_detail');
        $trans_pic_detail = $this->input->post('trans_pic_detail');

        // var_dump($trans_detail);exit;

        $date_expected_create = date_create($date_expected);
        $date_result_create = date_create($date_result);

        $data_th = array(
            'activity_id' => $activity_id,
            'trans_code' => $trans_code,
            'trans_date' => $trans_date,
            'trans_status_id' => $trans_status_id,
            'trans_loc' => $trans_loc,
            'trans_loc2' => $trans_loc2,
            'ref_doc' => $ref_doc,
            'ref_doc2'=> $ref_doc2,
            'next_pic' => $next_pic,
            'next_loc' => $next_loc,
            'date_expected' => date_format($date_expected_create, 'Y-m-d H:i:s'),
            'date_result' =>  date_format($date_result_create, 'Y-m-d H:i:s'),
            'notes' => $notes,
            's1' => $s1,
            's2' => $s2,
            'n1' => $n1,
            'n2'=> $n2,
        );

        $this->db->trans_start();
        $insert = $this->transheader_model->insert($data_th);        
        $lastId = $this->db->insert_id();
        foreach($trans_detail as $item){
            $data_td = array(
                'th_id' => $lastId,
                'product_category_id' => $item['product_category_id'],
                'product_sub_category_id'=> $item['prd_sub_cat_id'],
                'product_class_id' => $item['product_class_id'],
                'rate_id' => $item['rate_id'],
                'sepuh_id' => $item['sepuh_id'],
                'size_id' => $item['ring_size_id'],
                'n2' => $item['qty'], // save qty on n2
                'notes'=> $item['keterangan']
            );

            $insert_td = $this->transdetail_model->insert($data_td);    
        }

        $data_tp = array(
            'th_id' => $lastId,
            'pic1' => $trans_pic_detail['pic1']
        );
        $insert_tp = $this->transpicdetail_model->insert($data_tp);

        $this->db->trans_complete();
    
        if ($this->db->trans_status() === FALSE)
        {
            echo json_encode(array(
                'message' => 'failed'
            ));
        }else{
            echo json_encode(array(
                'message' => 'success'  
            ));
        }
    }


    public function submit_handler(){
        $activity_id = $this->input->post('activity_id');
        $trans_code = $this->input->post('trans_code');
        $trans_date = date('Y-m-d H:i:s');
        $trans_status_id = $this->input->post('trans_status_id');
        $trans_loc = $this->input->post('trans_loc');
        $trans_loc2 = $this->input->post('trans_loc2');
        $ref_doc = $this->input->post('ref_doc');
        $ref_doc2 = $this->input->post('ref_doc2');
        $next_pic = $this->input->post('next_pic');
        $next_loc = $this->input->post('next_loc');
        $date_expected = $this->input->post('date_expected');
        $date_result = $this->input->post('date_result');
        $notes = $this->input->post('notes');
        $s1 = $this->input->post('s1');
        $s2 = $this->input->post('s2');
        $n1 = $this->input->post('n1');
        $n2 = $this->input->post('n2');
        $trans_detail = $this->input->post('trans_detail');
        $trans_pic_detail = $this->input->post('trans_pic_detail');

        // var_dump($trans_detail);exit;

        $date_expected_create = date_create($date_expected);
        $date_result_create = date_create($date_result);

        $data_th = array(
            'activity_id' => $activity_id,
            'trans_code' => $trans_code,
            'trans_date' => $trans_date,
            'trans_status_id' => $trans_status_id,
            'trans_loc' => $trans_loc,
            'trans_loc2' => $trans_loc2,
            'ref_doc' => $ref_doc,
            'ref_doc2'=> $ref_doc2,
            'next_pic' => 11,
            'next_loc' => $next_loc,
            'date_expected' => date_format($date_expected_create, 'Y-m-d H:i:s'),
            'date_result' =>  date_format($date_result_create, 'Y-m-d H:i:s'),
            'notes' => $notes,
            's1' => $s1,
            's2' => $s2,
            'n1' => $n1,
            'n2'=> $n2,
            'n3' => 11
        );

        $this->db->trans_start();
        $insert = $this->transheader_model->insert($data_th);        
        $lastId = $this->db->insert_id();
        foreach($trans_detail as $item){
            $data_td = array(
                'th_id' => $lastId,
                'product_category_id' => $item['product_category_id'],
                'product_sub_category_id'=> $item['prd_sub_cat_id'],
                'product_class_id' => $item['product_class_id'],
                'rate_id' => $item['rate_id'],
                'sepuh_id' => $item['sepuh_id'],
                'size_id' => $item['ring_size_id'] ?? $item['bracelet_size_id'],
                'bentuk_id' => $item['bentuk_id'],
                'n2' => $item['qty'], // save qty on n2,
                'n3' => $item['ring_size_id'] ?? '', // save ring size,
                'n4' => $item['bracelet_size_id'] ?? '', // save bracelet size,
                'notes'=> $item['keterangan']
            );

            $insert_td = $this->transdetail_model->insert($data_td);    
        }

        $data_tp = array(
            'th_id' => $lastId,
            'pic1' => $trans_pic_detail['pic1'],
            'pic2' => 11,
            'date_submit1' => date_format($date_expected_create, 'Y-m-d H:i:s')
        );
        $insert_tp = $this->transpicdetail_model->insert($data_tp);

        $this->db->trans_complete();
    
        if ($this->db->trans_status() === FALSE)
        {
            echo json_encode(array(
                'message' => 'failed'
            ));
        }else{
            echo json_encode(array(
                'message' => 'success'  
            ));
        }
    }
}