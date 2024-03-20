<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Subcategory_model extends CI_Model
{
   private $table = "product_sub_category";
   private $table_category = "product_category";

   function get()
   {
      return $this->db->order_by('prd_sub_cat_id  ', 'desc')->get($this->table)->result();
   }

   function getWithCategory(){
      $q = "SELECT a.*, b.*, a.image as sub_image FROM product_sub_category a, product_category b WHERE a.product_category_id = b.product_category_id ORDER BY a.prd_sub_cat_name ASC";
      return $this->db->query($q)->result();
   }

   function getLast(){
      $q = "SELECT * FROM $this->table ORDER BY prd_sub_cat_id DESC LIMIT 1";
      return $this->db->query($q)->result();
   }

   function getBasedCategory($product_category_id){
      $q = "SELECT * FROM $this->table WHERE product_category_id = $product_category_id";
      return $this->db->query($q)->result();
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
      $this->db->delete($this->table, array("prd_sub_cat_id" => $id));
      return $this->db->affected_rows();
   }
}