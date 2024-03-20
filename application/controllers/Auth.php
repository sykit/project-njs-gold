<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {
	public function index(){
		$this->data['title'] = 'Welcome Home';
		$isLoggedIn = $this->session->userdata('authenticated');
		if ($isLoggedIn) {
			redirect(base_url('pages'));
		} else{
			$this->data['fgroup'] = $this->fgroup_model->get();
			$this->render('auth/login', $this->data);
		}
	}

	public function view_forgot(){
		$this->data['title'] = 'Welcome Home';
		$this->render('auth/forgot');
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url(""));
	}

	public function submit_register($type){
		$credential = $this->input->post('email', true);
		$credential = $this->input->post('username', true);
		$password = $this->input->post('password', true);
		$check_email = $this->auth_model->emailexist($email);

		if(count($check_email)){
			$this->session->set_flashdata('message1', 'Email sudah terdaftar mohon gunakan email lain');
			redirect(base_url("auth/register"));
		}else{
			$data = array(
				'id_user_ref' => $this->session->userdata('user_id'),
				'username' => $email,
				'email' => $email,
			);

			$register_submit = $this->auth_model->insert_user($data);
			$insertId = $this->db->insert_id();

			$data2 = array(
				'user_id' => $insertId,
				'password' => sha1($password),
			);

			$auth_submit = $this->auth_model->insert($data);

			if($auth_submit > 0){
				$this->session->set_flashdata('success', 'Pendaftaran berhasil. Sistem akan mengkonfirmasi akun anda');
				redirect(base_url("auth/login"));
			}else{
				$this->session->set_flashdata('message', 'Pendaftaran berhasil. Sistem akan mengkonfirmasi akun anda');
				redirect(base_url("auth/login"));
			}
		}
	}

	public function submit_login(){
		$credential = $this->input->post('credential', true);
		$password = $this->input->post('password', true);
		$resultAuth = $this->auth_model->authenticate($credential, $password);
		$useragent = getBrowserInfo();
		if (sizeof($resultAuth) > 0) {
			for ($i = 0; $i < count($resultAuth); $i++) {
				$session_data = NULL;
				$redirect_path = NULL;

				$activity_data = array(
					'user_id' => $resultAuth[$i]['user_id'],
					'activity' => 'login',
					'ip_address_visitor' => '',
					'browser_type' => $useragent['name'],
					'os' => $useragent['platform'],
					'date_created' => date("Y-m-d"),
					'time_created' => date('H:i:s'),
				);
				
				$this->useractivity_model->insert($activity_data);
				
				$session_data = array(
					'authenticated' => true,
					'func_group_id' => $resultAuth[$i]['func_group_id'],
					'func_group_name' => $resultAuth[$i]['func_group_name'],
					'user_id' => $resultAuth[$i]['user_id'],
					'username' => $resultAuth[$i]['username'],
					'email' => $resultAuth[$i]['email'],
					'surname' => $resultAuth[$i]['surname'],
				);
				$this->session->set_userdata($session_data);
				// var_dump($session_data);exit;
				redirect(base_url('pages'));
			}
		} else {
			$this->session->set_flashdata('message', 'Gagal, Mohon cek kembali data anda. Pastikan akun anda sudah diverifikasi oleh Admin');
			redirect(base_url(""));
		}
	}
}
