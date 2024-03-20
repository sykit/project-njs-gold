<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subcategory extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function add(){
        $product_category_id = $this->input->post('product_category_id');
        $prd_sub_cat_name = $this->input->post('prd_sub_cat_name');
        $image = $this->input->post('image');
        $nama = $_FILES['up_image']['name'];
        $temp = array('image' => $this->upload->data());
        $filename = $nama . $temp['image']['file_ext'];

        unlink("./public/uploads/".$image);
  
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
           redirect('manage/product/category');
        }else{
           $data = array('image' => $this->upload->data());
           $submisson = array(
              'product_category_id' => $product_category_id,
              'prd_sub_cat_name' => $prd_sub_cat_name,
              'image' => $this->upload->data('file_name'));
           $insert = $this->db->insert('product_sub_category', $submisson);
           if ($insert > 0) {
              $this->session->set_flashdata('message', 'Submission Success');
              redirect(base_url("manage/product/subcategory"));
           } else {
              $this->session->set_flashdata('error', 'Data tak terupdate / tidak ada data yang perlu di update');
              redirect(base_url("manage/product/subcategory"));
           }
        }
   }

   public function edit(){
      $subcategory_id = $this->input->post('prd_sub_cat_id');
      $subcategory_name = $this->input->post('prd_sub_cat_name');
      $subcatregory_image = $this->input->post('prd_sub_cat_image');

      $data = array(
         'prd_sub_cat_name' => $subcategory_name,
      );

      $update = $this->subcategory_model->update($subcategory_id, $data);
      if ($update > 0) {
         $this->session->set_flashdata('message', 'Submission Success');
         redirect(base_url("manage/product/subcategory"));
      } else {
         $this->session->set_flashdata('error', 'Data tak terupdate / tidak ada data yang perlu di update');
         redirect(base_url("manage/product/subcategory"));
      } 
   }

   public function edit_category(){
      $subcategory_id = $this->input->post('prd_sub_cat_id');
      $category_id= $this->input->post('product_category_id');

      $data = array(
         'product_category_id' => $category_id,
      );

      $update = $this->subcategory_model->update($subcategory_id, $data);
      if ($update > 0) {
         $this->session->set_flashdata('message', 'Submission Success');
         redirect(base_url("manage/product/subcategory"));
      } else {
         $this->session->set_flashdata('error', 'Data tak terupdate / tidak ada data yang perlu di update');
         redirect(base_url("manage/product/subcategory"));
      } 
   }

   public function edit_image(){
      $subcategory_id = $this->input->post('prd_sub_cat_id');
      $nama = $_FILES['up_image']['name'];
      $temp = array('image' => $this->upload->data());
      $filename = $nama . $temp['image']['file_ext'];

      $config['upload_path'] = './public/uploads/';
      $config['allowed_types'] = 'jpg|png|jpeg|web|tiff|gif';
      $config['max_size'] = '500000';
      $config['overwrite'] = FALSE;
      $config['encrypt_name'] = TRUE;
      $this->upload->initialize($config);

      if (!$this->upload->do_upload('up_image')) {
         $error = array('error' => $this->upload->display_errors());
         $error = $error['error'];
         $this->session->set_flashdata('error', 'Galat, mohon coba lagi' . $error);
         redirect('manage/product/subcategory');
      }else{
         $submisson = array(
            'image' => $this->upload->data('file_name'));
         $update = $this->subcategory_model->update($subcategory_id, $submisson);
         if ($update > 0) {
            $this->session->set_flashdata('message', 'Submission Success');
            redirect(base_url("manage/product/subcategory"));
         } else {
            $this->session->set_flashdata('error', 'Data tak terupdate / tidak ada data yang perlu di update');
            redirect(base_url("manage/product/subcategory"));
         }
      }
   }

   public function delete(){
      $subcategory_id = $this->input->post('subcategory-id');
      $check = $this->product_model->checkSubCategory($subcategory_id);
      if($check[0]->total > 0){
         $this->session->set_flashdata('error', 'Data tidak dapat di update, terdapat sub kategori di produk');
            redirect(base_url("manage/product/subcategory"));
      }else{
         $delete = $this->subcategory_model->delete($subcategory_id);
         if ($delete > 0) {
            $this->session->set_flashdata('message', 'Submission Success');
            redirect(base_url("manage/product/subcategory"));
         } else {
            $this->session->set_flashdata('error', 'Data tak terupdate / tidak ada data yang perlu di update');
            redirect(base_url("manage/product/subcategory"));
         }
      }
   }
}