<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asyncproductstock extends MY_Controller {
    public function getAllProductStock(){
        $q = $this->productstockmonitoring_model->get_all_product_stock($this->input);
        echo json_encode($q);
    }
    public function getDetailProductStock(){
        $q = $this->productstockmonitoring_model->get_Detail_product_stock($this->input);
        echo json_encode($q);
    }
    public function getProductStock(){
        $q = $this->productstockmonitoring_model->get_product_stock($this->input);
        echo json_encode($q);
    }
    public function getSubCategory(){
        $id = $this->input->GET("product_category_id");
        $q = $this->productstockmonitoring_model->get_sub_category($id);
        echo json_encode($q);
    }
}