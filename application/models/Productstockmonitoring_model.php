<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Productstockmonitoring_model extends CI_Model
{
  private $table = "company";



  function get_all_product_stock()
  {
    $q = "SELECT a.*, b.product_category_name,c.prd_sub_cat_name,d.prd_rate_code,e.sepuh_code,count(a.jewelry_id) as jumlah ,round(sum(a.jewelry_weight),2) as jewelry_weight
    from jewelry_resources a,
         product_category b,
         product_sub_category c,
         product_rate d,
         sepuh e,
         product_class h
    where a.product_category_id=b.product_category_id
      and a.prd_sub_cat_id=c.prd_sub_cat_id
      and a.prd_rate_id=d.prd_rate_id
      and a.sepuh_id=e.sepuh_id
      and a.resource_status=1
      and a.resource_location=1
      and a.packaging_id is not NULL
      and a.product_class_id=h.product_class_id
      group by b.product_category_name,c.prd_sub_cat_name,d.prd_rate_code,e.sepuh_code
      order by b.product_category_name,c.prd_sub_cat_name ASC";
    return $this->db->query($q)->result();
  }
  function get_product_stock($input)
  {
    $product_category_id = $input->get('product_category_id');
    $prd_sub_cat_id = $input->get('prd_sub_cat_id');

    $param = "";
    if ($product_category_id != 'x') {
      $param = $param . " a.product_category_id = '" . $product_category_id . "' and";

      if ($prd_sub_cat_id != 'x') {
        $param = $param . "  a.prd_sub_cat_id = '" . $prd_sub_cat_id . "' and";
      }
    }



    $q = "SELECT a.*, b.product_category_name,c.prd_sub_cat_name,d.prd_rate_code,e.sepuh_code,count(a.jewelry_id) as jumlah,round(sum(a.jewelry_weight),2) as jewelry_weight
        from jewelry_resources a,
            product_category b,
            product_sub_category c,
            product_rate d,
            sepuh e,
            product_class h
        where $param
           a.product_category_id=b.product_category_id
          and a.prd_sub_cat_id=c.prd_sub_cat_id
          and a.prd_rate_id=d.prd_rate_id
          and a.sepuh_id=e.sepuh_id
          and a.resource_status=1
          and a.resource_location=1
          and a.packaging_id is not NULL
          and a.product_class_id=h.product_class_id
          group by b.product_category_name,c.prd_sub_cat_name,d.prd_rate_code,e.sepuh_code
          order by b.product_category_name,c.prd_sub_cat_name ASC";
    return $this->db->query($q)->result();
  }
  function get_detail_product_stock($input)
  {
    $product_category_id = $input->get('product_category_id');
    $prd_sub_cat_id = $input->get('prd_sub_cat_id');
    if (empty($product_category_id) || empty($prd_sub_cat_id)) {
      return [];
    }

    $q = "SELECT c.prd_sub_cat_name,h.product_class_code,d.prd_rate_code,e.sepuh_code,count(a.jewelry_id) as jumlah,round(sum(a.jewelry_weight),2) as jewelry_weight
    from jewelry_resources a,
         product_category b,
         product_sub_category c,
         product_rate d,
         sepuh e,
         product_class h
    where a.product_category_id='$product_category_id'
      and a.prd_sub_cat_id='$prd_sub_cat_id'
      and a.product_category_id=b.product_category_id
      and a.prd_sub_cat_id=c.prd_sub_cat_id
      and a.prd_rate_id=d.prd_rate_id
      and a.sepuh_id=e.sepuh_id
      and a.resource_status=1
      and a.resource_location=1
      and a.packaging_id is not NULL
      and a.product_class_id=h.product_class_id
      group by c.prd_sub_cat_name,h.product_class_code,d.prd_rate_code,e.sepuh_code
      order by c.prd_sub_cat_name,h.product_class_code ASC";
    return $this->db->query($q)->result();
  }


  function get_sub_category($id)
  {
    if ($id == 'x') {
      return [];
    }
    $q = "SELECT * FROM product_sub_category where product_category_id = $id";
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
