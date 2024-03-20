<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Transpicdetail_model extends CI_Model
{
   private $table = "trans_pic_detail";

   function get()
   {
      return $this->db->order_by('trans_pic_id ', 'desc')->get($this->table)->result();
   }

   function getLast(){
      $q = "SELECT * FROM $this->table ORDER BY id DESC LIMIT 1";
      return $this->db->query($q)->result();
   }

   function getTranspicByThCode($th_code){
      return $this->db->query('SELECT b.* FROM trans_header a, trans_pic_detail b WHERE b.th_id = a.th_id AND a.trans_code = ?', array($th_code))->result();
   }

   function getTranspicByThId($th_id){
      return $this->db->query('SELECT b.* FROM trans_header a, trans_pic_detail b WHERE b.th_id = a.th_id AND a.th_id = ?', array($th_id))->result();
   }

   function picNameByThCode($th_code){
      return $this->db->query('SELECT b.*, c.user_id, c.surname FROM trans_header a, trans_pic_detail b, user c WHERE b.th_id = a.th_id AND c.user_id = b.pic1 AND a.trans_code = ?', array($th_code))->result();
   }

   function insert($data)
   {
      $this->db->insert($this->table, $data);
      return $this->db->affected_rows();
   }

   public function update($id, $data)
   {
      $this->db->where('trans_pic_id', $id);
      $this->db->update($this->table, $data);
      return $this->db->affected_rows();
   }

   public function delete($id)
   {
      $this->db->delete($this->table, array("trans_pic_id" => $id));
      return $this->db->affected_rows();
   }
}