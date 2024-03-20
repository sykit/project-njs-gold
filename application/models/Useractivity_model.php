<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Useractivity_model extends CI_Model
{
  private $table = "user_activity";
  private $table2 = "user";

  public function getAll(){
   $query = "SELECT a.*, b.* from $this->table as a LEFT JOIN $this->table2 as b ON a.account_id = b.id ORDER BY a.id DESC";
        return $this->db->query($query)->result();
  }

  function insert($data)
  {
      $this->db->insert($this->table, $data);
      return  $this->db->affected_rows();
  }

  public function update($id, $data)
  {       
      $this->db->where('id', $id);
      $this->db->update($this->table, $data);
      return  $this->db->affected_rows();
  }

  public function delete($id){
   $this->db->delete($this->table, array("id" => $id));
   return  $this->db->affected_rows();
  }
}


?>