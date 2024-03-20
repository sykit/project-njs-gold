<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller {
   public function __construct()
	{
      parent::__construct();
	}

	public function add(){
   }

   public function edit(){
   }

   public function delete(){
   }

   public function getCompanyById($company_id)
   {
      $q = $this->company_model->getCompanyById($company_id);
      echo json_encode($q[0]);
   }
}