<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Transactionstatus_model extends CI_Model
{
   private $table = "trans_status";

   function get()
   {
      return $this->db->order_by('trans_status_id', 'ASC')->get($this->table)->result();
   }

   function getAll(){
    $q = "SELECT * FROM $this->table ORDER BY trans_status_id ASC";
    return $this->db->query($q)->result();
   }

   function getLast(){
      $q = "SELECT * FROM $this->table ORDER BY trans_status_id DESC LIMIT 1";
      return $this->db->query($q)->result();
   }

   function getById($id){
    $q = "SELECT * FROM $this->table WHERE trans_status_id = ?";
    return $this->db->query($q, array($id))->result();
   }

   function insert($data)
   {
      $this->db->insert($this->table, $data);
      return $this->db->affected_rows();
   }

   public function update($id, $data)
   {
      $this->db->where('trans_status_id', $id);
      $this->db->update($this->table, $data);
      return $this->db->affected_rows();
   }

   public function delete($id)
   {
      $this->db->delete($this->table, array("trans_status_id" => $id));
      return $this->db->affected_rows();
   }
}