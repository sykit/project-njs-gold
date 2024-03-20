<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customerdata extends MY_Controller
{
   public function __construct()
   {
      parent::__construct();
   }

   function get()
   {
      return $this->db->order_by('func_group_id', 'ASC')->get($this->table)->result();
   }

   public function add()
   {

      $sales_area_id = $this->input->post("sales_area_id");
      $cluster_id = $this->input->post("cluster_id");
      $company_type_id = $this->input->post("company_type_id");
      $company_code = $this->input->post('company_code');
      $company_name = $this->input->post('company_name');
      $company_owner_name = $this->input->post('company_owner_name');
      $company_phone = $this->input->post('company_phone');
      $company_address = $this->input->post('company_address');
      $data = array(
         'company_type_id' => $company_type_id,
         'cluster_id' => $cluster_id,
         'sales_area_id' => $sales_area_id,
         'company_code' => $company_code,
         'company_name' => $company_name,
         'company_owner_name' => $company_owner_name,
         'company_phone' => $company_phone,
         'company_address' => $company_address,
         'is_internal' => '0',
      );
    
    echo json_encode(array('message' => 'Error inserting product'));
      $update = $this->customerdata_model->insert($data);
      if ($update > 0) {
         $this->session->set_flashdata('message', 'Submission Success');
         redirect(base_url("manage/customer_data"));
      } else {
         $this->session->set_flashdata('error', 'Error inserting customer');
         redirect(base_url("manage/customer_data"));
      }
   }

   public function delete()
   {
      $company_id = $this->input->post('company_id');
      $data = array(
         'is_deleted' => '1'
      );


      $update = $this->customerdata_model->update($company_id, $data);
      // $update = $this->customerdata_model->delete($company_id);
      if ($update > 0) {
         $this->session->set_flashdata('message', 'Submission Success');
         redirect(base_url("manage/customer_data"));
      } else {
         $this->session->set_flashdata('error', 'Data tak terupdate / tidak ada data yang perlu di update');
         redirect(base_url("manage/customer_data"));
      }
   }

   public function edit()
   {
      $company_id = $this->input->post('company_id');
      $sales_area_id = $this->input->post("sales_area_id");
      $cluster_id = $this->input->post("cluster_id");
      $company_type_id = $this->input->post("company_type_id");
      $company_code = $this->input->post('company_code');
      $company_name = $this->input->post('company_name');
      $company_owner_name = $this->input->post('company_owner_name');
      $company_phone = $this->input->post('company_phone');
      $company_address = $this->input->post('company_address');
      $data = array(
         'company_type_id' => $company_type_id,
         'cluster_id' => $cluster_id,
         'sales_area_id' => $sales_area_id,
         'company_code' => $company_code,
         'company_name' => $company_name,
         'company_owner_name' => $company_owner_name,
         'company_phone' => $company_phone,
         'company_address' => $company_address,
         'is_internal' => '0',
         'company_type_id' => $company_type_id,

      );

     
      

      $update = $this->customerdata_model->update($company_id, $data);
      if ($update > 0) {
         $this->session->set_flashdata('message', 'Submission Success');
         redirect(base_url("manage/customer_data"));
      } else {
         $this->session->set_flashdata('error', 'Data tak terupdate / tidak ada data yang perlu di update');
         redirect(base_url("manage/customer_data"));
      }
   }
}
