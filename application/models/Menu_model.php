
<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
   public function get_menu_funcgroup($fgroup_id, $act_category){    
        $q = "SELECT 
                a.group_hdr_id,
                b.group_dtl_id,
                c.activity_id,
                c.activity_name,
                c.routes,
                c.activity_category,
                b.func_group_id
                FROM
                group_act_map_header a,
                group_activity_map_detail b,
                activity c,
                functional_group d
                WHERE a.activity_id = c.activity_id
                AND a.group_hdr_id = b.group_hdr_id
                AND d. func_group_id = b.func_group_id
                AND b.func_group_id = ?
                AND c.activity_category = ?";
        $result = $this->db->query($q, array($fgroup_id, $act_category))->result();
        echo json_encode($result);
   }
}