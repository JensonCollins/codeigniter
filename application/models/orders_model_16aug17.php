<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Orders_model extends MY_Model
{
    public $_table_name;
    public $_order_by;
    public $_primary_key;


    public function get_order_parts_info($order_id)
    {
        $this->db->select('tbl_order_parts.*');
        $this->db->from('tbl_order_parts');
        $this->db->join('tbl_orders', 'tbl_orders.order_id  =  tbl_order_parts.order_id ', 'left');
        $this->db->where('tbl_order_parts.order_id', $order_id);
        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }

}
