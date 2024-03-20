<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Category_model extends CI_Model
{
   private $table = "product_category";

   function get()
   {
      return $this->db->order_by('product_category_name', 'ASC')->get($this->table)->result();
   }

   function getLast(){
      $q = "SELECT * FROM $this->table ORDER BY product_category_id DESC LIMIT 1";
      return $this->db->query($q)->result();
   }

   function getByAlphabetical(){
      $q = "SELECT * FROM $this->table ORDER BY product_category_name ASC";
      return $this->db->query($q)->result();
   }

   function insert($data)
   {
      $this->db->insert($this->table, $data);
      return $this->db->affected_rows();
   }

   public function update($id, $data)
   {
      $this->db->where('product_category_id ', $id);
      $this->db->update($this->table, $data);
      return $this->db->affected_rows();
   }

   public function delete($id)
   {
      $this->db->delete($this->table, array("product_category_id " => $id));
      return $this->db->affected_rows();
   }
}