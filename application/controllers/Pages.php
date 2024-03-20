<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$isLoggedIn = $this->session->userdata('authenticated');
		if (!$isLoggedIn) {
			redirect(base_url('auth'));
		}
	}

	// Catealog related pages

	public function index()
	{
		$this->data['title'] = 'Dashboard';
		$this->data['page_title'] = 'Dashboard';
		$this->data['page_title'] = 'Daftar Produk';
		$this->data['menu_category'] = $this->category_model->getByAlphabetical();
		$this->render('pages/product_list', $this->data);
	}

	public function product_management()
	{
		$this->data['title'] = 'Kelola Katalog Produk';
		$this->data['page_title'] = 'Kelola Katalog Produk';
		$this->data['category'] = $this->category_model->get();
		$this->data['subcategory'] = $this->subcategory_model->getWithCategory();
		$this->data['rate'] = $this->productrate_model->get();
		$this->data['sepuh'] = $this->sepuh_model->get();
		$this->data['ringsize'] = $this->ringsize_model->get();
		$this->data['braceletsize'] = $this->braceletsize_model->get();
		$this->render('pages/product_class', $this->data);
	}

	public function product_category(){
		$this->data['title'] = 'Kelola Sub Kategori Produk';
		$this->data['page_title'] = 'Kelola Sub Kategori Produk';
		$this->data['category'] = $this->category_model->get();
		$this->render('pages/product_category', $this->data);
	}

	public function product_subcategory(){
		$this->data['title'] = 'Kelola Sub Kategori Produk';
		$this->data['page_title'] = 'Kelola Sub Kategori Produk';
		$this->data['category'] = $this->category_model->get();
		$this->data['subcategory'] = $this->subcategory_model->getWithCategory();
		$this->render('pages/product_subcategory', $this->data);
	}

	public function product_list(){
		$this->data['title'] = 'Daftar Produk';
		$this->data['page_title'] = 'Daftar Produk';
		$this->data['menu_category'] = $this->category_model->getByAlphabetical();
		$this->render('pages/product_list', $this->data);
	}

	public function product_list_all(){
		$this->data['title'] = 'Daftar Produk';
		$this->data['page_title'] = 'Daftar Produk';
		$this->data['category'] = $this->category_model->get();
		$this->data['subcategory'] = $this->subcategory_model->getWithCategory();
		$this->data['rate'] = $this->productrate_model->get();
		$this->render('pages/product_list_all', $this->data);
	}

	

	// Administration related pages
	public function fgroup_management(){
		$this->data['title'] = 'Manajemen Kelola Fungsi Jabatan';
		$this->data['page_title'] = 'Manajemen Kelola Fungsi Jabatan';
		$this->data['fgroup'] = $this->fgroup_model->get();
		$this->render('pages/fgroup_list', $this->data);
	}

	public function akun()
	{
		$this->data['title'] = 'Akun Saya';
		$this->data['page_title'] = 'Akun Saya';
		$this->render('pages/akun', $this->data);
	}

	public function user_management(){
		$this->data['title'] = 'Manajemen User';
		$this->data['page_title'] = 'Akun Saya';
		$this->data['jabatan'] = $this->user_model->get_jabatan();
		$this->data['company'] = $this->company_model->getAll();
		$this->data['users'] = $this->user_model->get_all_user();
		$this->render('pages/user_list', $this->data);
	}

	public function company_type()
	{
		$this->data['title'] = 'Manajemen Tipe Perusahaan';
		$this->data['page_title'] = 'Manajemen Tipe Perusahaan';
		$this->render('pages/company_type', $this->data);
	}

	public function company()
	{
		$this->data['title'] = 'Manajemen Perusahaan';
		$this->data['page_title'] = 'Manajemen Perusahaan';
		$this->render('pages/company', $this->data);
	}


	// SCM related pages
	public function transactions(){
		$this->data['title'] = 'Transaksi';
		$this->data['page_title'] = 'Transaksi';
		$actgroup = $this->db->query('SELECT * FROM activity_group ORDER BY activity_group_id ASC')->result();
		$activity_group = array();
		foreach($actgroup as $item){
			$actmenu = $this->db->query('SELECT * FROM activity where activity_category = ? ', array($item->activity_group_id))->result();

			$activity = array();
			foreach($actmenu as $item2){
				$act = array(
					'activity_name' => $item2->activity_name,
					'activity_code' => $item2->activity_code,
					'is_initial_activity' => $item2->is_initial_activity,
					'routes' => $item2->routes
				);
				array_push($activity, $act);
			}

			$allactivity = array(
				'group_name' => $item->group_name,
				'activity_group_id' => $item->activity_group_id,
				'list' => $activity
			);
			array_push($activity_group, $allactivity);
		}

		// echo '<pre>';
		// var_dump(json_encode($activity_group));exit;
		// echo '</pre>';

		$this->data['allmenu'] = $activity_group;
		$this->render('pages/transactions', $this->data);
	}

	public function customer_data()
	{
		$this->data['title'] = 'Kelola Pelanggan';
		$this->data['page_title'] = 'Kelola Pelanggan';
		$this->data['jabatan'] = $this->user_model->get_jabatan();
		$this->data['company'] = $this->company_model->getAll();
		$this->data['company_type'] = $this->customerdata_model->get_company_type();
		$this->data['cluster'] = $this->customerdata_model->get_all_cluster();
		$this->data['sales_area'] = $this->customerdata_model->get_all_sales_area();
		$this->data['customer_internal'] = $this->customerdata_model->get_all_customer_internal();
		$this->data['customer'] = $this->customerdata_model->get_all_customer();
		$this->render('pages/customer_data', $this->data);
	}
	public function discount_data()
	{
		$this->data['title'] = 'Kelola Diskon Pelanggan';
		$this->data['page_title'] = 'Kelola Diskon Pelanggan';
		$this->data['jabatan'] = $this->user_model->get_jabatan();
		$this->data['company'] = $this->company_model->getAll();
		$this->data['company_type'] = $this->discount_model->get_company_type();
		$this->data['cluster'] = $this->discount_model->get_all_cluster();
		$this->data['sales_area'] = $this->discount_model->get_all_sales_area();
		$this->data['customer_internal'] = $this->discount_model->get_all_customer_internal();
		$this->data['customer'] = $this->discount_model->get_all_customer();
		$this->render('pages/discount_maintenance', $this->data);
	}

	public function product_stock_monitoring()
	{
		$this->data['title'] = 'Product Stock Monitoring';
		$this->data['page_title'] = 'Product Stock Monitoring';
		$this->data['category'] = $this->category_model->get();
		$this->data['subcategory'] = $this->subcategory_model->getWithCategory();
		$this->render('pages/product_stock_monitoring', $this->data);
	}

	public function product_movement_monitoring()
	{
		$this->data['title'] = 'Monitoring Pergerakan Produk';
		$this->data['page_title'] = 'Monitoring Pergerakan Produk';
		$this->data['category'] = $this->category_model->get();
		$this->data['subcategory'] = $this->subcategory_model->getWithCategory();
		$this->render('pages/product_movement_monitoring', $this->data);

	}
	public function product_alocation(){
		$this->data['title'] = 'Product Alocation';
		$this->data['page_title'] = 'Product Alocation';

		$this->data['category'] = $this->category_model->get();
		$this->data['subcategory'] = $this->subcategory_model->get();
		$this->data['rate'] = $this->productrate_model->get();
		$this->data['trans_loc'] = $this->company_model->getUserMapCompany($this->session->userdata('user_id'));
		$this->data['activity_id'] = 17;
		$this->data['sepuh'] = $this->sepuh_model->get();
		$this->data['ringsize'] = $this->ringsize_model->get();
		$this->data['trans_status'] = $this->transactionstatus_model->getAll();
		$this->data['nwom'] = $this->productalocation_model->get_all_nwom();
		$this->render('pages/product_alocation', $this->data);
	}
}