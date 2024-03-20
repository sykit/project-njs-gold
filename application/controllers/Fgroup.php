<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fgroup extends CI_Controller {
   public function __construct()
	{
      parent::__construct();
	}

   function get()
   {
      return $this->db->order_by('func_group_id', 'ASC')->get($this->table)->result();
   }

	public function add(){
      $category_name = $this->input->post('func_group_name');
      $submisson = array(
         'func_group_name' => $category_name,
         'created_at' => date('Y-m-d H:i:s', now()));
      $insert = $this->db->insert('functional_group', $submisson);
      if ($insert > 0) {
         $this->session->set_flashdata('message', 'Submission Success');
         redirect(base_url("manage/fgroup"));
      } else {
         $this->session->set_flashdata('error', 'Data tak terupdate / tidak ada data yang perlu di update');
         redirect(base_url("manage/fgroup"));
      }
    }

   public function edit(){
      $fgid = $this->input->post('func_group_id');
      $fgname = $this->input->post('func_group_name');
      $data = array(
         'func_group_name' => $fgname
      );

      $update = $this->fgroup_model->update($fgid, $data);
      if ($update > 0) {
         $this->session->set_flashdata('message', 'Submission Success');
         redirect(base_url("manage/fgroup"));
      } else {
         $this->session->set_flashdata('error', 'Data tak terupdate / tidak ada data yang perlu di update');
         redirect(base_url("manage/fgroup"));
      }
   }

   public function delete(){
      $fgid = $this->input->post('func_group_id');
      $delete = $this->fgroup_model->delete($fgid);
      if ($delete > 0) {
         $this->session->set_flashdata('message', 'Submission Success');
         redirect(base_url("manage/fgroup"));
      } else {
         $this->session->set_flashdata('error', 'Data tak terupdate / tidak ada data yang perlu di update');
         redirect(base_url("manage/fgroup"));
      }
   }
}