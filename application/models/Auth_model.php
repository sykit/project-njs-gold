<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
  private $table = "auth";
  private $table_user = "user";

  public function authenticate($credential, $password){
      $query = "SELECT
               a.*,
               b.func_group_id,
               b.func_group_name
               FROM
               user a, functional_group b WHERE a.email = ?
               AND b.func_group_id = a.func_group_id
               AND a.password = sha1(?)
               ";
        return $this->db->query($query,
         array($credential, $password))->result_array();
  }

  public function emailexist($email){
        $query = "SELECT * FROM $this->table_user WHERE email =  " . $this->db->escape($email) . "LIMIT 1";
        return $this->db->query($query)->result_array();
  }

  function insert_user($data){
    $this->db->insert($this->table_user, $data);
    return  $this->db->affected_rows();
  }

  function insert($data)
  {
      $this->db->insert($this->table, $data);
      return  $this->db->affected_rows();
  }

  public function update($id, $data)
  {       
      $this->db->where('id_auth', $id);
      $this->db->update($this->table, $data);
      return  $this->db->affected_rows();
  }

  public function update_user($id_user, $data)
  {       
      $this->db->where('user_id', $id_user);
      $this->db->update($this->table, $data);
      return  $this->db->affected_rows();
  }

  public function delete($id){
   $this->db->delete($this->table, array("id" => $id));
   return  $this->db->affected_rows();
  }
}


?>