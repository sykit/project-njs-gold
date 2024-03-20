<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends CI_Model
{
   private $table = "product_class";

   function get()
   {
      return $this->db->order_by('product_class_id', 'ASC')->get($this->table)->result();
   }

   function getLast(){
      $q = "SELECT * FROM $this->table ORDER BY product_class_id DESC LIMIT 1";
      return $this->db->query($q)->result();
   }

   function checkCategory($product_category_id){
      $q = "SELECT COUNT(product_category_id) as total FROM $this->table WHERE product_category_id = $product_category_id";
      return $this->db->query($q)->result();
   }

   function checkSubCategory($prd_sub_cat_id){
      $q = "SELECT COUNT(prd_sub_cat_id) as total FROM $this->table WHERE prd_sub_cat_id = $prd_sub_cat_id";
      return $this->db->query($q)->result();
   }

   function getSubcatByProduct($product_class_id){
      $q = "SELECT prd_sub_cat_id FROM `product_class` WHERE `product_class_id` = $product_class_id";
      return $this->db->query($q)->result();
   }

   function insert($data)
   {
      $this->db->insert($this->table, $data);
      return $this->db->affected_rows();
   }

   public function update($id, $data)
   {
      $this->db->where('product_class_id', $id);
      $this->db->update($this->table, $data);
      return $this->db->affected_rows();
   }

   public function getDetailRateWidth($product_id){
      $q = "SELECT a.product_class_id, a.product_class_name, a.prd_rate_id, b.prd_class_detail_id, b.prd_class_rate_id2, b.prd_class_rate_id3, b.prd_class_rate_id4, b.prd_class_rate_id5, b.prd_class_rate_id6, b.prd_class_rate_id7, b.prd_class_rate_id8, b.prd_class_rate_id9, b.prd_class_rate_id10, b.prd_class_rate_id11, b.prd_class_rate_id12 FROM product_class a LEFT JOIN product_class_detail b ON a.product_class_id = b.product_class_id 
      WHERE a.product_class_id = $product_id";
   }

   public function delete($id)
   {
      $this->db->delete($this->table, array("product_class_id " => $id));
      return $this->db->affected_rows();
   }
}