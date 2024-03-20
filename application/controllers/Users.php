<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends MY_Controller
{
   public function __construct()
   {
      parent::__construct();
   }

   function get()
   {
      return $this->db->order_by('func_group_id', 'ASC')->get($this->table)->result();
   }

   public function add(){
      $surname = $this->input->post('surname');
      $username = $this->input->post('username');
      $email = $this->input->post('email');
      $func_group_id = $this->input->post('func_group_id');
      $company_id = $this->input->post('company_id');
      $password = $this->input->post('password');
      $cpassword = $this->input->post('confirm_password');
      $data = array(
         'surname' => $surname,
         'username' => $username,
         'email' => $email,
         'func_group_id' => $func_group_id,
         'company_id' => $company_id,
         'password' => sha1($company_id)
      );

      $cekEmail = $this->user_model->get_user_byidemail('',$email);
      if(!empty($cekEmail)){
         $this->session->set_flashdata('error', 'Email Sudah Terpakai');
         redirect(base_url("manage/users"));
      }

      if ($password != $cpassword) {
         $this->session->set_flashdata('error', 'Password tidak sama');
         redirect(base_url("manage/users"));
      } 
      
      $insert = $this->user_model->insert($data);
      if ($insert > 0) {
         $this->session->set_flashdata('message', 'Submission Success');
         redirect(base_url("manage/users"));
      } else {
         $this->session->set_flashdata('error', 'Data tak terupdate / tidak ada data yang perlu di update');
         redirect(base_url("manage/users"));
      }
   }

   public function edit(){
      $user_id = $this->input->post('user_id');
      $surname = $this->input->post('surname');
      $username = $this->input->post('username');
      $email = $this->input->post('email');
      $func_group_id = $this->input->post('func_group_id');
      $company_id = $this->input->post('company_id');
      $password = $this->input->post('password');
      $cpassword = $this->input->post('confirm_password');
      
      $cekEmail = $this->user_model->get_user_byidemail($user_id,$email);
      if(!empty($cekEmail)){
         $this->session->set_flashdata('error', 'Email Sudah Terpakai');
         redirect(base_url("manage/users"));
      }

      $data = array(
         'surname' => $surname,
         'username' => $username,
         'email' => $email,
         'func_group_id' => $func_group_id,
         'company_id' => $company_id
      );
      if (!empty($password) && $password != $cpassword) {
         $this->session->set_flashdata('error', 'Password tidak sama');
         redirect(base_url("manage/users"));
      } else {
         $data = array_merge($data, array('password' => sha1($password)));
      }

      $update = $this->user_model->update($user_id, $data);
      if ($update > 0) {
         $this->session->set_flashdata('message', 'Submission Success');
         redirect(base_url("manage/users"));
      } else {
         $this->session->set_flashdata('error', 'Data tak terupdate / tidak ada data yang perlu di update');
         redirect(base_url("manage/users"));
      }
   }

   public function delete(){
      $user_id = $this->input->post('user_id');
      $delete = $this->user_model->delete($user_id);
      if ($delete > 0) {
         $this->session->set_flashdata('message', 'Submission Success');
         redirect(base_url("manage/users"));
      } else {
         $this->session->set_flashdata('error', 'Data tak terupdate / tidak ada data yang perlu di update');
         redirect(base_url("manage/users"));
      }
   }
}
