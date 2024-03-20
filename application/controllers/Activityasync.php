<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activityasync extends MY_Controller { 
   public function render_menu($fgroup_id, $activity_category){
      return $this->menu_model->get_menu_funcgroup($fgroup_id, $activity_category);
   }
}