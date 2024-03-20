<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
  private $table = "user";

  public function get()
  {
    $query = "SELECT $this->table  ORDER BY a.user_id DESC";
    return $this->db->query($query)->result();
  }

  public function get_auth_user($id_user)
  {
    $query = "SELECT a.*
              FROM 
              user a 
              WHERE 
              a.user_id = $id_user 
              ORDER BY a.user_id
              DESC LIMIT 1";
    return $this->db->query($query)->result();
  }

  function get_all_user()
  {
    $q = "SELECT a.*,b.func_group_name as jabatan FROM user a left join functional_group b on a.func_group_id = b.func_group_id where a.func_group_id !='1' ORDER BY user_id DESC";
    return $this->db->query($q)->result();
  }

  function get_user_type($type, $id_user_ref)
  {
    $q = "SELECT * FROM user WHERE usertype = '$type' AND id_user_ref = $id_user_ref ORDER BY id_user desc";
    return $this->db->query($q)->result();
  }

  function get_user_byid($input)
  {
    $id = $input->get('user_id');
    $q = "SELECT a.*,b.func_group_name as jabatan FROM user a left join functional_group b on a.func_group_id = b.func_group_id where user_id = '$id' ";
    return $this->db->query($q)->result();
  }

  function get_user_byidemail($id, $email)
  {
    if (empty($id)) {
      $q = "SELECT a.*,b.func_group_name as jabatan FROM user a left join functional_group b on a.func_group_id = b.func_group_id where email = '$email' ";
    } else {
      $q = "SELECT a.*,b.func_group_name as jabatan FROM user a left join functional_group b on a.func_group_id = b.func_group_id where user_id != '$id' and email = '$email' ";

    }
    return $this->db->query($q)->result();
  }

  function get_fg_byemail($email)
  {
    $q = "SELECT a.user_id,
            a.company_id,
            a.surname,
            a.email,
            a.func_group_id,
            b.func_group_id,
            b.func_group_name
            FROM user a, functional_group b
            WHERE a.func_group_id = b.func_group_id
            AND a.email ='$email'";
    return $this->db->query($q)->result();
  }

  function check_device($api_key)
  {
    $q = "SELECT * FROM user WHERE sn_product = '$api_key'";
    return $this->db->query($q)->result();
  }

  function insert($data)
  {
    $this->db->insert($this->table, $data);
    return  $this->db->affected_rows();
  }

  public function update($id, $data)
  {
    $this->db->where('user_id', $id);
    $this->db->update($this->table, $data);
    return  $this->db->affected_rows();
  }

  public function delete($id)
  {
    // $q = "update user set flag_del = 1 where user_id = '$id'";
    // $this->db->query($q);
      $this->db->delete($this->table, array("user_id" => $id));
    return  $this->db->affected_rows();
  }
  function get_jabatan()
  {
     $q = "SELECT * FROM functional_group where func_group_id != '1' ORDER BY func_group_id ASC";
     return $this->db->query($q)->result();
  }
}
