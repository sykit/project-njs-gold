<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Completepages extends MY_Controller
{
  public function __construct()
  {
    parent::__construct();
    $isLoggedIn = $this->session->userdata('authenticated');
    if (!$isLoggedIn) {
      redirect(base_url('auth'));
    }
  }

  public function complete()
  {
    $this->data['title'] = 'Selesai';
    $this->data['page_title'] = 'Selesai';
    $this->render('pages/scm/complete.php', $this->data);
  }
}
