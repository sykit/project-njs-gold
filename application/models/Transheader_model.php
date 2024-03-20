<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Transheader_model extends CI_Model
{
   private $table = "trans_header";

   function get()
   {
      return $this->db->order_by('th_id ', 'desc')->get($this->table)->result();
   }

   function getLast(){
      $q = "SELECT * FROM $this->table ORDER BY id DESC LIMIT 1";
      return $this->db->query($q)->result();
   }

   function getTransHeaderByThCode($th_code){
      return $this->db->query('SELECT * FROM trans_header WHERE trans_code = ?', array($th_code))->result();
   }

   function getTransHeaderByThId($th_id){
      return $this->db->query('SELECT * FROM trans_header WHERE th_id = ? LIMIT 1', array($th_id))->result();
   }

   function getTransHeaderByActivityId($activity_id){
      return $this->db->query('SELECT * FROM trans_header WHERE activity_id = ?', array($activity_id))->result();
   }

   function insert($data)
   {
      $this->db->insert($this->table, $data);
      return $this->db->affected_rows();
   }

   public function update($id, $data)
   {
      $this->db->where('th_id', $id);
      $this->db->update($this->table, $data);
      return $this->db->affected_rows();
   }

   public function delete($id)
   {
      $this->db->delete($this->table, array("th_id" => $id));
      return $this->db->affected_rows();
   }
   function getTransHeaderDetailCompany($th_id)
  {
    $q = "SELECT a.*, b.*, c.* FROM trans_header a left join company b on a.trans_loc = b.company_id left join company_type c on a.trans_loc2 = c.company_type_id where th_id = '$th_id'";

    return $this->db->query($q)->result();
  }
}