<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Productmovementmonitoring_model extends CI_Model
{
	function get_summary_product_movement($start_date, $end_date) {
		$q = "
			SELECT
				SUM(CASE WHEN a.activity_id = 1 THEN b.n2 ELSE 0 END) AS jumlah_order,
				SUM(CASE WHEN a.activity_id = 13 THEN b.n2 ELSE 0 END) AS jumlah_verif,
				SUM(CASE WHEN a.activity_id = 14 THEN b.n2 ELSE 0 END) AS jumlah_spop,
				SUM(CASE WHEN a.activity_id = 15 THEN b.n2 ELSE 0 END) AS jumlah_GD,
				SUM(CASE WHEN a.activity_id = 16 THEN b.n2 ELSE 0 END) AS jumlah_GR
			FROM trans_header a
				JOIN trans_detail b ON a.th_id = b.th_id
				JOIN trans_pic_detail c ON a.th_id = c.th_id
			WHERE a.trans_status_id <> 1
				AND b.n2 IS NOT NULL
				AND c.date_submit1 BETWEEN ? AND ?
		";

		return $this->db->query($q, array($start_date . ' 00:00:00', $end_date . ' 23:59:59'))->result();
	}

	function get_all_product_movement_with_activity_id ($start_date, $end_date, $activity_id) {
		$q = "
			SELECT
				a.trans_code,
				f.activity_name,
				DATE_FORMAT(c.date_submit1, '%d/%m/%Y %H:%i:%s') AS submit_date,
				g.company_code,
				u.surname AS pic,
				d.product_category_name,
				e.prd_sub_cat_name,
				h.prd_rate_code,
				i.sepuh_code,
				b.n2 AS jumlah
			FROM trans_header a
				JOIN trans_detail b ON a.th_id = b.th_id
				JOIN trans_pic_detail c ON a.th_id = c.th_id
				JOIN product_category d ON b.product_category_id = d.product_category_id
				JOIN product_sub_category e ON b.product_sub_category_id = e.prd_sub_cat_id
				JOIN activity f ON a.activity_id = f.activity_id
				JOIN company g ON a.trans_loc2 = g.company_id
				JOIN product_rate h ON b.rate_id = h.prd_rate_id
				JOIN sepuh i ON b.sepuh_id = i.sepuh_id
				JOIN user u on u.user_id = c.pic1
			WHERE a.activity_id = ?
				AND a.trans_status_id <> 1
				AND b.n2 IS NOT NULL
				AND g.is_internal = 0
				AND c.date_submit1 BETWEEN ? AND ?
		";

		/**
		 * Activity ID untuk data product movement monitoring.
		 *
		 * activity_id = 1 		=> SOM
		 * activity_id = 13 	=> Verifikasi SOM
		 * activity_id = 14 	=> SPOP
		 * activity_id = 15 	=> Goods Delivery/Pengiriman Hasil Produksi
		 * activity_id = 16 	=> Goods Receipt/Penerimaan Hasil Produksi
		 */

		return $this->db->query($q, array($activity_id, $start_date . ' 00:00:00', $end_date . ' 23:59:59'))->result();
	}
}
