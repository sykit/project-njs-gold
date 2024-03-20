<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
	}

    public function add(){
        $product_class_name = $this->input->post('product_class_name');
        $product_class_code = $this->input->post('product_class_code');
        $product_category_id = $this->input->post('product_category_id');
        $prd_sub_cat_id = $this->input->post('prd_sub_cat_id');
        $prd_rate_id = $this->input->post('prd_rate_id');
        $sepuh_id = $this->input->post('sepuh_id');

        $prd_rate_id2 = $this->input->post('prd_rate_id2');
        $prd_rate_id3 = $this->input->post('prd_rate_id3');
        $prd_rate_id4 = $this->input->post('prd_rate_id4');
        $prd_rate_id5 = $this->input->post('prd_rate_id5');
        $prd_rate_id6 = $this->input->post('prd_rate_id6');
        $prd_rate_id7 = $this->input->post('prd_rate_id7');
        $prd_rate_id8 = $this->input->post('prd_rate_id8');
        $prd_rate_id9 = $this->input->post('prd_rate_id9');
        $prd_rate_id10 = $this->input->post('prd_rate_id10');
        $prd_rate_id11 = $this->input->post('prd_rate_id11');
        $prd_rate_id12 = $this->input->post('prd_rate_id12');

        $prd_class_weight1 = $this->input->post('prd_class_weight1');
        $prd_class_weight2 = $this->input->post('prd_class_weight2');
        $prd_class_weight3 = $this->input->post('prd_class_weight3');
        $prd_class_weight4 = $this->input->post('prd_class_weight4');
        $prd_class_weight5 = $this->input->post('prd_class_weight5');
        $prd_class_weight6 = $this->input->post('prd_class_weight6');
        $prd_class_weight7 = $this->input->post('prd_class_weight7');
        $prd_class_weight8 = $this->input->post('prd_class_weight8');
        $prd_class_weight9 = $this->input->post('prd_class_weight9');
        $prd_class_weight10 = $this->input->post('prd_class_weight10');
        $prd_class_weight11 = $this->input->post('prd_class_weight11');
        $prd_class_weight12 = $this->input->post('prd_class_weight12');

        $ring_size_id1 = $this->input->post('ring_size_id1');
        $ring_size_id2 = $this->input->post('ring_size_id2');
        $ring_size_id3 = $this->input->post('ring_size_id3');
        $ring_size_id4 = $this->input->post('ring_size_id4');
        $ring_size_id5 = $this->input->post('ring_size_id5');
        $ring_size_id6 = $this->input->post('ring_size_id6');
        $ring_size_id7 = $this->input->post('ring_size_id7');
        $ring_size_id8 = $this->input->post('ring_size_id8');
        $ring_size_id9 = $this->input->post('ring_size_id9');
        $ring_size_id10 = $this->input->post('ring_size_id10');
        $ring_size_id11 = $this->input->post('ring_size_id11');
        $ring_size_id12 = $this->input->post('ring_size_id12');

        $bracelet_size_id1 = $this->input->post('bracelet_size_id1');
        $bracelet_size_id2 = $this->input->post('bracelet_size_id2');
        $bracelet_size_id3 = $this->input->post('bracelet_size_id3');
        $bracelet_size_id4 = $this->input->post('bracelet_size_id4');
        $bracelet_size_id5 = $this->input->post('bracelet_size_id5');
        $bracelet_size_id6 = $this->input->post('bracelet_size_id6');
        $nama = $_FILES['up_image']['name'];
        $temp = array('image' => $this->upload->data());
        $filename = $nama . $temp['image']['file_ext'];
  
        $config['upload_path'] = './public/uploads/';
        $config['allowed_types'] = 'jpg|png|jpeg|';
        $config['max_size'] = '500000';
        $config['filename'] = $filename;
        $config['overwrite'] = TRUE;
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('up_image')) {
            $error = array('error' => $this->upload->display_errors());
            echo json_encode(array('message' => 'Error inserting product'));
         }else{ 
             $data = array(
                 'product_class_name' => $product_class_name,
                 'product_class_code' => $product_class_code,
                 'product_category_id' => $product_category_id,
                 'prd_sub_cat_id' => $prd_sub_cat_id,
                 'prd_rate_id' => $prd_rate_id,
                 'sepuh_id'=> $sepuh_id,
                 'image' => $filename,
                 'created_at' => date('Y-m-d H:i:s', now()),
                 'updated_at' => date('Y-m-d H:i:s', now())
             );
     
             $insert = $this->product_model->insert($data);
             if($insert > 0){
                $data2 = array(
                    'product_class_id' => $this->db->insert_id(),
                    'prd_class_rate_id2'=> $prd_rate_id2,
                    'prd_class_rate_id3'=> $prd_rate_id3,
                    'prd_class_rate_id4'=> $prd_rate_id4,
                    'prd_class_rate_id5'=> $prd_rate_id5,
                    'prd_class_rate_id6'=> $prd_rate_id6,
                    'prd_class_rate_id7'=> $prd_rate_id7,
                    'prd_class_rate_id8'=> $prd_rate_id8,
                    'prd_class_rate_id9'=> $prd_rate_id9,
                    'prd_class_rate_id10'=> $prd_rate_id10,
                    'prd_class_rate_id11'=> $prd_rate_id11,
                    'prd_class_rate_id12'=> $prd_rate_id12,
                    'prd_class_weight1' => $prd_class_weight1,
                    'prd_class_weight2' => $prd_class_weight2,
                    'prd_class_weight3' => $prd_class_weight3,
                    'prd_class_weight4' => $prd_class_weight4,
                    'prd_class_weight5' => $prd_class_weight5,
                    'prd_class_weight6' => $prd_class_weight6,
                    'prd_class_weight7' => $prd_class_weight7,
                    'prd_class_weight8' => $prd_class_weight8,
                    'prd_class_weight9' => $prd_class_weight9,
                    'prd_class_weight10' => $prd_class_weight10,
                    'prd_class_weight11' => $prd_class_weight11,
                    'prd_class_weight12' => $prd_class_weight12,
                    'ring_size_id1' => $ring_size_id1 ?? 0,
                    'ring_size_id2' => $ring_size_id2 ?? 0,
                    'ring_size_id3' => $ring_size_id3 ?? 0,
                    'ring_size_id4' => $ring_size_id4 ?? 0,
                    'ring_size_id5' => $ring_size_id5 ?? 0,
                    'ring_size_id6' => $ring_size_id6 ?? 0,
                    'ring_size_id7' => $ring_size_id7 ?? 0,
                    'ring_size_id8' => $ring_size_id8 ?? 0,
                    'ring_size_id9' => $ring_size_id9 ?? 0,
                    'ring_size_id10' => $ring_size_id10 ?? 0,
                    'ring_size_id11' => $ring_size_id11 ?? 0,
                    'ring_size_id12' => $ring_size_id12 ?? 0,
                    'bracelet_size_id' => $bracelet_size_id1 ?? 0,
                );
                $insert2 = $this->productdetail_model->insert($data2);
                if($insert2 > 0){
                    echo json_encode(array('success' => true));
                }
             }else{
                 echo json_encode(array('message' => 'Error inserting product'));
             }
         }

    }

    public function edit(){
        $product_class_id = $this->input->post('product_class_id');
        $product_class_name = $this->input->post('product_class_name');
        $product_class_code = $this->input->post('product_class_code');
        $product_category_id = $this->input->post('product_category_id');
        $prd_sub_cat_id = $this->input->post('prd_sub_cat_id');
        $prd_rate_id = $this->input->post('prd_rate_id');
        $sepuh_id = $this->input->post('sepuh_id');

        $prd_rate_id2 = $this->input->post('prd_rate_id2');
        $prd_rate_id3 = $this->input->post('prd_rate_id3');
        $prd_rate_id4 = $this->input->post('prd_rate_id4');
        $prd_rate_id5 = $this->input->post('prd_rate_id5');
        $prd_rate_id6 = $this->input->post('prd_rate_id6');
        $prd_rate_id7 = $this->input->post('prd_rate_id7');
        $prd_rate_id8 = $this->input->post('prd_rate_id8');
        $prd_rate_id9 = $this->input->post('prd_rate_id9');
        $prd_rate_id10 = $this->input->post('prd_rate_id10');
        $prd_rate_id11 = $this->input->post('prd_rate_id11');
        $prd_rate_id12 = $this->input->post('prd_rate_id12');

        $prd_class_weight1 = $this->input->post('prd_class_weight1');
        $prd_class_weight2 = $this->input->post('prd_class_weight2');
        $prd_class_weight3 = $this->input->post('prd_class_weight3');
        $prd_class_weight4 = $this->input->post('prd_class_weight4');
        $prd_class_weight5 = $this->input->post('prd_class_weight5');
        $prd_class_weight6 = $this->input->post('prd_class_weight6');
        $prd_class_weight7 = $this->input->post('prd_class_weight7');
        $prd_class_weight8 = $this->input->post('prd_class_weight8');
        $prd_class_weight9 = $this->input->post('prd_class_weight9');
        $prd_class_weight10 = $this->input->post('prd_class_weight10');
        $prd_class_weight11 = $this->input->post('prd_class_weight11');
        $prd_class_weight12 = $this->input->post('prd_class_weight12');

        $ring_size_id1 = $this->input->post('ring_size_id1');
        $ring_size_id2 = $this->input->post('ring_size_id2');
        $ring_size_id3 = $this->input->post('ring_size_id3');
        $ring_size_id4 = $this->input->post('ring_size_id4');
        $ring_size_id5 = $this->input->post('ring_size_id5');
        $ring_size_id6 = $this->input->post('ring_size_id6');
        $ring_size_id7 = $this->input->post('ring_size_id7');
        $ring_size_id8 = $this->input->post('ring_size_id8');
        $ring_size_id9 = $this->input->post('ring_size_id9');
        $ring_size_id10 = $this->input->post('ring_size_id10');
        $ring_size_id11 = $this->input->post('ring_size_id11');
        $ring_size_id12 = $this->input->post('ring_size_id12');

        $bracelet_size_id1 = $this->input->post('bracelet_size_id1');

        $data = array(
            'product_class_name' => $product_class_name,
            'product_class_code' => $product_class_code,
            'product_category_id' => $product_category_id,
            'prd_sub_cat_id' => $prd_sub_cat_id,
            'prd_rate_id' => $prd_rate_id,
            'sepuh_id'=> $sepuh_id,
            'updated_at' => mdate('%Y-%m-%d %H:%i:%s', now())
        );

        $data2 = array(
            'prd_class_rate_id2'=> $prd_rate_id2,
            'prd_class_rate_id3'=> $prd_rate_id3,
            'prd_class_rate_id4'=> $prd_rate_id4,
            'prd_class_rate_id5'=> $prd_rate_id5,
            'prd_class_rate_id6'=> $prd_rate_id6,
            'prd_class_rate_id7'=> $prd_rate_id7,
            'prd_class_rate_id8'=> $prd_rate_id8,
            'prd_class_rate_id9'=> $prd_rate_id9,
            'prd_class_rate_id10'=> $prd_rate_id10,
            'prd_class_rate_id11'=> $prd_rate_id11,
            'prd_class_rate_id12'=> $prd_rate_id12,
            'prd_class_weight1' => $prd_class_weight1,
            'prd_class_weight2' => $prd_class_weight2,
            'prd_class_weight3' => $prd_class_weight3,
            'prd_class_weight4' => $prd_class_weight4,
            'prd_class_weight5' => $prd_class_weight5,
            'prd_class_weight6' => $prd_class_weight6,
            'prd_class_weight7' => $prd_class_weight7,
            'prd_class_weight8' => $prd_class_weight8,
            'prd_class_weight9' => $prd_class_weight9,
            'prd_class_weight10' => $prd_class_weight10,
            'prd_class_weight11' => $prd_class_weight11,
            'prd_class_weight12' => $prd_class_weight12,
            'ring_size_id1' => $ring_size_id1 ?? 0,
            'ring_size_id2' => $ring_size_id2 ?? 0,
            'ring_size_id3' => $ring_size_id3 ?? 0,
            'ring_size_id4' => $ring_size_id4 ?? 0,
            'ring_size_id5' => $ring_size_id5 ?? 0,
            'ring_size_id6' => $ring_size_id6 ?? 0,
            'ring_size_id7' => $ring_size_id7 ?? 0,
            'ring_size_id8' => $ring_size_id8 ?? 0,
            'ring_size_id9' => $ring_size_id9 ?? 0,
            'ring_size_id10' => $ring_size_id10 ?? 0,
            'ring_size_id11' => $ring_size_id11 ?? 0,
            'ring_size_id12' => $ring_size_id12 ?? 0,
            'bracelet_size_id' => $bracelet_size_id1 ?? 0,
        ); 
        
        $update = $this->product_model->update($product_class_id, $data);
        $update2 = $this->productdetail_model->updateByProduct($product_class_id, $data2);

        // var_dump($update);exit;
        
        if($update && $update2){
            echo json_encode(array('success' => true));
        }else{
            echo json_encode(array('message' => $update));
        }
    }

    public function edit_image(){
        $product_class_id = $this->input->post('product_class_id');

        var_dump($product_class_id);
  
        unlink(base_url("public/uploads/".$category_image));
  
        $nama = $_FILES['up_image']['name'];
        $temp = array('image' => $this->upload->data());
        $filename = $nama . $temp['image']['file_ext'];
  
        $config['upload_path'] = './public/uploads/';
        $config['allowed_types'] = 'jpg|png|jpeg|';
        $config['max_size'] = '500000';
        $config['filename'] = $filename;
        $config['overwrite'] = TRUE;
        $config['encrypt_name'] = TRUE;
        $this->upload->initialize($config);
  
        if (!$this->upload->do_upload('up_image')) {
           $error = array('error' => $this->upload->display_errors());
           $error = $error['error'];
           $this->session->set_flashdata('error', 'Galat, mohon coba lagi' . $error);
           redirect('manage/product');
        }else{
           $data = array('image' => $this->upload->data());
           $submisson = array(
              'image' => $this->upload->data('file_name'));
           $update = $this->product_model->update($product_class_id, $submisson);
           if ($update > 0) {
              $this->session->set_flashdata('message', 'Submission Success');
              redirect(base_url("manage/product"));
           } else {
              $this->session->set_flashdata('error', 'Data tak terupdate / tidak ada data yang perlu di update');
              redirect(base_url("manage/product"));
           }
        }
    }

    public function delete(){
        $product_class_id = $this->input->post('product_class_id');
        $delete = $this->product_model->delete($product_class_id);
        if ($delete > 0) {
            $this->session->set_flashdata('message', 'Submission Success');
            redirect(base_url("manage/product"));
        } else {
            $this->session->set_flashdata('error', 'Data tak terupdate / tidak ada data yang perlu di update');
            redirect(base_url("manage/product"));
        }
    }
}