<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asynccustomer extends MY_Controller {
    public function getAllCustomer(){
        $q = $this->customerdata_model->get_all_customer($this->input);
        echo json_encode($q);
    }
    public function getCustomer(){
        $q = $this->customerdata_model->get_customer($this->input);
        echo json_encode($q);
    }
    public function getClusterBySalesArea(){
        $id = $this->input->GET("sales_area_id");
        $q = $this->customerdata_model->get_cluster_by_sales_area($id);
        echo json_encode($q);
    }
    public function customerDetail(){
        $q = $this->customerdata_model->get_customer_byid($this->input);
        echo json_encode($q);
    }
}