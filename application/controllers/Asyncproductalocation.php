<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asyncproductalocation extends MY_Controller {
    public function getAllProductStock(){
        $q = $this->productalocation_model->get_all_product_stock($this->input);
        echo json_encode($q);
    }
    public function getNWOMDetail(){
        $q = $this->productalocation_model->get_detail_nwom($this->input);
        echo json_encode($q);
    }
    public function getListOrder(){
        $q = $this->productalocation_model->getListOrder($this->input);
        echo json_encode($q);
    }
    public function getSubCategory(){
        $id = $this->input->GET("product_category_id");
        $q = $this->productalocation_model->get_sub_category($id);
        echo json_encode($q);
    }
}