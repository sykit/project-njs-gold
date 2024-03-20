<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Productrate_model extends CI_Model
{
   private $table = "product_rate";

   function get()
   {
      return $this->db->order_by('prd_rate_id ', 'desc')->get($this->table)->result();
   }

   function getLast(){
      $q = "SELECT * FROM $this->table ORDER BY id DESC LIMIT 1";
      return $this->db->query($q)->result();
   }

   function getName($rate_id){
      $q = "SELECT * FROM $this->table WHERE id = $rate_id";
      return $this->db->query($q)->result();
   }

   function rateByProduct($product_class_id){
      $array = array();
      $data1 = $this->db->query('SELECT a.*, b.product_class_name, b.product_class_id FROM product_rate a, product_class b WHERE a.prd_rate_id = b.prd_rate_id AND b.product_class_id = ?', array($product_class_id))->result();
      $x = array(
         'prd_rate_id' => $data1[0]->prd_rate_id,
         'prd_rate_code'=>  $data1[0]->prd_rate_code,
      );
      
      array_push($array, $x);
      
      for($i = 2 ; $i <= 12 ; $i++){
         $data = $this->db->query("SELECT 
                                    b$i.prd_class_rate_id$i prd_rate_id,
                                    a$i.prd_rate_code prd_rate_code
                                    FROM
                                    product_rate a$i
                                    INNER JOIN 
                                    product_class_detail b$i
                                    ON a$i.prd_rate_id = 
                                    b$i.prd_class_rate_id$i
                                    AND b$i.product_class_id = ? 
                                    AND b$i.prd_class_rate_id$i IS NOT NULL", array($product_class_id))->result();
         
         if(isset($data[0]->prd_rate_id)){
            $y = array(
               'prd_rate_id' => $data[0]->prd_rate_id ?? '',
               'prd_rate_code'=>  $data[0]->prd_rate_code ?? '',
            );
   
            array_push($array, $y);
         }
      }
      
      return $array;
   }

   function insert($data)
   {
      $this->db->insert($this->table, $data);
      return $this->db->affected_rows();
   }

   public function update($id, $data)
   {
      $this->db->where('prd_rate_id', $id);
      $this->db->update($this->table, $data);
      return $this->db->affected_rows();
   }

   public function delete($id)
   {
      $this->db->delete($this->table, array("prd_rate_id" => $id));
      return $this->db->affected_rows();
   }
}