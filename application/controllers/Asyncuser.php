<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asyncuser extends MY_Controller {
    public function getDetail(){
        $q = $this->user_model->get_user_byid($this->input);
        echo json_encode($q);
    }
}