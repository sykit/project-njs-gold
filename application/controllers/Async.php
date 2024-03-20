<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Async extends MY_Controller {
    public function fetch_classtype(){
        $this->data['random_password'] =  $this->classtype_model->get();
        echo json_encode($this->data['random_password']);
    }

    public function fetch_subclasstype(){
        $id_classtype = $this->input->get('id_classtype');
        $this->data['random_password'] =  $this->subclasstype_model->get_subclass_parent($id_classtype);
        echo json_encode($this->data['random_password']);
    }

    public function fg_by_email(){
        $email = $this->input->post('email');
        $user = $this->user_model->get_fg_byemail($email);
        echo json_encode($user);
    }

    public function check_product_code(){
        $product_code = $this->input->post('product_class_code', true);
        $q = "SELECT * FROM product_class WHERE product_class_code ='$product_code'";
        $result = $this->db->query($q)->result();
        echo json_encode($result);
    }

    public function fetch_product_query($product_category_id, $prd_sub_cat_id, $product_rate, $product_weight){
        if($product_category_id == 0 &&
           $prd_sub_cat_id == 0 &&
           !strpos($product_rate, '-') && 
           $product_weight == 0){

            $q = "SELECT 
                a.product_class_id, 
                a.product_class_name, 
                a.image,
                b.product_category_id, 
                b.product_category_name,
                c.prd_sub_cat_id, 
                c.prd_sub_cat_name,
                d.prd_rate_id, 
                d.prd_rate_name,
                d.prd_rate_code,
                d.prd_rate_percentage
                FROM product_class a LEFT JOIN product_category b ON a.product_category_id = b.product_category_id
                                    LEFT JOIN product_sub_category c ON a.prd_sub_cat_id = c.prd_sub_cat_id
                                    LEFT JOIN product_rate d ON a.prd_rate_id = d.prd_rate_id
            ";
            $result = $this->db->query($q)->result();
            echo json_encode($result);
        }else{
            $q = "SELECT 
                a.product_class_id, 
                a.product_class_name, 
                a.image,
                b.product_category_id, 
                b.product_category_name,
                c.prd_sub_cat_id, 
                c.prd_sub_cat_name,
                d.prd_rate_id, 
                d.prd_rate_name,
                d.prd_rate_code,
                d.prd_rate_percentage,
                e.prd_class_rate_id2,
                e.prd_class_rate_id3,
                e.prd_class_rate_id4,
                e.prd_class_rate_id5,
                e.prd_class_rate_id6,
                e.prd_class_rate_id7,
                e.prd_class_rate_id8,
                e.prd_class_rate_id9,
                e.prd_class_rate_id10,
                e.prd_class_rate_id11,
                e.prd_class_rate_id12,
                e.prd_class_weight1,
                e.prd_class_weight2,
                e.prd_class_weight3,
                e.prd_class_weight4,
                e.prd_class_weight5,
                e.prd_class_weight6,
                e.prd_class_weight7,
                e.prd_class_weight8,
                e.prd_class_weight9,
                e.prd_class_weight10,
                e.prd_class_weight11,
                e.prd_class_weight12
                FROM product_class a LEFT JOIN product_category b ON a.product_category_id = b.product_category_id
                                    LEFT JOIN product_sub_category c ON a.prd_sub_cat_id = c.prd_sub_cat_id
                                    LEFT JOIN product_rate d ON a.prd_rate_id = d.prd_rate_id 
                                    LEFT JOIN product_class_detail e ON a.product_class_id  = e.product_class_id
            ";


            /**
             * Use casee
             * Jika
             * kat != 2
             * subkat != 2
             * rateid = 2,3,4,5
             * berat = 10
             */

            if($product_category_id != 0){ // jika kategori tidak kosong
                $q .= " WHERE a.product_category_id = " . $product_category_id;

                if($prd_sub_cat_id != 0){
                    $q .= " AND c.prd_sub_cat_id = " . $prd_sub_cat_id;
                    
                    if(strpos($product_rate, '-')){
                        $convert = str_replace('-', ',', $product_rate);
                        $q .= " AND  d.prd_rate_id IN ($convert)";
                    }

                    // $q .= " AND e.prd_class_weight1 <= " . $product_weight;
                }else{
                    // // jika sub category jg 0
                    if($prd_sub_cat_id == 0 && !strpos($product_rate, '-') && $product_weight == 0){
                        // jika subkategori 0, product rate 0, weight 0
                    }else{
                        if(strpos($product_rate, '-')){
                            $convert = str_replace('-', ',', $product_rate);
                            $q .= " AND  d.prd_rate_id IN ($convert)";
                        }
                    //     $q .= " AND e.prd_class_weight1 BETWEEN 0 AND " . $product_weight ;
                    }

                }
            }else{ // jika kategori kosong
                if(strpos($product_rate, '-')){
                    $convert = str_replace('-', ',', $product_rate);
                    $q .= " WHERE d.prd_rate_id IN ($convert)";
                }else{
                    $q .= " ";
                }

                // $q .= " OR e.prd_class_weight1 <= " . $product_weight . " AND e.prd_class_weight1 > 0" ;
            }
             
            $result = $this->db->query($q)->result();
            echo json_encode($result);
        }
    }

    
    public function fetch_product(){
        $q = "SELECT 
            a.product_class_id, 
            a.product_class_name, 
            a.image,
            b.product_category_id, 
            b.product_category_name,
            c.prd_sub_cat_id, 
            c.prd_sub_cat_name,
            d.prd_rate_id, 
            d.prd_rate_name,
            d.prd_rate_code,
            d.prd_rate_percentage
            FROM product_class a, product_category b, product_sub_category c, product_rate d 
            WHERE
            a.product_category_id = b.product_category_id AND
            c.product_category_id = a.product_category_id AND
            c.prd_sub_cat_id = a.prd_sub_cat_id AND
            a.prd_rate_id = d.prd_rate_id GROUP BY a.product_class_id ORDER BY a.product_class_name
        ";
        $result = $this->db->query($q)->result();
        
        $data = [];
        $data_result = [];
        foreach($result as $item){
            $data2 = array(     
              $item->product_class_name,
              $item->product_class_id,
              $item->image,
              $item->product_category_name,
              $item->prd_sub_cat_name,
              $item->prd_rate_code,
              $item->prd_rate_percentage,
           );
           
          array_push($data2);
          array_push($data, $data2);
        };


        foreach($data as $key=>$value){
                $data_temp = array(
                $value[0],
                $value[1],
                $value[2] == '' ? 'N/A' : $value[2],
                $value[3],
                $value[4],
                $value[5],
                $value[6]
                );
                array_push($data_temp);
                array_push($data_result, $data_temp);
        }

        echo json_encode(array('data' => $data_result, 'data_length' => sizeof($data_result)));
    }

    public function fetch_product_id($id){
        $q = "SELECT 
        a.product_class_id,
        a.product_class_name,
        a.product_class_code,
        a.sepuh_id,
        a.image,
        x.product_category_name,
        x.product_category_id,
        y.prd_sub_cat_id,
        y.prd_sub_cat_name,
        a.product_class_id as p_id,
        c.prd_rate_id as prd_rate_id,
        d.prd_rate_id as prd_class_rate_id2,
        e.prd_rate_id as prd_class_rate_id3,
        f.prd_rate_id as prd_class_rate_id4,
        g.prd_rate_id as prd_class_rate_id5,
        h.prd_rate_id as prd_class_rate_id6,
        i.prd_rate_id as prd_class_rate_id7,
        j.prd_rate_id as prd_class_rate_id8,
        k.prd_rate_id as prd_class_rate_id9,
        l.prd_rate_id as prd_class_rate_id10,
        m.prd_rate_id as prd_class_rate_id11,
        n.prd_rate_id as prd_class_rate_id12,
        IFNULL(CONCAT(c.prd_rate_code, ' (', c.prd_rate_name, ')'), '') as prd_class_rate_name,
        IFNULL(CONCAT(d.prd_rate_code, ' (', d.prd_rate_name, ')'), '') as prd_class_rate_name2,
        IFNULL(CONCAT(e.prd_rate_code, ' (', e.prd_rate_name, ')'), '') as prd_class_rate_name3,
        IFNULL(CONCAT(f.prd_rate_code, ' (', f.prd_rate_name, ')'), '') as prd_class_rate_name4,
        IFNULL(CONCAT(g.prd_rate_code, ' (', g.prd_rate_name, ')'), '') as prd_class_rate_name5,
        IFNULL(CONCAT(h.prd_rate_code, ' (', h.prd_rate_name, ')'), '') as prd_class_rate_name6,
        IFNULL(CONCAT(i.prd_rate_code, ' (', i.prd_rate_name, ')'), '') as prd_class_rate_name7,
        IFNULL(CONCAT(j.prd_rate_code, ' (', j.prd_rate_name, ')'), '') as prd_class_rate_name8,
        IFNULL(CONCAT(k.prd_rate_code, ' (', k.prd_rate_name, ')'), '') as prd_class_rate_name9,
        IFNULL(CONCAT(l.prd_rate_code, ' (', l.prd_rate_name, ')'), '') as prd_class_rate_name10,
        IFNULL(CONCAT(m.prd_rate_code, ' (', m.prd_rate_name, ')'), '') as prd_class_rate_name11,
        IFNULL(CONCAT(n.prd_rate_code, ' (', m.prd_rate_name, ')'), '') as prd_class_rate_name12,
        o.ring_size_id as ring_size_id1,
        p.ring_size_id as ring_size_id2,
        q.ring_size_id as ring_size_id3,
        r.ring_size_id as ring_size_id4,
        s.ring_size_id as ring_size_id5,
        t.ring_size_id as ring_size_id6,
        u.bracelet_size_id as bracelet_size_id,
        IFNULL(CONCAT('(', o.size, ', ', o.lingkar, ' cm',  ', ', o.diameter, ' cm', ') '), '') as ring_size1,
        IFNULL(CONCAT('(',p.size, ', ', p.lingkar, ' cm',  ', ', p.diameter, ' cm', ') '), '') as ring_size2,
        IFNULL(CONCAT('(',q.size, ', ', q.lingkar, ' cm',  ', ', q.diameter, ' cm', ') '), '') as ring_size3,
        IFNULL(CONCAT('(',r.size, ', ', r.lingkar, ' cm',  ', ', r.diameter, ' cm', ') '), '') as ring_size4,
        IFNULL(CONCAT('(',s.size, ', ', s.lingkar, ' cm',  ', ', s.diameter, ' cm', ') '), '') as ring_size5,
        IFNULL(CONCAT('(',t.size, ', ', t.lingkar, ' cm',  ', ', t.diameter, ' cm', ') '), '') as ring_size6,
        o.size as ring2_size1,
        p.size as ring2_size2,
        q.size as ring2_size3,
        r.size as ring2_size4,
        s.size as ring2_size5,
        t.size as ring2_size6,
        o2.ring_size_id as ring_size_id7,
        p2.ring_size_id as ring_size_id8,
        q2.ring_size_id as ring_size_id9,
        r2.ring_size_id as ring_size_id10,
        s2.ring_size_id as ring_size_id11,
        t2.ring_size_id as ring_size_id12,
        IFNULL(CONCAT('(',o2.size, ', ', o2.lingkar, ' cm',  ', ', o2.diameter, ' cm', ') '), '') as ring_size7,
        IFNULL(CONCAT('(',p2.size, ', ', p2.lingkar, ' cm',  ', ', p2.diameter, ' cm', ') '), '') as ring_size8,
        IFNULL(CONCAT('(',q2.size, ', ', q2.lingkar, ' cm',  ', ', q2.diameter, ' cm', ') '), '') as ring_size9,
        IFNULL(CONCAT('(',r2.size, ', ', r2.lingkar, ' cm',  ', ', r2.diameter, ' cm', ') '), '') as ring_size10,
        IFNULL(CONCAT('(',s2.size, ', ', s2.lingkar, ' cm',  ', ', s2.diameter, ' cm', ') '), '') as ring_size11,
        IFNULL(CONCAT('(',t2.size, ', ', t2.lingkar, ' cm',  ', ', t2.diameter, ' cm', ') '), '') as ring_size12,
        o2.size as ring2_size7,
        p2.size as ring2_size8,
        q2.size as ring2_size9,
        r2.size as ring2_size10,
        s2.size as ring2_size11,
        t2.size as ring2_size12,
        IFNULL(CONCAT('(', u.design, ', ', u.size, ') '), '') as bracelet_size,
        b.prd_class_weight1,
        b.prd_class_weight2,
        b.prd_class_weight3,
        b.prd_class_weight4, 
        b.prd_class_weight5,
        b.prd_class_weight6,
        b.prd_class_weight7,
        b.prd_class_weight8,
        b.prd_class_weight9,
        b.prd_class_weight10,
        b.prd_class_weight11,
        b.prd_class_weight12,
        z.sepuh_name,
        z.sepuh_code
        FROM
        product_class a LEFT JOIN
        product_class_detail b ON a.product_class_id = b.product_class_id
        LEFT JOIN product_rate c ON c.prd_rate_id = a.prd_rate_id
        LEFT JOIN product_rate d ON d.prd_rate_id = b.prd_class_rate_id2
        LEFT JOIN product_rate e ON e.prd_rate_id = b.prd_class_rate_id3
        LEFT JOIN product_rate f ON f.prd_rate_id = b.prd_class_rate_id4
        LEFT JOIN product_rate g ON g.prd_rate_id = b.prd_class_rate_id5
        LEFT JOIN product_rate h ON h.prd_rate_id = b.prd_class_rate_id6
        LEFT JOIN product_rate i ON i.prd_rate_id = b.prd_class_rate_id7
        LEFT JOIN product_rate j ON j.prd_rate_id = b.prd_class_rate_id8
        LEFT JOIN product_rate k ON k.prd_rate_id = b.prd_class_rate_id9
        LEFT JOIN product_rate l ON l.prd_rate_id = b.prd_class_rate_id10
        LEFT JOIN product_rate m ON m.prd_rate_id = b.prd_class_rate_id11
        LEFT JOIN product_rate n ON n.prd_rate_id = b.prd_class_rate_id12
        LEFT JOIN ring_size_reference o ON o.ring_size_id = b.ring_size_id1
        LEFT JOIN ring_size_reference p ON p.ring_size_id = b.ring_size_id2
        LEFT JOIN ring_size_reference q ON q.ring_size_id = b.ring_size_id3
        LEFT JOIN ring_size_reference r ON r.ring_size_id = b.ring_size_id4
        LEFT JOIN ring_size_reference s ON s.ring_size_id = b.ring_size_id5
        LEFT JOIN ring_size_reference t ON t.ring_size_id = b.ring_size_id6
        LEFT JOIN ring_size_reference o2 ON o2.ring_size_id = b.ring_size_id7
        LEFT JOIN ring_size_reference p2 ON p2.ring_size_id = b.ring_size_id8
        LEFT JOIN ring_size_reference q2 ON q2.ring_size_id = b.ring_size_id9
        LEFT JOIN ring_size_reference r2 ON r2.ring_size_id = b.ring_size_id10
        LEFT JOIN ring_size_reference s2 ON s2.ring_size_id = b.ring_size_id11
        LEFT JOIN ring_size_reference t2 ON t2.ring_size_id = b.ring_size_id12
        LEFT JOIN bracelet_size_reference u ON u.bracelet_size_id = b.bracelet_size_id

        LEFT JOIN product_category x ON x.product_category_id = a.product_category_id  
        LEFT JOIN product_sub_category y ON y.prd_sub_cat_id = a.prd_sub_cat_id
        LEFT JOIN sepuh z ON z.sepuh_id = a.sepuh_id
        WHERE 
        a.product_class_id = ?";
        $result = $this->db->query($q, array($id))->result();

        echo json_encode($result);
    }

    public function fetch_subcatbycat($product_category_id){
        $q = $this->subcategory_model->getBasedCategory($product_category_id);
        echo json_encode($q);
    }

    public function fetch_ratenameid($rate_id){
        $q = $this->subcategory_model->getBasedCategory($product_category_id);
        echo json_encode($q);
    }

    public function fetch_subcatbyproduct($product_class_id){
        $q = $this->product_model->getSubcatByProduct($product_class_id);
        echo json_encode($q);
    }

    public function fetch_products(){
        $q = "SELECT 
        a.product_class_id, 
        a.product_class_name, 
        a.image,
        b.product_category_id, 
        b.product_category_name,
        c.prd_sub_cat_id, 
        c.prd_sub_cat_name,
        d.prd_rate_id, 
        d.prd_rate_name,
        d.prd_rate_code,
        d.prd_rate_percentage
        FROM product_class a LEFT JOIN product_category b ON a.product_category_id = b.product_category_id
                            LEFT JOIN product_sub_category c ON a.prd_sub_cat_id = c.prd_sub_cat_id
                            LEFT JOIN product_rate d ON a.prd_rate_id = d.prd_rate_id
                            ORDER BY a.product_class_id DESC LIMIT 12
    ";
    $result = $this->db->query($q)->result();
    echo json_encode($result);
    }
}