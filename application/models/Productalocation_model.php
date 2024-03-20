<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Productalocation_model extends CI_Model
{

  function get_all_nwom()
  {
    $q = "SELECT * FROM trans_header where activity_id = '14' order by trans_code  desc ";

    return $this->db->query($q)->result();
  }

  function get_detail_nwom($input)
  {
    $id = $input->get('nwom');

    $q = "SELECT a.*, b.*, c.* FROM trans_header a left join company b on a.trans_loc = b.company_id left join company_type c on a.trans_loc2 = c.company_type_id where th_id = '$id'";

    return $this->db->query($q)->result();
  }
  function getListOrder($input)
  {
    $id = $input->get('th_id');

    $q = "SELECT ROW_NUMBER() OVER(ORDER BY td_id) as `no`, a.*,b.product_category_name,c.prd_sub_cat_name,d.product_class_name,e.prd_rate_code,f.sepuh_code, g.size, h.size as size2, h.design  FROM trans_detail a 
    left join product_category b on a.product_category_id = b.product_category_id
    left join product_sub_category c on a.product_sub_category_id = c.prd_sub_cat_id
    left join product_class d on a.product_class_id = d.product_class_id
    left join product_rate e on e.prd_rate_id = a.rate_id
    left join sepuh f on a.sepuh_id = f.sepuh_id
    left join ring_size_reference g on a.size_id = g.ring_size_id
    left join bracelet_size_reference h on a.size_id = h.bracelet_size_id
    where th_id = '$id'";
    // print_r($this->db->query($q)->result());
    // die;
    return $this->db->query($q)->result();
  }



  function insert($data)
  {

 
    $th_id = $data->post('nwom');
    $td_id = $data->post('td_id');
    $n1 = $data->post('n1');
    $n2 = $data->post('n2');
    $trans_status_id = $data->post('trans_status_id');
    $trans_pic_detail = $this->input->post('trans_pic_detail');

    $catatan = $data->post('note');

    $code = "par";
    $activity_id = '17';

    $trans_code = strtoupper($code);

    $today_date =  date("m/d/Y");
    $trans_date = date('Y-m-d H:i:s');

    $new_trans_code = '';
    $new_activity_code = $code;

    $new_trans_date = $today_date;
    $new_trans_autoid = 1;


    $new_trans_code = strtoupper($new_activity_code . '-' . $new_trans_date . '-');

    $q = "SELECT * from trans_header where trans_code like '$new_trans_code%' order by trans_code desc ";
    $data_code =  $this->db->query($q)->result();
    if (!empty($data_code)) {
      $lastcode = explode("-", $data_code[0]->trans_code)[2];
      $new_trans_autoid = (int)$lastcode + 1;
    }
    $new_trans_code = $new_trans_code . $new_trans_autoid;
    $sql = "SELECT * from trans_header where th_id = '$th_id'";
    $data_th_lama =  $this->db->query($sql)->result();
    $sql2 = "SELECT * from workflow where activity_id = '$activity_id'";
    $workflow =  $this->db->query($sql2)->result();
    $data_th = array(
      'activity_id' => $activity_id,
      'trans_code' => $new_trans_code,
      'trans_date' => $trans_date,
      'trans_status_id' => 4,
      'trans_loc' => $data_th_lama[0]->trans_loc,
      'trans_loc2' => $data_th_lama[0]->trans_loc2,
      'ref_doc' => $th_id,
      'next_pic' => $workflow[0]->pic1,
      'notes' => $catatan,
    );

    $this->db->trans_start();
    $insert = $this->transheader_model->insert($data_th);
    $q = "SELECT * from trans_header where trans_code = '$new_trans_code'";
    $data_th_baru =  $this->db->query($q)->result();
    $th_id_baru = $data_th_baru[0]->th_id;

    for ($i = 0; $i < count($td_id); $i++) {
      $sql = "SELECT * from trans_detail where td_id = '$td_id[$i]'";
      $trans_detail =  $this->db->query($sql)->result();
      $data_td = array(
        'th_id' => $th_id_baru,
        'product_category_id' => $trans_detail[0]->product_category_id,
        'product_sub_category_id' => $trans_detail[0]->product_sub_category_id,
        'product_class_id' => $trans_detail[0]->product_class_id,
        'rate_id' => $trans_detail[0]->rate_id,
        'sepuh_id' => $trans_detail[0]->sepuh_id,
        'size_id' => $trans_detail[0]->size_id,
        'n1' => $n1[$i], // save qty on n2
        'n2' => $n2[$i], // save qty on n2
      );
      $insert_td = $this->transdetail_model->insert($data_td);

      // var_dump($data_td);
      // die;
    }
    $data_tp = array(
      'th_id' => $th_id_baru,
      'pic1' => $trans_pic_detail,
      'pic2' => '25'
    );

    $insert_tp = $this->transpicdetail_model->insert($data_tp);

    $this->db->trans_complete();

    if ($this->db->trans_status() === FALSE) {
      echo json_encode(array(
        'message' => 'failed'
      ));
    } else {
      echo json_encode(array(
        'message' => 'success'
      ));
    }
    return $this->db->affected_rows();
  }
  public function delete($id)
  {
    $this->db->delete($this->table, array("company_id " => $id));
    return $this->db->affected_rows();
  }
}
