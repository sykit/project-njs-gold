<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scmdistributepages extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$isLoggedIn = $this->session->userdata('authenticated');
		if (!$isLoggedIn) {
			redirect(base_url('auth'));
		}
	}
	
	public function som(){
		$this->data['title'] = 'Surat Order Marketing';
		$this->data['page_title'] = 'Surat Order Marketing';
		$this->data['category'] = $this->category_model->get();
		$this->data['subcategory'] = $this->subcategory_model->get();
		$this->data['rate'] = $this->productrate_model->get();
		$this->data['trans_loc'] = $this->company_model->getUserMapCompany($this->session->userdata('user_id'));
		$this->data['activity_id'] = 1;
		$this->data['sepuh'] = $this->sepuh_model->get();
		$this->data['ringsize'] = $this->ringsize_model->get();
		$this->data['trans_status'] = $this->transactionstatus_model->getAll();
		$this->render('pages/scm/som.php', $this->data);
	}

	public function somdl(){
		$this->data['title'] = 'SOM Data Loader';
		$this->data['page_title'] = 'SOM Data Loader';
		$this->data['category'] = $this->category_model->get();
		$this->data['subcategory'] = $this->subcategory_model->get();
		$this->data['rate'] = $this->productrate_model->get();
		$this->data['trans_loc'] = $this->company_model->getUserMapCompany($this->session->userdata('user_id'));
		$this->data['activity_id'] = 1;
		$this->data['sepuh'] = $this->sepuh_model->get();
		$this->data['ringsize'] = $this->ringsize_model->get();
		$this->data['trans_status'] = $this->transactionstatus_model->getAll();
		$this->render('pages/scm/somdl.php', $this->data);
	}

	public function som_inprogress(){
		$th_code = $_GET['th_code'];
		$this->data['title'] = 'Surat Order Marketing';
		$this->data['page_title'] = 'Surat Order Marketing';
		$this->data['category'] = $this->category_model->get();
		$this->data['subcategory'] = $this->subcategory_model->get();
		$this->data['rate'] = $this->productrate_model->get();
		$this->data['trans_loc'] = $this->company_model->getUserMapCompany($this->session->userdata('user_id'));
		$this->data['activity_id'] = 1;
		$this->data['sepuh'] = $this->sepuh_model->get();
		$this->data['ringsize'] = $this->ringsize_model->get();
		$this->data['trans_header'] = $this->transheader_model->getTransHeaderByThCode($th_code);
		$this->data['trans_detail'] = $this->transdetail_model->getTransDetailByCode($th_code);
		$this->data['trans_pic_detail'] = $this->transpicdetail_model->getTranspicByThCode($th_code);
		$this->data['trans_status'] = $this->transactionstatus_model->getAll();
		$this->data['pic'] = $this->transpicdetail_model->picNameByThCode($th_code);
		$this->render('pages/scm/som-inprogress.php', $this->data);
	}

	public function som_inprocess(){
		$th_code = $_GET['th_code'];
		$this->data['title'] = 'Surat Order Marketing';
		$this->data['page_title'] = 'Surat Order Marketing';
		$this->data['category'] = $this->category_model->get();
		$this->data['subcategory'] = $this->subcategory_model->get();
		$this->data['rate'] = $this->productrate_model->get();
		$this->data['trans_loc'] = $this->company_model->getUserMapCompany($this->session->userdata('user_id'));
		$this->data['activity_id'] = 1;
		$this->data['sepuh'] = $this->sepuh_model->get();
		$this->data['ringsize'] = $this->ringsize_model->get();
		$this->data['trans_header'] = $this->transheader_model->getTransHeaderByThCode($th_code);
		$this->data['trans_detail'] = $this->transdetail_model->getTransDetailByCode($th_code);
		$this->data['trans_pic_detail'] = $this->transpicdetail_model->getTranspicByThCode($th_code);
		$this->data['trans_status'] = $this->transactionstatus_model->getAll();
		$this->data['pic'] = $this->transpicdetail_model->picNameByThCode($th_code);

		$this->render('pages/scm/som-inprocess.php', $this->data);
	}

	public function som_masuk(){
		$th_code = $_GET['th_code'];
		$this->data['title'] = 'Surat Order Marketing';
		$this->data['page_title'] = 'Surat Order Marketing';
		$this->data['category'] = $this->category_model->get();
		$this->data['subcategory'] = $this->subcategory_model->get();
		$this->data['rate'] = $this->productrate_model->get();
		$this->data['trans_loc'] = $this->company_model->getUserMapCompany($this->session->userdata('user_id'));
		$this->data['activity_id'] = 1;
		$this->data['sepuh'] = $this->sepuh_model->get();
		$this->data['ringsize'] = $this->ringsize_model->get();
		$this->data['trans_header'] = $this->transheader_model->getTransHeaderByThCode($th_code);
		$this->data['trans_detail'] = $this->transdetail_model->getTransDetailByCode($th_code);
		$this->data['trans_pic_detail'] = $this->transpicdetail_model->getTranspicByThCode($th_code);
		$this->data['trans_status'] = $this->transactionstatus_model->getAll();
		$this->data['pic'] = $this->transpicdetail_model->picNameByThCode($th_code);
		$this->render('pages/scm/som-masuk.php', $this->data);
	}

	public function som_complete(){
		$th_code = $_GET['th_code'];
		$this->data['title'] = 'Surat Order Marketing';
		$this->data['page_title'] = 'Surat Order Marketing';
		$this->data['category'] = $this->category_model->get();
		$this->data['subcategory'] = $this->subcategory_model->get();
		$this->data['rate'] = $this->productrate_model->get();
		$this->data['trans_loc'] = $this->company_model->getUserMapCompany($this->session->userdata('user_id'));
		$this->data['activity_id'] = 1;
		$this->data['sepuh'] = $this->sepuh_model->get();
		$this->data['ringsize'] = $this->ringsize_model->get();
		$this->data['trans_header'] = $this->transheader_model->getTransHeaderByThCode($th_code);
		$this->data['trans_detail'] = $this->transdetail_model->getTransDetailByCode($th_code);
		$this->data['trans_pic_detail'] = $this->transpicdetail_model->getTranspicByThCode($th_code);
		$this->data['trans_status'] = $this->transactionstatus_model->getAll();
		$this->data['pic'] = $this->transpicdetail_model->picNameByThCode($th_code);
		$this->render('pages/scm/som-complete.php', $this->data);
	}

	public function somv(){
		$som_th_code = $_GET['som_th_code'];
		$this->data['title'] = 'Verifikasi Surat Order Marketing';
		$this->data['page_title'] = 'Verifikasi Surat Order Marketing';
		$this->data['category'] = $this->category_model->get();
		$this->data['subcategory'] = $this->subcategory_model->get();
		$this->data['rate'] = $this->productrate_model->get();
		$this->data['trans_loc'] = $this->company_model->getUserMapCompany($this->session->userdata('user_id'));
		$this->data['sepuh'] = $this->sepuh_model->get();
		$this->data['ringsize'] = $this->ringsize_model->get();
		$this->data['trans_header'] = $this->transheader_model->getTransHeaderByThCode($som_th_code);
		$this->data['trans_detail'] = $this->transdetail_model->getTransDetailByCode($som_th_code);
		$this->data['trans_pic_detail'] = $this->transpicdetail_model->getTranspicByThCode($som_th_code);
		$this->data['trans_status'] = $this->transactionstatus_model->getAll();
		$this->render('pages/scm/somv.php', $this->data);
	}

	public function somv_inprogress(){
		$th_code = $_GET['th_code'];
		$this->data['title'] = 'Verifikasi Surat Order Marketing';
		$this->data['page_title'] = 'Verifikasi Surat Order Marketing';
		$this->data['category'] = $this->category_model->get();
		$this->data['subcategory'] = $this->subcategory_model->get();
		$this->data['rate'] = $this->productrate_model->get();
		$this->data['trans_loc'] = $this->company_model->getUserMapCompany($this->session->userdata('user_id'));
		$this->data['sepuh'] = $this->sepuh_model->get();
		$this->data['ringsize'] = $this->ringsize_model->get();
		$this->data['trans_header'] = $this->transheader_model->getTransHeaderByThCode($th_code);
		$this->data['trans_detail'] = $this->transdetail_model->getTransDetailByCode($th_code);
		$this->data['trans_pic_detail'] = $this->transpicdetail_model->getTranspicByThCode($th_code);
		$this->data['trans_status'] = $this->transactionstatus_model->getAll();
		$this->render('pages/scm/somv-inprogress.php', $this->data);
	}

	public function somv_inprocess(){
		$som_th_code = $_GET['th_code'];
		$this->data['title'] = 'Verifikasi Surat Order Marketing';
		$this->data['page_title'] = 'Verifikasi Surat Order Marketing';
		$this->data['category'] = $this->category_model->get();
		$this->data['subcategory'] = $this->subcategory_model->get();
		$this->data['rate'] = $this->productrate_model->get();
		$this->data['trans_loc'] = $this->company_model->getUserMapCompany($this->session->userdata('user_id'));
		$this->data['sepuh'] = $this->sepuh_model->get();
		$this->data['ringsize'] = $this->ringsize_model->get();
		$this->data['trans_header'] = $this->transheader_model->getTransHeaderByThCode($som_th_code);
		$this->data['trans_detail'] = $this->transdetail_model->getTransDetailByCode($som_th_code);
		$this->data['trans_pic_detail'] = $this->transpicdetail_model->getTranspicByThCode($som_th_code);
		$this->data['trans_status'] = $this->transactionstatus_model->getAll();
		$this->render('pages/scm/somv-inprocess.php', $this->data);
	}

	public function somv_complete(){
		$som_th_code = $_GET['th_code'];
		$this->data['title'] = 'Verifikasi Surat Order Marketing';
		$this->data['page_title'] = 'Verifikasi Surat Order Marketing';
		$this->data['category'] = $this->category_model->get();
		$this->data['subcategory'] = $this->subcategory_model->get();
		$this->data['rate'] = $this->productrate_model->get();
		$this->data['trans_loc'] = $this->company_model->getUserMapCompany($this->session->userdata('user_id'));
		$this->data['activity_id'] = 1;
		$this->data['sepuh'] = $this->sepuh_model->get();
		$this->data['ringsize'] = $this->ringsize_model->get();
		$this->data['trans_header'] = $this->transheader_model->getTransHeaderByThCode($som_th_code);
		$this->data['trans_detail'] = $this->transdetail_model->getTransDetailByCode($som_th_code);
		$this->data['trans_pic_detail'] = $this->transpicdetail_model->getTranspicByThCode($som_th_code);
		$this->data['trans_status'] = $this->transactionstatus_model->getAll();
		$this->render('pages/scm/somv-complete.php', $this->data);
	}

	public function por(){
		$this->data['title'] = 'Penerimaan Produk';
		$this->data['page_title'] = 'Penerimaan Produk';
		$this->data['category'] = $this->category_model->get();
		$this->data['subcategory'] = $this->subcategory_model->get();
		$this->data['rate'] = $this->productrate_model->get();
		$this->data['trans_loc'] = $this->company_model->getUserMapCompany($this->session->userdata('user_id'));
		$this->data['activity_id'] = 18;
		$this->data['sepuh'] = $this->sepuh_model->get();
		$this->data['ringsize'] = $this->ringsize_model->get();
		$this->data['trans_status'] = $this->transactionstatus_model->getAll();
		$this->render('pages/scm/por.php', $this->data);
	}
	public function por_inprogress(){
		$th_code = $_GET['th_code'];
		$this->data['title'] = 'Penerimaan Produk';
		$this->data['page_title'] = 'Penerimaan Produk';
		$this->data['category'] = $this->category_model->get();
		$this->data['subcategory'] = $this->subcategory_model->get();
		$this->data['rate'] = $this->productrate_model->get();
		$this->data['trans_loc'] = $this->company_model->getUserMapCompany($this->session->userdata('user_id'));
		$this->data['activity_id'] = 18;
		$this->data['sepuh'] = $this->sepuh_model->get();
		$this->data['ringsize'] = $this->ringsize_model->get();
		$data= $this->transheader_model->getTransHeaderByThCode($th_code);
		$th_code2= $data[0]->ref_doc;
		$th_id= $data[0]->th_id;
		// $data2= $this->transheader_model->getTransHeaderByThId($th_code2);

		// print_r($th_code2);
		// die;
		$this->data['trans_header'] = $data;
		$this->data['trans_header2'] = $this->transheader_model->getTransHeaderByThId($th_code2);
		$this->data['company'] = $this->transheader_model->getTransHeaderDetailCompany($th_code2);
		// print_r($th_code);
		// die;

		$this->data['trans_detail'] = $this->transdetail_model->getTransDetailByCode($th_code);
		$this->data['trans_detail2'] = $this->transdetail_model->getTransDetailByCode($th_code2);
		$this->data['trans_pic_detail'] = $this->transpicdetail_model->getTranspicByThCode($th_code);
		$this->data['trans_pic_detail2'] = $this->transpicdetail_model->getTranspicByThCode($th_code2);
		$this->data['trans_status'] = $this->transactionstatus_model->getAll();
		$this->data['total_berat'] = $this->transdetail_model->getTotalWeightByThId($th_id);
		$this->data['pic'] = $this->transpicdetail_model->picNameByThCode($th_code);
		$this->data['pic2'] = $this->transpicdetail_model->picNameByThCode($th_code2);
		$this->render('pages/scm/por-inprogress.php', $this->data);
	}

	public function por_inprocess(){
		$th_code = $_GET['th_code'];
		$this->data['title'] = 'Penerimaan Produk';
		$this->data['page_title'] = 'Penerimaan Produk';
		$this->data['category'] = $this->category_model->get();
		$this->data['subcategory'] = $this->subcategory_model->get();
		$this->data['rate'] = $this->productrate_model->get();
		$this->data['trans_loc'] = $this->company_model->getUserMapCompany($this->session->userdata('user_id'));
		$this->data['activity_id'] = 18;
		$this->data['sepuh'] = $this->sepuh_model->get();
		$this->data['ringsize'] = $this->ringsize_model->get();
		$data= $this->transheader_model->getTransHeaderByThCode($th_code);
		$th_code2= $data[0]->ref_doc;
		$th_id= $data[0]->th_id;
		// $data2= $this->transheader_model->getTransHeaderByThId($th_code2);

		// print_r($th_code2);
		// die;
		$this->data['trans_header'] = $data;
		$this->data['trans_header2'] = $this->transheader_model->getTransHeaderByThId($th_code2);
		$this->data['company'] = $this->transheader_model->getTransHeaderDetailCompany($th_code2);
		// print_r($th_code);
		// die;

		$this->data['trans_detail'] = $this->transdetail_model->getTransDetailByCode($th_code);
		$this->data['trans_detail2'] = $this->transdetail_model->getTransDetailByCode($th_code2);
		$this->data['trans_pic_detail'] = $this->transpicdetail_model->getTranspicByThCode($th_code);
		$this->data['trans_pic_detail2'] = $this->transpicdetail_model->getTranspicByThCode($th_code2);
		$this->data['trans_status'] = $this->transactionstatus_model->getAll();
		$this->data['total_berat'] = $this->transdetail_model->getTotalWeightByThId($th_id);
		$this->data['pic'] = $this->transpicdetail_model->picNameByThCode($th_code);
		$this->data['pic2'] = $this->transpicdetail_model->picNameByThCode($th_code2);
		// print_r($th_code);
		// die;

		$this->render('pages/scm/por-inprocess.php', $this->data);
	}
}