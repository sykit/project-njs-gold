<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Activity_model extends CI_Model {
    public function inprogress_count($user_id){
        $q = "select count(f.activity_name) as count
        from trans_header a,
             trans_pic_detail c,
             trans_status d,
             user e,
             activity f
        where a.th_id=c.th_id
          and a.trans_status_id in(-99,1)
          and a.trans_status_id=d.trans_status_id
          and a.activity_id=f.activity_id
          and a.n2=e.user_id
          and c.pic1=e.user_id
          and c.pic1= ?
        group by f.activity_name";
        return $this->db->query($q, array($user_id))->result();
    }

    public function inprogress_list($user_id){
        $q = "select f.activity_name, h.alias, f.activity_code, a.trans_code,a.trans_date,d.trans_status_name, d.trans_status_id, e.surname
        from trans_header a,
             trans_pic_detail c,
             trans_status d,
             user e,
             activity f,
             activity_group h
        where a.th_id=c.th_id
          and a.trans_status_id in(-99,1,5)
          and a.trans_status_id=d.trans_status_id
          and a.activity_id=f.activity_id
          and a.n2=e.user_id
          and c.pic1=e.user_id
          and h.activity_group_id = f.activity_category
          and c.pic1=?
         order by a.trans_date desc";
        
        return $this->db->query($q, array($user_id))->result();
    }

    public function incoming_count($func_group_id){
      $q = "select count(f.activity_name) as count
      from trans_header a,
           trans_pic_detail c,
           trans_status d,
           user e,
           activity f,
           functional_group g
      where a.th_id>0
        and a.th_id=c.th_id
        and a.trans_status_id not in(1,5,-99)
        and a.trans_status_id=d.trans_status_id
        and a.activity_id=f.activity_id
        and a.n2=e.user_id
        and a.next_pic=?
        and a.n3=g.func_group_id
        and e.user_id=c.pic1
        and c.pic2=?
        and c.pic2=g.func_group_id
      order by a.trans_date desc";

        return $this->db->query($q, array($func_group_id, $func_group_id))->result();
    }

    public function incoming_list($func_group_id){
      $q="select f.activity_name, h.alias, f.activity_code, a.trans_code,a.trans_date, d.trans_status_id, d.trans_status_name,e.surname,g.func_group_name
          from trans_header a,
              trans_pic_detail c,
              trans_status d,
              user e,
              activity f,
              functional_group g,
              activity_group h
          where a.th_id>0
            and a.th_id=c.th_id
            and a.trans_status_id not in(-99,1,5)
            and a.trans_status_id=d.trans_status_id
            and a.activity_id=f.activity_id
            and a.n2=e.user_id
            and a.next_pic=?
            and a.n3=g.func_group_id
            and e.user_id=c.pic1
            and c.pic2=?
            and c.pic2=g.func_group_id
            and h.activity_group_id = f.activity_category
          order by a.trans_date desc";

          return $this->db->query($q, array($func_group_id, $func_group_id))->result();
    }

    public function inprocess_count($user_id)
    {
        $q = "
            select count(f.activity_name) as count
            from
                trans_header a,
                trans_pic_detail c,
                trans_status d,
                user e,
                activity f
            where
                a.th_id=c.th_id
                and a.trans_status_id not in(1,5,-99)
                and a.trans_status_id=d.trans_status_id
                and a.activity_id=f.activity_id
                and a.n2=e.user_id
                and c.pic1=e.user_id
                and c.pic1=?
        ";

        return $this->db->query($q, array($user_id))->result();
    }

    public function inprocess_list($user_id){
        $q = "
            select
                f.activity_name,
                a.trans_code,
                a.trans_date,
                d.trans_status_name,
                d.trans_status_id,
                e.func_group_name,
                f.activity_code,
                h.alias
            from 
                trans_header a,
                trans_pic_detail c,
                trans_status d,
                functional_group e,
                activity f,
                user g,
                activity_group h
            where 
                a.th_id=c.th_id
                and a.trans_status_id not in(1,5)
                and a.trans_status_id=d.trans_status_id
                and a.activity_id=f.activity_id
                and a.n2=g.user_id
                and c.pic2=e.func_group_id
                and h.activity_group_id = f.activity_category
                and c.pic1=?
            order by a.trans_date desc
        ";
        
        return $this->db->query($q, array($user_id))->result();
    }

    public function complete_count($user_id){
        $q = "
            select count(f.activity_name) as count
            from trans_header a,
                trans_pic_detail c,
                trans_status d,
                user e,
                activity f
            where a.th_id=c.th_id
                and a.trans_status_id=5
                and a.trans_status_id=d.trans_status_id
                and a.activity_id=f.activity_id
                and a.n2=e.user_id
                and c.pic1=e.user_id
                and c.pic1=?
            group by f.activity_name
        ";

        return $this->db->query($q, array($user_id))->result();
    }

    public function complete_list($user_id){
        $q = "
            select
                f.activity_name,
                a.trans_code,
                a.trans_date,
                d.trans_status_name,
                e.surname
            from
                trans_header a,
                trans_pic_detail c,
                trans_status d,
                user e,
                activity f
            where
                a.th_id=c.th_id
                and a.trans_status_id=5
                and a.trans_status_id=d.trans_status_id
                and a.activity_id=f.activity_id
                and a.n2=e.user_id
                and c.pic1=e.user_id
                and c.pic1=?
            order by a.trans_date desc
        ";
        
        return $this->db->query($q, array($user_id))->result();
    }

    public function reject_count($func_group_id){
        $q = "select count(f.activity_name)
        from trans_header a,
             trans_pic_detail c,
             trans_status d,
             user e,
             activity f
        where a.th_id=c.th_id
          and a.trans_status_id=1
          and a.trans_status_id=d.trans_status_id
          and a.activity_id=f.activity_id
          and a.n2=e.user_id
          and c.pic1=e.user_id
          and c.pic1= ?
        group by f.activity_name";
        
        return $this->db->query($q, array($func_group_id))->result();
    }

    public function reject_list($func_group_id){
        $q = "select f.activity_name ,a.trans_code,a.trans_date,d.trans_status_name,e.surname
        from trans_header a,
             trans_pic_detail c,
             trans_status d,
             user e,
             activity f
        where a.th_id=c.th_id
          and a.trans_status_id in(-99,1)
          and a.trans_status_id=d.trans_status_id
          and a.activity_id=f.activity_id
          and a.n2=e.user_id
          and c.pic1=e.user_id
          and c.pic1= ?
         order by a.trans_date desc";

         return $this->db->query($q, array($func_group_id))->result();
    }

    public function update_trans_status($trans_code, $trans_status_id, $next_pic){
        $data = array(
            'trans_status_id' => $trans_status_id,
            'next_pic' => $next_pic
        );

        $this->db->where('trans_code', $trans_code);
        $this->db->update('trans_header', $data);
        return $this->db->affected_rows();
    }
}

?>