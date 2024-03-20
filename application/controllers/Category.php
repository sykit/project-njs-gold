<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
   public function __construct()
	{
      parent::__construct();
	}

	public function add(){
        $category_name = $this->input->post('category_name');
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
           redirect('admin/landing_setting');
        }else{
           $data = array('image' => $this->upload->data());
           $submisson = array(
              'product_category_name' => $category_name,
              'image' => $this->upload->data('file_name'),
              'created_at' => date('Y-m-d H:i:s', now())
            );
           $insert = $this->db->insert('product_category', $submisson);
           if ($insert > 0) {
              $this->session->set_flashdata('message', 'Submission Success');
              redirect(base_url("manage/product/category"));
           } else {
              $this->session->set_flashdata('error', 'Data tak terupdate / tidak ada data yang perlu di update');
              redirect(base_url("manage/product/category"));
           }
        }
   }

   public function edit(){
      $category_id = $this->input->post('category_id');
      $category_name = $this->input->post('category_name');

      $data = array(
         'product_category_name' => $category_name
      );

      $update = $this->category_model->update($category_id, $data);
      if ($update > 0) {
         $this->session->set_flashdata('message', 'Submission Success');
         redirect(base_url("manage/product/category"));
      } else {
         $this->session->set_flashdata('error', 'Data tak terupdate / tidak ada data yang perlu di update');
         redirect(base_url("manage/product/category"));
      } 
   }

   public function edit_image(){
      $category_id = $this->input->post('category_id');
      $category_image = $this->input->post('category_image');

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
         redirect('admin/landing_setting');
      }else{
         $data = array('image' => $this->upload->data());
         $submisson = array(
            'image' => $this->upload->data('file_name'));
         $insert = $this->category_model->update($category_id, $submisson);
         if ($insert > 0) {
            $this->session->set_flashdata('message', 'Submission Success');
            redirect(base_url("manage/product/category"));
         } else {
            $this->session->set_flashdata('error', 'Data tak terupdate / tidak ada data yang perlu di update');
            redirect(base_url("manage/product/category"));
         }
      }
   }

   public function delete(){
      $category_id = $this->input->post('category_id');
      $check = $this->product_model->checkCategory($category_id);
      if($check[0]->total > 0){
         $this->session->set_flashdata('error', 'Data tidak dapat di update, terdapat kategori di produk');
            redirect(base_url("manage/product/category"));
      }else{
         $delete = $this->category_model->delete($category_id);
         if ($delete > 0) {
            $this->session->set_flashdata('message', 'Submission Success');
            redirect(base_url("manage/product/category"));
         } else {
            $this->session->set_flashdata('error', 'Data tak terupdate / tidak ada data yang perlu di update');
            redirect(base_url("manage/product/category"));
         }
      }
   }
}