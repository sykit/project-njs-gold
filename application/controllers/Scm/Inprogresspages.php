<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inprogresspages extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$isLoggedIn = $this->session->userdata('authenticated');
		if (!$isLoggedIn) {
			redirect(base_url('auth'));
		}
	}
	
	public function inprogress(){
        $this->data['title'] = 'Draf';
		$this->data['page_title'] = 'Draf';
		$this->render('pages/scm/inprogress.php', $this->data);
	}
}