<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('date');
        $this->load->helper('common_helper');
        $this->load->helper('number');
        $this->load->model('auth_model');
		$this->load->model('user_model');
		$this->load->model('useractivity_model');
    }

    public function render($view)
    {
        $this->data['inprogress_count'] = $this->activity_model->inprogress_count($this->session->userdata('user_id'));
        $this->data['inprogress_list'] = $this->activity_model->inprogress_list($this->session->userdata('user_id'));
        $this->data['incoming_count'] = $this->activity_model->incoming_count($this->session->userdata('func_group_id'));
        $this->data['incoming_list'] = $this->activity_model->incoming_list($this->session->userdata('func_group_id'));
        $this->data['inprocess_count'] = $this->activity_model->inprocess_count($this->session->userdata('user_id'));
        $this->data['inprocess_list'] = $this->activity_model->inprocess_list($this->session->userdata('user_id'));
        $this->data['complete_count'] = $this->activity_model->complete_count($this->session->userdata('user_id'));
        $this->data['complete_list'] = $this->activity_model->complete_list($this->session->userdata('user_id'));
        $this->load->view('header', $this->data);
        $this->load->view($view, $this->data);
        $this->load->view('footer', $this->data);
    }
}