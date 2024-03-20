<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Company_model extends CI_Model
{
    private $table = "company";
    private $table_comptype = "companytype";

    public function getAll(){
        $q = "SELECT * FROM company $this->table";
        return $this->db->query($q)->result();
    }

    public function getUserMapCompany($user_id){
        $q = "SELECT
            a.user_id,
            a.surname,
            a.company_id,
            b.company_name
            FROM
            user a,
            company b,
            company_type c
            WHERE c.company_type_id = b.company_type_id
            AND b.company_id = a.company_id AND a.user_id = ?";
            return $this->db->query($q, array($user_id))->result();
    }

    public function company($company_type_id){
        $q = "SELECT
              a.*
              FROM 
              company a,
              company_type b
              WHERE a.company_type_id = b.company_type_id
              AND a.company_type_id = ?";
            return $this->db->query($q, array($company_type_id))->result();                                                                                                                                                                       
    }

    public function user($company_id){
        $q = "SELECT
            a.company_id,
            a.company_name,
            a.company_owner_name,
            a.company_address
            FROM 
            company a,
            company_type b
            WHERE a.company_type_id = b.company_type_id
            AND a.company_id = ?";
            return $this->db->query($q, array($company_id))->result();
    }

    public function companyType(){
        $q = "SELECT company_type_id, company_type_name, is_internal FROM company_type WHERE is_internal = 0";
        return $this->db->query($q)->result();
    }

    function getCompanyById($company_id) {
        $q = "
            SELECT
                c.*, ct.company_type_name 
            FROM company c
                INNER JOIN company_type ct ON ct.company_type_id = c.company_type_id
            WHERE c.company_id = ?
        ";

        return $this->db->query($q, array($company_id))->result();
    }

}