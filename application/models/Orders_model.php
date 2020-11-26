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

    public function get_all_order_info()
    {
        $this->db->select('tbl_orders.*', false);
        $this->db->from('tbl_orders');
        $this->db->order_by('tbl_orders.order_id', 'DESC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_all_customers()
    {
        $this->db->select('tbl_customer.*', false);
        $this->db->from('tbl_customer');
        $this->db->order_by('tbl_customer.LongName', 'ASC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    
    public function getRows($params = array()) {

        $this->db->select('tbl_orders.*,tbl_customer.*', false);
        $this->db->from('tbl_orders');
        $this->db->join('tbl_customer', 'tbl_customer.customer_id  =  tbl_orders.customer_id ', 'left');
        if (!empty($params['customer_id']) && $params['customer_id'] != NULL) {
            $this->db->where('tbl_orders.customer_id',$params['customer_id']);
            
//            if (!empty($params['search']['keywords']) && $params['search']['keywords'] != '' && $params['search']['keywords'] != '-') {
//                 $this->db->where("(OrderNo LIKE '%" . $params['search']['keywords'] . "%' OR DateIn LIKE '%".$params['search']['keywords']."%' OR DueDeliveryDate LIKE '%" . $params['search']['keywords'] . "%' "
//                            . "OR Status LIKE '%" . $params['search']['keywords'] . "%' OR tbl_customer.ShortName LIKE '%" . $params['search']['keywords'] . "%' OR tbl_customer.LongName LIKE '%" . $params['search']['keywords'] . "%' "
//                            . ")");
//            }
        }
//        else{
//            if (!empty($params['search']['keywords']) && $params['search']['keywords'] != '' && $params['search']['keywords'] != '-') {
//                 $this->db->where("(OrderNo LIKE '%" . $params['search']['keywords'] . "%' OR DateIn LIKE '%".$params['search']['keywords']."%' OR DueDeliveryDate LIKE '%" . $params['search']['keywords'] . "%' "
//                            . "OR Status LIKE '%" . $params['search']['keywords'] . "%' "
//                            . ")");
//            }
//        }
        if (!empty($params['search']['keywords']) && $params['search']['keywords'] != '' && $params['search']['keywords'] != '-') {
                 $this->db->where("(OrderNo LIKE '%" . $params['search']['keywords'] . "%' OR DateIn LIKE '%".$params['search']['keywords']."%' OR DueDeliveryDate LIKE '%" . $params['search']['keywords'] . "%' "
                            . "OR Status LIKE '%" . $params['search']['keywords'] . "%' OR tbl_customer.ShortName LIKE '%" . $params['search']['keywords'] . "%' OR tbl_customer.LongName LIKE '%" . $params['search']['keywords'] . "%' "
                            . ")");
            }

        if (array_key_exists("start", $params) && array_key_exists("limit", $params)) {
            $this->db->limit($params['limit'], $params['start']);
        } elseif (!array_key_exists("start", $params) && array_key_exists("limit", $params)) {
            $this->db->limit($params['limit']);
        }
        $this->db->order_by('tbl_orders.order_id', 'ASC');
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result_array() : FALSE;
    }
}
