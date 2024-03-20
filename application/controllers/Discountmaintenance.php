<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Discountmaintenance extends MY_Controller
{
   public function __construct()
   {
      parent::__construct();
   }

   function get()
   {
      return $this->db->order_by('func_group_id', 'ASC')->get($this->table)->result();
   }

   
   public function edit()
   {
      $company_id = $this->input->post('company_id');
      $discount = $this->input->post('discount');
      $data = array(
         'discount' => $discount,

      );
      // print_r($data);
      // die;
      $update = $this->discount_model->update($company_id, $data);
      // $this->session->set_flashdata('message', 'Submission Success');
      //    redirect(base_url("manage/discount_maintenance"));
      if ($update > 0) {
         $this->session->set_flashdata('message', 'Submission Success');
         redirect(base_url("manage/discount_maintenance"));
      } else {
         $this->session->set_flashdata('error', 'Data tak terupdate / tidak ada data yang perlu di update');
         redirect(base_url("manage/discount_maintenance"));
      }
   }
}
