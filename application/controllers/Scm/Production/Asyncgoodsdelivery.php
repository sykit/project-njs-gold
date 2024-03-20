<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Asyncgoodsdelivery extends MY_Controller
{
  public function __construct()
  {
    parent::__construct();
    $isLoggedIn = $this->session->userdata('authenticated');
    if (!$isLoggedIn) {
      redirect(base_url('auth'));
    }
  }

  public function goods_delivery()
  {
    $this->data['title'] = 'Pengiriman Hasil Produksi';
    $this->data['page_title'] = 'Pengiriman Hasil Produksi';

    $this->data['trans_loc'] = $this->company_model->getUserMapCompany($this->session->userdata('user_id'));
    $this->data['trans_status'] = $this->transactionstatus_model->getAll();
    $this->data['trans_spop'] = $this->transheader_model->getTransHeaderByActivityId(14); // activity_id 14 = Surat Permintaan Order Produksi
    $this->data['workflow'] = $this->workflow_model->getAll();

    $this->render('pages/scm/production/goods_delivery.php', $this->data);
  }

  public function save_handler()
  {
    $trans_date = date('Y-m-d H:i:s');
    $trans_detail = $this->input->post('trans_detail');
    $trans_pic_detail = $this->input->post('trans_pic_detail');

    $data_th = array(
      'activity_id' => 15,
      'trans_code' => $this->input->post('trans_code'),
      'trans_date' => $trans_date,
      'trans_status_id' => $this->input->post('trans_status_id'),
      'trans_loc' => $this->input->post('trans_loc'),
      'trans_loc2' => $this->input->post('trans_loc2'),
      'ref_doc' => $this->input->post('ref_doc'),
      'next_pic' => $this->input->post('next_pic'),
      'next_loc' => $this->input->post('next_loc'),
      'notes' => $this->input->post('notes'),
    );

    $this->db->trans_start();
    $insert = $this->transheader_model->insert($data_th);

    $lastId = $this->db->insert_id();

    foreach ($trans_detail as $item) {
      $data_td = array(
        'th_id' => $lastId,
        'product_category_id' => empty($item['product_category_id']) ? NULL : number_format($item['product_category_id']),
        'product_sub_category_id' => empty($item['product_sub_category_id']) ? NULL : number_format($item['product_sub_category_id']),
        'product_class_id' => empty($item['product_class_id']) ? NULL : number_format($item['product_class_id']),
        'rate_id' => empty($item['rate_id']) ? NULL : number_format($item['rate_id']),
        'sepuh_id' => empty($item['sepuh_id']) ? NULL : number_format($item['sepuh_id']),
        'size_id' => empty($item['size_id']) ? NULL : number_format($item['size_id']),
        'bentuk_id' => empty($item['bentuk_id']) ? NULL : number_format($item['bentuk_id']),
        'n1' => $item['n1'],
        'n2' => $item['n2'],
        'n3' => $item['n3'],
        'notes' => empty($item['notes']) ? NULL : $item['notes']
      );

      $insert_td = $this->transdetail_model->insert($data_td);
    }

    $data_tp = array(
      'th_id' => $lastId,
      'pic1' => $trans_pic_detail['pic1'],
      'pic2' => $trans_pic_detail['pic2'],
    );
    $insert_tp = $this->transpicdetail_model->insert($data_tp);

    $this->db->trans_complete();

    if ($this->db->trans_status() === FALSE) {
      echo json_encode(array(
        'message' => 'failed'
      ));
    } else {
      $th_header_data = $this->transheader_model->getTransHeaderByThId($lastId); 

      echo json_encode(array(
        'message' => 'success',
        'trans_header' => $th_header_data[0]
      ));
    }
  }

  function send_handler() {
    $data_th = array(
      'trans_status_id' => $this->input->post('trans_status_id')
    );

    $insert = $this->transheader_model->update($this->input->post('th_id'), $data_th);
    echo json_encode(array(
      'message' => 'success'
    ));
  }
}
