<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Braceletsize_model extends CI_Model
{
   private $table = "bracelet_size_reference";

   function get()
   {
      return $this->db->order_by('bracelet_size_id ', 'desc')->get($this->table)->result();
   }
   
   function insert($data)
   {
      $this->db->insert($this->table, $data);
      return $this->db->affected_rows();
   }

   public function update($id, $data)
   {
      $this->db->where('bracelet_size_id ', $id);
      $this->db->update($this->table, $data);
      return $this->db->affected_rows();
   }

   public function delete($id)
   {
      $this->db->delete($this->table, array("bracelet_size_id" => $id));
      return $this->db->affected_rows();
   }
}