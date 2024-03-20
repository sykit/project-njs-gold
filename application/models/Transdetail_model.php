<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Transdetail_model extends CI_Model
{
   private $table = "trans_detail";

   function get()
   {
      return $this->db->order_by('td_id ', 'desc')->get($this->table)->result();
   }

   function getLast(){
      $q = "SELECT * FROM $this->table ORDER BY id DESC LIMIT 1";
      return $this->db->query($q)->result();
   }

   function getTransDetailByCode($th_code){
      return $this->db->query('SELECT b.*,
      b.notes as td_notes,
      c.*,
      d.*,
      e.*,
      f.*,
      g.*,
      h.ring_size_id,
      h.size as ring_size,
      i.bracelet_size_id,
      i.design as bracelet_design,
      i.size as bracelet_size
      FROM 
      trans_header a, 
      trans_detail b
      LEFT JOIN product_class c ON b.product_class_id = c.product_class_id
      LEFT JOIN product_category d ON b.product_category_id = d.product_category_id
      LEFT JOIN product_sub_category e ON b.product_sub_category_id = e.prd_sub_cat_id
      LEFT JOIN product_rate f ON b.rate_id = f.prd_rate_id
      LEFT JOIN sepuh g ON b.sepuh_id = g.sepuh_id
      LEFT JOIN ring_size_reference h ON b.size_id = h.ring_size_id
      LEFT JOIN bracelet_size_reference i ON b.size_id = i.bracelet_size_id
      WHERE b.th_id = a.th_id 
      AND a.trans_code = ?', array($th_code))->result();
   }

   function getTransDetailByThId($th_id){
      return $this->db->query('SELECT b.*,
      b.notes as td_notes,
      c.*,
      d.*,
      e.*,
      f.*,
      g.*,
      h.ring_size_id,
      h.size as ring_size,
      i.bracelet_size_id,
      i.design as bracelet_design,
      i.size as bracelet_size
      FROM 
      trans_header a, 
      trans_detail b
      LEFT JOIN product_class c ON b.product_class_id = c.product_class_id
      LEFT JOIN product_category d ON b.product_category_id = d.product_category_id
      LEFT JOIN product_sub_category e ON b.product_sub_category_id = e.prd_sub_cat_id
      LEFT JOIN product_rate f ON b.rate_id = f.prd_rate_id
      LEFT JOIN sepuh g ON b.sepuh_id = g.sepuh_id
      LEFT JOIN ring_size_reference h ON b.size_id = h.ring_size_id
      LEFT JOIN bracelet_size_reference i ON b.size_id = i.bracelet_size_id
      WHERE b.th_id = a.th_id 
      AND a.th_id = ?', array($th_id))->result();
   }

   function insert($data)
   {
      $this->db->insert($this->table, $data);
      return $this->db->affected_rows();
   }

   public function update($id, $data)
   {
      $this->db->where('td_id', $id);
      $this->db->update($this->table, $data);
      return $this->db->affected_rows();
   }

   public function delete($id)
   {
      $this->db->delete($this->table, array("td_id" => $id));
      return $this->db->affected_rows();
   }
   function getTotalWeightByThId($id){
      $q = "SELECT sum(n2)as total_berat FROM $this->table where th_id = '$id'";
      return $this->db->query($q)->result();
   }
}