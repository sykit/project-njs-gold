<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Customerdata_model extends CI_Model
{
  private $table = "company";


  function get_company_type()
  {
    $q = "SELECT * FROM company_type where is_internal = '0'";
    return $this->db->query($q)->result();
  }
  function get_customer($data)
  {
    $sales_area_id = $this->input->GET("sales_area_id");
    $cluster_id = $this->input->GET("cluster_id");
    $company_type_id = $this->input->GET("company_type_id");

    $param = "";
    if($sales_area_id != 'x'){
      $param = $param." and a.sales_area_id = '".$sales_area_id."'";
    }
    if($cluster_id != 'x'){
      $param = $param." and a.cluster_id = '".$cluster_id."'";
    }
    if($company_type_id != 'x'){
      $param = $param." and a.company_type_id = '".$company_type_id."'";
    }

    $q = "SELECT a.*,b.company_type_name, c.cluster_name, d.sales_area_name, ROW_NUMBER() OVER(ORDER BY company_id) as `no` FROM company a left join company_type b on a.company_type_id = b.company_type_id left join cluster c on a.cluster_id = c.cluster_id left join sales_area d on a.sales_area_id = d.sales_area_id where a.is_internal ='0' and a.is_deleted = '0' $param";
    return $this->db->query($q)->result();
  }
  function get_all_customer()
  {
    $q = "SELECT a.*,b.company_type_name, c.cluster_name, d.sales_area_name, ROW_NUMBER() OVER(ORDER BY company_id) as `no` FROM company a left join company_type b on a.company_type_id = b.company_type_id left join cluster c on a.cluster_id = c.cluster_id left join sales_area d on a.sales_area_id = d.sales_area_id where a.is_internal ='0' and a.is_deleted = '0'";
    return $this->db->query($q)->result();
  }

  function get_all_customer_internal()
  {
    $q = "SELECT a.*,b.cluster_name FROM company a left join cluster b on a.cluster_id = b.cluster_id where a.is_internal ='1' ";
    return $this->db->query($q)->result();
  }

  function get_all_cluster()
  {
    $q = "SELECT * FROM cluster";
    return $this->db->query($q)->result();
  }
  function get_all_sales_area()
  {
    $q = "SELECT * FROM sales_area";
    return $this->db->query($q)->result();
  }

  function get_cluster_by_id($id)
  {
    $q = "SELECT * FROM cluster where cluster_id = '$id'";
    return $this->db->query($q)->result();
  }
  function get_cluster_by_sales_area($id)
  {
    $q = "SELECT * FROM cluster where sales_area_id = '$id'";
    return $this->db->query($q)->result();
  }

  
  public function update($id, $data)
  {
    $this->db->where('company_id', $id);
    $this->db->update($this->table, $data);
    return  $this->db->affected_rows();
  }
  function get_customer_byid($input)
  {
    $id = $input->get('company_id');
    $q = "SELECT * FROM company  where company_id= '$id' ";
    return $this->db->query($q)->result();
  }
  function insert($data)
   {
      $this->db->insert($this->table, $data);
      return $this->db->affected_rows();
   }
   public function delete($id)
   {
      $this->db->delete($this->table, array("company_id " => $id));
      return $this->db->affected_rows();
   }
}
