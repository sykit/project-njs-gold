<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Incomingpages extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$isLoggedIn = $this->session->userdata('authenticated');
		if (!$isLoggedIn) {
			redirect(base_url('auth'));
		}
	}
	
	public function incoming(){
        $this->data['title'] = 'Kotak Masuk';
		$this->data['page_title'] = 'Kotak Masuk';
		$this->render('pages/scm/incoming.php', $this->data);
	}
}