<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Productdetail_model extends CI_Model
{
   private $table = "product_class_detail";

   function get()
   {
      return $this->db->order_by('prd_class_detail_id ', 'ASC')->get($this->table)->result();
   }

   function getLast(){
      $q = "SELECT * FROM $this->table ORDER BY prd_class_detail_id DESC LIMIT 1";
      return $this->db->query($q)->result();
   }

   function insert($data)
   {
      $this->db->insert($this->table, $data);
      return $this->db->affected_rows();
   }

   public function update($id, $data)
   {
      $this->db->where('prd_class_detail_id', $id);
      $this->db->update($this->table, $data);
      return $this->db->affected_rows();
   } 

   public function updateByProduct($id, $data){
      $this->db->where('product_class_id', $id);
      $this->db->update($this->table, $data);
      return $this->db->affected_rows();
   }

   public function productIdByCode($product_class_name){
      $q1 = $this->db->query('SELECT a.product_class_id, a.product_class_name, b.product_category_id, b.product_category_name, c.prd_sub_cat_id, c.prd_sub_cat_name 
      FROM product_class a, product_category b, product_sub_category c 
      WHERE a.product_category_id = b.product_category_id 
      AND a.prd_sub_cat_id = c.prd_sub_cat_id 
      AND product_class_name = ?', array($product_class_name))->result();
      return $q1;
   }

   public function productSepuhByCode($product_class_name, $sepuh_code){
      /* 
      * get sepuh id
      */

      $q2 = "SELECT sepuh_id, sepuh_code, sepuh_name FROM sepuh WHERE sepuh_code = '$sepuh_code'";
      $result2 = $this->db->query($q2, array($sepuh_code))->result();

      if(sizeof($result2) == 0){
         return array('message', 0);
      }else{
         $sepuh_id = $result2[0]->sepuh_id;
         $q1 = "SELECT 
               b.*
               FROM
               product_class a,
               sepuh b 
               WHERE a.sepuh_id = b.sepuh_id
               AND b.sepuh_code = '$sepuh_code'
               AND a.product_class_name = '$product_class_name'";
               
         return $this->db->query($q1, array($product_class_name, $sepuh_id))->result();
      }
   }

   public function productRateByCode($product_class_name, $product_rate_code){
      $q1 = "SELECT
               b.prd_rate_id,
               b.prd_rate_code,
               b.prd_rate_name
            FROM product_class a,
               product_rate b 
            WHERE b.prd_rate_id = a.prd_rate_id
            AND a.product_class_name = '$product_class_name'
            AND b.prd_rate_code = '$product_rate_code'";
      $result1 =  $this->db->query($q1)->result();

      if(sizeof($result1) > 0){
         return $result1;
      }else{

            $qx = "SELECT prd_rate_id, prd_rate_code, prd_rate_name FROM product_rate WHERE prd_rate_code = '$product_rate_code'";
            $resultx = $this->db->query($qx)->result();
            $rate_idx = $resultx[0]->prd_rate_id;
            $rate_namex = $resultx[0]->prd_rate_name;
            $rate_codex = $resultx[0]->prd_rate_code;

            $q2 = "SELECT a.prd_class_rate_id2, 
                     a.prd_class_rate_id3,
                     a.prd_class_rate_id4,
                     a.prd_class_rate_id5,
                     a.prd_class_rate_id6,
                     a.prd_class_rate_id7,
                     a.prd_class_rate_id8,
                     a.prd_class_rate_id9,
                     a.prd_class_rate_id10,
                     a.prd_class_rate_id11,
                     a.prd_class_rate_id12
                  FROM product_class_detail a,
                  product_class b
                  WHERE b.product_class_id = a.product_class_id
                  AND b.product_class_name = '$product_class_name'";
            $result2 = $this->db->query($q2)->result();
   
            $array_result = array($result2[0]->prd_class_rate_id2, 
                           $result2[0]->prd_class_rate_id3, 
                           $result2[0]->prd_class_rate_id4, 
                           $result2[0]->prd_class_rate_id5, 
                           $result2[0]->prd_class_rate_id6, 
                           $result2[0]->prd_class_rate_id7, 
                           $result2[0]->prd_class_rate_id8, 
                           $result2[0]->prd_class_rate_id9, 
                           $result2[0]->prd_class_rate_id10, 
                           $result2[0]->prd_class_rate_id11, 
                           $result2[0]->prd_class_rate_id12);
            $is_inarray = in_array($rate_idx, $array_result);
            if($is_inarray){
               $av_result = array('prd_rate_id' => $rate_idx, 'prd_rate_code' => $rate_codex, 'prd_rate_name' => $rate_namex);
               $av_result_arr = array($av_result);
               return $av_result_arr;
            }else{
               $no_result = array();
               return $no_result;
            }
      }
   }

   public function productBraceletSizeByCode($product_class_name, $bracklet_size, $bracklet_design){
      /**
       * Logic and step
       * Dapatkan bracelet size id
       * Check apakah id bracklet terdaftar di product class detail
       */

       $q1 = "SELECT 
               a.product_class_id,
               a.product_class_name,
               a.product_class_code,
               b.bracelet_size_id,
               a.product_category_id,
               c.bracelet_size_id,
               c.design,
               c.size
               FROM
               product_class a,
               product_class_detail b,
               bracelet_size_reference c
               WHERE a.product_class_id = b.product_class_id
               AND c.bracelet_size_id = b.bracelet_size_id
               AND product_category_id = 3
               AND product_class_name = '$product_class_name'
               AND c.design = '$bracklet_design'
               AND c.size = $bracklet_size";

               $result = $this->db->query($q1)->result();
               return $result;
   }

   public function productSizeByCode($product_class_name, $ringsize){
      /**s
       * Logic and step
       * 1. Dapatkan ring size id
       * 2. Dapatkan product class id dari code
       * 3. Check index of ring size id dari product class code
       * 
       * empty response message = 0 <-- data not available
       * available response message = 1 <-- data available
      */ 

      $q1 = "SELECT
            a.ring_size_id,
            a.size,
            a.lingkar,
            a.diameter
            FROM
            ring_size_reference a WHERE a.size = ?";
      $result1 = $this->db->query($q1, array($ringsize))->result();

      if(sizeof($result1)){
         $sizeFromSheet = $result1[0]->ring_size_id;
         if($sizeFromSheet != null || $sizeFromSheet != 0 || $sizeFromSheet != ''){
            $q3 = "SELECT product_class_id, product_class_name from product_class WHERE product_class_name = ? ";
            $result3 = $this->db->query($q3, array($product_class_name))->result();
            
            $productClassIdSheet = $result3[0]->product_class_id;
   
            if($productClassIdSheet != null || $sizeFromSheet != 0 || $sizeFromSheet != ''){
               $q2 = "SELECT
                     a.ring_size_id1,
                     a.ring_size_id2,
                     a.ring_size_id3,
                     a.ring_size_id4,
                     a.ring_size_id5,
                     a.ring_size_id6,
                     a.ring_size_id7,
                     a.ring_size_id8,
                     a.ring_size_id9,
                     a.ring_size_id10,
                     a.ring_size_id11,
                     a.ring_size_id12
                     FROM
                     product_class_detail a,
                     product_class b
                     WHERE
                     a.product_class_id = b.product_class_id
                     AND a.product_class_id = ?";
         
               $result2 = $this->db->query($q2, array($productClassIdSheet))->result();

                  $data_ring = array(
                        $result2[0]->ring_size_id1, 
                        $result2[0]->ring_size_id2,
                        $result2[0]->ring_size_id3, 
                        $result2[0]->ring_size_id4,
                        $result2[0]->ring_size_id5, 
                        $result2[0]->ring_size_id6,
                        $result2[0]->ring_size_id7, 
                        $result2[0]->ring_size_id8,
                        $result2[0]->ring_size_id9, 
                        $result2[0]->ring_size_id10,
                        $result2[0]->ring_size_id11, 
                        $result2[0]->ring_size_id12);
                  
                  $isAvailable = in_array($sizeFromSheet, $data_ring);
                  if($isAvailable == true){
                     $response = array(array('message' => 1, 'ring_size_id' => $sizeFromSheet, 'ring_size_name' => $result1[0]->size));
                  }else{
                     $response = array(array('message' => 0));
                  }

                  return $response;
            }
         }else{
            return array();
         }
      }else{
         return array();
      }
   }

   public function productBentukByCode($product_class_name, $bentuk_id){
      $q1 = "";
   }

   public function productValidationByModel($product_class_name, $kode_sepuh, $kadar, $ukuran=null, $bentuk=null){
      $q1 = $this->db->query('SELECT * FROM product_class WHERE product_class_name = ? ', array($product_class_name))->result();
      if(sizeof($q1) > 0){
         $product_class_id = $q1[0]->product_class_id;
         $q2 = $this->db->query('SELECT * FROM * product_class_detail WHERE product_class_id = ? ', array($product_class_id))->result();
      }
   }

   public function delete($id)
   {
      $this->db->delete($this->table, array("prd_class_detail_id" => $id));
      return $this->db->affected_rows();
   }
}