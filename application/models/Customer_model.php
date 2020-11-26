<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Customer_Model extends MY_Model
{
    public $_table_name;
    public $_order_by;
    public $_primary_key;

    public function get_customer_info($id = null) // this function is to get all customer info from tbl customer and tbl_customer_group
    {
        $this->db->select('tbl_customer.*', false);
        $this->db->select('tbl_customer_group.*', false);
        $this->db->from('tbl_customer');
        $this->db->join('tbl_customer_group', 'tbl_customer_group.customer_group_id  =  tbl_customer.customer_group_id ', 'left');
        if (!empty($id)) {
            //specific customer information needed
            $this->db->where('tbl_customer.customer_id', $id);
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
            //all customer information needed
            $query_result = $this->db->get();
            $result = $query_result->result();
        }

        return $result;
    }

    public function get_all_customer_info()
    {
        $this->db->select('tbl_customer.*', false);
        $this->db->from('tbl_customer');
        $this->db->order_by('tbl_customer.ShortName', 'ASC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
}
