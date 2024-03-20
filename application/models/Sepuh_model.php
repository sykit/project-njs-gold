<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Sepuh_model extends CI_Model
{
   private $table = "sepuh";

   function get()
   {
      return $this->db->order_by('sepuh_id', 'desc')->get($this->table)->result();
   }

   function sepuhByProduct($product_class_id){
      return $this->db->query('SELECT a.* FROM sepuh a, product_class b WHERE a.sepuh_id = b.sepuh_id')->result();
   }
   
   function insert($data)
   {
      $this->db->insert($this->table, $data);
      return $this->db->affected_rows();
   }

   public function update($id, $data)
   {
      $this->db->where('prd_sub_cat_id', $id);
      $this->db->update($this->table, $data);
      return $this->db->affected_rows();
   }

   public function delete($id)
   {
      $this->db->delete($this->table, array("sepuh_id" => $id));
      return $this->db->affected_rows();
   }
}