<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Asyncproductmovement extends MY_Controller
{
    public function getSummaryProductMovement($start_date, $end_date)
    {
        $summary_product_summary = $this->productmovementmonitoring_model->get_summary_product_movement($start_date, $end_date);
        echo json_encode($summary_product_summary);
    }

    public function getAllProductMovement($start_date, $end_date, $activity_id)
    {
        $q = $this->productmovementmonitoring_model->get_all_product_movement_with_activity_id($start_date, $end_date, $activity_id);
        echo json_encode($q);
    }
}
