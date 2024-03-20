<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inprocesspages extends MY_Controller
{
  public function __construct()
  {
    parent::__construct();
    $isLoggedIn = $this->session->userdata('authenticated');
    if (!$isLoggedIn) {
      redirect(base_url('auth'));
    }
  }

  public function inprocess()
  {
    $this->data['title'] = 'Dalam Proses';
    $this->data['page_title'] = 'Dalam Proses';
    $this->render('pages/scm/inprocess.php', $this->data);
  }
}
