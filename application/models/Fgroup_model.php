<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Fgroup_model extends CI_Model
{
   private $table = "functional_group";

   function get()
   {
      $q = "SELECT * FROM $this->table ORDER BY func_group_id ASC";
      return $this->db->query($q)->result();
   }

   function getLast(){
      $q = "SELECT * FROM $this->table ORDER BY func_group_id DESC LIMIT 1";
      return $this->db->query($q)->result();
   }

   function insert($data)
   {
      $this->db->insert($this->table, $data);
      return $this->db->affected_rows();
   }

   public function update($id, $data)
   {
      $this->db->where('func_group_id ', $id);
      $this->db->update($this->table, $data);
      return $this->db->affected_rows();
   }

   public function delete($id)
   {
      $this->db->delete($this->table, array("func_group_id " => $id));
      return $this->db->affected_rows();
   }
}